<template>
    <div>
    <vheader></vheader>
    <vleftnav></vleftnav>

    <v-container class="fill-height" fluid style="padding=20px;">
      <v-main>
			<v-simple-table>
				<template v-slot:default>
					<thead>
						<tr>
							<th class="text-left">
								tasks
							</th>
						</tr>
					</thead>
					<tbody>
						<tr
						v-for="task in tasks" :key="task.id"
						>
							<td>{{ task.comment }}</td>
						</tr>
					</tbody>
				</template>
			</v-simple-table>
      </v-main>
    </v-container>
    <vfooter></vfooter>
  </div>
</template>

<script>
  export default {
    data: () => ({
		tasks: "?"
	}),
	props:{
		id: {
			type: Number,
			required: true
		}
	},
    methods: {
		fetchTasks() {
			return new Promise((resolve, reject) => {
				axios.get("/Super-Maintenance-Web/public/tasks/" + this.id)
					.then(response => {
						this.tasks = response.data.tasks
						resolve(response)
				})
				.catch(error => {
					reject(error)
				})
			})
    	}
	},
	mounted(){
		this.fetchTasks()
	}
  }

</script>

<style>

</style>