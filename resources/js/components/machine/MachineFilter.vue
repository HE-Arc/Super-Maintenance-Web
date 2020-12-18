<template>
    <div>
        <!-- Filter by machine --->
        <v-select
            :items="machines"
            v-model="selectedMachineId"
            name="machine"
            item-text="name"
            item-value="id"
            label="Filtrer par machine"
            :change="updateSelectedMachineId"
            dense
            outlined
            clearable
        />

        <v-container v-show="loading" 
            fill-height 
            fluid
            >
			<v-row align="center" justify="center">
				<v-progress-circular
				:size="50"
				color="indigo"
				indeterminate
				></v-progress-circular>
			</v-row>
		</v-container>
        <!-- Display maintains for the selected machine -->
        <v-list v-show="!loading && isItemSelected" two-line>
            <v-list-item-group
                active-class="indigo--text"
                mandatory
            >
                <template v-for="(item, index) in items">
                    <v-list-item 
                        :key="index" 
                        @click="triggerChange(item)"
                        >
                        <!-- problem : the key remains the same so those components are not updated -->
                        <template>
                            <v-list-item-content>
                                <v-list-item-title v-text="machineName(item.id_machine)"></v-list-item-title>

                                <v-list-item-subtitle
                                    class="text--primary"
                                    v-text="dateDay(item)"
                                ></v-list-item-subtitle>

                                <v-list-item-subtitle v-if="selection === 'failure'"
                                    v-text="item.troubleshooting_description"
                                ></v-list-item-subtitle>

                            </v-list-item-content>
                        </template>
                    </v-list-item>
                </template>
            </v-list-item-group>
        </v-list>
        <v-alert v-show="!loading && !isItemSelected"
              type="info"
              color="indigo"
              outlined
              prominent
              text
            >
            {{ emptyMessage }}
        </v-alert>
    </div>
</template>

<script>
/*
    Component to filter maintains or failure by a machine and display them on a list.
*/
export default {
    props:{
		selection: { //maintain or failure
			type: String,
			required: true
        },
        context: { //calendar or info
			type: String,
			required: true
        },
    },
    watch:{ //watch attribute update
        'selection': function(selection) {
            this.selection = selection
        }
    },
    data: () => ({
        machines: [],
        selectedMachineId: -1, //-1 = select all machines
        selectedId: -1,
        emptyMessage: "Aucun élément ne correspond à la sélection",
        items: [],
        value: 0,
        loading: true,
    }),
    methods: {
        fetchMachines() {
			return new Promise((resolve, reject) => {
				axios.get("/machines")
					.then(response => {
						this.machines = response.data.machines
						resolve(response)
				})
				.catch(error => {
					reject(error)
				})
			})
        },
        fetchItemsByMachine() {
			return new Promise((resolve, reject) => {
                if(this.selectedMachineId !== -1) {
                    //get all items for this machine id
                    axios.get("/" + this.selectionUrl +"_machine/" + this.selectedMachineId)
                        .then(response => {
                            this.fillItems(response.data)
                            this.loading = false;
                            resolve(response)
                    })
                    .catch(error => {
                        reject(error)
                    })
                }
                else {
                    //select all items
                    axios.get("/" + this.selectionUrl)
                        .then(response => {
                            this.fillItems(response.data)
                            this.loading = false;
                            resolve(response)
                    })
                    .catch(error => {
                        reject(error)
                    })
                }
			})
        },
        fillItems(data) {
            // Fill the items array with the completed items
            this.items = []
            
            let items = this.selection === "maintain" ? data.maintains : data.troubleshooting_reports
            
            items.forEach(item => {
                if(this.context === "calendar") {
                    this.items.push(item)
                }
                else { 
                    //info
                    if(item.start_date !== null && item.end_date !== null) {
                        this.items.push(item)
                    }
                }
            });

            // update the selected maintain
            if(this.items.length > 0) {
                this.triggerSelectedIdChange(this.items[0].id)
            } 
            else {
                // if there's no item, display nothing
                this.triggerSelectedIdChange(-1)
            }
        },
        dateDay(item){
            // Convert from yyyy-mm-dd tp dd-mm-yyyy format
            let datetime = item.hasOwnProperty('planned_at') ? item.planned_at : item.start_date
            return datetime.split(" ")[0]
        },
        machineName(id_machine){
            // Get the machine name of the machine id_machine
            return this.machines.find(x => x.id == id_machine).name
        },
        triggerSelectedIdChange(selectedId) {
            // trigger an event when the selected item id changes
            this.selectedId = selectedId
            this.$emit("selectedIdChange", selectedId)
        },
        triggerSelectedMachineIdChange() {
            // trigger an event when the selected machine id changes
            this.$emit("selectedMachineIdChange", this.selectedMachineId)
        },
        triggerSelectedDateChange(selectedDate) {
            // trigger an event when the selected item id changes
            this.selectedDate = selectedDate
            this.$emit("selectedDateChange", selectedDate)
        },
        triggerChange(item) {
            this.triggerSelectedIdChange(item.id)
            this.triggerSelectedDateChange(item.planned_at)
        }
    },
    computed: {
        updateSelectedMachineId() {
            /*
                Update the list of items when the selected machine changes
            */
            if(typeof this.selectedMachineId == 'undefined') {
                this.selectedMachineId = -1 //select all
            }

            // Get items if at least one machine correspond to the selection
            if(this.machines.length > 0) {
                this.fetchItemsByMachine()
            }
            
            this.triggerSelectedMachineIdChange()
        },
        selectionUrl() {
            return this.selection === "maintain" ? "maintains" : "troubleshootingReports"
        },
        isItemSelected() {
            // Check if an item is selected
            return this.selectedId !== -1
        }
    },
	mounted() {
        this.fetchMachines()
	},
}
</script>

<style>

</style>