<template>
	<div>
		<vheader></vheader>
		<vleftnav></vleftnav>

			<v-container class="fill-height" fluid style="padding=20px;">
				<v-main>
					<v-row>
						<v-col lg="6" sm="6" xs="6" md="6">
							<maintain-info v-if="machine_name" :machine_name="machine_name" :maintain="maintain"></maintain-info>
						</v-col>
						<v-col lg="6" sm="6" xs="6" md="6">
							<machine-tasks v-if="machine_id" :id="machine_id"></machine-tasks>
						</v-col>
					</v-row>
				</v-main>
			</v-container>

		<vfooter></vfooter>
	</div>
</template>

<script>
import MaintainInfo from './MaintainInfo.vue'
import MaintainPage from './MaintainPage.vue'
  export default {
  components: { MaintainPage, MaintainInfo },
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
				axios.get("/Super-Maintenance-Web/public/maintain/" + this.id_maintain)
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
				axios.get("/Super-Maintenance-Web/public/machine/" + this.maintain.id_machine)
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