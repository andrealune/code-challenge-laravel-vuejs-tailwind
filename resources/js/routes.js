import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: "/",
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
