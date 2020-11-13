<template>
  <div>
    <vheader></vheader>
    <vleftnav></vleftnav>

    <v-container class="fill-height" fluid style="padding=20px;">
      <v-main>

		<v-row>
			<v-col cols="6">
				<v-subheader>Machine concernée</v-subheader>
				</v-col>
			<v-col cols="6">
				<v-text-field
				:value="machine_name"
				></v-text-field>
			</v-col>
		</v-row>

		<v-row>
			<v-col cols="6">
				<v-subheader>Début de la maintenance</v-subheader>
				</v-col>
			<v-col cols="6">
				<v-text-field
				:value="maintain.start_date"
				></v-text-field>
			</v-col>
		</v-row>

		<v-row>
			<v-col cols="6">
				<v-subheader>Fin de la maintenance</v-subheader>
				</v-col>
			<v-col cols="6">
				<v-text-field
				:value="maintain.end_date"
				></v-text-field>
			</v-col>
		</v-row>

		<v-row>
			<v-col cols="6">
				<v-subheader>Durée</v-subheader>
				</v-col>
			<v-col cols="6">
				<v-text-field
				:value="computeSpendTime(maintain.end_date, maintain.start_date)"
				></v-text-field>
			</v-col>
		</v-row>

		<v-row>
			<v-col cols="6">
				<v-subheader>Intervenant</v-subheader>
				</v-col>
			<v-col cols="6">
				<v-text-field
				:value="maintainer_name"
				></v-text-field>
			</v-col>
		</v-row>
      </v-main>
    </v-container>
    <vfooter></vfooter>
  </div>
</template>

<script>
import MaintainInfo from './MaintainInfo.vue'
  export default {
  components: { MaintainInfo },
    data: () => ({
		maintainer_name: null
	}),
	props: {
		maintain:{
			type: Object,
			required: true
		},
		machine_name:{
			type: String,
			required: true
		}
	},
    methods: {
		stringToDate(s) {
			//source : https://stackoverflow.com/questions/8003616/javascript-how-to-find-the-difference-between-two-datetimes-in-mysql-timestamp
			let dateParts = s.split(" ")[0].split("-");
			let timeParts = s.split(" ")[1].split(":");
			let d = new Date(dateParts[0], --dateParts[1], dateParts[2]);
			d.setHours(timeParts[0], timeParts[1], timeParts[2]);

			return d;
			},
		computeSpendTime(end_date, start_date) {
			let secondsRemaining = (this.stringToDate(end_date) - this.stringToDate(start_date)) / 1000; //delta in seconds
			let hours = Math.floor(secondsRemaining / 3600);
			secondsRemaining = secondsRemaining - hours * 3600;
			let minutes = Math.floor(secondsRemaining / 60);
			secondsRemaining = secondsRemaining - minutes * 60;

			return hours + "h" + minutes + "m" + secondsRemaining + "s";
			},
		fetchMaintainerName() {
			return new Promise((resolve, reject) => {
				axios.get("/Super-Maintenance-Web/public/maintainer/1")// + this.maintain.id_maintainer)
					.then(response => {
						this.maintainer_name = response.data.maintainer[0].name
						resolve(response)
				})
				.catch(error => {
					reject(error)
				})
			})
		}
	},
	mounted(){
		this.fetchMaintainerName()
	}
  }
</script>