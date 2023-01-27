<template>

  <section>
      <h2 class="mb-10">Editar empleado</h2>
      <v-form ref="form" v-model="valid" lazy-validation>
          <div class="section-top">
              <div class="section-container">
              <!-- image located in public/images/1.png -->
              <img src="/images/1.png" alt="imagen empleado" class="img-employee">
              </div>
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
                          v-model="fecha_nacimiento"
                          label="Fecha nacimiento"
                          readonly
                          v-bind="attrs"
                          v-on="on"
                          ></v-text-field>
                      </template>
                      <v-date-picker
                          v-model="fecha_nacimiento"
                          required
                          :active-picker.sync="activePicker"
                          min="1950-01-01"
                          @change="save"  
                      ></v-date-picker>
                      </v-menu>
                  </div>
                  <div class="botones"> 
                    <v-btn
                    color="warning">
                        Reestablecer
                    </v-btn>
                    <v-btn
                    color="primary"
                    class="mr-4"
                    @click="validate">
                      Guardar cambios
                    </v-btn>
                  </div>
                  </div>
              </div>
          </div>
      </v-form>
      <v-form ref="form2" v-model="valid2" lazy-validation>
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

          <div class="botones"> 
              <v-btn
              color="warning">
                  Reestablecer
              </v-btn>
              <v-btn
              color="primary"
              class="mr-4"
              @click="validate2">
                Guardar cambios
              </v-btn>
            </div>

          </div>
        </div>
      </v-form>
      <v-form ref="form3" v-model="valid3" lazy-validation>
        <div class="section-data-form">
          <div class="section-container">
          <h3 class="mb-5 mt-5">Datos laborales</h3>

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

        <div class="botones"> 
              <v-btn
              color="warning">
                  Reestablecer
              </v-btn>
              <v-btn
              color="primary"
              class="mr-4"
              @click="validate3">
                Guardar cambios
              </v-btn>
            </div>

          </div>
        </div>
      </v-form>
      <v-form ref="form4" v-model="valid4" lazy-validation>
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
          <div class="botones"> 
              <v-btn
              color="warning">
                  Reestablecer
              </v-btn>
              <v-btn
              color="primary"
              class="mr-4"
              @click="validate4">
                Guardar cambios
              </v-btn>
            </div>
          </div>
        </div>
      </v-form>
        
        <!-- Botones -->
        <div class="botones">
  
          <v-btn
          color="warning"
          class="mr-4"
          :to="{ name: 'pages-empleados-detalles', params: {id: user_id} }"

          >
              Volver
          </v-btn>

          <v-btn
          color="error"
          class="mr-4"
          @click="dialog = true"  v-if="this.admin == false "
          >
              Borrar empleado
          </v-btn>

        </div>     

      <v-dialog
            v-model="dialog"
            persistent
            max-width="590px"
            >

            <v-card  v-if="this.dialog">
                <v-card-title class="text-h5"> ¿Estás seguro de que quieres eliminar a este empleado? </v-card-title>
                <v-card-text> Todos sus datos se perderán. </v-card-text>
                <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                    color="green darken-1" text @click="dialog = false">
                    Cancelar
                </v-btn>
                <v-btn
                    color="green darken-1" text @click="deleteUser">
                    Aceptar
                </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>

    </section>
  
  </template>
  
  <script>
  import axios from 'axios';
  import { mdiEyeOutline, mdiEyeOffOutline } from '@mdi/js'
  import store from '../../store/index.js';

  
  export default {
    created() {
      if (this.$store.state.categorias.length === 0) {
        this.$store.dispatch('fetchCategorias')  
      }
      if (this.$store.state.supervisores.length === 0) {
        this.$store.dispatch('fetchSupervisores')  
      }

      axios.get('/api/users/' + this.$route.params.id,{
            headers: {
            'Authorization': 'Bearer ' + store.state._token
            },
            params:{
                'api_key':'secreto'
            }
        })
        .then(async response => {
            this.name = response.data.data.name;
            this.email = response.data.data.email;
            this.category = response.data.data.category;
            this.fecha_nacimiento = response.data.data.fecha_nacimiento;
            this.formation = response.data.data.formation;
            this.es_supervisor = response.data.data.supervisor;
            this.es_admin = response.data.data.admin;
            this.formacion = response.data.data.formacion;
            this.image_url = response.data.data.image_url;
            this.sueldo_base = response.data.data.convenio.sueldo;
            this.convenio_id = response.data.data.convenio.id;
            this.horas_diarias = response.data.data.convenio.horas_diarias;
            this.sueldo_horas_extra = response.data.data.convenio.sueldo_horas_extra;
            this.tope_horas_extra = response.data.data.convenio.tope_horas_extra;
            this.sueldo_extraordinario = response.data.data.convenio.sueldo_extraordinario;
            this.dias_vacaciones = response.data.data.convenio.dias_vacaciones;

            if(this.es_supervisor){
              this.rol = "Supervisor"
            }
            else if (this.es_admin){
              this.rol = "Administrador"
            }
            else{
              this.rol = "Empleado"
            }


            //get the name of the supervisor
            axios.get('/api/supervisor/' + this.$route.params.id, {
                headers: {
                'Authorization': 'Bearer ' + store.state._token
                }
            }).then(async response =>  {
                this.nombre_supervisor = response.data.data.name;
            }).catch(error => {
                console.log(error);
            });

        })
        .catch(error => {
            console.log(error);
        });

    },
    methods: {
      validate() {
        this.$refs.form.validate()
  
        if(this.valid) {
          this.editarDatosPersonales()
        }
      },
      validate2(){
        this.$refs.form2.validate()
        if (this.valid2){
          this.editarDatosProfesionales()
        }
      },

      validate3(){
        this.$refs.form3.validate()
        if (this.valid3){
          this.editarDatosLaborales()
        }
      },

      validate4(){
        this.$refs.form4.validate()
        if (this.valid4){
          this.editarDatosCuenta()
        }
      },

      editarDatosPersonales(){

      },
      editarDatosProfesionales(){

      },
      editarDatosLaborales(){
        // llamada a metodo post para actualizar los datos en bbdd
        axios.post('/api/convenios/' + this.convenio_id, {
          sueldo: this.sueldo_base,
          horas_diarias: this.horas_diarias,
          sueldo_horas_extra: this.sueldo_horas_extra,
          tope_horas_extra: this.tope_horas_extra,
          sueldo_extraordinario: this.sueldo_extraordinario,
          dias_vacaciones: this.dias_vacaciones
        }, {
          headers: {
            'Authorization': 'Bearer ' + store.state._token
            }
        }).then(async response => {
          this.$router.push({ name: 'pages-empleados-detalles', params: {id: this.user_id}})
        })
      },
      editarDatosCuenta(){

      },
      deleteUser(){
        axios.delete('/api/users/' + this.user_id, {
          headers: {
            'Authorization': 'Bearer ' + store.state._token
            }
        })
        .then(async response => {
            this.$router.push({ name: 'superole-dashboard'})
        })
        .catch(err => {
          console.log(err)
        })
      },

      save (date) {
        this.$refs.menu.save(date)
      },
      
    },
    data() {
      return {
        valid: true,
        valid2: true,
        valid3: true,
        valid4: true,
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
        convenio_id: '',
        role: '',
        fecha_nacimiento: '',
        admin: '',
        supervisor: '',
        sueldo_base: '',
        horas_diarias: '',
        sueldo_horas_extra: '',
        tope_horas_extra: '',
        rol: '',
        sueldo_extraordinario: '',
        dias_vacaciones: '',
        user_id: this.$route.params.id,
        roleItems: ['Empleado', 'Supervisor'],
        password: '',
        isPasswordVisible: false,
        icons: {mdiEyeOutline, mdiEyeOffOutline},
        menu: false,
        activePicker: null,
        date: null,
        profile_img: null,
        formation: '',
        dialog: false,
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

  .botones{
    display: flex;
    justify-content: center;
    gap: 30px;
  }
  </style>