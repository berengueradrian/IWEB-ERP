<template>
  <v-menu offset-y left nudge-bottom="14" min-width="230" content-class="user-profile-menu-content">
    <template v-slot:activator="{ on, attrs }">
      <v-badge bottom color="success" overlap offset-x="12" offset-y="12" class="ms-4" dot>
        <v-avatar size="40px" v-bind="attrs" v-on="on">
          <v-img src="/images/1.png"></v-img>
        </v-avatar>
      </v-badge>
    </template>
    <v-list>
      <div class="pb-3 pt-2">
        <v-badge bottom color="success" overlap offset-x="12" offset-y="12" class="ms-4" dot>
          <v-avatar size="40px">
            <v-img src="/images/1.png"></v-img>
          </v-avatar>
        </v-badge>
        <div class="d-inline-flex flex-column justify-center ms-3" style="vertical-align: middle">
          <span class="text--primary font-weight-semibold mb-n1"> {{this.$store.state.user.name}} </span>
          <small class="text--disabled text-capitalize">{{this.$store.state.user.email}}</small>
        </div>
      </div>

      <v-divider></v-divider>

      <!-- Profile -->
      <!-- <v-list-item link>
        <v-list-item-icon class="me-2">
          <v-icon size="22">
            {{ icons.mdiAccountOutline }}
          </v-icon>
        </v-list-item-icon>
        <v-list-item-content>
          <v-list-item-title>Profile</v-list-item-title>
        </v-list-item-content>
      </v-list-item> -->

      <!-- Email -->
      <!-- <v-list-item link>
        <v-list-item-icon class="me-2">
          <v-icon size="22">
            {{ icons.mdiEmailOutline }}
          </v-icon>
        </v-list-item-icon>
        <v-list-item-content>
          <v-list-item-title>Inbox</v-list-item-title>
        </v-list-item-content>
      </v-list-item> -->

      <!-- Chat -->
      <!-- <v-list-item link>
        <v-list-item-icon class="me-2">
          <v-icon size="22">
            {{ icons.mdiChatOutline }}
          </v-icon>
        </v-list-item-icon>
        <v-list-item-content>
          <v-list-item-title>Chat</v-list-item-title>
        </v-list-item-content>

        <v-list-item-action>
          <v-badge inline color="error" content="2"> </v-badge>
        </v-list-item-action>
      </v-list-item> -->

      <!-- <v-divider class="my-2"></v-divider> -->

      <!-- Settings -->
      <!-- <v-list-item link>
        <v-list-item-icon class="me-2">
          <v-icon size="22">
            {{ icons.mdiCogOutline }}
          </v-icon>
        </v-list-item-icon>
        <v-list-item-content>
          <v-list-item-title>Settings</v-list-item-title>
        </v-list-item-content>
      </v-list-item> -->

      <!-- Pricing -->
      <!-- <v-list-item link>
        <v-list-item-icon class="me-2">
          <v-icon size="22">
            {{ icons.mdiCurrencyUsd }}
          </v-icon>
        </v-list-item-icon>
        <v-list-item-content>
          <v-list-item-title>Pricing</v-list-item-title>
        </v-list-item-content>
      </v-list-item> -->

      <!-- FAQ -->
      <!-- <v-list-item link>
        <v-list-item-icon class="me-2">
          <v-icon size="22">
            {{ icons.mdiHelpCircleOutline }}
          </v-icon>
        </v-list-item-icon>
        <v-list-item-content>
          <v-list-item-title>FAQ</v-list-item-title>
        </v-list-item-content>
      </v-list-item> -->

      

      <!-- Logout -->
      <v-list-item link @click="logout">
        <v-list-item-icon class="me-2">
          <v-icon size="22">
            {{ icons.mdiLogoutVariant }}
          </v-icon>
        </v-list-item-icon>
        <v-list-item-content>
          <v-list-item-title>Logout</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </v-list>
  </v-menu>
</template>

<script>
import {
  mdiAccountOutline,
  mdiEmailOutline,
  mdiCheckboxMarkedOutline,
  mdiChatOutline,
  mdiCogOutline,
  mdiCurrencyUsd,
  mdiHelpCircleOutline,
  mdiLogoutVariant,
} from '@mdi/js'
import store from '../../store/index.js';
import axios from 'axios'
export default {
  setup() {
    return {
      icons: {
        mdiAccountOutline,
        mdiEmailOutline,
        mdiCheckboxMarkedOutline,
        mdiChatOutline,
        mdiCogOutline,
        mdiCurrencyUsd,
        mdiHelpCircleOutline,
        mdiLogoutVariant,
      },
      store
    }
  },
  computed: {
    profileImage() {
      return '/storage/' + this.$store.state.user.profileImage
    },
  },
  methods: {
    async logout() {
      try {
        await axios.post('/api/logout', {},{
          headers: {
            'Authorization': 'Bearer ' + this.$store.state._token
          }
        })
      } catch (error) {
        console.log(error)
      } finally {
        this.$store.dispatch('actualiseUser', null)
        this.$store.dispatch('actualiseToken', null)
        localStorage.removeItem('user')
        localStorage.removeItem('_token')
        this.$router.push('/login')
      }
    }
  }
}
</script>

<style lang="scss">
.user-profile-menu-content {
  .v-list-item {
    min-height: 2.5rem !important;
  }
}
</style>
