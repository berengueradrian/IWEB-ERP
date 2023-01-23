<template>
  <div>
    <v-card>
      <v-card-title>
        <h2 style="margin-bottom: 10px;">Solicitudes de vacaciones</h2>
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
        :items="filteredItems"
        :search="search"
        item-key="descripcion"
        class="table-rounded"
        hide-default-footer
        disable-sort
      >
        <template #[`item.user_id`]="{item}">
          <div class="d-flex flex-column">
            <span class="d-block font-weight-semibold text--primary text-truncate">{{ item.user_id }}</span>
          </div>
        </template>
        <template #[`item.descripcion`]="{item}">
          {{ `${item.descripcion}` }}
        </template>
        <template #[`item.estado`]="{item}">
          <v-chip
            small
            :color="statusColor[item.estado]"
            class="font-weight-medium"
          >
            {{ `${item.estado}` }}
          </v-chip>
        </template>
        <template #[`item.tipo`]="{item}">
          <div class="parent" v-if="item.estado == 'Pendiente'">
            <div class="child font-weight-medium">
              <v-btn
                color="success"
                @click="approve(item.id)"
              >
                Aprobar
              </v-btn>
            </div>
            <div class="child">
            <v-btn
              color="error"
              @click="deny(item.id)"
            >
              Denegar
            </v-btn>
            </div>
          </div>
        </template>
      </v-data-table>
    </v-card>
  </div>
</template>
    
<script>
  import store from '../../store/index.js';
  import axios from 'axios';
  import { mdiMagnify } from '@mdi/js';

  export default {
    async created() {
      await this.$store.dispatch('fetchSolicitudesVacaciones')
      this.usreList = this.$store.state.solicitudesVacaciones
    },
    data() {
      return {
        search: '',
        headers: [
        { text: 'Trabajador', value: 'user_id' },
        { text: 'Descripción', value: 'descripcion' },
        { text: 'Fecha inicio', value: 'fecha_inicio' },
        { text: 'Fecha fin', value: 'fecha_fin' },
        { text: 'Justificante', value: 'justificante' },
        { text: 'Estado', value: 'estado' },
        { text: '', value: 'tipo' },
        ],
        usreList: [],
        status: {
          0: 'Pendiente',
          1: 'Aprobada',
          2: 'Denegada',
        },
        solicitudes: null,
      }
    },
    computed: {
      filteredItems() {
        return this.usreList.map(item => {
          item.user_id = this.$store.state.usuariosSolicitudes[item.user_id]
          item.estado = this.status[item.estado];
          return item;
        });
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
        mdiMagnify,
      }
    },
    methods: {
      getStatusText(estado) {
        return this.status[estado]
      },
      async approve(id) {
        try {
          await axios.post('http://localhost:8000/api/solicitudes/' + id + '/aprobar', {},{
            headers: {
              'Authorization': 'Bearer ' + store.state._token
            }
          }).
          then(response => {
            console.log(response)
            this.actualizar()
            //this.solicitudes = JSON.parse(JSON.stringify(this.$store.state.solicitudesVacaciones))
          })
        } catch (error) {
          console.log(error)
        }
      },
      async deny(id) {
        try {
        await axios.post('http://localhost:8000/api/solicitudes/' + id + '/denegar', {},{
          headers: {
            'Authorization': 'Bearer ' + store.state._token
          }
        }).
        then(response => {
          console.log(response)
          this.actualizar()
          // this.$store.dispatch('fetchSolicitudesVacaciones')
          // this.usreList = JSON.parse(JSON.stringify(this.$store.state.solicitudesVacaciones))
          // this.solicitudes = JSON.parse(JSON.stringify(this.$store.state.solicitudesVacaciones))
        })
        } catch (error) {
          console.log(error)
        }
      },
      async actualizar() {
        await this.$store.dispatch('fetchSolicitudesVacaciones')
        this.$set(this, 'usreList', JSON.parse(JSON.stringify(this.$store.state.solicitudesVacaciones)))
        //this.usreList = this.$store.state.solicitudesVacaciones
        // this.solicitudes = JSON.parse(JSON.stringify(this.$store.state.solicitudesVacaciones))
      }
    },
  }
</script>

<style scoped>
  .parent {
    display: flex;
    flex-direction: row;
    justify-content: center;
  }
  .child {
    margin: 0 5px;
    font-size: medium;
  }
</style>