<template>
  <v-card>
    <v-card-title class="align-start">
      <span>Weekly Overview</span>

      <v-spacer></v-spacer>

      <v-btn
        icon
        small
        class="mt-n2 me-n3"
      >
        <!-- <v-icon size="22">
          {{ icons.mdiDotsVertical }}
        </v-icon> -->
      </v-btn>
    </v-card-title>

    <v-card-text>
      <!-- Chart -->
      <vue-apex-charts
        :options="chartOptions"
        :series="chartData"
        height="210"
      ></vue-apex-charts>

      <div class="d-flex align-center">
        <h3 class="text-2xl font-weight-semibold me-4">
          45%
        </h3>
        <span>Your sales perfomance in 45% 🤩 better compare to last month</span>
      </div>

      <v-btn
        block
        color="primary"
        class="mt-6"
        outlined
      >
        Details
      </v-btn>
    </v-card-text>
  </v-card>
</template>

<script>
import store from '../../store/index.js';
import VueApexCharts from 'vue-apexcharts'
// eslint-disable-next-line object-curly-newline
import { mdiDotsVertical, mdiTrendingUp, mdiCurrencyUsd } from '@mdi/js'
import { getCurrentInstance } from '@vue/composition-api'

export default {
  components: {
    VueApexCharts,
  },
  setup() {
    return {
      store,
      // chartOptions,
      // chartData,

      icons: {
        mdiDotsVertical,
        mdiTrendingUp,
        mdiCurrencyUsd,
      },
    }
  },
  async created() {
    await this.$store.dispatch('fetchJornadas')
    console.log(this.$store.state)
    // this.chartData.data = JSON.parse(JSON.stringify(this.$store.state.jornadas))
    // console.log(this.$store.state.jornadas)
  },
  data() {
    return {
      // ins: getCurrentInstance()?.proxy,
      // $vuetify: ins && ins.$vuetify ? ins.$vuetify : null,
      // customChartColor: $vuetify.theme.isDark ? '#3b3559' : '#f5f5f5',

      chartOptions: {
        colors: [
          'primary',
          'primary',
          'primary',
          'primary',
          'primary',
          'primary',
          'primary',
        ],
        chart: {
          type: 'bar',
          toolbar: {
            show: false,
          },
          offsetX: -15,
        },
        plotOptions: {
          bar: {
            columnWidth: '40%',
            distributed: true,
            borderRadius: 8,
            startingShape: 'rounded',
            endingShape: 'rounded',
          },
        },
        dataLabels: {
          enabled: false,
        },
        legend: {
          show: false,
        },
        xaxis: {
          categories: ['S', 'M', 'T', 'W', 'T', 'F', 'S'],
          axisBorder: {
            show: false,
          },
          axisTicks: {
            show: false,
          },
          tickPlacement: 'on',
          labels: {
            show: false,
            style: {
              fontSize: '12px',
            },
          },
        },
        yaxis: {
          show: true,
          tickAmount: 5,
          labels: {
            offsetY: 3,
            formatter: value => `$${value}`,
          },
        },
        stroke: {
          width: [2, 2],
        },
        grid: {
          strokeDashArray: 12,
          padding: {
            right: 0,
          },
        },
    },

    chartData: [
      {
        data: [40, 60, 50, 60, 75, 60, 50, 65],
      },
    ]
    }
  },
  computed: {
    user() {
      return this.$store.state.user.user
    },
    completada() {
      this.$store.dispatch('fetchCompletada')
      return this.$store.state.completada
    },
    jornadas() {
      this.$store.dispatch('fetchJornadas')
      return this.$store.state.jornadas
    }
  },
  methods: {

  },
}
</script>
