<template>
    <v-form
    ref="form"
    v-model="valid"
    lazy-validation
    >
    <h2 class="mb-10">Nueva categoría</h2>

        <v-text-field v-model="nombre" :counter="50" :rules="nombreRules" label="Nombre" required ></v-text-field>

        <v-btn :disabled="!valid" color="primary" class="mr-4" @click="validate">
            Enviar categoría
        </v-btn>

        <v-btn color="error" class="mr-4" :to="{ name: 'pages-categorias' }" @click="reset">
            Cancelar
        </v-btn>

        <v-btn color="warning" @click="reset">
            Reestablecer
        </v-btn>
    </v-form>
</template>

<script>
    import store from '../../store/index.js';
    import axios from 'axios';

    export default {
        setup() {
            return {
                store,
            }
        },
        data: () => ({
            valid: true,
            nombre: '',
            nombreRules: [
                v => !!v || 'El nombre es obligatorio',
                v => (v && v.length <= 50) || 'El nombre debe tener menos de 50 caracteres',
            ]
        }),
        methods: {
            validate () {
                this.$refs.form.validate()

                if(this.valid) {
                    this.sendSolicitud()
                }
            },
            async sendSolicitud() {
                const formData = new FormData();
                formData.append('name', this.nombre);
                // print name from formData
                //console.log(formData.get('name'));
                await axios.post('/api/categorias/', formData, {
                    headers: {
                    'Authorization': 'Bearer ' + store.state._token
                    }
                })
                .then(async response => {
                    //console.log(response);
                    await this.$store.dispatch('fetchCategorias')
                    this.$router.push({ name: 'pages-categorias' })
                })
                .catch(error => {
                    console.log(error);
                });
                    
            },
            reset () {
                this.$refs.form.reset()
            },
            resetValidation () {
                this.$refs.form.resetValidation()
            },
        }
    }
</script>