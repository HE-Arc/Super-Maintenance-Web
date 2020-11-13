<template>
  <div>
    <vheader></vheader>
    <vleftnav></vleftnav>

    <v-container class="fill-height" fluid style="padding=20px;">
      <v-main>
      </v-main>
    </v-container>

    <vfooter></vfooter>
  </div>
</template>

<script>
import MachineTasks from './MachineTasks.vue'
import MaintainPage from './MaintainPage.vue'
  export default {
  components: { MachineTasks, MaintainPage },
    data: () => ({

    }),
    methods: {

    },
  }
</script>