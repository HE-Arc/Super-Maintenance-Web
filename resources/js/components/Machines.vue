<template>
    <div>
	<MaintainerAttribution style="z-index:999999;" ref="attributeMaintainer" />

    <v-container fluid style="padding=20px;">
		<v-row>
			<v-col lg="4" sm="6" xs="12" md="6" v-for="machine in machines" :key="machine.id">
				<v-card>
					<GChart
						type="ColumnChart"
						:data="chartData"
						:options="chartOptions"
					/>
					<v-card-title>Machine {{machine.name}}</v-card-title>
					<v-card-text>
						<p>ID de la machine : {{machine.id}}</p>
						<p>Emplacement de la machine : {{machine.location}}</p>
						<p>Etat de la machine : {{machine.state}}</p>
					</v-card-text>
					<v-card-actions>
						<v-alert
							v-if="machine.state == 'OFF' && machine.id_maintainer == null"
							prominent
							style="width:100%;margin:10px;"
							type="error"
						>
							<v-row align="center">
								<v-col class="grow">
								EN PANNE
								</v-col>
								<v-col class="shrink">
								<v-btn @click="OpenAttributionDialog(machine)">
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

						<v-alert
							v-else-if="machine.state == 'OFF' && machine.id_maintainer != null"
							prominent
							style="width:100%;margin:10px;"
							type="warning"
						>
							<v-row align="center">
								<v-col class="grow">
								EN PANNE
								</v-col>
								<v-col class="shrink">
									{{machine.maintainer_name}}
								</v-col>
							</v-row>
						</v-alert>

					</v-card-actions>
				</v-card>
			</v-col>
		</v-row>
    </v-container>

  </div>
</template>

<script>
/*
* Machine vue is card in the general vue
* you can see machine statistic, date and if maintainer is attributed on machine failure
*/
  import { GChart } from 'vue-google-charts'
  import MaintainerAttribution from './dialogs/MaintainerAttribution'

  export default {
    data: () => ({
		machines: "?",
		showDialog: false,
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
				axios.get("/machinesAndTroubleshootings")
					.then(response => {
						this.machines = response.data.machines
						resolve(response)
				})
				.catch(error => {
					reject(error)
				})
			})
		},
		OpenAttributionDialog(machine) {
			this.$refs.attributeMaintainer.show(machine)
		},
		refresh(){
			this.fetchMachines()
		}
	},
	mounted(){
		this.fetchMachines()
	},
	components: {
		GChart,
		MaintainerAttribution
	}
  }



</script>

<style>

</style>