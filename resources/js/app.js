import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

// Vue 3 Integration
import { createApp } from 'vue';
import ThemeToggle from './components/ThemeToggle.vue';
import ContactForm from './components/ContactForm.vue';
import ProjectsFilter from './components/ProjectsFilter.vue';
import SkillsList from './components/SkillsList.vue';

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
