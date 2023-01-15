<template>
  <v-card>
    <v-card-title class="align-start">
      <span>Últimas jornadas realizadas</span>
    </v-card-title>

    <v-card-text>
      <v-list class="pb-0">
        <v-list-item
          v-for="(data,index) in this.$store.state.jornadas"
          :key="data.id"
          :class="`d-flex align-center px-0 ${index > 0 ? 'mt-4':''}`"
        >
          <v-avatar
            :color="`${data.hora_salida - data.hora_entrada < 8 ? 'error':'success'}`"
            size="40"
            :class="`${data.hora_salida - data.hora_entrada < 8 ? 'error':'success'} white--text font-weight-medium me-3`"
          >
            <span class="text-base">{{ data.hora_salida - data.hora_entrada}}h</span>
          </v-avatar>

          <div class="d-flex align-center flex-grow-1 flex-wrap">
            <div class="me-2">
              <div class="font-weight-semibold">
                <span class="text--primary text-base me-1">{{ data.fecha }}</span>
              </div>
            </div>
          </div>
        </v-list-item>
      </v-list>
    </v-card-text>
  </v-card>
</template>

<script>
import store from '../../store/index.js';

export default {
  async created() {
    await this.$store.dispatch('fetchJornadas')
  },
  setup() {
    return {
      store,
    }
  },
}
</script>
