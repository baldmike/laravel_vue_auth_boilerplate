<template>    
    <div class="container">
        <notifications group="auth" position="top center" width="40%"/>
        <nav-bar></nav-bar>
        <component v-if="!isAuthenticated" :is="component"></component>
        <router-view></router-view>
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
        props: ["component"],
        computed: mapGetters(['isAuthenticated']),
        methods: mapActions(['login']),
        mounted() {
            if (window.auth.check()) {
                this.$router.push('dashboard');
            }
        }
    }

</script>