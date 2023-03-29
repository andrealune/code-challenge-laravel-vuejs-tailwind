export default [
    {
        path: 'error',
        name: 'Error',
        meta: {
            title: 'Something went wrong!',
        },
        component: () => import('../../../pages/Errors/Index.vue'),
    },
    {
        path: '404',
        name: 'Error404',
        meta: {
            title: 'Page not found!',
        },
        component: () => import('../../../pages/Errors/404.vue'),
    },
]
