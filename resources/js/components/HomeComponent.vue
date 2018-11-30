<template>
    <div class="page">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header"></div>

                    <div class="card-body">
                        I am the Home Component
                        <li>{{ x }}</li>
                        <li>{{ y }}</li>
                        <li>{{ z }}</li>
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
                x: 7,
                y: 14,
                z: 21
            }
        },
        mounted() {
            console.log('Home Component mounted.')
        }
    }
</script>

<style scoped>
    .page {
        background-color: rosybrown;
    }
</style>