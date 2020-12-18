<template>
	<div style="border-left: 1px solid gray; padding: 30px;">
		<v-container v-show="loading" fill-height fluid>
			<v-row align="center" justify="center">
				<v-progress-circular
				:size="50"
				color="indigo"
				indeterminate
				></v-progress-circular>
			</v-row>
		</v-container>
		<v-row v-show="!loading">
			<v-col cols="5">
				<maintain-info v-if="machine_name" :machine_name="machine_name" :maintain="maintain"></maintain-info>
			</v-col>
			<v-col offset="1" cols="6">
				<machine-tasks v-if="machine_id" :id="machine_id"></machine-tasks>
			</v-col>
		</v-row>
	</div>
</template>

<script>
  export default {
    data: () => ({
		maintain: null,
		machine_name: null,
		machine_id: null,
		loading: true
	}),
	props:{
		id_maintain: {
			type: Number,
			required: true
			},
	},
	watch:{ //update the component when the id_failure is updated
		'id_maintain': function(id_maintain) {
			this.loading = true
			this.id_maintain = id_maintain
			this.fetchMaintainById()
		}
	},
    methods: {
		fetchMaintainById() {
			return new Promise((resolve, reject) => {
				axios.get("/maintain/" + this.id_maintain)
					.then(response => {
						this.maintain = response.data.maintain[0]
						this.machine_id = parseInt(response.data.maintain[0].id_machine)
						resolve(response)
						this.fetchMachineById()
						
				})
				.catch(error => {
					reject(error)
				})
			})
		},
		fetchMachineById() {
			return new Promise((resolve, reject) => {
				axios.get("/machine/" + this.maintain.id_machine)
					.then(response => {
						this.machine_name = response.data.machine[0].name
						resolve(response)
				})
				.catch(error => {
					reject(error)
				})
			})
		},
		updateLoading(loading) {
			this.loading = loading
		}
	},
	mounted(){
		this.fetchMaintainById()
	}
  }
</script>