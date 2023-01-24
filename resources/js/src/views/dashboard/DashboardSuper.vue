<template>
  <section style="display:flex; flex-direction: column">
    <v-btn to="/superole/nuevo" color="primary" class="mb-10" v-if="$store.state.user.admin" style="align-self:flex-end">Añadir empleado</v-btn>
    <general-table class="mb-10" v-if="$store.state.user.supervisor === 1" title="Tu equipo" :supervisor="true"></general-table>
    <general-table title="Todos los empleados" :supervisor="false"></general-table>
  </section>
</template>

<script>
import GeneralTable from '@/views/GeneralTable.vue'

export default {
  components: { GeneralTable }
}
</script>