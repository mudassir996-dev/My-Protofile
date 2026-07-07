<template>
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
</template>

<script>
import { ref } from 'vue';

export default {
    name: 'ContactForm',
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
                // Get the CSRF token from the meta tag
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
    }
};
</script>
