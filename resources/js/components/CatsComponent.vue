<template>
    <div class="page">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header"></div>

                    <div class="card-body">
                        <b-row>
            <b-col v-for="(animal, index) in getCats"
                    :key="index" cols="4">
                <b-card 
                    img-src="https://picsum.photos/1024/400/?image=13"
                    img-alt="Image"
                    img-top
                    tag="article"
                    class="mb-2 center">

                    <b-btn class="selectButton" @click="showModal(animal)" animal="'animal.id'">{{ animal.name }}  |  <span style="color: black;"> {{ animal.species }} </span>  |  {{ animal.breed }}</b-btn>
                    <p class="card-text">
                        
                    </p>
                </b-card>
            </b-col>
        </b-row>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    
    import { mapActions, mapGetters } from "vuex";

    export default {

        name: 'cats',
        data() {
            return {

            }
        },
        mounted() {
            console.log('Cats Component mounted.')
        },
        computed: mapGetters(['isAuthenticated', 'currentUser', 'getCats']),
            
        methods: {
            
        }
    }
</script>

<style scoped>
    
</style>