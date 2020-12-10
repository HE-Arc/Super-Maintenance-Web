<template>
    <div>
        <v-tabs
            fixed-tabs
            background-color="indigo"
            dark
            style="margin-bottom:30px;"
        >
            <v-tab @click="updateSelection('maintain')">Maintenance</v-tab>
            <v-tab @click="updateSelection('failure')">Panne</v-tab>
        </v-tabs>
        <machine-filter @selectedIdChange="updateSelectedId" :selection="selection"></machine-filter>
    </div>
</template>

<script>
import MachineFilter from '../MachineFilter.vue'
export default {
    data: () => ({
      selection: "maintain",
    }),
    methods : {
        updateSelection(selection) {
            this.selection = selection
            this.$emit("selectionChange", selection)
        },
        updateSelectedId(selectedId) {
            this.$emit("selectedIdChange", selectedId)
        },

    }
}
</script>

<style>

</style>