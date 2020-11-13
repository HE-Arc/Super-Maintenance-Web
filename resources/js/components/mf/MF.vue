<template>
  <div>
    <vheader></vheader>
    <vleftnav></vleftnav>

    <v-container class="fill-height" fluid style="padding=20px;">
      <v-main>
        <v-row>
          <v-col md=3>
            <mf-selection></mf-selection>
          </v-col>
          <v-divider vertical></v-divider>
          <v-col
            class="d-flex"
          >
            <maintain-page :id_maintain="1"></maintain-page>
          </v-col>
        </v-row>
      </v-main>
    </v-container>

    <vfooter></vfooter>
  </div>
</template>

<script>
import MaintainPage from '../MaintainPage.vue'
  export default {
  components: { MaintainPage },
    data: () => ({

    }),
    methods: {

    },
  }
</script>