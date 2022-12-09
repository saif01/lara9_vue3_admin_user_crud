import { createRouter, createWebHistory } from 'vue-router'


const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            component: () => import('../pages/dashboard.vue'),
            name: 'Dashboard',
            meta: {
                title: 'Dashboard',
            },
        },

        {
            path: '/crud',
            component: () => import('../pages/crud.vue'),
            name: 'CRUD',
            meta: {
                title: 'CRUD',
            },
        },

        {
            path: '/about',
            component: () => import('../pages/dashboard.vue'),
            name: 'About',
            meta: {
                title: 'About',
            },
        },
    ],
});


// Run brfore every route request
router.beforeEach((to, from, next) => {

    let appName = 'Testing';
    let title = to.meta && to.meta.title ? to.meta.title : '';
    // set current title
    document.title = `${appName} ${title}`;

    next();
});


export default router;