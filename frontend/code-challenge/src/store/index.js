import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    token: null,
  },
  getters: {
    getToken: state => state.token,
  },
  mutations: {
    SET_TOKEN(state, token){
      state.token = token;
    },
    REMOVE_TOKEN(state) {
      state.token = null;
    },
  },
  actions: {
    setToken({ commit }, token){
      commit('SET_TOKEN', token);
      localStorage.setItem('token', token);
    },
    removeToken({ commit }) {
      commit('REMOVE_TOKEN');
      localStorage.removeItem('token');
    },
  },
  modules: {

  }
})
