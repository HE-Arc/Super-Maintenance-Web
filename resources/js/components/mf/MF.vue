<template>
  <div>
    <vheader></vheader>
    <vleftnav></vleftnav>

    <v-container class="fill-height" fluid style="padding=20px;">
      <v-main>
        <v-row>
          <v-col cols="3">
            <mf-selection></mf-selection>
             
          </v-col>
         
          <v-col
            cols="9"
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
  export default {
    data: () => ({

    }),
    methods: {

    },
  }
</script>