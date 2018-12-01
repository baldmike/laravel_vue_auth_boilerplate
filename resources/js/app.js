import Vue from 'vue' 
import VueRouter from 'vue-router'
import { router } from './router'
import BootstrapVue from 'bootstrap-vue'

import 'bootstrap/dist/css/bootstrap.css' 

import store from './store'

require('./bootstrap')

Vue.use(VueRouter)
Vue.use(BootstrapVue)

window.Vue = require('vue')

Vue.component('home-component', require('./components/HomeComponent.vue'))
Vue.component('main-component', require('./components/MainComponent.vue'))
Vue.component('dashboard-component', require('./components/DashboardComponent.vue'))
Vue.component('about-component', require('./components/AboutComponent.vue'))

window.addEventListener('load', function () { 
    const app = new Vue({ 
        el: "#app", 
        template: '<router-view></router-view>', 
        router,
        store
    })
})