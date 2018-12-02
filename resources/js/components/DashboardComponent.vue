<template>
    <div class="page">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header"></div>
                    <div class="card-body">
                        I am the Dashboard Component
                    </div>
                </div>
            </div>
        </div>
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
            console.log('Dashboard Component mounted.')
        },
        computed: mapGetters(['isAuthenticated']),
    }
</script>

<style scoped>
    .page {
        background-color: lime;
    }
</style>