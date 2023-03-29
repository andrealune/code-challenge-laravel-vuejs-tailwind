import { createRouter, createWebHistory } from "vue-router"
// import store from '@stores'

// const baseURL = '/app'
import routes from './modules/index'

const router = createRouter({
    history: createWebHistory(),
    routes: routes
})

export default router