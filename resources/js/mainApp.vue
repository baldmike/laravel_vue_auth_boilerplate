<template>    
    <div class="container-fluid">
        <notifications group="notifications" position="top center" width="50%"/>
        <nav-bar></nav-bar>
        <login-component v-if="!isAuthenticated" :is="loginComponent"></login-component>
        <router-view v-if="isAuthenticated"></router-view>
    </div>
</template>

<script>

    import NavBar from './components/NavBar'
    import { mapGetters, mapActions } from 'vuex';

    export default {
        name: "mainApp",
        components: {
            NavBar,
        },
        props: ["loginComponent"],
        computed: mapGetters(['isAuthenticated']),
        methods: mapActions(['login']),
        mounted() {
            if (window.auth.check()) {
                this.$router.push('dashboard');
            }
        }
    }

</script>

