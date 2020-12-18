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
        <machine-filter @selectedIdChange="updateSelectedId" @selectedMachineIdChange="updateSelectedMachineId" :selection="selection" context="info"></machine-filter>
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
            // pass the data to the parent
            this.$emit("selectionChange", selection)
        },
        updateSelectedId(selectedId) {
            // pass the data to the parent
            this.$emit("selectedIdChange", selectedId)
        },
        updateSelectedMachineId(selectedMachineId) {
            // pass the data to the parent
            this.$emit("selectedMachineIdChange", selectedMachineId)
        }
    }
}
</script>

<style>

</style>