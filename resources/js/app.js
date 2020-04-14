/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import Vue from 'vue'


import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'

import 'animate.css'
import colors from 'vuetify/lib/util/colors'
Vue.use(colors)
Vue.use(Vuetify)
import Vuelidate from 'vuelidate'
Vue.use(Vuelidate)

require('./bootstrap');



window.Vue = require('vue');
window.axios = require('axios');


import { store } from './store/store'

//UI
// import SLayout from './components/UI/SLayout.vue'

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component('s-layout', require('./components/UI/SLayout.vue').default);
Vue.component('s-ckp', require('./components/UI/CKP.vue').default);
Vue.component('s-ckpbulan', require('./components/UI/CKPbulan.vue').default);
Vue.component('s-ckpratarata', require('./components/UI/CKPRatarata.vue').default);

Vue.component('s-penilaian', require('./components/UI/Penilaian.vue').default);
Vue.component('s-settings', require('./components/UI/Settings.vue').default);
Vue.component('s-about', require('./components/UI/About.vue').default);
Vue.component('s-footer', require('./components/UI/Footer.vue').default);


// Vue.component('s-layout', () => import('./components/UI/SLayout.vue'));
// Vue.component('s-ckp', () => import('./components/UI/CKP.vue'));
// Vue.component('s-ckpbulan', () => import('./components/UI/CKPbulan.vue'));
// Vue.component('s-penilaian', () => import('./components/UI/Penilaian.vue'));
// Vue.component('s-about', () => import('./components/UI/About.vue'));
// Vue.component('s-footer', () => import('./components/UI/Footer.vue'));


// window.Vue.component('s-layout', SLayout)
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    store,
    vuetify: new Vuetify()
    
 
    
});
