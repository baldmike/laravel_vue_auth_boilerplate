import Vue from 'vue' 
import Vuex from 'vuex'
import VueCookie from 'vue-cookie'

// to make API calls
import { router } from './router'
import axios from 'axios'

Vue.use(Vuex)
Vue.use(VueCookie)

export default new Vuex.Store({

    state() {
        let userToken = Vue.cookie.get('token');
        let user = Vue.cookie.get('user');

        return {
            token: userToken ? userToken : null,
            user: user ? user : null,
            notificationMessages: [],
        }
        
    },
    getters: { 
        // if there is a token, the user is authenticated
        isAuthenticated: state => !!state.token
    },
    mutations: {
        setLoginCred(state, payload) {
            state.token = payload.token;
            state.user = payload.user;
            state.isAuthenticated = true;
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + payload.token
        },
        logout(state) {
            state.token = null;
            state.user = null;
            state.isAuthenticated = false;
            Vue.cookie.delete('token');
        },
        addNotificationMessage(state, payload) {
            state.notificationMessages.push(payload);
        },
        makeXDouble(state) {
            state.x *= 2;
        },
        makeYDouble(state) {
            state.y *= 2;
        },
        makeZDouble(state) {
            state.z *= 2;
        }
    },
    actions: {
        addNotificationMessage(context, payload) {
            context.commit('addNotificationMessage');
        },
        setLoginCred(context, payload) {
            context.commit('setLoginCred', payload)
        },
        logout( { commit }) {
        
            axios.post("/api/logout").then((userData) => {        
                
                commit('logout');

                router.push({ path: 'login' });
            })
        },
        doubleX(context) {
            context.commit('makeXDouble');
        },
        doubleY(context) {
            context.commit('makeYDouble');
        },
        doubleZ(context) {
            context.commit('makeZDouble');
        }

    }

})