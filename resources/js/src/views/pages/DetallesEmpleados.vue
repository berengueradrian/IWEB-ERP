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
                <v-card-text> <b>Equipos a los que pertenece: </b>  {{ this.user.supervisor }} </v-card-text>
            </div>  
            <div style="display:flex; flex-flow: row;  justify-content:center; gap: 20px;">
                <v-btn
                    color="info" v-if="this.user.es_admin == false">
                    Ver historial de solicitudes 
                </v-btn>
                <v-btn v-if="this.user.es_admin == false"
                    color="info">
                    Ver convenio
                </v-btn>
            </div>
        </div>
      </div>
      
      <!-- Botones -->
      <div style="display:flex; flex-flow:row; justify-content: center; gap: 20px;">
        <v-btn
        color="primary" >
          Editar datos
        </v-btn>

        <v-btn color="error" v-if="this.user.es_admin == false" @click="dialog = true">
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
    async created() {
        axios.get('/api/users/' + this.$route.params.id,{
            headers: {
            'Authorization': 'Bearer ' + store.state._token
            },
            params:{
                'api_key':'secreto'
            }
        })
        .then(async response => {
            console.log(response.data.data)
            this.user = response.data.data;
            this.user.name = response.data.data.name;
            this.user.email = response.data.data.email;
            this.user.category = response.data.data.category;
            this.user.fecha_nacimiento = response.data.data.fecha_nacimiento;
            this.user.formation = response.data.data.formation;
            this.user.es_supervisor = response.data.data.supervisor;
            this.user.es_admin = response.data.data.admin;
            this.user.supervisado_por = response.data.data.supervisado;
            this.user.image_url = response.data.data.image_url;
        })
        .catch(error => {
            console.log(error);
        });
    },
    setup() {
      return {
        store
      }
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
                supervisado_por: '',
                image_url: ''
            },
            dialog: false,
        }
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