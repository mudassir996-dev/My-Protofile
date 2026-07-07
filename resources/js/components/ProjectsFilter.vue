<template>
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
</template>

<script>
import { ref, computed } from 'vue';

export default {
    name: 'ProjectsFilter',
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
    }
};
</script>
