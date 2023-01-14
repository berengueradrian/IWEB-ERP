<template>
  <div>
    <div style="margin-bottom: 10px; margin-left: 10px;">
      <v-btn :to="{name: 'pages-solicitud-nueva'}" small color="primary"> Nueva solicitud </v-btn>
    </div>
    <v-card>
      <v-card-title>
          <h2 style="margin-bottom: 10px;">Solicitudes realizadas</h2>
          <v-spacer></v-spacer>
          <v-text-field
            v-model="search"
            label="Buscar"
            single-line
            hide-details
          ></v-text-field>
          <v-icon style="margin-top: 15px;">{{ mdiMagnify }}</v-icon>
      </v-card-title>
      <v-data-table
        :headers="headers"
        :items="usreList"
        item-key="descripcion"
        class="table-rounded"
        hide-default-footer
        disable-sort
      >
        <template #[`item.tipo`]="{item}">
          <div class="d-flex flex-column">
            <span class="d-block font-weight-semibold text--primary text-truncate">{{ item.tipo }}</span>
          </div>
          </template>
          <template #[`item.descripcion`]="{item}">
          {{ `${item.descripcion}` }}
          </template>
          <template #[`item.estado`]="{item}">
          <v-chip
            small
            :color="statusColor[status[item.estado]]"
            class="font-weight-medium"
          >
            {{ status[item.estado] }}
          </v-chip>
        </template>
      </v-data-table>
    </v-card>
  </div>
</template>
  
<script>
  import store from '../../store/index.js';
  import { mdiMagnify } from '@mdi/js';
  
  export default {
    async created() {
      //console.log(this.$store.state.user)
        await this.$store.dispatch('fetchSolicitudes')
        await this.$store.dispatch('fetchSolicitudesVacaciones')
        //console.log(this.$store.state)
        // console.log(this.$store.state.solicitudes)
        this.usreList = JSON.parse(JSON.stringify(this.$store.state.solicitudesVacaciones))
    },
    data() {
      return {
        mdiMagnify,
        search: '',
        headers: [
          { text: 'Tipo', value: 'tipo' },
          { text: 'Descripción', value: 'descripcion' },
          { text: 'Fecha inicio', value: 'fecha_inicio' },
          { text: 'Fecha fin', value: 'fecha_fin' },
          { text: 'Justificante', value: 'justificante' },
          { text: 'Estado', value: 'estado' },
        ],
        usreList: [],
        status: {
            0: 'Pendiente',
            1: 'Aprobada',
            2: 'Denegada',
        },
      }
    },
    setup() {
      const statusColor = {
        /* eslint-disable key-spacing */
        Pendiente: 'warning',
        Aprobada: 'success',
        Denegada: 'error',
        /* eslint-enable key-spacing */
      }
  
      return {
        store,
        statusColor,
      }
    },
  }
</script>