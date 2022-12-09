import { createRouter, createWebHistory } from 'vue-router'

import Dashboard from '../index.vue'

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/admin/',
            component: () => import('./../pages/dashboard.vue'),
            name: 'Dashboard',
            meta: {
                title: 'Dashboard',
            },
        },
        {
            path: '/admin/about',
            component: () => import('./../pages/about.vue'),
            name: 'About',
            meta: {
                title: 'About',
            },
        },
    ],
});


// Run brfore every route request
router.beforeEach((to, from, next) => {

    let appName = 'Testing Admin';
    let title = to.meta && to.meta.title ? to.meta.title : '';
    // set current title
    document.title = `${appName} ${title}`;

    next();
});


export default router;