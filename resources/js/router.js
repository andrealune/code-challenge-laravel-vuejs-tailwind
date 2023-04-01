import { createRouter, createWebHistory } from 'vue-router'

import Login from './pages/Login.vue'
import Main from './pages/Main.vue'

const routes = [
  { path: '/', component: Login },
  { path: '/users', component: Main },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router
