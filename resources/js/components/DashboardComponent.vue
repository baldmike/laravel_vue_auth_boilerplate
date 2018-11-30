<template>
    <div class="page">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header"></div>
                    <div class="card-body">
                        I am the Dashboard Component
                        <li>{{ x * 2}}</li>
                        <li>{{ y * 2}}</li>
                        <li>{{ z * 2}}</li>
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
                x: 7,
                y: 14,
                z: 21
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