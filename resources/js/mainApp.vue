<template>    
    <div class="container">
        <nav-bar></nav-bar>
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
        computed: mapGetters(['isAuthenticated']),
        methods: mapActions(['login'])
    }

</script>