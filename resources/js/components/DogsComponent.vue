<template>
    <div>
        <b-row>
            <b-col v-for="(dog, index) in getDogs"
                    :key="index" cols="4">
                <b-card 
                    img-src="https://picsum.photos/1024/400/?image=34"
                    img-alt="Image"
                    img-top
                    tag="article"
                    class="mb-2 center">

                    <b-btn class="selectButton" @click="showModal(dog)" dog="'dog.id'">{{ dog.name }}  |  <span style="color: black;"> {{ dog.species }} </span>  |  {{ dog.breed }}</b-btn>
                    <p class="card-text">
                        
                    </p>
                </b-card>
            </b-col>
        </b-row>

        <div>
            <!-- Modal Component -->
            <b-modal ref="selectedDogModal" :dog="'dog'" ok-only ok-title="Close" ok-variant="dark">
                <h1 class="my-2">{{ selectedDog.name }}</h1>
                <li class="my-4">{{ selectedDog.breed }}, {{selectedDog.gender}}, {{ selectedDog.weight }} pounds</li>
                <li class="my-4">From {{ selectedDog.source }} on {{ selectedDog.created_at | moment("dddd, MMMM Do YYYY" )}}</li>
                <div class="my-4">{{ selectedDog.description }}</div>
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
                dog: '',
                selectedDog: '',
            }
        },
        mounted() {
            console.log('Dogs Component mounted.')
        },
        computed: mapGetters(['isAuthenticated', 'currentUser', 'getDogs']),
            
        methods: {
            
        }
    }
</script>

<style scoped>
    
</style>