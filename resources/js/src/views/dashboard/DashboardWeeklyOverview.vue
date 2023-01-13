<template>
  <v-card
    class="mx-auto text-center"
    color="green"
    max-width="600"
  >
    <v-card-text>
      <v-sheet color="rgba(0, 0, 0, .12)">
        <v-sparkline
          :value="this.data"
          color="rgba(255, 255, 255, .7)"
          height="100"
          padding="24"
          stroke-linecap="round"
          smooth
        >
          <template v-slot:label="item">
            ${{ item.value }}
          </template>
        </v-sparkline>
      </v-sheet>
    </v-card-text>

    <v-card-text>
      <div class="text-h4 font-weight-thin">
        Últimas jornadas
      </div>
    </v-card-text>
  <!-- <v-card
    class="mt-4 mx-auto"
    max-width="400"
  >
    <v-sheet
      class="v-sheet--offset mx-auto"
      color="cyan"
      elevation="12"
      max-width="calc(100% - 32px)"
    >
      <v-sparkline
        :value="data"
        color="white"
        line-width="2"
        padding="16"
      ></v-sparkline>
    </v-sheet> -->
  </v-card>
</template>

<script>
import store from '../../store/index.js';
import VueApexCharts from 'vue-apexcharts'
import { mdiDotsVertical, mdiTrendingUp, mdiCurrencyUsd } from '@mdi/js'

export default {
  components: {
    VueApexCharts,
  },
  setup() {
    return {
      store,
      icons: {
        mdiDotsVertical,
        mdiTrendingUp,
        mdiCurrencyUsd,
      },
    }
  },
  async created() {
    await this.$store.dispatch('fetchCompletada')
    await this.$store.dispatch('fetchJornadas')
    this.datos = JSON.parse(JSON.stringify(this.$store.state.jornadas))
    // console.log(JSON.parse(JSON.stringify(this.$store.state.jornadas)))
    // console.log(this.datos)
    // console.log(this.$store.state.jornadas)
    this.calculoHoras()
    // console.log(this.data)
    
  },
  data() {
    return {
      datos: null,
      data: null
    }
  },
  computed: {
    user() {
      return this.$store.state.user.user
    },
    completada() {
      return this.$store.state.completada
    },
    jornadas() {
      return this.$store.state.jornadas
    }
  },
  methods: {
    calculoHoras() {
      var caso = this.$store.state.jornadas
      this.data = []
      // console.log("hola")
      // console.log(caso[0])
      for (let i = 0; i < caso.length && i <= 5; i++) {
        this.data.push(caso[i].hora_salida - caso[i].hora_entrada)
      }
      this.data = [...this.data]//Array.from(this.data)
    }
  },
}
</script>

<style scoped>
.v-sheet--offset {
    top: -24px;
    position: relative;
  }
</style>