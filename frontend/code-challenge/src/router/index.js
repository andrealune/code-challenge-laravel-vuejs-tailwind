import Vue from 'vue'
import VueRouter from 'vue-router'
import HomeView from '../views/HomeView.vue'
import LoginView from '../views/LoginView.vue'
import store from '@/store/index';

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView,
    meta: {requiresAuth: true},
  },
  {
    path: '/login',
    name: 'login',
    component: LoginView
  },
  {
    path: '*',
    redirect: '/login'
  }
]

const router = new VueRouter({
  routes
})

router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.requiresAuth)) {
    // Verifica si el usuario tiene un token válido en el localStorage
    const token = localStorage.getItem('token');
    if (!token) {
      next({ path: '/login' }); // Redirige al login si no hay token
    } else {
      store.commit('SET_TOKEN', token); // Actualiza el estado del token en Vuex
      next();
    }
  } else {
    next();
  }
});

export default router
