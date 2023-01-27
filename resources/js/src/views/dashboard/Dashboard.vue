<template>
  <v-row>
    <v-col
      cols="12"
      md="4"
    >
      <dashboard-fichar></dashboard-fichar>
    </v-col>

    <v-col
      cols="12"
      md="8"
    >
      <dashboard-datos-usuario></dashboard-datos-usuario>
    </v-col>

    <v-col
      cols="12"
      md="4"
    >
      <v-row class="match-height">
        <v-col
          cols="12"
          sm="6"
        >
          <v-card>
            <v-card-title class="align-start">
              <v-avatar
                color="warning"
                size="38"
                class="elevation-3"
              >
                <v-icon
                  size="24"
                  color="white"
                  class="rounded-0"
                >
                  {{ mdiCalendarClockOutline }}
                </v-icon>
              </v-avatar>
              <v-spacer></v-spacer>
            </v-card-title>

            <v-card-text class="text-no-wrap text--primary mt-3">
              <p class="font-weight-semibold text-sm mb-1">
                Horas totales
              </p>
              <p class="font-weight-semibold text-sm mb-1">
                trabajadas 
              </p>

              <div class="d-flex align-end flex-wrap">
                <span class="font-weight-semibold text-2xl me-1 mb-2">{{ this.$store.state.horasTotales }}</span>
              </div>
            </v-card-text>
          </v-card>
        </v-col>
        <v-col
          cols="12"
          sm="6"
        >
          <v-card>
            <v-card-title class="align-start">
              <v-avatar
                color="success"
                size="38"
                class="elevation-3"
              >
                <v-icon
                  size="24"
                  color="white"
                  class="rounded-0"
                >
                  {{ mdiAccountCashOutline }}
                </v-icon>
              </v-avatar>
              <v-spacer></v-spacer>
            </v-card-title>

            <v-card-text class="text-no-wrap text--primary mt-3">
              <p class="font-weight-semibold text-sm mb-1">
                Nóminas
              </p>
              <p class="font-weight-semibold text-sm mb-1">
                recibidas 
              </p>

              <div class="d-flex align-end flex-wrap">
                <span class="font-weight-semibold text-2xl me-1 mb-2">{{ this.nominasCount }}</span>
              </div>
            </v-card-text>
          </v-card>
        </v-col>
        
        <v-col
          cols="12"
          sm="6"
        >
          <v-card>
            <v-card-title class="align-start">
              <v-avatar
                color="primary"
                size="38"
                class="elevation-3"
              >
                <v-icon
                  size="24"
                  color="white"
                  class="rounded-0"
                >
                  {{ mdiBookArrowUpOutline }}
                </v-icon>
              </v-avatar>
              <v-spacer></v-spacer>
            </v-card-title>

            <v-card-text class="text-no-wrap text--primary mt-3">
              <p class="font-weight-semibold text-sm mb-1">
                Solicitudes
              </p>
              <p class="font-weight-semibold text-sm mb-1">
                realizadas 
              </p>

              <div class="d-flex align-end flex-wrap">
                <span class="font-weight-semibold text-2xl me-1 mb-2">{{ this.solicitudesCount }}</span>
              </div>
            </v-card-text>
          </v-card>
        </v-col>

        <v-col
          cols="12"
          sm="6"
        >
          <v-card>
            <v-card-title class="align-start">
              <v-avatar
                color="info"
                size="38"
                class="elevation-3"
              >
                <v-icon
                  size="24"
                  color="white"
                  class="rounded-0"
                >
                  {{ mdiAccountGroupOutline }}
                </v-icon>
              </v-avatar>
              <v-spacer></v-spacer>
            </v-card-title>

            <v-card-text class="text-no-wrap text--primary mt-3">
              <p class="font-weight-semibold text-sm mb-1">
                Compañeros 
              </p>
              <p class="font-weight-semibold text-sm mb-1">
                de equipo 
              </p>

              <div class="d-flex align-end flex-wrap">
                <span class="font-weight-semibold text-2xl me-1 mb-2">{{ this.$store.state.numeroCompaneros }}</span>
              </div>
            </v-card-text>
          </v-card>
        </v-col>
      </v-row>
    </v-col>

    <v-col
      cols="12"
      md="8"
    >
      <dashboard-jornadas></dashboard-jornadas>
    </v-col>


    <!-- <v-col
      cols="12"
      sm="6"
      md="4"
    >
      <dashboard-weekly-overview></dashboard-weekly-overview>
    </v-col>

    <v-col
      cols="12"
      md="4"
      sm="6"
    >
      <dashboard-card-total-earning></dashboard-card-total-earning>
    </v-col>
    <v-col
      cols="12"
      md="8"
    >
      <dashboard-card-deposit-and-withdraw></dashboard-card-deposit-and-withdraw>
    </v-col>
    <v-col cols="12">
      <dashboard-datatable></dashboard-datatable>
    </v-col> -->
  </v-row>
</template>

<script>
import store from '../../store/index.js';
import { mdiAccountGroupOutline, mdiBookArrowUpOutline, mdiAccountCashOutline, mdiCalendarClockOutline } from '@mdi/js';
// demos
import DashboardFichar from './DashboardFichar.vue'
import DashboardDatosUsuario from './DashboardDatosUsuario.vue'
import DashboardCardTotalEarning from './DashboardCardTotalEarning.vue'
import DashboardCardDepositAndWithdraw from './DashboardCardDepositAndWithdraw.vue'
import DashboardWeeklyOverview from './DashboardWeeklyOverview.vue'
import DashboardDatatable from './DashboardDatatable.vue'
import DashboardJornadas from './DashboardJornadas.vue'

export default {
  components: {
    DashboardFichar,
    DashboardDatosUsuario,
    DashboardJornadas,
    DashboardCardTotalEarning,
    DashboardCardDepositAndWithdraw,
    DashboardWeeklyOverview,
    DashboardDatatable
  },
  async created() {
    await this.$store.dispatch('fetchHorasTotales')
    await this.$store.dispatch('fetchNumeroCompaneros')
    await this.$store.dispatch('fetchSolicitudes')
    await this.$store.dispatch('fetchAllNominas')
    await this.$store.dispatch('fetchNominas')
    this.solicitudesCount = this.$store.state.solicitudes.length
    this.nominasCount = this.$store.state.nominas_usuario.length
  },
  setup() {
    return {
      store,
      mdiAccountGroupOutline,
      mdiAccountCashOutline,
      mdiCalendarClockOutline,
      mdiBookArrowUpOutline,
    }
  },
  data: () => ({
    solicitudesCount: 0,
    nominasCount: 0,
  }),
}
</script>
