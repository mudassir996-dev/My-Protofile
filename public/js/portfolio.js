const { createApp, ref, onMounted, onUnmounted, computed } = Vue;

// -------------------------------------------------------------
// 1. Theme Toggle Component
// -------------------------------------------------------------
const ThemeToggle = {
    setup() {
        const isDark = ref(false);

        const toggleTheme = () => {
            isDark.value = !isDark.value;
            if (isDark.value) {
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            } else {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            }
        };

        onMounted(() => {
            const savedTheme = localStorage.getItem('theme');
            const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            
            if (savedTheme === 'dark' || (!savedTheme && systemPrefersDark)) {
                isDark.value = true;
                document.documentElement.classList.add('dark');
            } else {
                isDark.value = false;
                document.documentElement.classList.remove('dark');
            }
        });

        return {
            isDark,
            toggleTheme
        };
    },
    template: `
        <button 
            @click="toggleTheme" 
            class="p-2 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-800 dark:text-slate-200 hover:scale-110 transition-transform duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500"
            aria-label="Toggle Dark Mode"
        >
            <!-- Moon Icon (Shows in light mode) -->
            <svg v-if="!isDark" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
            </svg>
            <!-- Sun Icon (Shows in dark mode) -->
            <svg v-else xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707m12.8 12.8A9 9 0 1111 3v0a9 9 0 0112 9v0z" />
            </svg>
        </button>
    `
};

// -------------------------------------------------------------
// 2. AJAX Contact Form Component
// -------------------------------------------------------------
const ContactForm = {
    props: {
        submitUrl: {
            type: String,
            required: true
        }
    },
    setup(props) {
        const form = ref({
            name: '',
            email: '',
            subject: '',
            message: ''
        });

        const loading = ref(false);
        const errors = ref({});
        const successMessage = ref('');
        const errorMessage = ref('');

        const submitForm = async () => {
            loading.value = true;
            errors.value = {};
            successMessage.value = '';
            errorMessage.value = '';

            try {
                const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

                const response = await fetch(props.submitUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': token || ''
                    },
                    body: JSON.stringify(form.value)
                });

                const data = await response.json();

                if (response.ok) {
                    successMessage.value = data.message || 'Your message has been sent successfully!';
                    form.value = { name: '', email: '', subject: '', message: '' };
                } else if (response.status === 422) {
                    errors.value = data.errors || {};
                } else {
                    errorMessage.value = data.message || 'Something went wrong. Please try again.';
                }
            } catch (error) {
                errorMessage.value = 'Failed to submit the form. Please check your internet connection and try again.';
                console.error('Submission error:', error);
            } finally {
                loading.value = false;
            }
        };

        return {
            form,
            loading,
            errors,
            successMessage,
            errorMessage,
            submitForm
        };
    },
    template: `
        <form @submit.prevent="submitForm" class="space-y-6 bg-white dark:bg-slate-800 p-8 rounded-2xl shadow-xl border border-slate-100 dark:border-slate-700/50">
            <div v-if="successMessage" class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 border border-green-200 dark:border-green-800" role="alert">
                <span class="font-semibold">Success!</span> {{ successMessage }}
            </div>
            
            <div v-if="errorMessage" class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 border border-red-200 dark:border-red-800" role="alert">
                <span class="font-semibold">Error!</span> {{ errorMessage }}
            </div>

            <div>
                <label for="name" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Your Name</label>
                <input 
                    type="text" 
                    id="name" 
                    v-model="form.name" 
                    required 
                    class="w-full px-4 py-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                    :class="{'border-red-500 focus:ring-red-500': errors.name}"
                />
                <p v-if="errors.name" class="mt-1 text-sm text-red-600 dark:text-red-400">{{ errors.name[0] }}</p>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Your Email</label>
                <input 
                    type="email" 
                    id="email" 
                    v-model="form.email" 
                    required 
                    class="w-full px-4 py-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                    :class="{'border-red-500 focus:ring-red-500': errors.email}"
                />
                <p v-if="errors.email" class="mt-1 text-sm text-red-600 dark:text-red-400">{{ errors.email[0] }}</p>
            </div>

            <div>
                <label for="subject" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Subject</label>
                <input 
                    type="text" 
                    id="subject" 
                    v-model="form.subject" 
                    required 
                    class="w-full px-4 py-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                    :class="{'border-red-500 focus:ring-red-500': errors.subject}"
                />
                <p v-if="errors.subject" class="mt-1 text-sm text-red-600 dark:text-red-400">{{ errors.subject[0] }}</p>
            </div>

            <div>
                <label for="message" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Message</label>
                <textarea 
                    id="message" 
                    rows="5" 
                    v-model="form.message" 
                    required 
                    class="w-full px-4 py-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                    :class="{'border-red-500 focus:ring-red-500': errors.message}"
                ></textarea>
                <p v-if="errors.message" class="mt-1 text-sm text-red-600 dark:text-red-400">{{ errors.message[0] }}</p>
            </div>

            <button 
                type="submit" 
                :disabled="loading"
                class="w-full py-4 px-6 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white font-semibold transition-all duration-200 transform active:scale-[0.98] disabled:opacity-50 disabled:cursor-not-allowed flex justify-center items-center gap-2"
            >
                <svg v-if="loading" class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span>{{ loading ? 'Sending...' : 'Send Message' }}</span>
            </button>
        </form>
    `
};

