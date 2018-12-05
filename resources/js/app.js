import Vue from 'vue' 
import VueRouter from 'vue-router'
import { router } from './router'
import BootstrapVue from 'bootstrap-vue'
import Notifications from 'vue-notification'
import Auth from './auth.js';
import VueCookie from 'vue-cookie';

import 'bootstrap/dist/css/bootstrap.css' 

import store from './store'

require('./bootstrap')

Vue.use(VueRouter)
Vue.use(BootstrapVue)
Vue.use(VueCookie)
Vue.use(Notifications)


window.Vue = require('vue')
window.auth = new Auth();

Vue.component('main-app', require('./mainApp.vue'))
Vue.component('login-component', require('./components/LoginComponent.vue'))
Vue.component('dashboard-component', require('./components/DashboardComponent.vue'))
Vue.component('not-found', require('./components/NotFound.vue'))

Vue.component('cats-component', require('./components/CatsComponent.vue'))
Vue.component('dogs-component', require('./components/DogsComponent.vue'))



window.addEventListener('load', function () { 
    const app = new Vue({ 
        el: "#app", 
        template: '<router-view></router-view>', 
        router,
        store
    })
})