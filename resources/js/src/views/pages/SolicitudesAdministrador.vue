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
        :items="usreList"
        :search="search"
        item-key="id"
      >
        <template #[`item.user.name`]="{item}">
          <div class="d-flex flex-column">
            <span class="d-block font-weight-semibold text--primary text-truncate"> {{ item.user.name }} </span>
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

        this.usreList = this.$store.state.solicitudesAdmin
        this.usuarios_solicitudes = this.$store.state.usuariosSolicitudesAdmin
    },
        data() {
            return {
                search: '',
                headers: [
                { text: 'Trabajador', value: 'user.name' },
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
                try {
                await axios.post('/api/solicitudesAdmin/' + id + '/aprobar', {},{
                    headers: {
                    'Authorization': 'Bearer ' + store.state._token
                    },
                    params: {
                        'api_key' : 'secreto'
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
            async deny(id){
                try {
                    await axios.post('/api/solicitudesAdmin/' + id + '/denegar', {}, {
                    headers: {
                        'Authorization': 'Bearer ' + store.state._token
                    }
                    }).
                    then(response => {
                        this.actualizar()
                    })
                    } catch (error) {
                        console.log(error)
                    }
            },
            async actualizar(){
                await this.$store.dispatch('fetchSolicitudesAdmin')
                this.usreList = this.$store.state.solicitudesAdmin
            },
            filterEstado() {

                //console.log(this.usreList)

                if (this.filters[0] === 'Elige uno') {
                    this.usreList = this.$store.state.solicitudesAdmin  
                }
                else {
                    this.usreList = this.$store.state.solicitudesAdmin.filter(sol => sol.estado === this.filters[0])
                }
                if (this.filters[1] !== 'Elige uno') {
                    this.usreList = this.usreList.filter(sol => sol.tipo === this.filters[1])
                }
                
                //console.log(this.usreList)
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


</style>