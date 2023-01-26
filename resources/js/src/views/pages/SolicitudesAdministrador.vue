<template>
  <div>
    <v-card>
      <v-card-title>
        <h2 style="margin-bottom: 10px;">Solicitudes recibidas </h2>
        <v-spacer></v-spacer>
        <div class="filters-bar">

            <v-select
            v-model="filters[0]"
            @input="filterEstado"
            :items="estados"
            label="Elige un estado"
            outlined
            dense
            class="filters-bar-select"
            ></v-select>
            <v-select
            v-model="filters[1]"
            @input="filterTipo"
            :items="tipos"
            dense
            label="Elige un tipo"
            outlined
            class="filters-bar-select"
            ></v-select>

        </div>
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
            <span class="d-block font-weight-semibold text--primary text-truncate"> {{ `${item.user_name}` }} </span>
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
        await this.$store.dispatch('fetchSolicitudesAdmin')

        this.usreList = JSON.parse(JSON.stringify(this.$store.state.solicitudesAdmin))
        this.usuarios_solicitudes = JSON.parse(JSON.stringify(this.$store.state.usuariosSolicitudesAdmin))
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
                tipos: ['Baja', 'Vacaciones', 'Otros', 'Elige uno'],
                estados: ['Pendiente', 'Aprobada', 'Denegada', 'Elige uno'],
                filters: ['Elige uno', 'Elige uno'] // First is the user, second the types and third the states
            }
        },
        computed: {
            filteredItems() {
                return this.usreList.map(item => {
                    item.user_id = this.usuarios_solicitudes[item.user_id]
                    axios.get('/api/users/' + item.user_id, {
                        headers: {
                        'Authorization': 'Bearer ' + store.state._token
                        },
                        params:{
                            'api_key':'secreto'
                        }
                    }).then(res => {
                        item.user_name = res.data.data.name;
                        console.log("la respuesta es " + res.data.data.name)
                        console.log(item.user_name)
                    }).catch(err => {
                        console.log(err);
                    });
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
            nombre_usuario(id){
                return this.usuarios_solicitudes[id].name;
            },
            async approve(id){

            },
            async deny(id){

            },
            async actualizar(){

            },
            filterEstado() {

                if (this.filters[0] === 'Elige uno') {
                    this.usreList = this.$store.state.solicitudesAdmin  
                }
                else {
                    this.usreList = this.$store.state.solicitudesAdmin.filter(sol => sol.estado === this.filters[0])
                }
                if (this.filters[1] !== 'Elige uno') {
                    this.usreList = this.usreList.filter(sol => sol.tipo === this.filters[1])
                }
                this.filteredItems();
            },
            filterTipo() {
                if (this.filters[1] === 'Elige uno') {
                    this.usreList = this.$store.state.solicitudesAdmin  
                }
                else {
                    this.usreList = this.$store.state.solicitudesAdmin.filter(sol => sol.tipo === this.filters[1])
                }
                if (this.filters[0] !== 'Elige uno') {
                    this.usreList = this.usreList.filter(sol => sol.estado === this.filters[0])
                }
                this.filteredItems();
            },
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
  overflow:auto;
}


</style>