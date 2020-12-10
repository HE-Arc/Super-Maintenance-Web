<template>
    <div>
       <v-select
            :items="machines"
            v-model="selectedMachine"
            name="machine"
            item-text="name"
            label="Filtrer par machine"
            dense
            outlined
        />
        <v-list two-line>
            <v-list-item-group
                v-model="selectedItem"
                active-class="indigo--text"
                mandatory
            >
                <template v-for="(item, index) in items">
                    <v-list-item :key="item.title + item.headline" 
                        @click="updateSelectedId(item.id)">
                        <template>
                        <v-list-item-content>
                            <v-list-item-title v-text="item.title"></v-list-item-title>

                            <v-list-item-subtitle
                            class="text--primary"
                            v-text="item.headline"
                            ></v-list-item-subtitle>

                            <v-list-item-subtitle v-text="item.subtitle"></v-list-item-subtitle>
                        </v-list-item-content>

                        <v-list-item-action>
                            <v-list-item-action-text v-text="item.action"></v-list-item-action-text>

                            <!---->
                        </v-list-item-action>
                        </template>
                    </v-list-item>

                    <v-divider
                        v-if="index < items.length - 1"
                        :key="index"
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
        selectedMachine: "",
        selectedItem: [],
        items: [
            {
                action: '15 min',
                headline: '08.09.2020',
                subtitle: `Réparation de la pompe à huile N°23`,
                title: 'AX35',
                id: 1
            },
            {
                action: '2 hr',
                headline: '10.05.2020',
                subtitle: `Changement du refroidisseur`,
                title: 'AX36',
                id: 2
            }
        ],
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
        updateSelectedId(selectedId){
            this.$emit("selectedIdChange", selectedId)
        },
	},
	mounted(){
        this.fetchMachines()
        this.$emit("selectedIdChange", 1)
	},
}
</script>

<style>

</style>