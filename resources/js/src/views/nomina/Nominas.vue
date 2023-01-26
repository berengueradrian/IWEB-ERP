<template>
    <section>
      <v-card>
        <v-card-title>Nominas de los empleados</v-card-title>
        <div class="filters-bar">
          <v-text-field
            v-model="filters[0]"
            @keyup="filterNomina"
            rounded
            dense
            outlined
            :prepend-inner-icon="mdiMagnify"
            class="app-bar-search filters-bar-search"
            width="50"
            hide-details
            placeholder="Buscar por empleado..."
          ></v-text-field>
          <v-select
            v-model="filters[1]"
            @input="filterNomina"
            :items="meses"
            label="Elige un mes"
            outlined
            class="filters-bar-select"
          ></v-select>
          <v-select
            v-model="filters[2]"
            @input="filterNomina"
            :items="anyos"
            label="Elige un año"
            outlined
            class="filters-bar-select"
          ></v-select>
        </div>
        <nominas-table :nominasProp="nominas"></nominas-table>
      </v-card>  
    </section>
  </template>
  
  <script>
  import NominasTable from '@/views/nomina/NominasTable.vue'
  import { mdiMagnify } from '@mdi/js'
  
  export default {
    components: { NominasTable },
  
    setup() {
      return {
        mdiMagnify
      }
    },
    async created() {
        if (this.$store.state.empleados.length === 0){
            await this.$store.dispatch('fetchEmpleados')
        }
        if (this.$store.state.categorias.length === 0){
            await this.$store.dispatch('fetchCategorias')
        }
        if (this.$store.state.supervisores.length === 0){
            await this.$store.dispatch('fetchSupervisores')
        }
        if (this.$store.state.nominas.length === 0){
            await this.$store.dispatch('fetchAllNominas')
        }
        if (this.$store.state.generadasNominas == false) {
            await this.$store.dispatch('generarNominasMesAnterior')
        }

        this.nominas = this.$store.state.nominas
      
        this.meses.push('Enero')
        this.meses.push('Febrero')
        this.meses.push('Marzo')
        this.meses.push('Abril')
        this.meses.push('Mayo')
        this.meses.push('Junio')
        this.meses.push('Julio')
        this.meses.push('Agosto')
        this.meses.push('Septiembre')
        this.meses.push('Octubre')
        this.meses.push('Noviembre')
        this.meses.push('Diciembre')
        this.meses.push('Todos')

        for (let i = 2020; i <= 2100; i++) {
          this.anyos.push(i)
        }

        this.anyos.push('Todos')
    },
    data() {
      return {
        meses: [],
        anyos: [],
        nominas: [],
        filters: ['', 'Todos', 'Todos'], // First is the email, second the category and third the role
        numeroMeses: {
          'Enero': '0',
          'Febrero': '1',
          'Marzo': '2',
          'Abril': '3',
          'Mayo': '4',
          'Junio': '5',
          'Julio': '6',
          'Agosto': '7',
          'Septiembre': '8',
          'Octubre': '9',
          'Noviembre': '10',
          'Diciembre': '11'
        }
      }
    },
    methods: {
      filterNomina() {
        this.nominas = this.$store.state.nominas.filter(nominas => nominas.user.name.includes(this.filters[0]))
        if (this.filters[1] !== 'Todos') {
          this.nominas = this.nominas.filter(nomina => nomina.mes === this.numeroMeses[this.filters[1]])
        }
        if (this.filters[2] !== 'Todos') {
          this.nominas = this.nominas.filter(nomina => nomina.anyo === this.filters[2].toString())
        }
      }
    }
  }
  </script>
  
  <style lang="scss">
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