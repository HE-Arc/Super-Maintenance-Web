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
        <machine-filter></machine-filter>
    </div>
</template>

<script>
import MachineFilter from '../MachineFilter.vue'
export default {
    methods : {
        updateSelection(selection) {
            this.$emit('selectionChange', selection)
        }
    }
}
</script>

<style>

</style>