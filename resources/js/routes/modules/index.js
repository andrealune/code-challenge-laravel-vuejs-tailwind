/* Layouts */
const AppLayout = () => import("../../Layouts/App.vue");
const ErrorLayout = () => import("../../Layouts/Error.vue");

import contact from './contact'
import dashboard from './dashboard'
import errorRoutes from './error'

export default [
    {
        path: '/',
        name: 'ContactList',
        meta: {
            label: 'List Contact',
        },
        component: () => import('../../pages/ContactList.vue'),
    },
    {
        path: '/create',
        name: 'ContactCreate',
        meta: {
            label: 'Add Contact',
        },
        component: () => import('../../pages/Action.vue'),
    },
    {
        path: '/:id/edit',
        name: 'ContactEdit',
        meta: {
            label: 'Edit Contact',
        },
        component: () => import('../../pages/Action.vue'),
    },
    // ...dashboard,
    // ...contact,
    // {
    //     path: '/',
    //     name: 'App',
    //     component: AppLayout,
    //     redirect: { name: 'Dashboard' },
    //     children: [
    //         ...dashboard,
    //         ...contact,
    //     ]
    // },
    // {
    //     path: '/',
    //     name: 'Error',
    //     component: ErrorLayout,
    //     children: [
    //         ...errorRoutes,
    //     ]
    // },
    // {
    //     path: '/:pathMatch(.*)*',
    //     meta: {
    //         isNotNav: true,
    //     },
    //     beforeEnter: (to, from, next) => {
    //         next({ name: 'Error404', replace: true, query: { 'ref': to.fullPath, 'from': from.fullPath } })
    //     }
    // }
];
