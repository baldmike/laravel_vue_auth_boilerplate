<template>
    <div>
        <b-row>
            <b-col cols="4">
                <b-button class="filterButton" @click="showAll">Show All</b-button>
                <b-button class="filterButton" @click="showDogs" disabled>Dogs</b-button>
                <b-button class="filterButton" @click="showCats">Cats</b-button>
                <b-button class="filterButton" @click="showRabbits">Rabbits</b-button>
            </b-col>
            <b-col cols="4">
                <div class="my-3">
                    <input class="searchBar" type="text" v-model="search" placeholder="Search">
                </div>
            </b-col>
            <b-col cols="4">
                
            </b-col>
        </b-row>

        <b-row>
            <b-col v-for="(dog, index) in filteredDogs"
                    :key="index" cols="4">
                <b-card 
                    img-src="https://picsum.photos/1024/400/?image=69"
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
        name: 'dogs',
        data() {
            return {
                name: '',
                dog: '',
                search: '',
                selectedDog: '',
            }
        },
        computed: {
            filteredDogs() {
                var self=this;

                return this.$store.state.dogs.filter(animal => animal.name.toLowerCase().indexOf(self.search.toLowerCase())>=0 || animal.breed.toLowerCase().indexOf(self.search.toLowerCase())>=0 || animal.species.toLowerCase().indexOf(self.search.toLowerCase())>=0);
            },
        ...mapGetters(['isAuthenticated', 'currentUser', 'getDogs'])},
        methods: {
            showModal (item) {
                this.selectedDog = item;
                this.$refs.selectedDogModal.show()
            },
            hideModal () {
                this.$refs.selectedDogModal.hide()
            },
            showCats() {
                this.$router.push('cats');
            },
            showDogs() {
                this.$router.push('dogs');
            },
            showRabbits() {
                this.$router.push('rabbits');
            },
            showAll() {
                this.$router.push('dashboard')
            }
        },
    }
</script>

<style>
    .btn {
        text-align: center;
        width: 24%;
    }
    .center {
        text-align: center;
    }
    .searchBar {
        width: 100%;
        text-align: center;
    }
    .selectButton {
        width: 85%;
    }
    .filterButton {
        width: 24%;
    }
</style>
