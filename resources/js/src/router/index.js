import Vue from 'vue'
import VueRouter from 'vue-router'
import store from '@/store'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    redirect: () => {
      if (store.state.user === null) {
        return 'login'
      }
      else if (store.state.user.admin || store.state.user.supervisor) {
        return 'superole/dashboard'
      }
      else {
        return 'empleado/dashboard'
      }
    },
  },
  {
    path: '/login',
    name: 'login',
    component: () => import('@/views/pages/Login.vue'),
    meta: {
      layout: 'blank',
    },
  },
  {
    path: '/empleado/dashboard',
    name: 'empleado-dashboard',
    component: () => import('@/views/dashboard/Dashboard.vue'),
    meta: {
      auth: true,
      base: true
    }
  },
  {
    path: '/superole/dashboard',
    name: 'superole-dashboard',
    component: () => import('@/views/dashboard/DashboardSuper.vue'),
    meta: {
      auth: true,
      super: true
    },
  },
  {
    path: '/superole/nuevo',
    name: 'superole-nuevo',
    component: () => import('@/views/NuevoEmpleado.vue'),
    meta: {
      auth: true,
      super: true
    },
  },
  {
    path: '/typography',
    name: 'typography',
    component: () => import('@/views/typography/Typography.vue'),
  },
  {
    path: '/icons',
    name: 'icons',
    component: () => import('@/views/icons/Icons.vue'),
  },
  {
    path: '/cards',
    name: 'cards',
    component: () => import('@/views/cards/Card.vue'),
  },
  {
    path: '/simple-table',
    name: 'simple-table',
    component: () => import('@/views/simple-table/SimpleTable.vue'),
  },
  {
    path: '/form-layouts',
    name: 'form-layouts',
    component: () => import('@/views/form-layouts/FormLayouts.vue'),
  },
  {
    path: '/pages/account-settings',
    name: 'pages-account-settings',
    component: () => import('@/views/pages/account-settings/AccountSettings.vue'),
  },
  {
    path: '/pages/solicitudes',
    name: 'pages-solicitudes',
    component: () => import('@/views/pages/Solicitudes.vue'),
  },
  {
    path: '/pages/solicitud/nueva',
    name: 'pages-solicitud-nueva',
    component: () => import('@/views/pages/NuevaSolicitud.vue'),
  },
  {
    path: '/pages/vacaciones',
    name: 'pages-solicitudes-vacaciones',
    component: () => import('@/views/pages/SolicitudesSupervisorVacaciones.vue'),
  },
  {
    path: '/pages/categorias',
    name: 'pages-categorias',
    component: () => import('@/views/pages/Categorias.vue'),
  },
  {
    path: '/pages/categorias/nueva',
    name: 'pages-categorias-nueva',
    component: () => import('@/views/pages/NuevaCategoria.vue'),
  },
  {
    path: '/pages/categorias/editar/:id',
    name: 'pages-categorias-editar',
    component: () => import('@/views/pages/EditarCategoria.vue'),
  },
  {
    path: '/pages/nominas',
    name: 'pages-nominas',
    component: () => import('@/views/nomina/Nominas.vue'),
  },
  {
    path: '/pages/superole/dashboard/editar/:id',
    name: 'pages-empleados-editar',
    component: () => import('@/views/pages/EditarEmpleados.vue'),
  },
  {
    path: '/pages/superole/dashboard/:id',
    name: 'pages-empleados-detalles',
    component: () => import('@/views/pages/DetallesEmpleados.vue'),
  },
  {
    path: '/pages/superole/solicitudes/',
    name: 'pages-solicitudes-administrador',
    component: () => import('@/views/pages/SolicitudesAdministrador.vue'),
  },
  {
    path: '/pages/superole/solicitudes/:id',
    name: 'pages-solicitudes-usuario-administrador',
    component: () => import('@/views/pages/SolicitudesUsuarioVistaAdministrador.vue'),
  },
  {
    path: '/pages/register',
    name: 'pages-register',
    component: () => import('@/views/pages/Register.vue'),
    meta: {
      layout: 'blank',
    },
  },
  {
    path: '/error-404',
    name: 'error-404',
    component: () => import('@/views/Error.vue'),
    meta: {
      layout: 'blank',
    },
  },
  {
    path: '*',
    redirect: 'error-404',
  },
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes,
})

router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.auth) && store.state.user === null && to.name !== 'login') {
    next({
      name: "login"
    });
  }
  if (to.matched.some(record => record.meta.base) && store.state.user !== null && (store.state.user.admin || store.state.user.supervisor)) {
    next({
      name: "error-404"
    })
  }
  if (to.matched.some(record => record.meta.admin) && store.state.user !== null && !store.state.user.admin) {
    next({
      name: "error-404"
    })
  }
  if (to.matched.some(record => record.meta.super) && store.state.user !== null && !store.state.user.supervisor && !store.state.user.admin) {
    next({
      name: "error-404"
    })
  }
  else {
    next();
  }
})

export default router
