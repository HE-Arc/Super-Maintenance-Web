
<template>
  <v-dialog 
    v-model="isVisible" 
    persistent
    max-width="500px"
    @keydown.esc="isVisible = false">
    <v-card tile>
       <v-toolbar dark color="indigo" style="margin-bottom:30px;">
                <v-toolbar-title>Attribuer un technicien à la panne</v-toolbar-title>
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
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn tile color="success" id="send_button" @clic="assign">
                    Attribuer
                    <v-icon
                    right
                    >
                    mdi-account-plus-outline
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
        item: [],
        maintainers: []
    }),
    methods: {
        show(item) {
            console.log("Dialog")
            this.isVisible = true
            this.item = item
            this.fetchMaintainers()
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
        assign(){
            console.log("yo")
            return new Promise((resolve, reject) => {
                axios.post("/troubleshootingReport/1", {
                    "id_machine": "2",
                    "id_maintainer": "3",
                    "start_date": "2020-11-08",
                    "end_date": "2020-11-08",
                    "troubleshooting_description": "ça marche plus",
                    "troubleshooting_hypotesis": "Colin a encore tout cassé",
                    "troubleshooting_check": "Demander a Colin si il a tout casser",
                    "repairs_actions": "Demander au patron de réparer",
                    "piece_to_change": "vérin CX32",
                    "piece_photo": "PhOt02lap1Eceu",
                    "resolved": true
                })
					.then(response => {
						
				})
				.catch(error => {
					reject(error)
                })
            })
        }
    }
}
</script>


