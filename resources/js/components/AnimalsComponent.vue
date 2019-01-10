<template>
    <div class="body">
        <b-row>
            <b-col cols="4">
                <b-form-checkbox v-model="filterDogs">Dogs</b-form-checkbox>
                <b-form-checkbox v-model="filterCats">Cats</b-form-checkbox>
                <b-form-checkbox v-model="filterRabbits">Rabbits</b-form-checkbox>
            </b-col>
            <b-col cols="4">
                <div class="my-3">
                    <input class="search-bar" type="text" v-model="search" placeholder="Search">
                </div>
            </b-col>
            <b-col cols="4">
                
            </b-col>
        </b-row>

        <b-row>
            <b-col v-for="(animal, index) in filteredAnimals"
                    :key="index" cols="12" md="3">
                <b-card v-if="animal.profile_photo" :img-src="'http://localhost:8000/storage/' + animal.profile_photo" height="60" img-alt="Selected animal image" class="animal-card">
                </b-card>
                <b-card v-else :img-src="'http://localhost:8000/storage/images/dog_placeholder.jpg'" img-alt="No Selected animal image" class="animal-card">
                </b-card>
                <b-btn class="select-button" @click="showModal(animal)" animal="'animal.id'">{{ animal.name }}  |  <span style="color: black;"> {{ animal.species }} </span>  |  {{ animal.breed }}</b-btn>
            </b-col>
        </b-row>

        <div>
            <!-- Modal Component -->
            <b-modal ref="selectedAnimalModal" :animal="'animal'" ok-only ok-title="Close" ok-variant="dark">
                <h1 class="my-2">{{ selectedAnimal.name }}</h1>
                <li class="my-4">{{ selectedAnimal.breed }}, {{selectedAnimal.gender}}, {{ selectedAnimal.weight }} pounds</li>
                <li class="my-4">From {{ selectedAnimal.source }} on {{ selectedAnimal.created_at | moment("dddd, MMMM Do YYYY")}}</li>
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
                filterDogs: false,
                filterCats: false,
                filterRabbits: false,
            }
        },
        computed: {
            filteredAnimals() {
                let self=this;
                let results = [];
                let allAnimals = this.$store.state.animals;

                if (this.filterDogs) {
                    allAnimals = this.$store.state.animals.filter(animal => animal.species === 'dog')
                }

                if (this.filterCats) {
                    allAnimals = this.$store.state.animals.filter(animal => animal.species === 'cat')
                }
            
                if (this.filterRabbits) {
                    allAnimals = this.$store.state.animals.filter(animal => animal.species === 'rab')
                }

                if (this.search) {
                    return this.$store.state.animals.filter(animal => animal.name.toLowerCase().indexOf(self.search.toLowerCase())>=0);
                
                }
                
                return allAnimals;
                
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
            showAll() {
                this.$router.push('dashboard')
            },
            noPic() {
                console.log("NO PROFILE PICTURE");
            },
        },
    }
</script>

<style scoped>

    .body {
        padding: 20px;
    }
    .btn {
        text-align: center;
        /* width: 24%; */
    }
    .center {
        text-align: center;
    }
    .search-bar {
        width: 100%;
        text-align: center;
    }
    .select-button {
        width: 100%;
        margin-bottom: 20px;
    }
    .filter-button {
        width: 24%;
    }
    .animal-card {
        margin-bottom: 20px;
        padding: 1rem;
        
    }
    .card-img {
        height: 16rem;
    }
</style>
