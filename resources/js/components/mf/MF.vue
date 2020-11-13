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
            <machine-tasks :id="1"></machine-tasks>
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