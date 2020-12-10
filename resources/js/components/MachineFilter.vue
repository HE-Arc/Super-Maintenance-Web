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
                v-model="selectedItem"
                active-class="indigo--text"
                mandatory
            >
                <template v-for="(item, index) in maintains">
                    <v-list-item :key="item.id + index" 
                        @click="updateSelectedId(item.id)">
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
                        v-if="index < maintains.length - 1"
                        :key="selectedItem + index"
                    ></v-divider>
                </template>
            </v-list-item-group>
        </v-list>
    </div>
</template>

<script>
export default {
    data: () => ({
        machines: [],
        selectedMachineId: -1, //-1 = select all machines
        selectedItem: [],
        maintains: [],
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
        fetchMaintainsByMachine() {
			return new Promise((resolve, reject) => {
                if(this.selectedMachineId !== -1)
                {
                    axios.get("/maintains_machine/" + this.selectedMachineId)
                        .then(response => {
                            this.maintains = []
                            response.data.maintains.forEach(maintain => {
                                if(maintain.start_date !== null && maintain.end_date !== null)
                                {
                                    this.maintains.push(maintain)
                                }
                            });
                            console.log(this.maintains)
                            resolve(response)
                    })
                    .catch(error => {
                        reject(error)
                    })
                }
                else
                {
                    axios.get("/maintains")
                        .then(response => {
                            this.maintains = []
                            response.data.maintains.forEach(maintain => {
                                if(maintain.start_date !== null && maintain.end_date !== null)
                                {
                                    this.maintains.push(maintain)
                                }
                            });
                            resolve(response)
                    })
                    .catch(error => {
                        reject(error)
                    })
                }
			})
        },
        updateSelectedId(selectedId){
            this.$emit("selectedIdChange", selectedId)
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
            return this.machines.find(x => x.id == id_machine).name
        },
    },
    computed: {
        updateSelectedMachineId(){
            if(typeof this.selectedMachineId == 'undefined')
            {
                this.selectedMachineId = -1 //select all
            }
            if(this.machines.length > 0)
            {
                this.fetchMaintainsByMachine()
            }
        },
    },
	mounted(){
        this.fetchMachines()
        this.$emit("selectedIdChange", 1) //TODO change here
	},
}
</script>

<style>

</style>