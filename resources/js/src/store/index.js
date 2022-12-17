import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

const store = new Vuex.Store({
  state() {
    return {
      user: {},
      completada: null,
      csrfToken: null
    }
  },
  mutations: {
    setUser(state, user) {
      state.user = user
    },
    setToken(state) {
      state.csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    },
    setCompletada(state, completada) {
      state.completada = completada
    }
  },
  actions: {
    async fetchUser({commit}) {
      try {
        const response = await axios.get('http://localhost:8000/api/users/67')
        commit('setUser', response.data)
      }
      catch (error) {
        throw error
      }
    },
    async fetchCompletada({commit}) {
      try {
        const response = await axios.get('http://localhost:8000/api/jornada/67')
        commit('setCompletada', response.data.jornada)
      }
      catch (error) {
        throw error
      }
    }
  },
  modules: {},
})
export default store;