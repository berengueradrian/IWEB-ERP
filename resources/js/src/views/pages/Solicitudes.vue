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
        item-key="id"
        class="table-rounded"
        hide-default-footer
        :items-per-page="50"
      >
        <template #[`item.tipo`]="{item}">
          <div class="d-flex flex-column">
            <span class="d-block font-weight-semibold text--primary text-truncate">{{ item.tipo }}</span>
          </div>
          </template>
          <template #[`item.descripcion`]="{item}">
            {{ `${item.descripcion}` }}
          </template>
          <template #[`item.justificante`]="{item}">
            {{ `${item.justificante}` }}
            <v-icon v-if="item.justificante != 'No consta'" @click="descargar(item.id, item.justificante)">{{ mdiDownload }}</v-icon>
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
        <template #[`item.id`]="{item}">
          <div class="parent" v-if="item.estado == 0">
            <div class="child">
              <v-btn
                color="error"
                @click="borrar(item.id)"
              >
                Borrar
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
  import { mdiMagnify, mdiDownload } from '@mdi/js';
  import axios from 'axios';
  
  export default {
    async created() {
      await this.$store.dispatch('fetchSolicitudes')

      this.usreList = JSON.parse(JSON.stringify(this.$store.state.solicitudes))
    },
    data() {
      return {
        mdiMagnify,
        mdiDownload,
        search: '',
        headers: [
          { text: 'Tipo', value: 'tipo' },
          { text: 'Descripción', value: 'descripcion' },
          { text: 'Fecha inicio', value: 'fecha_inicio' },
          { text: 'Fecha fin', value: 'fecha_fin' },
          { text: 'Justificante', value: 'justificante' },
          { text: 'Estado', value: 'estado' },
          { text: '', value: 'id' },
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
    methods: {
      async borrar(id) {
        await axios.delete('http://localhost:8000/api/solicitudes/' + id ,{
          headers: {
            'Authorization': 'Bearer ' + store.state._token
          }
        }).then(response => {
          this.actualizar()
        })
      },
      async actualizar() {
        await this.$store.dispatch('fetchSolicitudes')
        this.$set(this, 'usreList', JSON.parse(JSON.stringify(this.$store.state.solicitudes)))
      },
      async descargar(id, nombre) {
        await axios.get('http://localhost:8000/api/solicitudes/' + id + '/file',
        {
          headers: {
            'Authorization': 'Bearer ' + store.state._token
          }
        }, {responseType: 'arraybuffer'})
        .then(response => {
          //this.descargar2(response, nombre)
          let encoder = new TextEncoder();
          let data = encoder.encode(response.data);
          let blob = new Blob([data], {type: response.headers['content-type']})
          let link = document.createElement('a')
          link.href = window.URL.createObjectURL(blob)
          link.download = nombre//'justificante' + '.' + response.headers['content-type'].split('/')[1] 
          link.click()
        })
        // .then(response => {
        //   var filename = nombre//response.headers.get('content-disposition').split('=')[1].replace(/^\"+|\"+$/g, '')
        //   var url = window.URL.createObjectURL(new Blob([response.data],{type:response.headers['content-type']}))
        //   var link = document.createElement('a')
        //   link.href = url
        //   link.setAttribute('download', filename)
        //   document.body.appendChild(link)
        //   link.click()
        // });
      },
      descargar2(response, nombre) {
        var newBlob = new Blob([response.body], {type: response.headers['content-type']})
        // IE doesn't allow using a blob object directly as link href
        // instead it is necessary to use msSaveOrOpenBlob
        if (window.navigator && window.navigator.msSaveOrOpenBlob) {
          window.navigator.msSaveOrOpenBlob(newBlob)
          return
        }
        // For other browsers:
        // Create a link pointing to the ObjectURL containing the blob.
        const data = window.URL.createObjectURL(newBlob)
        var link = document.createElement('a')
        link.href = data
        link.download = nombre
        link.click()
        setTimeout(function () {
          // For Firefox it is necessary to delay revoking the ObjectURL
          window.URL.revokeObjectURL(data)
        }, 100)
      },
    }
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