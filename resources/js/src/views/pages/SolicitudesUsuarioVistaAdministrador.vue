<template>
    <div>
      <v-card class="overflow-hidden">
        <v-card-title>
          <h2 style="margin-bottom: 10px;"> Solicitudes del trabajador {{ `${user_name}` }}</h2>
          <v-spacer></v-spacer>
        </v-card-title>
        <v-data-table
          :headers="headers"
          :items="usreList"
          item-key="id"
          class="table-rounded"
          hide-default-footer
          :sort-by="['estado']"
        >

          <template #[`item.tipo`]="{item}">
            <div class="d-flex flex-column">
              <span class="d-block font-weight-semibold text--primary text-truncate"> {{ `${item.tipo}` }}</span>
            </div>
          </template>
          <template #[`item.descripcion`]="{item}">
            {{ `${item.descripcion}` }}
          </template>
          <template #[`item.estado`]="{item}">
            <v-chip
              small
              :color="getStatusColor(item.estado)"
              class="font-weight-medium"
            >
              {{ `${getStatusText(item.estado)}` }}
            </v-chip>
          </template>

        </v-data-table>
      </v-card>
      
    <div style="display:flex; flex-flow: row; justify-content: center; margin-top: 30px;">
        <v-btn color="warning"  :to="{ name: 'pages-empleados-detalles', params:{id: user_id} }">
            Volver
    </v-btn>
    </div>
    </div>

  
  </template>
  
  <style lang="scss">
  
  </style>
  
  <script>
  import store from '../../store/index.js';
  import { mdiMagnify } from '@mdi/js';
  import axios from 'axios';
  
  export default {
      async created() {
          axios.get("/api/solicitudes/" + this.$route.params.id,{
            headers: {
            'Authorization': 'Bearer ' + store.state._token
            },
            params:{
                'api_key':'secreto'
            }
        }).then(response => {
            this.usreList = response.data.solicitudes;
            this.user_name = response.data.solicitudes[0].user.name;
            this.user_id = response.data.solicitudes[0].user.id;
          });
      },
          data() {
              return {
                  search: '',
                  headers: [
                  { text: 'Tipo', value: 'tipo'},
                  { text: 'Descripción', value: 'descripcion' },
                  { text: 'Fecha inicio', value: 'fecha_inicio' },
                  { text: 'Fecha fin', value: 'fecha_fin' },
                  { text: 'Justificante', value: 'justificante' },
                  { text: 'Estado', value: 'estado' },
                  ],
                  usreList: [],
                  user_name: '',
                  user_id: '',
                  status: {
                    0: 'Pendiente',
                    1: 'Aprobada',
                    2: 'Denegada',
                  },
                  solicitudes: null
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
              getStatusText(estado){
                  return this.status[estado];
              },
              getStatusColor(estado){
                  return this.statusColor[this.status[estado]];
              }
          }
      }
  
  </script>
  
  <style>
  .filters-bar{
    display: flex;
    gap: 30px;
    padding: 0px 20px;
    height: min-content;
    width: 75%;
    margin-top: 20px;
  }
  .filters-bar-select{
    width: 200px!important;
    flex: 0 0 auto!important;
  }
  .filters-bar-search{
    max-width: 300px!important;
    margin-right: 50px!important;
  }
  
  .v-data-table{
    height: min-content!important;
    max-height: 600px!important;
  }
  
  .v-data-table__wrapper{
      height: min-content!important;
      max-height: 600px!important;
  }
  
  
  </style>