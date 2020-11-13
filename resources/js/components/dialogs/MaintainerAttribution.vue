<template>
<transition name="maintainer-attribution-dialog">
    <div class="modal-mask">
      <div class="modal-wrapper">
        <v-card class="modal-container" tile>
            <v-toolbar dark color="primary">
                <v-toolbar-title>Attribuer un technicien à la panne</v-toolbar-title>
                <v-spacer></v-spacer>
                <v-toolbar-items>
                    <v-btn icon dark @click.stop="$emit('close')">
                        <v-icon>mdi-close</v-icon>
                    </v-btn>
                </v-toolbar-items>
            </v-toolbar>
            <v-card-text>
                <v-text-field
                    outlined
                    dense
                    v-model="id"
                    label="ID"
                    required
                    readonly
                ></v-text-field>
                <v-text-field
                    outlined
                    dense
                    v-model="maintainer"
                    label="Technicien"
                    required
                ></v-text-field>
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
      </div>
    </div>
  </transition>
</template>

<script>
export default {
    data: () => ({
        maintainer: ""
    }),
    props: {
        id: {
            type: Number,
            required: true
        }
    }
}
</script>

<style scoped>
* {
    box-sizing: border-box;
}
.modal-mask {
    position: fixed;
    z-index: 99999998;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, .5);
    transition: opacity .3s ease;
    overflow-x: auto;
}
.modal-container {
    width: 50%;
    height: 100%;
    margin: 100px auto;
    box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
    transition: all .3s ease;
}
/*
 * The following styles are auto-applied to elements with
 * transition="modal" when their visibility is toggled
 * by Vue.js.
 *
 * You can easily play with the modal transition by editing
 * these styles.
 */
.modal-enter {
  opacity: 0;
}
.modal-leave-active {
  opacity: 0;
}
.modal-enter .modal-container,
.modal-leave-active .modal-container {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}
</style>