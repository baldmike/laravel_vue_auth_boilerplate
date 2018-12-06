<template>
    <div>
        <b-card :title="currentUser"
                img-src="https://picsum.photos/600/300/?image=25"
                img-alt="Image"
                img-top
                tag="article"
                style="max-width: 33%;"
                class="mb-2">
            <p class="card-text">
            {{ currentUser }}
            </p>
            <b-button href="#" variant="primary">Go somewhere</b-button>
        </b-card>
    </div>
</template>

<script>

    import { mapActions, mapGetters } from "vuex";

    export default {
        name: 'dashboard',
        data() {
            return {
                
            }
        },
        beforeCreate() {
            
        },
        mounted() {
            // this.$store.dispatch('refreshUserData')
            console.log('Dashboard Component mounted.')
        },
        computed: mapGetters(['isAuthenticated', 'currentUser']),
    }
</script>

<style scoped>
    .page {
        background-color: lime;
    }
</style>