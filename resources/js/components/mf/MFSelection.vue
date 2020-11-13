<template>
    <div>
        <v-tabs
            fixed-tabs
            background-color="indigo"
            dark
            style="margin-bottom:30px;"
        >
            <v-tab>Maintenance</v-tab>
            <v-tab>Panne</v-tab>
        </v-tabs>
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
                multiple
            >
                <template v-for="(item, index) in items">
                    <v-list-item :key="item.title">
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
        selectedItem: [0],
        items: [
            {
                action: '15 min',
                headline: '08.09.2020',
                subtitle: `Réparation de la pompe à huile N°23`,
                title: 'AX35',
            },
            {
                action: '2 hr',
                headline: '10.05.2020',
                subtitle: `Changement du refroidisseur`,
                title: 'AX36',
            }
        ],
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
}
</script>

<style>

</style>