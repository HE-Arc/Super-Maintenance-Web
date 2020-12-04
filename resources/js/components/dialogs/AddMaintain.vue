
<template>
  <v-dialog 
    v-model="isVisible" 
    persistent
    max-width="500px"
    @keydown.esc="isVisible = false">
    <v-card tile>
       <v-toolbar dark color="indigo" style="margin-bottom:30px;">
                <v-toolbar-title>Ajouter une maintenance</v-toolbar-title>
                <v-spacer></v-spacer>
                <v-toolbar-items>
                    <v-btn icon dark @click.stop="hide">
                        <v-icon>mdi-close</v-icon>
                    </v-btn>
                </v-toolbar-items>
            </v-toolbar>
            <v-card-text>
                <v-select
                    :items="maintainers"
                    v-model="maintainer"
                    name="techicien"
                    item-text="name"
                    label="Techicien"
                    dense
                    outlined
                />
                <v-select
                    :items="machines"
                    v-model="machine"
                    name="machine"
                    item-text="name"
                    label="Machine"
                    dense
                    outlined
                />
                <v-menu
                    v-model="datePicker"
                    :close-on-content-click="false"
                    :nudge-right="40"
                    transition="scale-transition"
                    offset-y
                    min-width="290px"
                >
                    <template v-slot:activator="{ on, attrs }">
                        <v-text-field
                            v-model="planned_at"
                            label="Date de la maintenance"
                            prepend-inner-icon="mdi-calendar"
                            readonly
                            outlined
                            dense
                            v-bind="attrs"
                            v-on="on"
                        ></v-text-field>
                    </template>
                    <v-date-picker
                        v-model="planned_at"
                        @input="datePicker = false"
                    ></v-date-picker>
                </v-menu>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn tile color="success" id="send_button">
                    Planifier
                    <v-icon
                    right
                    >
                    mdi-calendar-edit
                    </v-icon>
                </v-btn>    
            </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
    data: () => ({
        isVisible: false,
        maintainer: "",
        machine: "",
        planned_at: new Date().toISOString().substr(0, 10),
        item: [],
        maintainers: [],
        machines: [],
        datePicker: false,
    }),
    methods: {
        show() {
            this.isVisible = true
            this.fetchMaintainers()
            this.fetchMachines()
        },
        hide(){
            this.isVisible = false
        },
        fetchMaintainers() {
			return new Promise((resolve, reject) => {
				axios.get("/maintainers")
					.then(response => {
						this.maintainers = response.data.maintainers
						resolve(response)
				})
				.catch(error => {
					reject(error)
				})
			})
        },
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
    	}
    }
}
</script>


