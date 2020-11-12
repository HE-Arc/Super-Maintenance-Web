<template>
  <div>
    <vheader></vheader>
    <vleftnav></vleftnav>

    <v-container class="fill-height" fluid style="padding=20px;">
      <v-main>
        <v-row>
          <v-col lg="5" md="5" xs="11" sm="11">
            <v-row>
              <v-text-field
                :value="machine_name"
                label="Machine concernée"
                readonly
              ></v-text-field>
            </v-row>

            <v-row>
              <v-text-field
                :value="created_at"
                label="Date de création"
                readonly
              ></v-text-field>
            </v-row>

            <v-row>
              <v-text-field
                :value="updated_at"
                label="Dernière modification"
                readonly
              ></v-text-field>
            </v-row>

            <v-row>
              <v-text-field
                :value="spendTime"
                label="Durée de la réparation"
                readonly
              ></v-text-field>
            </v-row>

            <v-row>
              <v-text-field
                :value="maintainer_name"
                label="Technicien en charge"
                readonly
              ></v-text-field>
            </v-row>

            <v-row>
              <v-text-field
                :value="isResolved"
                label="Résolue ?"
                readonly
              ></v-text-field>
            </v-row>
          </v-col>

          <v-spacer cols="1"></v-spacer>

          <v-col lg="5" md="5" xs="11" sm="11">
            <v-row>
              <v-text-field
                :value="failure_description"
                label="Decription"
                readonly
              ></v-text-field>
            </v-row>

            <v-row>
              <v-text-field
                :value="failure_hypotesis"
                label="Hypothèse"
                readonly
              ></v-text-field>
            </v-row>

            <v-row>
              <v-text-field
                :value="failure_check"
                label="Cause réelle"
                readonly
              ></v-text-field>
            </v-row>

            <v-row>
              <v-text-field
                :value="repairs_actions"
                label="Résolution"
                readonly
              ></v-text-field>
            </v-row>

            <v-row>
              <v-text-field
                :value="piece_to_change"
                label="Pièce à changer"
                readonly
              ></v-text-field>
            </v-row>

            <v-row v-if="isPiecePicture">
              <div class="subheading">Photo</div>
              <v-img
                src="https://picsum.photos/510/300?random"
              ></v-img>
            </v-row>
          </v-col>
          
          <v-spacer cols="1"></v-spacer>
        </v-row>
      </v-main>
    </v-container>

    <vfooter></vfooter>
  </div>
</template>

<script>
export default {
  data: () => ({
    id: 0,
    id_machine: 0,
    machine_name: "LMP2020-1",
    id_maintainer: 0,
    maintainer_name: "Michou Radon",
    created_at: "10.11.2020",
    updated_at: "12.11.2020",
    end_date: "15:25:00",
    start_date: "16:45:00",
    failure_description: "panne très embêtante",
    failure_hypotesis: "ne fonctionne plus", //hypothesis on why did the failure happened
    failure_check: "pièce xy défectueuse", //check the hypothesis
    repairs_actions: "changement de la pièce xy",
    piece_to_change: "xy",
    piece_photo: "./images/images_failure_xy",
    resolved: "oui",
  }),
  methods: {
    fetchFailure() {
      return new Promise((resolve, reject) => {
        axios
          .get("/Super-Maintenance-Web/public/troubleshootingReport/1")
          .then((response) => {
            //TODO reject if the size of the array is smaller than 1
            console.log(response.data.troubleshootingReport[0]);
            resolve(response);
          })
          .catch((error) => {
            reject(error);
          });
      });
    },
  },
  computed: {
    spendTime() {
      //return end_date-start_date
      return "1h20min";
    },
    isPiecePicture() {
      return this.piece_photo !== "";
    },
    isResolved() {
      return this.resolved == true ? "Oui" : "Non";
    },
  },
  mounted() {
    this.fetchFailure();
  },
};
</script>

<style>
</style>