// -------------------------------------------------------------
// 3. Projects Filter Grid Component
// -------------------------------------------------------------
const ProjectsFilter = {
    props: {
        projects: {
            type: Array,
            required: true
        },
        tags: {
            type: Array,
            required: true
        }
    },
    setup(props) {
        const selectedTag = ref('All');

        const selectTag = (tag) => {
            selectedTag.value = tag;
        };

        const filteredProjects = computed(() => {
            if (selectedTag.value === 'All') {
                return props.projects;
            }
            return props.projects.filter(project => {
                return project.tech_stack && project.tech_stack.includes(selectedTag.value);
            });
        });

        return {
            selectedTag,
            selectTag,
            filteredProjects
        };
    },
    template: `
        <div class="space-y-10">
            <!-- Filter Controls -->
            <div class="flex flex-wrap justify-center gap-2 md:gap-3">
                <button 
                    @click="selectTag('All')" 
                    class="px-5 py-2.5 rounded-full text-sm font-semibold transition-all duration-300 shadow-sm border focus:outline-none"
                    :class="selectedTag === 'All' 
                        ? 'bg-indigo-600 border-indigo-600 text-white shadow-indigo-100 dark:shadow-none' 
                        : 'bg-white dark:bg-slate-800 border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 hover:border-slate-300 dark:hover:border-slate-600'"
                >
                    All Projects
                </button>
                <button 
                    v-for="tag in tags" 
                    :key="tag"
                    @click="selectTag(tag)" 
                    class="px-4 py-2 rounded-full text-sm font-semibold transition-all duration-300 shadow-sm border focus:outline-none"
                    :class="selectedTag === tag 
                        ? 'bg-indigo-600 border-indigo-600 text-white shadow-indigo-100 dark:shadow-none' 
                        : 'bg-white dark:bg-slate-800 border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 hover:border-slate-300 dark:hover:border-slate-600'"
                >
                    {{ tag }}
                </button>
            </div>

            <!-- Projects Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div 
                    v-for="project in filteredProjects" 
                    :key="project.id"
                    class="group bg-white dark:bg-slate-800 rounded-2xl shadow-lg hover:shadow-xl border border-slate-100 dark:border-slate-700/50 overflow-hidden transition-all duration-300 flex flex-col h-full transform hover:-translate-y-1"
                >
                    <!-- Thumbnail -->
                    <div class="relative overflow-hidden aspect-video bg-slate-100 dark:bg-slate-900 border-b border-slate-100 dark:border-slate-700/30">
                        <img 
                            v-if="project.image" 
                            :src="'/storage/' + project.image" 
                            :alt="project.title"
                            class="object-cover w-full h-full group-hover:scale-105 transition-transform duration-500"
                        />
                        <div v-else class="flex items-center justify-center w-full h-full bg-gradient-to-br from-indigo-50 to-purple-50 dark:from-slate-800 dark:to-slate-900 text-slate-400 dark:text-slate-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-indigo-500/60 dark:text-indigo-400/40" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                            </svg>
                        </div>
                    </div>

                    <!-- Body -->
                    <div class="p-6 flex flex-col flex-grow">
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2 leading-tight group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                            {{ project.title }}
                        </h3>
                        <p class="text-sm text-slate-600 dark:text-slate-400 mb-6 flex-grow leading-relaxed">
                            {{ project.description }}
                        </p>

                        <!-- Tech Stack Tags -->
                        <div class="flex flex-wrap gap-1.5 mb-6">
                            <span 
                                v-for="tech in project.tech_stack" 
                                :key="tech"
                                class="px-2.5 py-1 text-xs font-semibold rounded bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300"
                            >
                                {{ tech }}
                            </span>
                        </div>

                        <!-- Actions -->
                        <div class="flex items-center gap-4 mt-auto border-t border-slate-100 dark:border-slate-700/50 pt-4">
                            <a 
                                v-if="project.live_url" 
                                :href="project.live_url" 
                                target="_blank" 
                                rel="noopener"
                                class="flex items-center gap-1.5 text-sm font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                                Live Demo
                            </a>
                            <a 
                                v-if="project.github_url" 
                                :href="project.github_url" 
                                target="_blank" 
                                rel="noopener"
                                class="flex items-center gap-1.5 text-sm font-semibold text-slate-600 dark:text-slate-400 hover:text-slate-800 dark:hover:text-white"
                            >
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0016 8c0-4.42-3.58-8-8-8z"/>
                                </svg>
                                GitHub
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `
};

