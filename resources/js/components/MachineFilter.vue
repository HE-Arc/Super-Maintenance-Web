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

        <!-- Display maintains for the selected machine -->
        <v-list two-line>
            <v-list-item-group
                active-class="indigo--text"
                mandatory
            >
                <template v-for="(item, index) in items">
                    <v-list-item 
                        :key="index" 
                        @click="updateSelectedId(item.id)"
                               
                        >
                        <!-- problem : the key remains the same so those components are not updated -->
                        <template>
                            <v-list-item-content>
                                <v-list-item-title v-text="machineName(item.id_machine)"></v-list-item-title>
                                <!--<v-list-item-title v-text="item.id"></v-list-item-title>-->

                                <v-list-item-subtitle
                                    class="text--primary"
                                    v-text="dateDay(item.start_date)"
                                ></v-list-item-subtitle>

                                <!--
                                Only for failures
                                <v-list-item-subtitle
                                    v-text="item.subtitle"
                                ></v-list-item-subtitle>
                                -->
                            </v-list-item-content>

                        <!--<v-list-item-action>
                            <v-list-item-action-text v-text="item.action"></v-list-item-action-text>
                        </v-list-item-action>-->
                        </template>
                    </v-list-item>

                    <v-divider
                        v-if="index < items.length - 1"
                        :key="item.id_machine+items.length"
                    ></v-divider>
                </template>
            </v-list-item-group>
        </v-list>
    </div>
</template>

<script>
export default {
    props:{
		selection: { //maintain or failure
			type: String,
			required: true
		},
    },
    watch:{ //watch attribute update
        'selection': function(selection) {
            console.log("coucou"  + selection)
            this.selection = selection
        }
    },
    data: () => ({
        machines: [],
        selectedMachineId: -1, //-1 = select all machines
        items: [],
        value: 0,
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
                if(this.selectedMachineId !== -1)
                {
                    //get all items that uses this id
                    axios.get("/" + this.selectionUrl +"_machine/" + this.selectedMachineId)
                        .then(response => {
                            this.fillItems(response.data)
                            resolve(response)
                    })
                    .catch(error => {
                        reject(error)
                    })
                }
                else
                {
                    //select all items
                    console.log(this.selectionUrl)
                    axios.get("/" + this.selectionUrl)
                        .then(response => {
                            this.fillItems(response.data)
                            resolve(response)
                    })
                    .catch(error => {
                        reject(error)
                    })
                }
			})
        },
        fillItems(data) {
            /*
                Fill the items array with the completed items
            */
            this.items = []
            
            let items = this.selection === "maintain" ? data.maintains : data.troubleshooting_reports
            
            items.forEach(item => {
                if(item.start_date !== null && item.end_date !== null)
                {
                    this.items.push(item)
                }
            });

            //update the selected maintain
            if(this.items.length > 0)
            {
                this.updateSelectedId(this.items[0].id)
            }
        },
        dateDay(datetime){
            /*
                Convert from yyyy-mm-dd tp dd-mm-yyyy format
            */
            let date = datetime.split(" ")[0]
            let [year, month, day] = date.split("-")
            return new Date(year, month, day).toLocaleDateString()
        },
        machineName(id_machine){
            /*
                Get the machine name of the machine id_machine
            */
            return this.machines.find(x => x.id == id_machine).name
        },
        updateSelectedId(selectedId){
            this.$emit("selectedIdChange", selectedId)
        },
        change(val){
            console.log(val)
        }
    },
    computed: {
        updateSelectedMachineId(){
            /*
                Update the list of items when the selected machine changes
            */
            if(typeof this.selectedMachineId == 'undefined')
            {
                this.selectedMachineId = -1 //select all
            }
            if(this.machines.length > 0)
            {
                this.fetchItemsByMachine()
            }
        },
        selectionUrl(){
            console.log(this.selection +"aaa")
            return this.selection === "maintain" ? "maintains" : "troubleshootingReports"
        },
    },
	mounted(){
        this.fetchMachines()
	},
}
</script>

<style>

</style>