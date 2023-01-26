<template>
  <div>
    <v-card>
      <v-card-title>
        <h2 style="margin-bottom: 10px;">Solicitudes de vacaciones</h2>
        <v-spacer></v-spacer>
        <v-text-field
          v-model="search"
          label="Buscar"
          single-line
          hide-details
        ></v-text-field>
        <v-icon style="margin-top: 15px;">{{ mdiMagnify }}</v-icon>
      </v-card-title>
      <v-data-table
        :headers="headers"
        :items="filteredItems"
        :search="search"
        item-key="descripcion"
        class="table-rounded"
        hide-default-footer
        disable-sort
      >
        <template #[`item.user_id`]="{item}">
          <div class="d-flex flex-column">
            <span class="d-block font-weight-semibold text--primary text-truncate">{{ item.user_id }}</span>
          </div>
        </template>
        <template #[`item.descripcion`]="{item}">
          {{ `${item.descripcion}` }}
        </template>
        <template #[`item.estado`]="{item}">
          <v-chip
            small
            :color="statusColor[item.estado]"
            class="font-weight-medium"
          >
            {{ `${item.estado}` }}
          </v-chip>
        </template>
        <template #[`item.tipo`]="{item}">
          <div class="parent" v-if="item.estado == 'Pendiente'">
            <div class="child font-weight-medium">
              <v-btn
                small
                color="success"
                @click="approve(item.id)"
              >
                Aprobar
              </v-btn>
            </div>
            <div class="child">
            <v-btn
              small
              color="error"
              @click="deny(item.id)"
            >
              Denegar
            </v-btn>
            </div>
          </div>
        </template>
      </v-data-table>
    </v-card>
    <v-row class="fill-height" style="margin-top: 100px;">
    <v-col>
      <v-sheet height="64">
        <v-toolbar
          flat
        >
          <v-btn
            outlined
            class="mr-4"
            color="grey darken-2"
            @click="setToday"
          >
            Today
          </v-btn>
          <v-btn
            fab
            text
            small
            color="grey darken-2"
            @click="prev"
          >
          ←
          </v-btn>
          <v-btn
            fab
            text
            small
            color="grey darken-2"
            @click="next"
          >
          →
          </v-btn>
          <v-toolbar-title v-if="$refs.calendar">
            {{ $refs.calendar.title }}
          </v-toolbar-title>
          <v-spacer></v-spacer>
          <v-menu
            bottom
            right
          >
            <template v-slot:activator="{ on, attrs }">
              <v-btn
                outlined
                color="grey darken-2"
                v-bind="attrs"
                v-on="on"
              >
                <span>{{ typeToLabel[type] }}</span>
              </v-btn>
            </template>
            <v-list>
              <v-list-item @click="type = 'day'">
                <v-list-item-title>Day</v-list-item-title>
              </v-list-item>
              <v-list-item @click="type = 'week'">
                <v-list-item-title>Week</v-list-item-title>
              </v-list-item>
              <v-list-item @click="type = 'month'">
                <v-list-item-title>Month</v-list-item-title>
              </v-list-item>
              <v-list-item @click="type = '4day'">
                <v-list-item-title>4 days</v-list-item-title>
              </v-list-item>
            </v-list>
          </v-menu>
        </v-toolbar>
      </v-sheet>
      <v-sheet height="600">
        <v-calendar
          ref="calendar"
          v-model="focus"
          color="primary"
          :events="events"
          :event-color="getEventColor"
          :type="type"
          @click:event="showEvent"
          @click:more="viewDay"
          @click:date="viewDay"
          @change="updateRange"
        ></v-calendar>
      </v-sheet>
    </v-col>
  </v-row>
  </div>
</template>
    
