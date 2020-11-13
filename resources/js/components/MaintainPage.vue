<template>
	<div style="border-left: 1px solid gray;">
		<v-row>
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
		machine_id: null
	}),
	props:{
		id_maintain: {
			type: Number,
			required: true
			},
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
	},
	mounted(){
		this.fetchMaintainById()
	}
  }
</script>