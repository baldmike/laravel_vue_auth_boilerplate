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
    export default {
        name: 'dashboard',
        data() {
            return {
                
            }
        },
        mounted() {
            console.log('Dashboard Component mounted.')
        }
    }
</script>

<style scoped>
    .page {
        background-color: lime;
    }
</style>