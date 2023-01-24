<template>

<section>
    <h2 class="mb-10">Detalles del empleado</h2>
    <v-form ref="form" v-model="valid" lazy-validation>
        <div class="section-top">
            <div class="section-container">
            <!-- image located in public/images/1.png -->
            <img src="/images/1.png" alt="imagen empleado" class="img-employee">
            </div>
            <div class="section-data-form">
                <div class="section-container top">
                <h3 class="mb-5 mt-5">Datos personales</h3>
                <!-- Name -->
                <div class="linea">
                    <v-card-text> <b>Nombre completo: </b> rosa maria rodriguez lledo </v-card-text>
                </div>
                
                <!-- Email -->

                <div class="linea">
                    <v-card-text> <b>Correo electrónico: </b> rosa maria rodriguez lledo </v-card-text>
                </div>

                <!-- Fecha nacimiento -->
                <div class="linea">
                    <v-card-text> <b>Fecha de nacimiento: </b> 12/12/1990 </v-card-text>
                </div>
                <div style="display:flex; flex-flow: row; width:100%; justify-content:center; ">
                    <v-btn
                    color="success">
                        <a href="mailto:rosam1010.rr@gmail.com" style="text-decoration:none; color:white"> Contactar </a>
                    </v-btn>
                </div>

                </div>
            </div>
        </div>

      <div class="section-data-form">
        <div class="section-container">
        <h3 class="mb-5 mt-5">Datos profesionales</h3>
            <!-- Category -->
            <div class="linea">
                    <v-card-text> <b>Categoría: </b> marketing</v-card-text>
            </div>
            <!-- Role -->
            <div class="linea">
                    <v-card-text> <b>Rol: </b> empleado</v-card-text>
            </div>  
            <!-- Formation -->
            <div class="linea">
                <v-card-text> <b>Formación: </b> Estudiantecien</v-card-text>
            </div>
            <!-- Role -->
            <div class="linea">
                <v-card-text> <b>Equipos a los que pertenece: </b> Ilyan, rosa</v-card-text>
            </div>  
            <div style="display:flex; flex-flow: row;  justify-content:center; gap: 20px;">
                <v-btn
                    color="info">
                    Ver historial de solicitudes 
                </v-btn>
                <v-btn
                    color="info">
                    Ver convenio
                </v-btn>
            </div>
        </div>
      </div>
      
      <!-- Botones -->
      <div style="display:flex; flex-flow:row; justify-content: center; gap: 20px;">
        <v-btn
        color="primary">
          Editar datos
        </v-btn>

        <v-btn color="error">
            Eliminar empleado
        </v-btn>

        <v-btn color="warning">
            Volver
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

v-text-field{
  width: 400px;
}

v-card-text{
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

.top{
    min-width: 900px;
}
.section-top{
    display:flex;
    justify-content: space-between;
    flex-flow: row wrap;
}

.img-employee{
    width: 250px;
    height: 250px;
    border-radius: 50%;
}

.linea{
    display:flex;
    flex-flow: column wrap;
    width: 100%;
}
</style>