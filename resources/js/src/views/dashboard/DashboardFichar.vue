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
            <span v-if="negativo && !mostrarHoras" class="text-h8" style="margin-bottom: 5px;"> Ya has completado una jornada hoy </span>
            <span v-if="negativo && mostrarHoras" class="text-h8" style="margin-bottom: 5px;"> Ya has completado una jornada de {{ this.horas }}h </span>
            <span v-if="mostrarHoras && !negativo" class="text-h8" style="margin-bottom: 5px;"> Tu jornada de hoy ha sido de {{ this.horas }}h </span>
            <v-btn v-if="this.completada == false" @click="finalizar" small color="primary"> Finalizar jornada </v-btn>
            <v-btn v-if="this.completada == true" @click="fichar" small color="primary" style="margin-top: 5px;"> Fichar </v-btn>
          </div>
        </v-card-text>
      </v-col>
    </v-row>
  </v-card>
</template>

<script>
  import axios from 'axios';
  import store from '../../store/index.js';

  export default {
    name: 'DashboardFichar',
    setup() {
      return {
        store
      };
    },
    data() {
      return {
        user: this.$store.state.user,
        negativo: false,
        horas: 0,
        mostrarHoras: false,
      }
    },
    async created() {
      await this.$store.dispatch('fetchCompletada')
      await this.$store.dispatch('fetchJornadas')
    },
    computed: {
      completada() {
        return this.$store.state.completada
      }
    },
    methods: {
      async fichar() {
        var ultima = this.$store.state.jornadas[0].fecha
        var hoy = new Date()
        if(hoy.getMonth() + 1 < 10) {
          var mes = '0' + (hoy.getMonth() + 1)
        } else {
          var mes = hoy.getMonth() + 1
        }
        var fecha = hoy.getFullYear() + '-' + mes + '-' + hoy.getDate()
        if(ultima == fecha) {
          this.negativo = true;
        }
        else {
          try {
            const response = await axios.
              post('/api/startJornada/' + this.user.id,{
                _token: this.$store.state.csrfToken
              }, {
                headers: {
                  'Authorization': 'Bearer ' + store.state._token
                }
              }
              ).then(response => {
                this.$store.dispatch('fetchCompletada')
              });
          } catch (error) {
            console.log(error);
          }
        }
      },
      async finalizar() {
        try {
          const response = await axios.
            post('/api/endJornada/' + this.user.id, {
              _token: this.$store.state.csrfToken
            }, {
              headers: {
                'Authorization': 'Bearer ' + store.state._token
              }
            }
            ).then(async (response) => {
              await this.$store.dispatch('fetchCompletada')
              await this.$store.dispatch('fetchJornadas')
              this.horas = this.$store.state.jornadas[0].hora_salida - this.$store.state.jornadas[0].hora_entrada
              this.mostrarHoras = true;
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
