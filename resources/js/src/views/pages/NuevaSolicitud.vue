<template>
    <v-form
    ref="form"
    v-model="valid"
    lazy-validation
    >
        <v-select
        v-model="select"
        :items="items"
        :rules="[v => !!v || 'El tipo es requerido']"
        label="Tipo"
        required
        ></v-select>

        <v-text-field
        v-model="description"
        :counter="50"
        :rules="descrRules"
        label="Descripción"
        required
        ></v-text-field>

        <div>
            <!-- <div class="mb-6">Active picker: <code>{{ activePicker || 'null' }}</code></div> -->
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
                <v-text-field
                v-model="date"
                label="Fecha inicial"
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
        <!-- :max="(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)" -->
        <div>
            <!-- <div class="mb-6">Active picker: <code>{{ activePicker || 'null' }}</code></div> -->
            <v-menu
            ref="menu2"
            v-model="menu2"
            :close-on-content-click="false"
            transition="scale-transition"
            offset-y
            min-width="auto"
            >
            <template v-slot:activator="{ on, attrs }">
                <v-text-field
                v-model="date2"
                label="Fecha final"
                readonly
                v-bind="attrs"
                v-on="on"
                ></v-text-field>
            </template>
            <v-date-picker
                v-model="date2"
                :active-picker.sync="activePicker"
                v-bind:min="this.date"
                @change="save2"
            ></v-date-picker>
            </v-menu>
        </div>

        <v-file-input
        v-model="justificante"
        show-size
        counter
        multiple
        label="File input"
        ></v-file-input>

        <v-btn
        :disabled="!valid"
        color="primary"
        class="mr-4"
        @click="validate"
        >
            Enviar solicitud
        </v-btn>

        <v-btn
        color="error"
        class="mr-4"
        :to="{ name: 'pages-solicitudes' }"
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
        created() {
            //this.$store.dispatch('fetchUser')
        },
        data: () => ({
            valid: true,
            description: '',
            descrRules: [
                v => !!v || 'La descripción es requerida',
                v => (v && v.length <= 50) || 'La descripción debe tener menos de 50 caracteres',
            ],
            dateRules: [
                v => !!v || 'La fecha es requerida',
            ],
            select: null,
            items: [
                'Baja',
                'Vacaciones',
                'Otros',
            ],
            checkbox: false,
            justificante: null,
            // fecha
            activePicker: null,
            date: null,
            menu: false,
            date2: null,
            menu2: false,
        }),
        computed: {
            user() {
                return this.$store.state.user.user
            },
        },
        methods: {
            validate () {
                this.$refs.form.validate()

                if(this.valid) {
                    this.sendSolicitud()
                }
            },
            async sendSolicitud() {
                const formData = new FormData();
                formData.append('descripcion', this.description);
                formData.append('tipo', this.select);
                formData.append('fecha_inicio', this.date);
                if(this.date2 == null) {formData.append('fecha_fin', this.date);}
                else {formData.append('fecha_fin', this.date2);}
                if(this.justificante != null) { formData.append('justificante_name', this.justificante[0].name);}
                else {formData.append('justificante_name', 'No consta');}
                formData.append('user_id', this.user.id);

                try {
                    await axios.post('http://localhost:8000/api/solicitudes/' + this.user.id, formData)
                    .then(response => {
                        // console.log(response);
                        //  console.log(this.justificante);
                        if(this.justificante == null) {
                            this.$router.push({ name: 'pages-solicitudes' })
                        }
                        return axios.post('http://localhost:8000/api/solicitud/file', {
                            justificante: this.justificante,
                            justificante_name: this.justificante[0].name,
                        }).then(response => {
                            // console.log(response);
                            this.$router.push({ name: 'pages-solicitudes' })
                        })
                    })
                    .catch(error => {
                        console.log(error);
                    });
                    
                } catch (error) {
                    console.log(error);
                }
            },
            reset () {
                this.$refs.form.reset()
            },
            resetValidation () {
                this.$refs.form.resetValidation()
            },
            // fecha
            save (date) {
                this.$refs.menu.save(date)
            },
            save2 (date2) {
                this.$refs.menu2.save(date2)
            },
        },
        watch: {
            // fecha
            menu (val) {
                val && setTimeout(() => (this.activePicker = 'YEAR'))
            },
            menu2 (val2) {
                val2 && setTimeout(() => (this.activePicker = 'YEAR'))
            },
        },
    }
</script>

<style scoped>

</style>