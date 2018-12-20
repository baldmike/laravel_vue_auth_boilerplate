<template>
    <div>
        <b-row>
            <b-col cols="4">
                <b-button class="filterButton" @click="showAll" disabled>Show All</b-button>
                <b-button class="filterButton" @click="showDogs">Dogs</b-button>
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
            <b-col v-for="(animal, index) in filteredAnimals"
                    :key="index" cols="3" class="animal-card">
                <b-card v-if="animal.profile_photo" :img-src="'http://localhost:8000/storage/' + animal.profile_photo" style="max-height: 40rem;" img-alt="Selected animal image">
                    <b-btn class="selectButton" @click="showModal(animal)" animal="'animal.id'">{{ animal.name }}  |  <span style="color: black;"> {{ animal.species }} </span>  |  {{ animal.breed }}</b-btn>
                </b-card>
                <b-card v-else :img-src="'http://localhost:8000/storage/images/dog_placeholder.jpg'" style="max-height: 40rem;" img-alt="No Selected animal image">
                    <b-btn class="selectButton" @click="showModal(animal)" animal="'animal.id'">{{ animal.name }}  |  <span style="color: black;"> {{ animal.species }} </span>  |  {{ animal.breed }}</b-btn>
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
                search: '',
                selectedAnimal: '',
            }
        },
        computed: {
            filteredAnimals() {
                var self=this;

                return this.$store.state.animals.filter(animal => animal.name.toLowerCase().indexOf(self.search.toLowerCase())>=0 || animal.breed.toLowerCase().indexOf(self.search.toLowerCase())>=0 || animal.species.toLowerCase().indexOf(self.search.toLowerCase())>=0);
            },
        ...mapGetters(['isAuthenticated', 'currentUser', 'getAnimals'])},
        methods: {
            showModal (item) {
                this.selectedAnimal = item;
                this.$refs.selectedAnimalModal.show()
            },
            hideModal () {
                this.$refs.selectedAnimalModal.hide()
            },
            showDogs() {
                this.$router.push('dogs');
            },
            showCats() {
                this.$router.push('cats');
            },
            showRabbits() {
                this.$router.push('rabbits');
            },
            showAll() {
                this.$router.push('dashboard')
            },
            noPic() {
                console.log("NO PROFILE PICTURE");
            }
        },
    }
</script>

<style scoped>
    .btn {
        text-align: center;
        /* width: 24%; */
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
