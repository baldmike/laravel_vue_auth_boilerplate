<template>
    <div class="page">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header"></div>
                    <div class="card-body">
                        I am the About Component, coo coo kachoo.
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
