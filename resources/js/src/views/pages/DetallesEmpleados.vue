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

        <file-upload-component></file-upload-component>
      
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
  </section>

</template>

<script>
import axios from 'axios';
import store from '../../store/index.js';
import FileUploadComponent from '../../components/FileUploadComponent.vue'


export default {
    async created() {
        axios.get('/api/users/' + this.$route.params.id,{
            headers: {
            'Authorization': 'Bearer ' + store.state._token
            }
        })
        .then(async response => {
            console.log(response.data.data)
            this.user = response.data.data;
            this.user.name = response.data.data.name;
            console.log(this.user.name)
        })
        .catch(error => {
            console.log(error);
        });
    },
    setup() {
      return {
        store,
        user: {
            name: '',
            email: '',
            birthdate: '',
            category: '',
            role: '',
            formation: '',
            teams: '',
        }
      }
    },
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