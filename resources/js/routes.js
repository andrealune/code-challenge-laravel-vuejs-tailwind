import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: "/register",
        name: "register",
        component: () => import("./pages/Register.vue"),
        meta: {
            middleware: "guest",
            title: `Register`,
        },
    },
    {
        path: "/login",
        name: "login",
        component: () => import("./pages/Login.vue"),
        meta: {
            middleware: "guest",
            title: `Login`,
        },
    },
    {
        path: "/",
        meta: {
            middleware: "auth",
        },
        component: () => import("./layouts/Base.vue"),
        children: [
            {
                path: "/contacts",
                name: "contacts",
                component: () => import("./pages/Contacts.vue"),
            },
            {
                path: "/contacts/create",
                name: "create-contact",
                component: () => import("./pages/ContactCreate.vue"),
            },
            {
                path: "/contacts/:id/edit",
                name: "update-contact",
                component: () => import("./pages/ContactCreate.vue"),
            },
            {
                path: "",
                redirect: "/contacts",
            },
        ],
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
