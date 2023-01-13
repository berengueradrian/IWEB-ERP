<template>
  <section>
    <v-card>
      <v-card-title>{{ title }}</v-card-title>
      <div class="filters-bar">
        <v-text-field
          v-model="filters[0]"
          @keyup="filterMail"
          rounded
          dense
          outlined
          :prepend-inner-icon="mdiMagnify"
          class="app-bar-search filters-bar-search"
          width="50"
          hide-details
          placeholder="Search by email..."
        ></v-text-field>
        <v-select
          v-model="filters[1]"
          @input="filterCategory"
          :items="categories"
          label="Choose category"
          outlined
          class="filters-bar-select"
        ></v-select>
        <v-select
          v-model="filters[2]"
          @input="filterRole"
          :items="roles"
          label="Choose role"
          outlined
          class="filters-bar-select"
        ></v-select>
      </div>
      <empleados-table :employees="employees" ></empleados-table>
    </v-card>  
  </section>
  
</template>

<script>
import EmpleadosTable from '@/views/EmpleadosTable.vue'
import { mdiMagnify } from '@mdi/js'

export default {
  components: { EmpleadosTable },
  props: ['title'],

  setup() {
    return {
      mdiMagnify
    }
  },
  created() {
    this.categories = this.$store.state.categorias.map(category => category.name)
    this.categories.push('Elige uno')
    this.employees = this.$store.state.empleados
  },
  data() {
    return {
      categories: [],
      roles: ['Admin', 'Supervisor', 'Empleado', 'Elige uno'],
      employees: [],
      filters: ['', 'Elige uno', 'Elige uno'] // First is the email, second the category and third the role
    }
  },
  methods: {
    filterMail() {
      this.employees = this.$store.state.empleados.filter(employee => employee.email.includes(this.filters[0]))
      if (this.filters[1] !== 'Elige uno') {
        this.employees = this.employees.filter(employee => employee.category === this.filters[1])
      }
      if (this.filters[2] !== 'Elige uno') {
        this.employees = this.employees.filter(employee => employee.role === this.filters[2])
      }

    },
    filterCategory() {
      if (this.filters[1] === 'Elige uno') {
        this.employees = this.$store.state.empleados  
      }
      else {
        this.employees = this.$store.state.empleados.filter(employee => employee.category === this.filters[1])
      }
      if (this.filters[0] !== '') {
        this.employees = this.employees.filter(employee => employee.email.includes(this.filters[0]))
      }
      if (this.filters[2] !== 'Elige uno') {
        this.employees = this.employees.filter(employee => employee.role === this.filters[2])
      }
    },
    filterRole() {
      if (this.filters[2] === 'Elige uno') {
        this.employees = this.$store.state.empleados
      }
      else {
        this.employees = this.$store.state.empleados.filter(employee => employee.role === this.filters[2])
      }
      if (this.filters[0] !== '') {
        this.employees = this.employees.filter(employee => employee.email.includes(this.filters[0]))
      }
      if (this.filters[1] !== 'Elige uno') {
        this.employees = this.employees.filter(employee => employee.category === this.filters[1])
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