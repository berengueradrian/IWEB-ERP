<template>
  <v-card>
    <v-card-title class="align-start">
      <span class="font-weight-semibold">{{$store.state.user.email}} </span>
      <v-spacer></v-spacer>
      <v-btn
        icon
        small
        class="me-n3 mt-n2"
      >
      </v-btn>
    </v-card-title>

    <v-card-subtitle class="mb-8 mt-n5">
      <span class="font-weight-semibold text--primary me-1">{{this.user.name}}</span>
    </v-card-subtitle>

    <v-card-text>
      <v-row>
        <v-col cols="6" md="3" class="d-flex align-center">
          <v-avatar size="44" color='success' rounded class="elevation-1">
            <v-icon dark color="white" size="30">
              {{ icons.mdiCalendarBlank }}
            </v-icon>
          </v-avatar>
          <div class="ms-3">
            <p class="text-xs mb-0">
              Fecha nacimiento
            </p>
            <h3 class="text-xs font-weight-semibold">
              {{ $store.state.user.fechaNacimiento }}
            </h3>
          </div>
        </v-col>
        <v-col cols="6" md="3" class="d-flex align-center">
          <v-avatar size="44" color='warning' rounded class="elevation-1">
            <v-icon dark color="white" size="30">
              {{ icons.mdiFolderAccountOutline }}
            </v-icon>
          </v-avatar>
          <div class="ms-3">
            <p class="text-xs mb-0">
              Formación
            </p>
            <h3 class="text-xs font-weight-semibold">
              {{ $store.state.user.formacion }}
            </h3>
          </div>
        </v-col>
        <v-col cols="6" md="3" class="d-flex align-center">
          <v-avatar size="44" color='info' rounded class="elevation-1">
            <v-icon dark color="white" size="30">
              {{ icons.mdiAccountTieOutline }}
            </v-icon>
          </v-avatar>
          <div class="ms-3">
            <p class="text-xs mb-0">
              Supervisor
            </p>

            <h3 v-if="this.supervisor.name" class="text-xs font-weight-semibold">
              {{ this.supervisor.name }}
            </h3>
            <h3 v-else class="text-xs font-weight-semibold">
              Ninguno
            </h3>

          </div>
        </v-col>
        <v-col cols="6" md="3" class="d-flex align-center">
          <v-avatar size="44" color='primary' rounded class="elevation-1">
            <v-icon dark color="white" size="30">
              {{ icons.mdiLabelOutline }}
            </v-icon>
          </v-avatar>
          <div class="ms-3">
            <p class="text-xs mb-0">
              Sección
            </p>
            <h3 class="text-xs font-weight-semibold">
              {{ this.categoria.name }}
            </h3>
          </div>
        </v-col>
      </v-row>
    </v-card-text>
  </v-card>
</template>

<script>
  import { mdiAccountOutline, mdiLabelOutline, mdiCalendarBlank, mdiFolderAccountOutline, mdiAccountEyeOutline, mdiAccountTieOutline } from '@mdi/js'

  import store from '../../store/index.js';

  export default {
    setup() {
      return {
        store,
        icons: {
          mdiAccountOutline,
          mdiLabelOutline,
          mdiCalendarBlank,
          mdiFolderAccountOutline,
          mdiAccountTieOutline
        },
      }
    },
    async created() {
      await this.$store.dispatch('fetchUser')
      await this.$store.dispatch('fetchCompletada')
      await this.$store.dispatch('fetchCategoria')
      await this.$store.dispatch('fetchSupervisor')
      //console.log(this.$store.state.supervisor)
    },
    computed: {
      user() {
        return this.$store.state.user
      },
      completada() {
        return this.$store.state.completada
      },
      categoria() {
        return this.$store.state.categoria
      },
      supervisor() {
        return this.$store.state.supervisor
      },
    },
    data() {
      return {
      }
    },

  }
</script>
