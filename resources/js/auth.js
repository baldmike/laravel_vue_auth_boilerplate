import axios from 'axios'
import store from './store'
// import Echo from "laravel-echo"

export default class Auth {
    constructor() {
        if (store.state.token) {
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + store.state.token;
        }
    }

    setAuthToken(token) {
        let tokenIsSet = axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
    }

    // completes the login
    login(token, user) {

        store.dispatch('setLoginCred', {
            token: token,
            user: user
        });
    }

    // checks for login status, returns boolean
    check() {
        return !!store.state.token;
    }

    // log out the user
    logout(router) {

        axios.call("post", "/api/logout").then(() => {

            this.$store.commit('logout');

            router.push({ name: 'login' });

        })
    }
}