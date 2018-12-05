<template>
    <div class="page">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header"></div>

                    <div class="card-body">
                        I am the Home Component
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    
    export default {

        name: 'home',
        data() {
            return {

            }
        },
        mounted() {
            console.log('Home Component mounted.')
        },
        computed: {
            x() {
                return this.$store.state.x;
            },
            y() {
                return this.$store.state.y;
            },
            z() {
                return this.$store.state.z;
            }
        },
        methods: {
            dblX() {
                this.$store.dispatch('doubleX');
            },
            dblY() {
                this.$store.dispatch('doubleY');
            },
            dblZ() {
                this.$store.dispatch('doubleZ');
            }
        }
    }
</script>

<style scoped>
    .page {
        background-color: rosybrown;
    }
</style>