<script>
  import store from '../../store/index.js';
  import axios from 'axios';
  import { mdiMagnify } from '@mdi/js';

  export default {
    async created() {
      await this.$store.dispatch('fetchSolicitudesVacaciones')
      this.usreList = this.$store.state.solicitudesVacaciones

      for (let i = 0; i < this.filteredItems.length; i ++) {
        this.events_color[this.filteredItems[i].id] = this.colors[this.rnd(0, this.colors.length - 1)]
      }

      for (let i = 0; i < this.filteredItems.length; i ++) {
        const event = this.filteredItems[i]
        this.events.push({
          id: event.id,
          name: event.user_id,
          start: event.fecha_inicio,
          end: event.fecha_fin,
          color: this.events_color[event.id],
        })
      }
    },
    data() {
      return {
        focus: '',
        type: 'month',
        typeToLabel: {
          month: 'Month',
          week: 'Week',
          day: 'Day',
          '4day': '4 Days',
        },
        selectedEvent: {},
        selectedElement: null,
        selectedOpen: false,
        events: [],
        events_color: {},
        colors: ['blue', 'indigo', 'deep-purple', 'cyan', 'green', 'orange', 'grey darken-1'],
        names: [], // deberian ser los empleados
        search: '',
        headers: [
        { text: 'Trabajador', value: 'user_id' },
        { text: 'Descripción', value: 'descripcion' },
        { text: 'Fecha inicio', value: 'fecha_inicio' },
        { text: 'Fecha fin', value: 'fecha_fin' },
        { text: 'Justificante', value: 'justificante' },
        { text: 'Estado', value: 'estado' },
        { text: '', value: 'tipo' },
        ],
        usreList: [],
        status: {
          0: 'Pendiente',
          1: 'Aprobada',
          2: 'Denegada',
        },
        solicitudes: null,
      }
    },
    computed: {
      filteredItems() {
        return this.usreList.map(item => {
          item.user_id = this.$store.state.usuariosSolicitudes[item.user_id]
          item.estado = this.status[item.estado];
          return item;
        });
      }
    },
    setup() {
      const statusColor = {
        /* eslint-disable key-spacing */
        Pendiente: 'warning',
        Aprobada: 'success',
        Denegada: 'error',
        /* eslint-enable key-spacing */
      }

      return {
        store,
        statusColor,
        mdiMagnify,
      }
    },
    methods: {
      getStatusText(estado) {
        return this.status[estado]
      },
      async approve(id) {
        try {
          await axios.post('/api/solicitudes/' + id + '/aprobar', {},{
            headers: {
              'Authorization': 'Bearer ' + store.state._token
            }
          }).
          then(response => {
            console.log(response)
            this.actualizar()
            //this.solicitudes = JSON.parse(JSON.stringify(this.$store.state.solicitudesVacaciones))
          })
        } catch (error) {
          console.log(error)
        }
      },
      async deny(id) {
        try {
        await axios.post('/api/solicitudes/' + id + '/denegar', {}, {
          headers: {
            'Authorization': 'Bearer ' + store.state._token
          }
        }).
        then(response => {
          // console.log(response)
          this.actualizar()
          // this.$store.dispatch('fetchSolicitudesVacaciones')
          // this.usreList = JSON.parse(JSON.stringify(this.$store.state.solicitudesVacaciones))
          // this.solicitudes = JSON.parse(JSON.stringify(this.$store.state.solicitudesVacaciones))
        })
        } catch (error) {
          console.log(error)
        }
      },
      async actualizar() {
        await this.$store.dispatch('fetchSolicitudesVacaciones')
        this.$set(this, 'usreList', JSON.parse(JSON.stringify(this.$store.state.solicitudesVacaciones)))
        //this.usreList = this.$store.state.solicitudesVacaciones
        // this.solicitudes = JSON.parse(JSON.stringify(this.$store.state.solicitudesVacaciones))
      },
      viewDay ({ date }) {
        this.focus = date
        this.type = 'day'
      },
      getEventColor (event) {
        return event.color
      },
      setToday () {
        this.focus = ''
      },
      prev () {
        this.$refs.calendar.prev()
      },
      next () {
        this.$refs.calendar.next()
      },
      showEvent ({ nativeEvent, event }) {
        const open = () => {
          this.selectedEvent = event
          this.selectedElement = nativeEvent.target
          requestAnimationFrame(() => requestAnimationFrame(() => this.selectedOpen = true))
        }

        if (this.selectedOpen) {
          this.selectedOpen = false
          requestAnimationFrame(() => requestAnimationFrame(() => open()))
        } else {
          open()
        }

        nativeEvent.stopPropagation()
      },
      updateRange () {
        const events = []

        for (let i = 0; i < this.filteredItems.length; i ++) {
          const event = this.filteredItems[i]
          events.push({
            id: event.id,
            name: event.user_id,
            start: event.fecha_inicio,
            end: event.fecha_fin,
            color: this.events_color[event.id],
          })
        }

        this.events = events
      },
      rnd (a, b) {
        return Math.floor((b - a + 1) * Math.random()) + a
      },
    },
    mounted() {
      // this.$refs.calendar.checkChange()
    }
  }
</script>

<style scoped>
  .parent {
    display: flex;
    flex-direction: row;
    justify-content: center;
  }
  .child {
    margin: 0 5px;
    font-size: medium;
  }
</style>