<template>

<section>
    <h2 class="mb-10">Detalles del empleado</h2>

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
                    <v-card-text> <b>Nombre completo: </b> {{ this.user.name }} </v-card-text>
                </div>
                
                <!-- Email -->

                <div class="linea">
                    <v-card-text> <b>Correo electrónico: </b> {{ this.user.email }} </v-card-text>
                </div>

                <!-- Fecha nacimiento -->
                <div class="linea">
                    <v-card-text> <b>Fecha de nacimiento: </b> {{ this.user.fecha_nacimiento }} </v-card-text>
                </div>
                <div style="display:flex; flex-flow: row; width:100%; justify-content:center; ">
                    <v-btn
                    color="success">
                        <a :href="'mailto:' + this.user.email " style="text-decoration:none; color:white"> Contactar </a>
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
                    <v-card-text> <b>Categoría: </b> 
                        <template v-if="this.user.category">
                            {{ this.user.category }}
                        </template>
                        <template v-else>
                            Sin asignar
                        </template>
                    </v-card-text>
            </div>
            <!-- Role -->
            <div class="linea">
                    <v-card-text> <b>Rol: </b> 
                    <template v-if="this.user.es_admin == true">
                        Administrador
                    </template>
                    <template v-else-if="this.user.es_supervisor == true">
                        Supervisor
                    </template>
                    <template v-else>
                        Empleado
                    </template>
                    
                    </v-card-text>
            </div>  
            <!-- Formation -->
            <div class="linea">
                <v-card-text> <b>Formación: </b> 
                    <template v-if="this.user.formation">
                        {{ this.user.formation }} 
                    </template>
                    <template v-else>
                        Desconocida
                    </template>
                </v-card-text>
            </div>
            <!-- Role -->
            <div class="linea">
                <v-card-text> <b>Equipo al que pertenece: </b>  
                    <template v-if="this.nombre_supervisor">
                        {{ this.nombre_supervisor }} 
                    </template>
                    <template v-else>
                        Ninguno
                    </template>
                </v-card-text>
            </div>  
        </div>
        </div>
        <div class="section-data-form">
            <div class="section-container">
                <h3 class="mb-5 mt-5">Convenio</h3>
                <!-- Sueldo base -->
                <div class="linea">
                        <v-card-text> <b>Sueldo base: </b> 
                            {{ this.user.sueldo_base }} €
                        </v-card-text>
                </div>
                <div class="linea">
                        <v-card-text> <b>Máximo de horas diarias: </b> 
                            {{ this.user.horas_diarias }} h
                        </v-card-text>
                </div>
                <div class="linea">
                        <v-card-text> <b>Sueldo por hora extra: </b> 
                            {{ this.user.sueldo_horas_extra }} €
                        </v-card-text>
                </div>
                <div class="linea">
                        <v-card-text> <b>Horas extra máximas al mes: </b> 
                            {{ this.user.tope_horas_extra }} h
                        </v-card-text>
                </div>
                <div class="linea">
                        <v-card-text> <b> Paga extraordinaria: </b> 
                            {{ this.user.sueldo_extraordinario }} h
                        </v-card-text>
                </div>
                <div class="linea">
                        <v-card-text> <b> Días de vacaciones disponibles al año : </b> 
                            {{ this.user.dias_vacaciones }} h
                        </v-card-text>
                </div>
                <div style="display:flex; flex-flow: row;  justify-content:center; gap: 20px;">
                    <v-btn
                        color="info" v-if="this.user.es_admin == false" :to="{ name: 'pages-solicitudes-usuario-administrador', params: {id:this.user.id} }" >
                        Ver historial de solicitudes 
                    </v-btn>
                </div>
            </div>
            
        </div>
      
      
      <!-- Botones -->
      <div style="display:flex; flex-flow:row; justify-content: center; gap: 20px;">
        <v-btn v-if="this.$store.state.user.admin"
        color="primary" :to="{name: 'pages-empleados-editar', params: {id: user.id}}" >
          Editar datos
        </v-btn>

        <v-btn color="error" v-if="this.user.es_admin == false && this.$store.state.user.admin" @click="dialog = true">
            Eliminar empleado
        </v-btn>

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

        <v-btn color="warning" :to="{ name: 'superole-dashboard' }">
            Volver
        </v-btn>
      </div>    
  </section>

</template>

<script>
import axios from 'axios';
import store from '../../store/index.js';
import FileUploadComponent from '../../components/FileUploadComponent.vue'
import { nullLiteral } from '@babel/types';


export default {
    setup() {
      return {
        store
      }
    },
    async created() {
        await this.$store.dispatch('fetchSupervisor')


        axios.get('/api/users/' + this.$route.params.id,{
            headers: {
            'Authorization': 'Bearer ' + store.state._token
            },
            params:{
                'api_key':'secreto'
            }
        })
        .then(async response => {
            this.user = response.data.data;
            this.user.name = response.data.data.name;
            this.user.email = response.data.data.email;
            this.user.category = response.data.data.category;
            this.user.fecha_nacimiento = response.data.data.fecha_nacimiento;
            this.user.formation = response.data.data.formation;
            this.user.es_supervisor = response.data.data.supervisor;
            this.user.es_admin = response.data.data.admin;
            this.user.image_url = response.data.data.image_url;
            this.user.sueldo_base = response.data.data.convenio.sueldo;
            this.user.horas_diarias = response.data.data.convenio.horas_diarias;
            this.user.sueldo_horas_extra = response.data.data.convenio.sueldo_horas_extra;
            this.user.tope_horas_extra = response.data.data.convenio.tope_horas_extra;
            this.user.sueldo_extraordinario = response.data.data.convenio.sueldo_extraordinario;
            this.user.dias_vacaciones = response.data.data.convenio.dias_vacaciones;


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
    data() {
        return {
            user: {
                name: '',
                email: '',
                category: '',
                formation: '',
                teams: '',
                fecha_nacimiento: '',
                es_supervisor: '',
                es_admin: '',
                image_url: '',
                sueldo_base: '',
                horas_diarias: '',
                sueldo_horas_extra: '',
                tope_horas_extra: '',
                sueldo_extraordinario: '',
                dias_vacaciones: ''

            },
            nombre_supervisor: '',
            dialog: false
        }
    },
    computed: {
        supervisor() {
        //this.$store.dispatch('fetchCompletada')
        return this.$store.state.supervisor
        },
    },
    methods: {
        deleteUser(){
            this.dialog = false;
            axios.delete('http://localhost:8000/api/users/' + this.$route.params.id,{
                    headers: {
                    'Authorization': 'Bearer ' + store.state._token
                    }
                })
                .then(async response => {
    
                    this.$router.push({ name: 'superole-dashboard' })
                })
                .catch(error => {
                    console.log(error);
                });
        }
            
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