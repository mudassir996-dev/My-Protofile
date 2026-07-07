<template>
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
</template>

<script>
import { ref, onMounted } from 'vue';

export default {
    name: 'ThemeToggle',
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
    }
};
</script>
