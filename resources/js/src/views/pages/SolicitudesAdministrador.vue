<template>
  <div>
    <v-card>
      <v-card-title>
        <h2 style="margin-bottom: 10px;">Solicitudes recibidas </h2>
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
            :color="statusColor[item.estado]"
            class="font-weight-medium"
          >
            {{ `${item.estado}` }}
          </v-chip>
        </template>
        <template #[`item.accion`]="{item}">
          <div class="parent" v-if="item.estado == 'Pendiente'">
            <div class="child font-weight-medium">
              <v-btn
                color="success"
                small
                @click="approve(item.id)"
              >
                Aprobar
              </v-btn>
            </div>
            <div class="child">
            <v-btn
                small
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

<style lang="scss">

</style>

<script>
import store from '../../store/index.js';
import { mdiMagnify } from '@mdi/js';
import axios from 'axios';

export default {
    async created() {
        axios.get('/api/solicitudesAdmin/',{
                headers: {
                'Authorization': 'Bearer ' + store.state._token
                }
            })
            .then(async response => {
                console.log(response);
                console.log(response.data.solicitudes);
                console.log(response.data.usuarios)
                this.usreList = response.data.solicitudes;
                this.usuarios_solicitudes = response.data.usuarios;
            })
            .catch(error => {
                console.log(error);
            });
        },
        data() {
            return {
                search: '',
                headers: [
                { text: 'Trabajador', value: 'user_id' },
                { text: 'Tipo', value: 'tipo'},
                { text: 'Descripción', value: 'descripcion' },
                { text: 'Fecha inicio', value: 'fecha_inicio' },
                { text: 'Fecha fin', value: 'fecha_fin' },
                { text: 'Justificante', value: 'justificante' },
                { text: 'Estado', value: 'estado' },
                { text: 'Acción', value: 'accion' },
                ],
                usreList: [],
                usuarios_solicitudes: [],
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
                item.user_id = this.usuarios_solicitudes[item.user_id]
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
            getStatusText(estado){
                return this.status[estado];
            },
            async approve(id){

            },
            async deny(id){

            },
            async actualizar(){

            }

        }
    }



</script>
