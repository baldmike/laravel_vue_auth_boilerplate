<template>
    <div>
        <b-row>
            <b-col v-for="(animal, index) in getCats"
                    :key="index" cols="4">
                <b-card 
                    img-src="https://picsum.photos/1024/400/?image=16"
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

        <div>
            <!-- Modal Component -->
            <b-modal ref="selectedAnimalModal" :animal="'animal'" ok-only ok-title="Close" ok-variant="dark">
                <h1 class="my-2">{{ selectedAnimal.name }}</h1>
                <li class="my-4">{{ selectedAnimal.breed }}, {{selectedAnimal.gender}}, {{ selectedAnimal.weight }} pounds</li>
                <li class="my-4">From {{ selectedAnimal.source }} on {{ selectedAnimal.created_at | moment("dddd, MMMM Do YYYY" )}}</li>
                <div class="my-4">{{ selectedAnimal.description }}</div>
            </b-modal>
        </div>
    </div>
</template>

<script>
    
    import { mapActions, mapGetters } from "vuex";

    export default {

        name: 'cats',
        data() {
            return {
                name: '',
                animal: '',
                selectedAnimal: '',
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