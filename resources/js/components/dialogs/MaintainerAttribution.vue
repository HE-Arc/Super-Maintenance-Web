
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
                <v-text-field
                    outlined
                    dense
                    v-model="item.id"
                    label="ID"
                    required
                    readonly
                ></v-text-field>
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
                <v-btn tile color="success" id="send_button">
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
    	}
    }
}
</script>


