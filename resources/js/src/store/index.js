import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

const store = new Vuex.Store({
  state() {
    return {
      user: {},
      completada: null,
      csrfToken: null,
      supervisor: {},
      categoria: null
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
    },
    setSupervisor(state, supervisor) {
      state.supervisor = supervisor
    },
    setCategoria(state, categoria) {
      state.categoria = categoria
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
    },
    async fetchSupervisor({commit}) {
      try {
        const response = await axios.get('http://localhost:8000/api/supervisor/67')
        commit('setSupervisor', response.data.supervisor)
      }
      catch (error) {
        throw error
      }
    },
    async fetchCategoria({commit}) {
      try {
        const response = await axios.get('http://localhost:8000/api/categoria/67')
        commit('setCategoria', response.data.categoria)
      }
      catch (error) {
        throw error
      }
    }
  },
  modules: {},
})
export default store;