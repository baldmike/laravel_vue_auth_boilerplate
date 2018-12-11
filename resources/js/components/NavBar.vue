<template>
    <div id="navig">
        <b-navbar toggleable="md" type="dark" variant="dark" fixed="top">
            <b-navbar-toggle target="nav_collapse"></b-navbar-toggle>

            <b-navbar-brand to="/dashboard">Home</b-navbar-brand>
            <b-collapse is-nav id="nav_collapse">

                <b-navbar-nav>
                    <b-nav-item v-if="isAuthenticated" to="dogs">Dogs</b-nav-item>
                    <b-nav-item v-if="isAuthenticated" to="newDog">New Animal</b-nav-item>
                    <b-nav-item v-if="isAuthenticated" to="cats">Cats</b-nav-item>
                    <b-nav-item v-if="isAuthenticated" to="#">New Cat</b-nav-item>
                </b-navbar-nav>
                    
                <b-navbar-nav class="ml-auto">
                    <b-nav-item v-if="isAuthenticated" @click="logout" right>Logout</b-nav-item>
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


<style>
    #navig {
        margin-bottom: 70px;
    }
</style>
