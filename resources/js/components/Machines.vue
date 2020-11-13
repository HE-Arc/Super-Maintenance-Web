<template>
    <div>
    <vheader></vheader>
    <vleftnav></vleftnav>

    <v-container class="fill-height" fluid style="padding=20px;">
      <v-main>
		  	<v-row>
				<v-col lg="3" sm="6" xs="12" md="4" v-for="machine in machines" :key="machine.id">
					<v-card>
						<v-card-text>
							<p>machine id : {{machine.id}}</p>
							<p>machine name : {{machine.name}}</p>
							<p>machine location : {{machine.location}}</p>
							<p>machine state : {{machine.state}}</p>
						</v-card-text>
						<v-card-actions>ok</v-card-actions>
					</v-card>
				</v-col>
			</v-row>
      </v-main>
    </v-container>

    <vfooter></vfooter>
  </div>
</template>

<script>
  export default {
    data: () => ({
		machines: "?",
    }),
    methods: {
		fetchMachines() {
			return new Promise((resolve, reject) => {
				axios.get("/Super-Maintenance-Web/public/machines")
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
	}
  }



</script>

<style>

</style>