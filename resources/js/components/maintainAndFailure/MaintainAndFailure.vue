<template>
  <div>
    <vheader></vheader>
    <vleftnav></vleftnav>

    <v-container class="fill-height" fluid style="padding=20px;">
      <v-main>
        <v-row>
          <v-col cols="3">
            <mf-selection 
              @selectionChange="updateSelection" @selectedIdChange="updateSelectedId"></mf-selection>
          </v-col>
         
          <v-col
            cols="9"
            v-if="isItemSelected"
          >
              <maintain-page v-if="selection === 'maintain'" :id_maintain="selectedId"></maintain-page>
              <failure-report v-else :id_failure="selectedId"></failure-report>
          </v-col>
          <v-col
            cols="9"
            v-else
          >
            <v-alert
              type="info"
              color="indigo"
              outlined
              prominent
              text
            >
              {{ emptyMessage }}
            </v-alert>
          </v-col>
        </v-row>
      </v-main>
    </v-container>

    <vfooter></vfooter>
  </div>
</template>

<script>
/*
  Maintain and failure page that contain other components 
*/

export default {
  data: () => ({
    selection: "maintain",
    selectedId: -1,
    emptyMessage: "Aucun élément ne correspond à la sélection"
  }),
  methods: {
    updateSelection: function(selection) {
      this.selection = selection
      this.selectedId = -1
    },
    updateSelectedId: function(selectedId) {
      this.selectedId = selectedId
    },
  },
  computed: {
    isItemSelected(){
      return this.selectedId !== -1
    }
  }
}
</script>