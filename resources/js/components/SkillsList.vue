<template>
    <div ref="container" class="space-y-6">
        <div v-for="skill in skills" :key="skill.id" class="space-y-2">
            <div class="flex justify-between items-center text-sm font-semibold text-slate-700 dark:text-slate-300">
                <span class="flex items-center gap-2">
                    <!-- Basic generic placeholder or visual cue -->
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
</template>

<script>
import { ref, onMounted, onUnmounted } from 'vue';

export default {
    name: 'SkillsList',
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
    }
};
</script>
