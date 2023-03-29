export default [
    {
        path: 'contacts',
        name: 'Contact',
        redirect: { name: 'ContactList' },
        meta: {
            label: 'Contact',
            icon: 'fas fa-projects'
        },
        component: {
            template: '<router-view></router-view>'
        },
        children: [
            {
                path: '/',
                name: 'ContactList',
                meta: {
                    label: 'List Contact',
                },
                component: () => import('../../pages/ContactList.vue'),
            },
            {
                path: 'create',
                name: 'ContactCreate',
                meta: {
                    label: 'Add Contact',
                },
                component: () => import('../../pages/Action.vue'),
            },
            {
                path: ':id/edit',
                name: 'ContactEdit',
                meta: {
                    label: 'Edit Contact',
                },
                component: () => import('../../pages/Action.vue'),
            },
            /* {
                path: ':id',
                name: 'ContactShow',
                meta: {
                    label: 'Contact Detail',
                },
                component: () => import('@views/Pages/Project/Show'),
            } */
        ]
    },
]
