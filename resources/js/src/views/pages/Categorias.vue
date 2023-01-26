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
            v-model="busqueda"
            @keyup="buscar"
            rounded
            dense
            outlined
            :prepend-inner-icon="mdiMagnify"
            class="app-bar-search filters-bar-search"
            width="50"
            hide-details
            placeholder="Buscar"
          ></v-text-field>
          <v-icon style="margin-top: 15px;">{{ mdiMagnify }}</v-icon>
      </v-card-title>

      <v-simple-table fixedHeader>
        <template v-slot:default>
        <thead>
            <tr>
            <th class="text-uppercase">
                Nombre
            </th>
            <th>
                Acciones
            </th>
            </tr>
        </thead>

      <tbody>
        <tr
          v-for="item in categorias"
          :key="item.id"
        >
          <td>{{ item.name }}</td>
          <td>
            <v-btn :to="{name: 'pages-categorias-editar', params: {id: item.id}}" small color="primary"> Editar </v-btn>
            <!-- <v-btn small color="error" @click="deleteCategory(item.id)" > Eliminar </v-btn> -->
        </td>

        </tr>
      </tbody>
    </template>
  </v-simple-table>

    </v-card>
    </section>
</template>

<script>

import store from '../../store/index.js';
import { mdiMagnify } from '@mdi/js';
import axios from 'axios';

export default {
    async created() {
        if (this.$store.state.categorias.length == 0) {
            await this.$store.dispatch('fetchCategorias')
            this.categorias = this.$store.state.categorias
        } else {
            this.categorias = this.$store.state.categorias
        }
    },
    data() {
      return {
        mdiMagnify,
        categorias: [],
        busqueda: '',
        headers: [
          { text: 'Nombre', value: 'nombre' }
        ]
      }
    },
    setup() {
      return {
        store
      }
    },
    methods: {
        buscar(){
            if(this.busqueda.length > 0 ){
                this.categorias = this.$store.state.categorias.filter((categoria) => categoria.name.toLowerCase().includes(this.busqueda.toLowerCase()))
            }
            else{
                this.categorias = this.$store.state.categorias
            }
        },
        deleteCategory(id){
            console.log(id)
            axios.delete('/api/categorias/' + id,{
                    headers: {
                    'Authorization': 'Bearer ' + store.state._token
                    }
                })
                .then(async response => {
                    console.log(response);
                    await this.$store.dispatch('fetchCategorias')
                    this.categorias = this.$store.state.categorias

                })
                .catch(error => {
                    console.log(error);
                });
        }
    }
    }
  
  

</script>

<style lang="scss">
.v-data-table__wrapper{
  height: min-content!important;
  max-height: 350px!important;
}
</style>
