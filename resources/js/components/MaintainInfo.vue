<template>
	<div>
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
				<v-subheader>Début de la maintenance</v-subheader>
			</v-col>
			<v-col cols="6">
				<v-text-field
				:value="maintain.start_date"
				readonly
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
				readonly
				></v-text-field>
			</v-col>
		</v-row>

		<v-row>
			<v-col cols="6">
				<v-subheader>Durée</v-subheader>
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
	</div>
</template>

<script>
/*
* Maintaininfo is view who show info of selected maintain
*/
  export default {
    data: () => ({
		maintainer_name: null,
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
	watch:{ //update the component when the id_failure is updated
		'maintain': function(maintain) {
			this.maintain = maintain
			this.fetchMaintainerName()
		},
		'machine_name': function(machine_name) {
			this.machine_name = machine_name
		},
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
			console.log()
			return new Promise((resolve, reject) => {
				axios.get("/maintainer/" + this.maintain.id_maintainer)
					.then(response => {
						let name = response.data.maintainer[0].name;
						let first_name = response.data.maintainer[0].first_name;

						this.maintainer_name = first_name + " " + name;
						this.$parent.updateLoading(false);
						resolve(response)
				})
				.catch(error => {
					reject(error)
				})
			})
		}
	},
	computed: {
		spendTime() {
			if(this.maintain != null && this.maintain.end_date != null && this.maintain.start_date != null)
			{
				return this.computeSpendTime(this.maintain.end_date, this.maintain.start_date);
			}
			return "";
		},
	},
	mounted(){
		this.fetchMaintainerName()
	}
  }
</script>