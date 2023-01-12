import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

var store = new Vuex.Store({
  state() {
    return {
      user: JSON.parse(localStorage.getItem('user')),
      //user: null,
      completada: null,
      csrfToken: null,
      supervisor: {},
      categoria: null,
      jornadas: null,
      nominas: null,
      solicitudes: null,
      solicitudesVacaciones: null,
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
    },
    setJornadas(state, jornadas) {
      state.jornadas = jornadas
    },
    setNominas(state, nominas) {
      state.nominas = nominas
    },
    setSolicitudes(state, solicitudes) {
      state.solicitudes = solicitudes
    },
    setSolicitudesVacaciones(state, solicitudesVacaciones) {
      state.solicitudesVacaciones = solicitudesVacaciones
    }
  },
  actions: {
    actualiseUser({commit}, user) {
      commit('setUser', user)
      //localStorage.setItem('user', JSON.stringify(user))
    },
    async fetchUser({commit}) {
      try {
        /* const response = await axios.get('http://localhost:8000/api/users/1')
        commit('setUser', response.data) */
      }
      catch (error) {
        throw error
      }
    },
    async fetchCompletada({commit}) {
      try {
        /* const response = await axios.get('http://localhost:8000/api/jornada/1')
        commit('setCompletada', response.data.jornada) */
      }
      catch (error) {
        throw error
      }
    },
    async fetchSupervisor({commit}) {
      try {
        /* const response = await axios.get('http://localhost:8000/api/supervisor/1')
        commit('setSupervisor', response.data.supervisor) */
      }
      catch (error) {
        throw error
      }
    },
    async fetchCategoria({commit}) {
      try {
        /* const response = await axios.get('http://localhost:8000/api/categoria/1')
        commit('setCategoria', response.data.categoria) */
      }
      catch (error) {
        throw error
      }
    },
    async fetchJornadas({commit}) {
      try {
        /* const response = await axios.get('http://localhost:8000/api/jornadas/1')
        commit('setJornadas', response.data.jornadas) */
      }
      catch (error) {
        throw error
      }
    },
    async fetchNominas({commit}) {
      try {
        /* const response = await axios.get('http://localhost:8000/api/nominas/1')
        commit('setNominas', response.data.nominas) */
      }
      catch (error) {
        throw error
      }
    },
    async fetchSolicitudes({commit}) {
      try {
        /* const response = await axios.get('http://localhost:8000/api/solicitudes/1')
        commit('setSolicitudes', response.data.solicitudes) */
      }
      catch (error) {
        throw error
      }
    },
    async fetchSolicitudesVacaciones({commit}) {
      try {
        const response = await axios.get('http://localhost:8000/api/solicitudesVacaciones/65')
        commit('setSolicitudesVacaciones', response.data.solicitudesVacaciones)
      }
      catch (error) {
        throw error
      }
    }
  },
  modules: {},
})
export default store;