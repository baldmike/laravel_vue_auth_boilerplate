<template>
    <div class="page">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header"></div>
                    <div class="card-body">
                        I am the About Component
                        <li>{{ x * 3}}</li>
                        <li>{{ y * 3}}</li>
                        <li>{{ z * 3}}</li>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'about',
        data() {
            return {
                x: 7,
                y: 14,
                z: 21
            }
        },
        mounted() {
            console.log('About Component mounted.')
        }
    }
</script>

<style scoped>
    .page {
        background-color: blue;
    }
</style>
