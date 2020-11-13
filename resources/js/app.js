/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import vuetify from '../plugins/vuetify' // path to vuetify export
import VueGoogleCharts from 'vue-google-charts'

Vue.use(VueGoogleCharts)

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.component('vheader', require('./components/Header.vue').default);
Vue.component('vleftnav', require('./components/LeftNav.vue').default);
Vue.component('vfooter', require('./components/Footer.vue').default);
Vue.component('home', require('./components/Home.vue').default);
Vue.component('machines', require('./components/Machines.vue').default);
Vue.component('machine-tasks', require('./components/MachineTasks.vue').default);
Vue.component('maintainer-attribution-dialog', require('./components/dialogs/MaintainerAttribution.vue').default);
Vue.component('mf-selection', require('./components/mf/MFSelection.vue').default);
Vue.component('mf', require('./components/mf/MF.vue').default);
Vue.component('calendar', require('./components/Calendar.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    vuetify,
    el: '#app',
});
