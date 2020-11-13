<template>
    <div>
    <v-container fluid style="padding=20px;">
		<v-row>
			<v-col lg="4" sm="6" xs="12" md="6" v-for="machine in machines" :key="machine.id">
				<v-card>
					<GChart
						type="ColumnChart"
						:data="chartData"
						:options="chartOptions"
					/>
					<v-card-text>
						<p>machine id : {{machine.id}}</p>
						<p>machine name : {{machine.name}}</p>
						<p>machine location : {{machine.location}}</p>
						<p>machine state : {{machine.state}}</p>
					</v-card-text>
					<v-card-actions>
						<v-alert
							v-if="machine.state == 'OFF'"
							prominent
							type="error"
							dense
						>
							<v-row align="center">
								<v-col class="grow">
								EN PANNE
								</v-col>
								<v-col class="shrink">
								<v-btn @click.stop="showModal = true">
									Attribuer
									<v-icon
									right
									>
									mdi-account-plus-outline
									</v-icon>
								</v-btn>
								</v-col>
							</v-row>
						</v-alert>
					</v-card-actions>
				</v-card>
				<maintainer-attribution-dialog :id="machine.id" v-if="showModal" @close="showModal = false"></maintainer-attribution-dialog>
			</v-col>
		</v-row>
    </v-container>

  </div>
</template>

<script>
  import { GChart } from 'vue-google-charts'

  export default {
    data: () => ({
		machines: "?",
		showModal: false,
		chartData: [
			['Mois', 'Pièces produites', 'Pièces défectueuses', 'Pannes'],
			['Janvier', 1004, 463, 14],
			['Février', 1150, 320, 10],
			['Mars', 945, 140, 27],
			['Avril', 1248, 326, 5]
		],
		chartOptions: {
			chart: {
				title: 'Company Performance',
				subtitle: 'Pièces produites, pièces défectueuses et pannes : 2020',
			}
		}
    }),
    methods: {
		fetchMachines() {
			return new Promise((resolve, reject) => {
				axios.get("/public/machines")
					.then(response => {
						this.machines = response.data.machines
						resolve(response)
				})
				.catch(error => {
					reject(error)
				})
			})
    	}
	},
	mounted(){
		this.fetchMachines()
	},
	components: {
		GChart
	}
  }



</script>

<style>

</style>