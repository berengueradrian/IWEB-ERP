<template>
  <section>
    <h2 class="mb-10">Nuevo empleado</h2>
    <v-form ref="form" v-model="valid" lazy-validation>
      <!-- Name -->
      <v-text-field 
        v-model="name"
        :counter="50"
        :rules="gralRules"
        label="Nombre"
        required
        class="form-text-input"
        ></v-text-field>
      <!-- Email -->
      <v-text-field
        v-model="email"
        :counter="20"
        :rules="mailRules"
        label="Mail"
        required
        class="form-text-input"
      ></v-text-field>
      <!-- Formation -->
      <v-textarea
        name="formacion"
        v-model="formation"
        label="Describe su formación"
        :rules="formationRules"
        hint="El máximo son 100 carácteres"
        class="form-text-input"
      ></v-textarea>
      <!-- Category -->
      <v-select
        v-model="category"
        :items="$store.state.categorias"
        item-text="name"
        item-value="id"
        :rules="[v => !!v || 'La categoría es requerida']"
        label="Categoría"
        required
        class="form-text-input"
      ></v-select>
      <!-- Role -->
      <v-select
        v-model="role"
        :items="roleItems"
        :rules="[v => !!v || 'El rol es requerido']"
        label="Rol"
        required
        class="form-text-input"
      ></v-select>
      <!-- Equipo -->
      <v-select
        v-model="supervisor"
        :items="$store.state.supervisores"
        item-text="name"
        item-value="id"
        label="Equipo"
        class="form-text-input"
      ></v-select>
      <!-- Contraseña -->
      <v-text-field
        v-model="password"
        :type="isPasswordVisible ? 'text' : 'password'"
        label="Password"
        placeholder="············"
        :append-icon="isPasswordVisible ? icons.mdiEyeOffOutline : icons.mdiEyeOutline"
        hide-details
        class="form-text-input"
        style="margin-bottom: 30px"
        @click:append="isPasswordVisible = !isPasswordVisible"
      ></v-text-field>
      <!-- Fecha nacimiento -->
      <div>
          <v-menu
          ref="menu"
          v-model="menu"
          :close-on-content-click="false"
          transition="scale-transition"
          offset-y
          required
          min-width="auto"
          >
          <template v-slot:activator="{ on, attrs }">
              <v-text-field class="form-text-input"
              v-model="date"
              label="Fecha nacimiento"
              readonly
              v-bind="attrs"
              v-on="on"
              ></v-text-field>
          </template>
          <v-date-picker
              v-model="date"
              required
              :active-picker.sync="activePicker"
              min="1950-01-01"
              @change="save"
              
          ></v-date-picker>
          </v-menu>
      </div>
      <!-- Foto perfil -->
      <v-file-input
        placeholder="Foto de perfil"
        chips
        truncate-length="15"
        v-model="profile_img"
        class="form-text-input"
      ></v-file-input>
      <!-- Botones -->
      <div class="mt-10">
        <v-btn
        :disabled="!valid"
        color="primary"
        class="mr-4"
        @click="validate"
        >
          Añadir empleado
        </v-btn>

        <v-btn
        color="error"
        class="mr-4"
        :to="{ name: 'superole-dashboard' }"
        @click="reset"
        >
            Cancelar
        </v-btn>

        <v-btn
        color="warning"
        @click="reset"
        >
            Reestablecer
        </v-btn>
      </div>
    </v-form>        
  </section>
</template>

<script>
import axios from 'axios';
import { mdiEyeOutline, mdiEyeOffOutline } from '@mdi/js'

export default {
  methods: {
    validate() {
      this.$refs.form.validate()

      if(this.valid) {
        this.crearEmpleado()
      }
    },
    crearEmpleado() {
      const formData = new FormData();
      formData.append('name', this.name)
      formData.append('email', this.email)
      formData.append('category', this.category)
      if (this.role === 'Empleado') {
        formData.append('role', 0)
      }
      else {
        formData.append('role', 1)
      }
      formData.append('supervisor', this.supervisor)
      formData.append('password', this.password)
      formData.append('img_url', this.profile_img)
      formData.append('birthday', this.date)
      formData.append('formacion', this.formation)
      
      axios.post('/api/users', formData)
        .then(() => this.$router.push('/superole/dashboard'))
        .catch(error => console.log('ERROR: ' + error))
    },
    reset() {
      this.$refs.form.reset()
    },
    save (date) {
      this.$refs.menu.save(date)
    },
  },
  data() {
    return {
      valid: true,
      gralRules: [
        v => !!v || 'Campo requerido',
        v => (v && v.length <= 50) || 'Este campo debe tener menos de 50 caracteres',
      ],
      mailRules: [
        v => !!v || 'Campo requerido',
        v => (v && v.length <= 50) || 'Este campo debe tener menos de 50 caracteres',
        v => (v && v.includes('@')) || 'Este campo debe ser un email'
      ],
      formationRules: [
        v => !!v || 'Campo requerido',
        v => (v && v.length <= 100) || 'Este campo debe tener menos de 100 caracteres',
      ],
      name: '',
      email: '',
      category: '',
      role: '',
      supervisor: '',
      roleItems: ['Empleado', 'Supervisor'],
      password: '',
      isPasswordVisible: false,
      icons: {mdiEyeOutline, mdiEyeOffOutline},
      menu: false,
      activePicker: null,
      date: null,
      profile_img: null,
      formation: ''
    }
  },
  watch: {
    menu (val) {
      val && setTimeout(() => (this.activePicker = 'YEAR'))
    },
  }
}
</script>

<style lang="scss">
.form-text-input{
  width: 500px;
}
</style>