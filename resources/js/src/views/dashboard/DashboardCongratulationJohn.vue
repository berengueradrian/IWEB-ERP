<template>
  <v-card class="greeting-card">
    <v-row class="ma-0 pa-0">
      <v-col cols="8">
        <v-card-title v-if="this.completada == true" class="text-no-wrap pt-1 ps-2"> Comienza tu jornada </v-card-title>
        <v-card-subtitle v-if="this.completada == true" class="text-no-wrap ps-2"> Nuestros avances son de todos </v-card-subtitle>
        <v-card-title v-if="this.completada == false" class="text-no-wrap pt-1 ps-2"> Jornada en marcha </v-card-title>
        <v-card-subtitle v-if="this.completada == false" class="text-no-wrap ps-2"> Que tengas un gran día </v-card-subtitle>
        <v-card-text class="d-flex align-center mt-2 pb-2 ps-2">
          <div>
            <v-btn v-if="this.completada == false" @click="finalizar" small color="primary"> Finalizar jornada </v-btn>
            <v-btn v-if="this.completada == true" @click="fichar" small color="primary"> Fichar </v-btn>
          </div>
        </v-card-text>
      </v-col>

      <v-col cols="4">
        <v-img
          contain
          height="180"
          width="159"
          :src="require(`@/assets/images/misc/triangle-${$vuetify.theme.dark ? 'dark' : 'light'}.png`).default"
          class="greeting-card-bg"
        ></v-img>
        <v-img
          contain
          height="108"
          max-width="83"
          class="greeting-card-trophy"
          :src="require('@/assets/images/misc/trophy.png').default"
        ></v-img>
      </v-col>
    </v-row>
  </v-card>
</template>

<script>
  import axios from 'axios';
  import store from '../../store/index.js';

  export default {
    name: 'DashboardCongratulationJohn',
    setup() {
      return {
        store
      };
    },
    data: () => ({

    }),
    created() {
      this.$store.dispatch('fetchUser')
      this.$store.commit('setToken')
      this.$store.dispatch('fetchCompletada')
      // console.log(this.$store.state)
    },
    computed: {
      user() {
        return this.$store.state.user.user
      },
      completada() {
        this.$store.dispatch('fetchCompletada')
        return this.$store.state.completada
      }
    },
    methods: {
      async fichar() {
        try {
          const response = await axios.
            post('http://localhost:8000/api/startJornada/' + this.user.id, {
              _token: this.$store.state.csrfToken
            }
            ).then(response => {
              this.$store.dispatch('fetchCompletada')
              // console.log(this.$store.state.completada)
              // console.log(response)
            });
        } catch (error) {
          console.log(error);
        }
      },
      async finalizar() {
        try {
          const response = await axios.
            post('http://localhost:8000/api/endJornada/' + this.user.id, {
              _token: this.$store.state.csrfToken
            }
            ).then(response => {
              this.$store.dispatch('fetchCompletada')
              // console.log(this.$store.state.completada)
              // console.log(response)
            });
        } catch (error) {
          console.log(error);
        }
      },
    },
  };
</script>

<style lang="scss" scoped>
.greeting-card {
  position: relative;
  .greeting-card-bg {
    position: absolute;
    bottom: 0;
    right: 0;
  }
  .greeting-card-trophy {
    position: absolute;
    bottom: 10%;
    right: 8%;
  }
}
// rtl
.v-application {
  &.v-application--is-rtl {
    .greeting-card-bg {
      right: initial;
      left: 0;
      transform: rotateY(180deg);
    }
    .greeting-card-trophy {
      left: 8%;
      right: initial;
    }
  }
}
</style>
