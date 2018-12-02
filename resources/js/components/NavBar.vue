<template>
    <div>
        <b-navbar toggleable="md" type="dark" variant="info">
            <b-navbar-toggle target="nav_collapse"></b-navbar-toggle>

            <b-navbar-brand to="/">NavBar</b-navbar-brand>
            <b-collapse is-nav id="nav_collapse">
                <b-navbar-nav>
                    <b-nav-item v-if="isAuthenticated" @click="logout">Logout</b-nav-item>
                    <b-nav-item v-else to="login">Login</b-nav-item>
                    <b-nav-item v-if="isAuthenticated" to="home">Home</b-nav-item>
                    <b-nav-item v-if="isAuthenticated" to="dashboard">Dashboard</b-nav-item>
                    <b-nav-item v-if="isAuthenticated" to="about">About</b-nav-item>
                </b-navbar-nav>
            </b-collapse>
        </b-navbar>
    </div>    
</template>

<script>

import { mapActions, mapGetters } from "vuex";

export default {
    name: "NavBar",
    methods: {

        logout() {
            this.$store.dispatch('logout');
        }

    },
    
    
    computed: mapGetters(['isAuthenticated']),
        
}
</script>


