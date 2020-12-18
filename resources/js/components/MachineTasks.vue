<template>
	<v-simple-table>
		<template v-slot:default>
			<thead>
				<tr>
					<th class="text-left">
						LISTE DES TACHES
					</th>
				</tr>
			</thead>
			<tbody>
				<tr
				v-for="task in tasks" :key="task.id"
				>
					<td>
						<v-chip
							class="ma-2"
							color="indigo"
							text-color="white"
						>
							<v-avatar
								left
								class="indigo darken-4"
							>
								{{ task.id }}
							</v-avatar>
						</v-chip>
						{{ task.comment }}
					</td>
				</tr>
			</tbody>
		</template>
	</v-simple-table>
</template>

<script>
/*
* Show tasks of machine in the maintain page
*/
  export default {
    data: () => ({
		tasks: []
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
				axios.get("/tasks/" + this.id)
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
	watch:{ //update the component when the id_failure is updated
		'id': function(id) {
			this.id = id
			this.fetchTasks()
		},
	},
	mounted(){
		this.fetchTasks()
	}
  }

</script>

<style>

</style>