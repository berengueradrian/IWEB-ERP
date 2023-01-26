<template>
    <v-simple-table fixedHeader>
      <template v-slot:default>
        <thead>
          <tr>
            <th class="text-uppercase">
              Empleado
            </th>
            <th class="text-center text-uppercase">
              Mes
            </th>
            <th class="text-center text-uppercase">
              Año
            </th>
            <th class="text-center text-uppercase">
              Estado
            </th>
            <th class="text-center text-uppercase">
              Acciones
            </th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="nomina in nominas"
            :key="nomina.id"
          >
            <td>{{ nomina.user.name }}</td>
            <td class="text-center">
              {{ numeroAMes(nomina.mes) }}
            </td>
            <td class="text-center">
              {{ nomina.anyo }}
            </td>
            <td class="text-center">
              {{ nomina.estado == 0 ? '❌' : '✅' }}
            </td>
            <td class="text-center">
                <v-btn v-if="nomina.estado == 0"
                    color="primary"
                    class="mr-2"
                >
                    Pagar
                </v-btn>
                <v-btn v-else
                    color="primary"
                    class="mr-2"
                >
                    Descargar
                </v-btn>
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
      'nominas'
    ],
    methods: {
      numeroAMes(numero) {
        numero = parseInt(numero)
        switch(numero) {
          case 0:
            return 'Enero'
          case 1:
            return 'Febrero'
          case 2:
            return 'Marzo'
          case 3:
            return 'Abril'
          case 4:
            return 'Mayo'
          case 5:
            return 'Junio'
          case 6:
            return 'Julio'
          case 7:
            return 'Agosto'
          case 8:
            return 'Septiembre'
          case 9:
            return 'Octubre'
          case 10:
            return 'Noviembre'
          case 11:
            return 'Diciembre'
        }
      }
    },
    created() {

    },
    data() {
      return {
        
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
  