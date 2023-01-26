<template>
    <div>
      <v-simple-table fixedHeader>
        <template v-slot:default>
          <thead>
            <tr>
              <th v-if="$store.state.user.admin" class="text-uppercase">
                Empleado
              </th>
              <th class="text-center text-uppercase">
                Mes
              </th>
              <th class="text-center text-uppercase">
                Año
              </th>
              <th class="text-center text-uppercase">
                Estado
              </th>
              <th class="text-center text-uppercase">
                Acciones
              </th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="nomina in nominas"
              :key="nomina.id"
            >
              <td v-if="$store.state.user.admin">{{ nomina.user.name }}</td>
              <td class="text-center">
                {{ numeroAMes(nomina.mes) }}
              </td>
              <td class="text-center">
                {{ nomina.anyo }}
              </td>
              <td class="text-center">
                <v-chip
                  small
                  :color="nomina.estado == 0 ? 'error' : 'success'"
                  class="font-weight-medium"
                >
                  {{ nomina.estado == 0 ? 'Pendiente' : 'Pagada' }}
                </v-chip>
              </td>
              <td class="text-center">
                  <v-btn v-if="nomina.estado == 0 && $store.state.user.admin"
                      color="primary"
                      class="mr-2"
                      @click="pagarNomina(nomina.id)"
                  >
                      Pagar
                  </v-btn>
                  <v-btn v-if="nomina.estado == 1"
                      color="primary"
                      class="mr-2"
                      @click="generarPDF(nomina.id)"
                  >
                      Descargar
                  </v-btn>
              </td>
            </tr>
          </tbody>
        </template>
      </v-simple-table>
      <div id="tabla-nomina-pdf">
        <div id="pdf">
          <div id="info-empresa-empleado">
            <div id="info-empresa">
              <h2 style="margin-bottom: 15px;">Empresa</h2>
              <p>Nombre: ERP - RRHH</p>
              <p>Dirección: Universidad de Alicante</p>
              <p>Teléfono: 965 90 90 90</p>
              <p>Email: erp@rrhh.ua.es </p>
            </div>
            <div id="info-empleado">
              <h2 style="margin-bottom: 15px;">Empleado</h2>
              <p>Nombre: {{ nominaDescargar.user.name }}</p>
              <p>Email: {{ nominaDescargar.user.email }} </p>
            </div>
          </div>
          <div id="info-paga">
            <h2 style="margin-bottom: 15px;margin-top: 15px;">Estado de la nomina</h2>
            <p>Estado: {{ nominaDescargar.estado == 0 ? 'Pendiente' : 'Pagada' }}</p>
            <p>Fecha: {{ numeroAMes(nominaDescargar.mes) + ' ' + nominaDescargar.anyo }}</p>
            <p>Cuenta bancaria del beneficiario: ****8193</p>
          </div>
          <div id="desglose-nomina">
            <h2 style="margin-bottom: 15px;margin-top: 15px;">Desglose de la nomina</h2>
            <v-simple-table hide-default-footer disable-pagination>
              <thead>
                <tr>
                  <th>Concepto</th>
                  <th>Importe</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Salario base</td>
                  <td>{{ nominaDescargar.sueldo }} €</td>
                </tr>
                <tr>
                  <td>Compensacion por horas extra</td>
                  <td>{{ nominaDescargar.importe_horas_extra }} €</td>
                </tr>
                <tr>
                  <td>Jornadas trabajadas</td>
                  <td>{{ nominaDescargar.jornadas_trabajadas }} jornadas</td>
                </tr>
                <tr>
                  <td>Horas totales trabajadas</td>
                  <td>{{ nominaDescargar.horas }} horas</td>
                </tr>
                <tr>
                  <td>Importe por dias de baja</td>
                  <td>{{ nominaDescargar.importe_dias_baja }} €</td>
                </tr>
                <tr>
                  <td>Importe total</td>
                  <td>{{ nominaDescargar.importe_total }} €</td>
                </tr>
              </tbody>
            </v-simple-table>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios'
  import jsPDF from 'jspdf'
  import html2canvas from 'html2canvas'
  
  export default {
    props: [
      'nominasProp'
    ],
    methods: {
      generarPDF(nominaId) {
        for (let i = 0; i < this.nominas.length; i++) {
          if (this.nominas[i].id == nominaId) {
            this.nominaDescargar = this.nominas[i]
          }
        }
        // timeout de 1 segundo para que se cargue el html
        setTimeout(() => {
          var element = document.getElementById('tabla-nomina-pdf')
          html2canvas(element, {
            onclone: function (clonedDoc) {
              clonedDoc.getElementById('tabla-nomina-pdf').style.display = 'block'
            }
          }).then((canvas) => {
            var imgData = canvas.toDataURL('image/png')
            var doc = new jsPDF('p', 'mm', 'letter')
            doc.addImage(imgData, 'JPEG', 0, 0, 210, 220)
            doc.save('nomina.pdf')
          })
        }, 1000)
      },
      numeroAMes(numero) {
        numero = parseInt(numero)
        switch(numero) {
          case 0:
            return 'Enero'
          case 1:
            return 'Febrero'
          case 2:
            return 'Marzo'
          case 3:
            return 'Abril'
          case 4:
            return 'Mayo'
          case 5:
            return 'Junio'
          case 6:
            return 'Julio'
          case 7:
            return 'Agosto'
          case 8:
            return 'Septiembre'
          case 9:
            return 'Octubre'
          case 10:
            return 'Noviembre'
          case 11:
            return 'Diciembre'
        }
      },
      async pagarNomina(id) {
        await axios.post('/api/nominas/' + id + '/pagada', {}, {
          headers: {
            'Authorization': 'Bearer ' + this.$store.state._token,
          }
        })
          .then(async response => {
            await this.$store.dispatch('fetchAllNominas')
          })
          .catch(error => {
            console.log(error)
          })

        this.nominas = this.$store.state.nominas
      }
    },
    async created() {
      if (this.$store.state.empleados.length === 0){
          await this.$store.dispatch('fetchEmpleados')
      }
      if (this.$store.state.categorias.length === 0){
          await this.$store.dispatch('fetchCategorias')
      }
      if (this.$store.state.supervisores.length === 0){
          await this.$store.dispatch('fetchSupervisores')
      }
      if (this.$store.state.nominas.length === 0){
          await this.$store.dispatch('fetchAllNominas')
      }
      if (this.$store.state.generadasNominas == false) {
          await this.$store.dispatch('generarNominasMesAnterior')
      }

      if (this.$store.state.user.admin) {
        this.nominas = this.$store.state.nominas
      } else {
        this.nominas = this.$store.state.nominas.filter(nomina => nomina.user_id == this.$store.state.user.id)
      }

      this.nominaDescargar = this.nominas[0]
    },
    data() {
      return {
        nominas: [],
        nominaDescargar: null,
      }
    },
    watch: {
      nominasProp: function() {
        if (this.$store.state.user.admin) {
          this.nominas = this.nominasProp
        } else {
          this.nominas = this.nominasProp.filter(nomina => nomina.user_id == this.$store.state.user.id)
        }
      }
    }
  }
  </script>
  
  <style lang="scss">
  .v-data-table__wrapper{
    height: min-content!important;
    max-height: 350px!important;
  }

  #tabla-nomina-pdf {
    display: none;
    padding: 100px;
    flex-direction: column;
  }

  #info-empresa-empleado {
    display: flex;
    justify-content: space-between;
    // make a bottom line to separate info
    border-bottom: 1px solid rgba(0, 0, 0, 0.12);
  }

  #info-paga {
    border-bottom: 1px solid rgba(0, 0, 0, 0.12);
  }

  .padding-table {
    padding: 0 10px 0 0;
  }
  </style>
  