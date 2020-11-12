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
              <v-img src="https://picsum.photos/510/300?random"></v-img>
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
    machine_name: "",
    id_maintainer: 0,
    maintainer_name: "",
    created_at: "",
    updated_at: "",
    end_date: "",
    start_date: "",
    failure_description: "",
    failure_hypotesis: "", //hypothesis on why did the failure happened
    failure_check: "", //check the hypothesis
    repairs_actions: "",
    piece_to_change: "",
    piece_photo: "",
    resolved: "",
  }),
  methods: {
    fetchFailure() {
      return new Promise((resolve, reject) => {
        axios
          .get("/Super-Maintenance-Web/public/troubleshootingReport/1")
          .then((response) => {
            //TODO reject if the size of the array is smaller than 1
            let failureReport = response.data.troubleshootingReport[0];

            this.id = failureReport.id;
            this.id_machine = failureReport.id_machine;
            this.id_maintainer = failureReport.id_maintainer;
            this.created_at = failureReport.created_at;
            this.updated_at = failureReport.updated_at;
            this.end_date = failureReport.end_date;
            this.start_date = failureReport.start_date;
            this.failure_description = failureReport.troubleshooting_description;
            this.failure_hypotesis = failureReport.troubleshooting_hypotesis;
            this.failure_check = failureReport.troubleshooting_check;
            this.repairs_actions = failureReport.repairs_actions;
            this.piece_to_change = failureReport.piece_to_change;
            this.piece_photo = failureReport.piece_photo;
            this.resolved = failureReport.resolved;

            resolve(response);

            this.fetchMachineName();
            this.fetchMaintainerName();
          })
          .catch((error) => {
            reject(error);
          });
      });
    },
    fetchMachineName() {
      return new Promise((resolve, reject) => {
        axios
          .get("/Super-Maintenance-Web/public/machine/" + this.id_machine)
          .then((response) => {
            this.machine_name = response.data.machine[0].name;

            resolve(response);
          })
          .catch((error) => {
            reject(error);
          });
      });
    },
    fetchMaintainerName() {
      return new Promise((resolve, reject) => {
        axios
          .get("/Super-Maintenance-Web/public/maintainer/" + this.id_maintainer)
          .then((response) => {
            let name = response.data.maintainer[0].name;
            let first_name = response.data.maintainer[0].first_name;

            this.maintainer_name = first_name + " " + name;

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