// -------------------------------------------------------------
// 4. Skills List Component
// -------------------------------------------------------------
const SkillsList = {
    props: {
        skills: {
            type: Array,
            required: true
        }
    },
    setup() {
        const container = ref(null);
        const isVisible = ref(false);
        let observer = null;

        onMounted(() => {
            observer = new IntersectionObserver((entries) => {
                if (entries[0].isIntersecting) {
                    isVisible.value = true;
                    if (observer && container.value) {
                        observer.unobserve(container.value);
                    }
                }
            }, {
                threshold: 0.1
            });

            if (container.value) {
                observer.observe(container.value);
            }
        });

        onUnmounted(() => {
            if (observer) {
                observer.disconnect();
            }
        });

        return {
            container,
            isVisible
        };
    },
    template: `
        <div ref="container" class="space-y-6">
            <div v-for="skill in skills" :key="skill.id" class="space-y-2">
                <div class="flex justify-between items-center text-sm font-semibold text-slate-700 dark:text-slate-300">
                    <span class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-indigo-500"></span>
                        {{ skill.name }}
                    </span>
                    <span>{{ skill.proficiency }}%</span>
                </div>
                
                <div class="h-2.5 w-full bg-slate-100 dark:bg-slate-700 rounded-full overflow-hidden">
                    <div 
                        class="h-full bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full transition-all duration-1000 ease-out"
                        :style="{ width: isVisible ? skill.proficiency + '%' : '0%' }"
                    ></div>
                </div>
            </div>
        </div>
    `
};

// -------------------------------------------------------------
// Initialize and mount apps on DOM loaded
// -------------------------------------------------------------
document.addEventListener('DOMContentLoaded', () => {
    // 1. Dark Theme Toggle
    const themeToggleApp = document.getElementById('theme-toggle-app');
    if (themeToggleApp) {
        createApp(ThemeToggle).mount(themeToggleApp);
    }

    // 2. AJAX Contact Form
    const contactFormApp = document.getElementById('contact-form-app');
    if (contactFormApp) {
        const submitUrl = contactFormApp.getAttribute('data-submit-url');
        createApp(ContactForm, { submitUrl }).mount(contactFormApp);
    }

    // 3. Projects Filter Grid
    const projectsFilterApp = document.getElementById('projects-filter-app');
    if (projectsFilterApp) {
        const projects = JSON.parse(projectsFilterApp.getAttribute('data-projects') || '[]');
        const tags = JSON.parse(projectsFilterApp.getAttribute('data-tags') || '[]');
        createApp(ProjectsFilter, { projects, tags }).mount(projectsFilterApp);
    }

    // 4. Grouped Skills progress bars
    const skillsApps = document.querySelectorAll('.skills-list-app');
    skillsApps.forEach(appElement => {
        const skills = JSON.parse(appElement.getAttribute('data-skills') || '[]');
        createApp(SkillsList, { skills }).mount(appElement);
    });
});
