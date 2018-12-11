<template>
    <div>
        <b-row>
            <b-col v-for="(animal, index) in getAnimals"
                    :key="index" cols="3">
                <b-card 
                    img-src="https://picsum.photos/1024/400/?image=31"
                    img-alt="Image"
                    img-top
                    tag="article"
                    class="mb-2 center">

                    <b-btn class="selectButton" @click="showModal(animal)" animal="'animal.id'">{{ animal.name }}  <span style="color: black;">{{ animal.breed }}</span></b-btn>
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
        name: 'animal',
        data() {
            return {
                name: '',
                animal: '',
                selectedAnimal: '',
            }
        },
        computed: mapGetters(['isAuthenticated', 'currentUser', 'getAnimals']),
        methods: {
            init() {
                
                this.$store.dispatch('getAllAnimals');
                console.log("AnimalsComponent - init method - THIS.DOGS: ");
            },
            showModal (item) {
                this.selectedAnimal = item;
                this.$refs.selectedAnimalModal.show()
            },
            hideModal () {
                this.$refs.selectedAnimalModal.hide()
            },
        },
        created() {
            this.init();

            console.log('Animals Component mounted.')
        }
    }
</script>

<style>
    .btn {
        text-align: center;
        width: 80%;
    }
    .center {
        text-align: center;
    }
</style>
