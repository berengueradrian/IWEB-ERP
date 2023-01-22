<template>
    <section>
    <div style="margin-bottom: 10px; margin-left: 10px;">
      <v-btn :to="{name: 'pages-categorias-nueva'}" small color="primary"> Nueva categoría </v-btn>
    </div>
    <v-card>
      <v-card-title>
          <h2 style="margin-bottom: 10px;">Categorías disponibles</h2>
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
        :items="categoriasLista"
        item-key="nombre"
        class="table-rounded"
        hide-default-footer
        disable-sort
      >
        <template #[`item.nombre`]="{item}">
          <div class="d-flex flex-column">
            <span class="d-block text--primary text-truncate">{{ item.nombre }}</span>
          </div>
          </template>
      </v-data-table>
    </v-card>
    </section>
</template>

<script>

import store from '../../store/index.js';
import { mdiMagnify } from '@mdi/js';


export default {
    async created() {
      //console.log(this.$store.state.user)
        await this.$store.dispatch('fetchCategorias')
        let categorias = this.$store.state.categorias
    
        // create a json with the names of the categories
        for (let i = 0; i < categorias.length; i++) {
            this.categoriasLista.push({nombre: categorias[i].name})
        }

        console.log(this.categoriasLista)
    },
    data() {
      return {
        mdiMagnify,
        search: '',
        headers: [
          { text: 'Nombre', value: 'nombre' }
        ],
        categoriasLista: []
      }
    },
    setup() {
      return {
        store
      }
    },
  }
  
  

</script>