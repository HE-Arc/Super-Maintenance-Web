
<template>
  <v-dialog 
    v-model="isVisible" 
    persistent
    max-width="500px"
    @keydown.esc="isVisible = false">
    <v-card tile>
       <v-toolbar dark color="red darken-1" style="margin-bottom:30px;">
                <v-toolbar-title>Etes-vous sur de vouloir supprimer cet élément ?
                </v-toolbar-title>
                <v-spacer></v-spacer>
                <v-toolbar-items>
                    <v-btn icon dark @click.stop="hide">
                        <v-icon>mdi-close</v-icon>
                    </v-btn>
                </v-toolbar-items>
            </v-toolbar>
            <v-card-actions>
                <v-btn tile color="normal" id="send_button" @click="hide">
                    Annuler
                    <v-icon
                    right
                    >
                    mdi-close
                    </v-icon>
                </v-btn>    
                <v-spacer></v-spacer>
                <v-btn tile color="error" id="send_button" @click="deleteObject">
                    Supprimer
                    <v-icon
                    right
                    >
                    mdi-trash-can-outline
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
        item: [],
        url: ""
    }),
    methods: {
        show(item, url) {
            this.isVisible = true
            this.item = item
            this.url = url
        },
        hide(){
            this.isVisible = false
        },
        deleteObject(){
            return new Promise((resolve, reject) => {
                axios.post(this.url + this.item["id"], {
                }).then(response => {
                        this.hide()
                        this.$parent.refresh()
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


