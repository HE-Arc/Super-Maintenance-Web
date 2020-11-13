<template>
  <div>
    <vheader></vheader>
    <vleftnav></vleftnav>

    <v-container class="fill-height" fluid style="padding=20px;">
      <v-main>
		<v-textarea
			:value="machine_name"
			label="Machine concernée"
			background-color="white lighten-2"
			rows="1"
			readonly
			auto-grow
			outlined
			filled
			></v-textarea>
		<v-textarea
			:value="maintain.start_date"
			label="Début de la maintenance"
			background-color="white lighten-2"
			rows="1"
			readonly
			auto-grow
			outlined
			filled
			></v-textarea>
		<v-textarea
			:value="maintain.end_date"
			label="Fin de la maintenance"
			background-color="white lighten-2"
			rows="1"
			readonly
			auto-grow
			outlined
			filled
			></v-textarea>
		<v-textarea
			:value="computeSpendTime(maintain.end_date, maintain.start_date)"
			label="Durée"
			background-color="white lighten-2"
			rows="1"
			readonly
			auto-grow
			outlined
			filled
			></v-textarea>
		
		<v-textarea
			value="TODO - JeanNeymar - TODO"
			label="Intervenant"
			background-color="white lighten-2"
			rows="1"
			readonly
			auto-grow
			outlined
			filled
			></v-textarea>


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
			}
    },
  }
</script>