<template>
  <v-simple-table height="min-content" fixedHeader>
    <template v-slot:default>
      <thead>
        <tr>
          <th class="text-uppercase">
            Nombre
          </th>
          <th class="text-center text-uppercase">
            Email
          </th>
          <th class="text-center text-uppercase">
            Categoría
          </th>
          <th class="text-center text-uppercase">
            Rol
          </th>
          <th class="text-center text-uppercase">
            Detalles
          </th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="item in employees"
          :key="item.id"
        >
          <td>{{ item.name }}</td>
          <td class="text-center">
            {{ item.email }}
          </td>
          <td class="text-center">
            {{ item.category }}
          </td>
          <td class="text-center">
            {{ item.role }}
          </td>
          <td class="text-center" to="#">
            Ver más
          </td>
        </tr>
      </tbody>
    </template>
  </v-simple-table>
</template>

<script>
import axios from 'axios'

export default {
  props: [
    'employees'
  ],
  methods: {

  },
  created() {
    
  },
  data() {
    return {
      
    }
  } 
}
</script>
