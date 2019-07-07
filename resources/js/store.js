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

        let currentUser = JSON.stringify(user);

        console.log("[STORE.STATE] --> user: " + (currentUser));
        console.log("[STORE.STATE] --> token: " + (userToken));

        return {
            token: userToken ? userToken : null,
            user: user ? user : null,
        }
    },
    getters: { 
        // getters get data from state and are available in components

        // !! returns boolean  --  if there is a token, the user is authenticated
        isAuthenticated: state => !!state.token,
        currentUser: state => state.user,
    },
    mutations: {
        // mutations are committed by actions, and are the ONLY way to manipulate state

        setLoginCred(state, payload) {
            state.token = payload.token;
            state.user = payload.user;
            state.isAuthenticated = true;
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + payload.token
        },
        setUser(state, user) {
            state.user = user;
        },
        logout(state) {
            state.token = null;
            state.user = null;
            state.isAuthenticated = false;
            Vue.cookie.delete('token');
            Vue.cookie.delete('user');
        },
    },
    actions: {
        // actions are dispatched, they commit mutations

        setLoginCred(context, payload) {
            context.commit('setLoginCred', payload)
        },
        refreshUserData(context) {
            axios.call("get", "/api/user").then((userData) => {
                let user = userData.data.data
                console.log("USER ----> " + user);
                context.commit('setUser', user)
            })
        },
        logout( { commit }) {
        
            axios.post("/api/logout").then((userData) => {        
                
                commit('logout');

                router.push({ path: '/' });
            })
        },
    }

})