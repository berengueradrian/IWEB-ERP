<template>
  <div class="auth-wrapper auth-v1">
    <div class="auth-inner">
      <v-card class="auth-card">
        <!-- logo -->
        <v-card-title class="d-flex align-center justify-center py-7">
          <router-link to="/" class="d-flex align-center">
            <v-img
              :src="require('@/assets/images/logos/logo.svg')"
              max-height="30px"
              max-width="30px"
              alt="logo"
              contain
              class="me-3"
            ></v-img>

            <h2 class="text-2xl font-weight-semibold">RRHH</h2>
          </router-link>
        </v-card-title>

        <!-- title -->
        <v-card-text>
          <p class="text-2xl font-weight-semibold text--primary mb-2">Welcome back! 👋🏻</p>
          <p class="mb-2">Sign-in to your account to see your information</p>
        </v-card-text>

        <!-- login form -->
        <v-card-text>
          <v-form>
            <v-text-field
              v-model="email"
              outlined
              label="Email"
              placeholder="john@example.com"
              hide-details
              class="mb-3"
            ></v-text-field>

            <v-text-field
              v-model="password"
              outlined
              :type="isPasswordVisible ? 'text' : 'password'"
              label="Password"
              placeholder="············"
              :append-icon="isPasswordVisible ? icons.mdiEyeOffOutline : icons.mdiEyeOutline"
              hide-details
              @click:append="isPasswordVisible = !isPasswordVisible"
            ></v-text-field>

            <!--<div class="d-flex align-center justify-space-between flex-wrap">
              <v-checkbox label="Remember Me" hide-details class="me-3 mt-1"> </v-checkbox>

              forgot link
              <a href="javascript:void(0)" class="mt-1"> Forgot Password? </a>
            </div>-->

            <v-btn block color="primary" class="mt-6" @click="attemptLogin" > Login </v-btn>
          </v-form>
          <v-alert
            text
            outlined
            type="error"
            class="mt-3"
            v-if="error_shown"
          >Login fallido. Vuelve a intentarlo</v-alert>
        </v-card-text>

        <!-- create new account  -->
        <!--<v-card-text class="d-flex align-center justify-center flex-wrap mt-2">
          <span class="me-2"> New on our platform? </span>
          <router-link :to="{ name: 'pages-register' }"> Create an account </router-link>
        </v-card-text>-->

        <!-- divider -->
        <!--<v-card-text class="d-flex align-center mt-2">
          <v-divider></v-divider>
          <span class="mx-5">or</span>
          <v-divider></v-divider>
        </v-card-text>-->

        <!-- social links -->
        <!--<v-card-actions class="d-flex justify-center">
          <v-btn v-for="link in socialLink" :key="link.icon" icon class="ms-1">
            <v-icon :color="$vuetify.theme.dark ? link.colorInDark : link.color">
              {{ link.icon }}
            </v-icon>
          </v-btn>
        </v-card-actions>-->
      </v-card>
    </div>

    <!-- background triangle shape  -->
    <img
      class="auth-mask-bg"
      height="173"
      :src="require(`@/assets/images/misc/mask-${$vuetify.theme.dark ? 'dark' : 'light'}.png`)"
    />

    <!-- tree -->
    <v-img class="auth-tree" width="247" height="185" :src="require('@/assets/images/misc/tree.png')"></v-img>

    <!-- tree  -->
    <v-img
      class="auth-tree-3"
      width="377"
      height="289"
      :src="require('@/assets/images/misc/tree-3.png')"
    ></v-img>
  </div>
</template>

<script>
// eslint-disable-next-line object-curly-newline
import { mdiFacebook, mdiTwitter, mdiGithub, mdiGoogle, mdiEyeOutline, mdiEyeOffOutline, mdiConsoleNetworkOutline } from '@mdi/js'
import { ref } from '@vue/composition-api'
import axios from 'axios'
import store from '@/store'
import router from '@/router'
export default {
  setup() {
    if (store.state.user !== null) {
      if (store.state.user.admin || store.state.user.supervisor) {
        router.push('/superole/dashboard')
      }
      else {
        router.push('/empleado/dashboard')
      }
    }
    
    const isPasswordVisible = ref(false)
    const error_shown = ref(false)
    const email = ref('')
    const password = ref('')
    const socialLink = [
      {
        icon: mdiFacebook,
        color: '#4267b2',
        colorInDark: '#4267b2',
      },
      {
        icon: mdiTwitter,
        color: '#1da1f2',
        colorInDark: '#1da1f2',
      },
      {
        icon: mdiGithub,
        color: '#272727',
        colorInDark: '#fff',
      },
      {
        icon: mdiGoogle,
        color: '#db4437',
        colorInDark: '#db4437',
      },
    ]

    return {
      isPasswordVisible,
      email,
      password,
      socialLink,
      error_shown,

      icons: {
        mdiEyeOutline,
        mdiEyeOffOutline,
      },
    }
  },
  methods: {
    attemptLogin() {
      axios.post('/api/login', {
        email: this.email,
        password: this.password
      }).then(res => {
        if (res.data.status === 'error') {
          this.error_shown = true
        }
        else {
          this.error_shown = false
          const user = {email: res.data.user.email, admin: res.data.user.admin, supervisor: res.data.user.supervisor, id: res.data.user.id, name: res.data.user.name, formacion: res.data.user.formacion, fechaNacimiento: res.data.user.fecha_nacimiento, supervisado: res.data.user.supervisado, categoria: res.data.user.category_id, profileImage: res.data.user.image_url}
          store.dispatch('actualiseUser', user)
          store.dispatch('actualiseToken', res.data.authorisation.token)
          localStorage.setItem('user', JSON.stringify(user))
          localStorage.setItem('_token', res.data.authorisation.token)
          this.$router.push('/')
        }
      }).catch(error => {
        this.error_shown = true;
      })
    }
  },
}
</script>

<style lang="scss">
@import '~@resources/sass/preset/pages/auth.scss';
</style>
