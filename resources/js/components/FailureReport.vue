<template>
  <div style="border-left: 1px solid gray; padding: 30px;" v-if="failure_report != null">
      <v-row>
        <v-col lg="5" md="5" xs="12" sm="12">
          <v-row>
			      <v-col cols="6">
				      <v-subheader>Machine concernée</v-subheader>
				    </v-col>
            <v-col cols="6">
              <v-text-field
                :value="machine_name"
                readonly
              ></v-text-field>
			      </v-col>
          </v-row>
  
          <v-row>
			      <v-col cols="6">
				      <v-subheader>Date de création</v-subheader>
				    </v-col>
            <v-col cols="6">
              <v-text-field
                :value="failure_report.created_at"
                readonly
              ></v-text-field>
			      </v-col>
          </v-row>

          <v-row>
            <v-col cols="6">
				      <v-subheader>Dernière modification</v-subheader>
				    </v-col>
            <v-col cols="6">
              <v-text-field
                :value="failure_report.updated_at"
                readonly
              ></v-text-field>
			      </v-col>
          </v-row>

          <v-row>
            <v-col cols="6">
				      <v-subheader>Durée de la réparation</v-subheader>
				    </v-col>
            <v-col cols="6">
              <v-text-field
                :value="spendTime"
                readonly
            ></v-text-field>
			      </v-col>
          </v-row>

          <v-row>
            <v-col cols="6">
				      <v-subheader>Technicien en charge</v-subheader>
				    </v-col>
            <v-col cols="6">
              <v-text-field
                :value="maintainer_name"
                readonly
              ></v-text-field>
			      </v-col>
          </v-row>

          <v-row>
            <v-col cols="6">
				      <v-subheader>Résolue ?</v-subheader>
				    </v-col>
            <v-col cols="6">
              <v-text-field
                :value="isResolved"
                readonly
              ></v-text-field>
			      </v-col>
          </v-row>
        </v-col>

        <v-spacer lg="1" md="1" xs="0" sm="0"></v-spacer>

        <v-col lg="6" md="6" xs="12" sm="12">
          <v-row>
            <v-textarea
              :value="failure_report.troubleshooting_description"
              label="Decription"
              background-color="white lighten-2"
              rows="1"
              readonly
              auto-grow
              outlined
              filled
            ></v-textarea>
          </v-row>

          <v-row>
            <v-textarea
              :value="failure_report.troubleshooting_hypotesis"
              label="Hypothèse"
              background-color="white lighten-2"
              rows="1"
              readonly
              auto-grow
              outlined
            ></v-textarea>
          </v-row>

          <v-row>
            <v-textarea
              :value="failure_report.troubleshooting_check"
              label="Cause réelle"
              background-color="white lighten-2"
              rows="1"
              readonly
              auto-grow
              outlined
            ></v-textarea>
          </v-row>

          <v-row>
            <v-textarea
              :value="failure_report.repairs_actions"
              label="Résolution"
              background-color="white lighten-2"
              rows="1"
              readonly
              auto-grow
              outlined
            ></v-textarea>
          </v-row>

          <v-row>
            <v-text-field
              :value="failure_report.piece_to_change"
              label="Pièce à changer"
              background-color="white lighten-2"
              readonly
              auto-grow
              outlined
            ></v-text-field>
          </v-row>

          <v-row v-if="isPiecePicture">
            <v-card>
              <v-card-title>Photo</v-card-title>

              <v-img :src="piecePhoto"></v-img>
            </v-card>
          </v-row>
        </v-col>
      </v-row>
  </div>
</template>

<script>
export default {
  props:{
		id_failure: {
			type: Number,
			required: true
		},
  },
  watch:{ //update the component when the id_failure is updated
    'id_failure' :function(id_failure) {
      this.id_failure = id_failure
      this.fetchFailure()
    }
  },
  data: () => ({
    failure_report: 
    {
      //TODO add failure props here
    },
    machine_name: "",
    maintainer_name: "",
    piece_photo: "",
  }),
  methods: {
    fetchFailure() {
      console.log("IDFailure" + this.id_failure)
      return new Promise((resolve, reject) => {
        axios
          .get("/troubleshootingReport/" + this.id_failure)
          .then((response) => {
            //TODO reject if the size of the array is smaller than 1
            this.failure_report = response.data.troubleshootingReport[0];

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
          .get(
            "/machine/" +
              this.failure_report.id_machine
          )
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
          .get(
            "http://localhost:8000/maintainer/" +
              this.failure_report.id_maintainer
          )
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
    stringToDate(s) {
      //source : https://stackoverflow.com/questions/8003616/javascript-how-to-find-the-difference-between-two-datetimes-in-mysql-timestamp
      let dateParts = s.split(" ")[0].split("-");
      let timeParts = s.split(" ")[1].split(":");
      let d = new Date(dateParts[0], --dateParts[1], dateParts[2]);
      d.setHours(timeParts[0], timeParts[1], timeParts[2]);

      return d;
    },
    computeSpendTime(end_date, start_date) {
      let secondsRemaining =
        (this.stringToDate(end_date) - this.stringToDate(start_date)) / 1000; //delta in seconds
      let hours = Math.floor(secondsRemaining / 3600);
      secondsRemaining = secondsRemaining - hours * 3600;
      let minutes = Math.floor(secondsRemaining / 60);
      secondsRemaining = secondsRemaining - minutes * 60;

      return hours + "h" + minutes + "m" + secondsRemaining + "s";
    },
  },
  computed: {
    isPiecePicture() {
      return (
        this.failure_report != null && this.failure_report.piece_photo !== ""
      );
    },
    isResolved() {
      return this.failure_report != null && this.failure_report.resolved
        ? "Oui"
        : "Non";
    },
    piecePhoto() {
      return this.failure_report != null ? "data:image/png;base64," + this.failure_report.piece_photo : "";
    },
    spendTime() {
      if (
        this.failure_report != null &&
        this.failure_report.end_date != null &&
        this.failure_report.start_date != null
      ) {
        return this.computeSpendTime(
          this.failure_report.end_date,
          this.failure_report.start_date
        );
      }
      return "";
    },
  },
  mounted() {
    this.fetchFailure();
  },
};
</script>

<style>
</style>