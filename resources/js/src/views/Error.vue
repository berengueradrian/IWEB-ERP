<template>
  <div id="misc">
    <img
      class="misc-mask"
      height="226"
      :src="require(`@/assets/images/misc/misc-mask-${$vuetify.theme.dark ? 'dark' : 'light'}.png`)"
    />

    <v-img class="misc-tree" :src="require('@/assets/images/misc/tree-4.png')"></v-img>

    <div class="page-title text-center px-5">
      <h2 class="text-2xl font-weight-semibold text--primary d-flex align-center justify-center">
        <span class="me-2">Página no encontrada</span>
        <v-icon color="warning">
          {{ icons.mdiAlert }}
        </v-icon>
      </h2>
      <p class="text-sm">la página que estás buscando no existe o no está disponible</p>

      <div class="misc-character d-flex justify-center">
        <v-img max-width="700" :src="require('@/assets/images/3d-characters/error.png')"></v-img>
      </div>

      <v-btn color="primary" v-on:click="goBack" class="mb-4"> Volver al inicio </v-btn>
    </div>
  </div>
</template>

<script>
import { mdiAlert } from '@mdi/js'

export default {
  setup() {
    return {
      icons: {
        mdiAlert,
      },
    }
  },
  methods: {
    goBack() {
      this.$router.go(-1) //this.$router.back()
    },
  },
  
}
</script>

<style lang="scss">
@import '~@resources/sass/preset/misc.scss';
</style>
