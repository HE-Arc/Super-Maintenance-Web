<template>
  <div>
    <vheader></vheader>
    <vleftnav></vleftnav>

    <v-container class="fill-height" fluid style="padding=20px;">
      <v-main>
        <v-row>
          <v-col cols="3">
            <mf-selection @selectionChange="updateSelection" @selectedIdChange="updateSelectedId"></mf-selection>
          </v-col>
         
          <v-col
            cols="9"
            v-if="selectedId != 0"
          >
              <maintain-page v-if="selection === 'maintain'" :id_maintain="selectedId"></maintain-page>
              <failure-report v-else :id_failure="selectedId"></failure-report>
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
      selectedId: 0,
    }),
    methods: {
      updateSelection: function(selection) {
        this.selection = selection
      },
      updateSelectedId: function(selectedId) {
        this.selectedId = selectedId
      },
    },
  }
</script>