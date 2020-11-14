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
        <machine-filter></machine-filter>
    </div>
</template>

<script>
import MachineFilter from '../MachineFilter.vue'
export default {

}
</script>

<style>

</style
MachineFilter>