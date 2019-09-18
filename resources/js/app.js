
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

//BootstrapVue
import BootstrapVue from 'bootstrap-vue'

Vue.use(BootstrapVue)

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'


//Vee-validate
import VeeValidate, { Validator } from 'vee-validate';
Vue.use(VeeValidate);

//SweetAlert2
import VueSweetalert2 from 'vue-sweetalert2';
Vue.use(VueSweetalert2);


//Components
Vue.component('change-password', require('./components/auth/ChangePassword.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});
