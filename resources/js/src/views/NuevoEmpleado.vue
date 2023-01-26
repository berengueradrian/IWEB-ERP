<template>
  <section>
    <h2 class="mb-10">Nuevo empleado</h2>
    <v-form ref="form" v-model="valid" lazy-validation>
      <div class="section-data-form">
        <div class="section-container">
        <h3 class="mb-5 mt-5">Datos personales</h3>
        <!-- Name -->
        <v-text-field 
          v-model="name"
          :counter="50"
          :rules="gralRules"
          label="Nombre"
          required
          class="form-text-input mr-10 mb-5"
          style="display: inline-block"
          ></v-text-field>
        <!-- Email -->
        <v-text-field
          v-model="email"
          :counter="20"
          :rules="mailRules"
          label="Mail"
          required
          class="form-text-input"
          style="display: inline-block"
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
        </div>
      </div>
      <div class="section-data-form">
        <div class="section-container">
        <h3 class="mb-5 mt-5">Datos profesionales</h3>
        <!-- Category -->
        <v-select
          v-model="category"
          :items="$store.state.categorias"
          item-text="name"
          item-value="id"
          :rules="[v => !!v || 'La categoría es requerida']"
          label="Categoría"
          required
          class="form-text-input mr-10 mb-5"
          style="display: inline-block"
        ></v-select>
        <!-- Role -->
        <v-select
          v-model="role"
          :items="roleItems"
          :rules="[v => !!v || 'El rol es requerido']"
          label="Rol"
          required
          class="form-text-input"
          style="display: inline-block"
        ></v-select>
        <!-- Formation -->
        <v-textarea
          name="formacion"
          v-model="formation"
          label="Describe su formación"
          :rules="formationRules"
          hint="El máximo son 100 carácteres"
          class="form-text-input mr-10"
          style="display: inline-block"
        ></v-textarea>
        <!-- Equipo -->
        <v-select
          v-model="supervisor"
          :items="$store.state.supervisores"
          item-text="name"
          item-value="id"
          label="Equipo"
          class="form-text-input mb-5"
          style="display: inline-block"
        ></v-select>
        </div>
      </div>
      <div class="section-data-form">
        <div class="section-container">
        <h3 class="mb-5 mt-5">Información de la cuenta</h3>
        <!-- Contraseña -->
        <v-text-field
          v-model="password"
          :type="isPasswordVisible ? 'text' : 'password'"
          label="Password"
          placeholder="············"
          :append-icon="isPasswordVisible ? icons.mdiEyeOffOutline : icons.mdiEyeOutline"
          hide-details
          class="form-text-input mr-10"
          style="margin-bottom: 30px; display: inline-block"
          @click:append="isPasswordVisible = !isPasswordVisible"
        ></v-text-field>
        <!-- Foto perfil -->
        <div style="display:inline-block">
        <v-file-input
          placeholder="Foto de perfil"
          chips
          truncate-length="15"
          v-model="profile_img"
          class="form-text-input"
        ></v-file-input>
        </div>
        </div>
      </div>
      <div class="section-data-form">
        <div class="section-container">
          <h3 class="mb-5 mt-5">Convenio</h3>
          <!-- Convenio base -->
          <v-text-field
          v-model="sueldo_base"
          type="number"
          :rules="numericRules"
          label="Sueldo base"
          required
          class="form-text-input mr-10"
          style="display: inline-block;"
        ></v-text-field>
        <v-text-field
          v-model="horas_diarias"
          type="number"
          :rules="numericRules"
          label="Horas diarias"
          required
          class="form-text-input"
          style="display: inline-block"
        ></v-text-field>
        <!-- Horas extra -->
        <v-text-field
          v-model="sueldo_horas_extra"
          type="number"
          :rules="numericRules"
          label="Sueldo horas extra"
          required
          class="form-text-input mr-10"
          style="display: inline-block"
        ></v-text-field>
        <v-text-field
          v-model="tope_horas_extra"
          type="number"
          :rules="numericRules"
          label="Tope horas extra"
          required
          class="form-text-input"
          style="display: inline-block"
        ></v-text-field>
        <!-- Más -->
        <v-text-field
          v-model="sueldo_extraordinario"
          type="number"
          :rules="numericRules"
          label="Sueldo extraordinario"
          required
          class="form-text-input mr-10"
          style="display: inline-block"
        ></v-text-field>
        <v-text-field
          v-model="dias_vacaciones"
          type="number"
          :rules="numericRules"
          label="Dias de vacaciones"
          required
          class="form-text-input"
          style="display: inline-block"
        ></v-text-field>
        </div>
      </div>
      
      
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
  created() {
    if (this.$store.state.categorias.length === 0) {
      this.$store.dispatch('fetchCategorias')  
    }
    if (this.$store.state.supervisores.length === 0) {
      this.$store.dispatch('fetchSupervisores')  
    }
  },
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
      formData.append('sueldo', this.sueldo_base)
      formData.append('horas_diarias', this.horas_diarias)
      formData.append('sueldo_horas_extra', this.sueldo_horas_extra)
      formData.append('tope_horas_extra', this.tope_horas_extra)
      formData.append('sueldo_extraordinario', this.sueldo_extraordinario)
      formData.append('dias_vacaciones', this.dias_vacaciones)
      axios.post('/api/users',
        formData, 
        {headers: {
          'Authorization': 'Bearer ' + this.$store.state._token
        }}
      )
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
      numericRules: [
        v => !!v || 'Campo requerido'
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
      formation: '',
      sueldo_base:'',
      horas_diarias:'',
      sueldo_horas_extra:'',
      tope_horas_extra:'',
      sueldo_extraordinario:'',
      dias_vacaciones:''
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
v-text-field{
  width: 400px;
}
.section-data-form{
  margin-bottom: 50px;
  border: 1px solid #ccc;
  border-radius: 4px;
}
.section-container{
  margin-left: 20px;
  margin-bottom: 20px;
}
</style>