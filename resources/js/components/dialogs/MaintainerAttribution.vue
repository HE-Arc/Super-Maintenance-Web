
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
                    item-value="id"
                    label="Techicien"
                    dense
                    outlined
                />
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn tile color="success" id="send_button" @click="assign">
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
/*
    Dialog to attribute a failure to a maintainer
*/
export default {
    data: () => ({
        isVisible: false,
        maintainer: "",
        item: [],
        maintainers: [],
        troubleshooting: null
    }),
    methods: {
        show(item) {
            this.isVisible = true
            this.item = item
            this.fetchMaintainers()
            this.getLastTroubleshooting()
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
            console.log("maintainer = " + this.maintainer)
            return new Promise((resolve, reject) => {
                axios.post("/troubleshootingReport/" + this.troubleshooting.id, {
                    "id_machine": this.item.id,
                    "id_maintainer": this.maintainer,
                    "start_date": "",
                    "end_date": "",
                    "troubleshooting_description": "",
                    "troubleshooting_hypotesis": "",
                    "troubleshooting_check": "",
                    "repairs_actions": "",
                    "piece_to_change": "",  
                    "piece_photo": "",
                    "resolved": false
                })
                .then(response => {
                    this.$parent.refresh()
                    this.hide()
                    resolve(response)
				})
				.catch(error => {
					reject(error)
                })
            })
        },
        getLastTroubleshooting(){
            return new Promise((resolve, reject) => {
                axios.get("/unresolvedtroubleshootingByMachine/" + this.item.id)
                    .then(response => {
                        this.troubleshooting = response.data.troubleshooting_reports[0]
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


