<template>
  <v-navigation-drawer
    :value="isDrawerOpen"
    app
    floating
    width="260"
    class="app-navigation-menu"
    :right="$vuetify.rtl"
    @input="val => $emit('update:is-drawer-open', val)"
  >
    <!-- Navigation Header -->
    <div class="vertical-nav-header d-flex items-center ps-6 pe-5 pt-5 pb-2">
      <router-link to="/" class="d-flex align-center text-decoration-none">
        <v-img
          :src="require('@/assets/images/logos/logo.svg').default"
          max-height="30px"
          max-width="30px"
          alt="logo"
          contain
          eager
          class="app-logo me-3"
        ></v-img>
        <v-slide-x-transition>
          <h2 v-if="!$store.state.user.admin && !$store.state.user.supervisor" class="app-title text--primary">Empleado</h2>
          <h2 v-if="$store.state.user.supervisor" class="app-title text--primary">Supervisor</h2>
          <h2 v-if="$store.state.user.admin" class="app-title text--primary">Administrador</h2>
        </v-slide-x-transition>
      </router-link>
    </div>

    <!-- Navigation Items -->
    <v-list expand shaped class="vertical-nav-menu-items pr-5">
      <nav-menu-link v-if="!this.$store.state.user.admin && !this.$store.state.user.supervisor" title="Inicio" to="/empleado/dashboard" :icon="icons.mdiHomeOutline"></nav-menu-link>
      <nav-menu-link v-if="this.$store.state.user.admin || this.$store.state.user.supervisor" title="Inicio" to="/superole/dashboard" :icon="icons.mdiHomeOutline"></nav-menu-link>
      <nav-menu-link
        v-if="this.$store.state.user.supervisor"
        title="Gestión vacaciones"
        :to="{ name: 'pages-solicitudes-vacaciones' }"
        :icon="icons.mdiFileClockOutline"
      ></nav-menu-link>
      <nav-menu-link v-if="!this.$store.state.user.admin"
        title="Solicitudes"
        :to="{ name: 'pages-solicitudes' }"
        :icon="icons.mdiBookArrowUpOutline"
      ></nav-menu-link>
      <!-- solicitudes que recibe el administrador -->
      <nav-menu-link v-if="this.$store.state.user.admin" title="Solicitudes" :to="{ name: 'pages-solicitudes-administrador' }" :icon="icons.mdiBookArrowUpOutline"></nav-menu-link>
      <nav-menu-link title="Nóminas" :to="{ name: 'pages-nominas' }" :icon="icons.mdiFileChartOutline"></nav-menu-link> 
      <nav-menu-link v-if="this.$store.state.user.admin" title="Categorías" to="/pages/categorias" :icon="icons.mdiShapeOutline" ></nav-menu-link>
      <!-- <nav-menu-group title="Pages" :icon="icons.mdiFileOutline">
        <nav-menu-link title="Login" :to="{ name: 'login' }" target="_blank"></nav-menu-link>
        <nav-menu-link title="Register" :to="{ name: 'pages-register' }" target="_blank"></nav-menu-link>
        <nav-menu-link title="Error" :to="{ name: 'error-404' }" target="_blank"></nav-menu-link>
      </nav-menu-group> -->
      <!-- <nav-menu-section-title title="USER INTERFACE"></nav-menu-section-title>-->
      <!-- <nav-menu-link title="Icons" :to="{ name: 'icons' }" :icon="icons.mdiEyeOutline"></nav-menu-link>
      <nav-menu-link title="Cards" :to="{ name: 'cards' }" :icon="icons.mdiCreditCardOutline"></nav-menu-link>
      <nav-menu-link title="Tables" :to="{ name: 'simple-table' }" :icon="icons.mdiTable"></nav-menu-link>
      <nav-menu-link title="Form Layouts" :to="{ name: 'form-layouts' }" :icon="icons.mdiFormSelect"></nav-menu-link> -->
    </v-list>
    <a
      href="https://themeselection.com/products/materio-vuetify-vuejs-laravel-admin-template"
      target="_blank"
      rel="nofollow"
    >
      <v-img
        :src="require(`@/assets/images/pro/upgrade-banner-${$vuetify.theme.dark ? 'dark' : 'light'}.png`).default"
        alt="upgrade-banner"
        transition="scale-transition"
        class="upgrade-banner mx-auto"
        max-width="230"
      ></v-img>
    </a>
  </v-navigation-drawer>
</template>

<script>
// eslint-disable-next-line object-curly-newline
import {
  mdiHomeOutline,
  mdiShapeOutline,
  mdiAlphaTBoxOutline,
  mdiEyeOutline,
  mdiCreditCardOutline,
  mdiTable,
  mdiFileOutline,
  mdiFormSelect,
  mdiAccountCogOutline,
  mdiFileChartOutline,
  mdiBookArrowUpOutline,
  mdiFileClockOutline
} from '@mdi/js'
import NavMenuSectionTitle from './components/NavMenuSectionTitle.vue'
import NavMenuGroup from './components/NavMenuGroup.vue'
import NavMenuLink from './components/NavMenuLink.vue'

export default {
  components: {
    NavMenuSectionTitle,
    NavMenuGroup,
    NavMenuLink,
  },
  props: {
    isDrawerOpen: {
      type: Boolean,
      default: null,
    },
  },
  setup() {
    return {
      icons: {
        mdiHomeOutline,
        mdiAlphaTBoxOutline,
        mdiEyeOutline,
        mdiCreditCardOutline,
        mdiTable,
        mdiFileOutline,
        mdiFormSelect,
        mdiAccountCogOutline,
        mdiFileChartOutline,
        mdiBookArrowUpOutline,
        mdiShapeOutline,
        mdiFileClockOutline
      },
    }
  },
}
</script>

<style lang="scss" scoped>
@import '@resources/sass/preset/mixins.scss';

.app-title {
  font-size: 1.25rem;
  font-weight: 700;
  font-stretch: normal;
  font-style: normal;
  line-height: normal;
  letter-spacing: 0.3px;
}

// ? Adjust this `translateX` value to keep logo in center when vertical nav menu is collapsed (Value depends on your logo)
.app-logo {
  transition: all 0.18s ease-in-out;
  .v-navigation-drawer--mini-variant & {
    transform: translateX(-4px);
  }
}

@include theme(app-navigation-menu) using ($material) {
  background-color: map-deep-get($material, 'background');
}

.app-navigation-menu {
  .v-list-item {
    &.vertical-nav-menu-link {
      ::v-deep .v-list-item__icon {
        .v-icon {
          transition: none !important;
        }
      }
    }
  }
}

// You can remove below style
// Upgrade Banner
.app-navigation-menu {
  .upgrade-banner {
    position: absolute;
    bottom: 13px;
    left: 50%;
    transform: translateX(-50%);
  }
}
</style>
