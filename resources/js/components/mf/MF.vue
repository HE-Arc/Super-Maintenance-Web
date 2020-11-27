<template>
  <div>
    <vheader></vheader>
    <vleftnav></vleftnav>

    <v-container class="fill-height" fluid style="padding=20px;">
      <v-main>
        <v-row>
          <v-col cols="3">
            <mf-selection @selectionChange="updateSelection"></mf-selection>
             
          </v-col>
         
          <v-col
            cols="9"
          >
              <maintain-page v-if="selection === 'maintain'" maintain-page :id_maintain="1"></maintain-page>
              <failure-report v-else :id_failure="2"></failure-report>
          </v-col>
        </v-row>
      </v-main>
    </v-container>

    <vfooter></vfooter>
  </div>
</template>

<script>
  export default {
    data: () => ({
      selection: "maintain",
    }),
    methods: {
      updateSelection: function(selection){
        this.selection = selection
      }
    },
  }
</script>