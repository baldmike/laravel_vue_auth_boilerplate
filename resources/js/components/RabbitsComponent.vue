<template>
    <div>
        <b-row>
            <b-col cols="4">
                <b-button class="filterButton" @click="showAll">Show All</b-button>
                <b-button class="filterButton" @click="showDogs">Dogs</b-button>
                <b-button class="filterButton" @click="showCats">Cats</b-button>
                <b-button class="filterButton" @click="showRabbits" disabled>Rabbits</b-button>
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
            <b-col v-for="(rabbit, index) in filteredRabbits"
                    :key="index" cols="4">
                <b-card 
                    img-src="https://picsum.photos/1024/400/?image=18"
                    img-alt="Image"
                    img-top
                    tag="article"
                    class="mb-2 center">

                    <b-btn class="selectButton" @click="showModal(rabbit)" rabbit="'rabbit.id'">{{ rabbit.name }}  |  <span style="color: black;"> {{ rabbit.species }} </span>  |  {{ rabbit.breed }}</b-btn>
                    <p class="card-text">
                        
                    </p>
                </b-card>
            </b-col>
        </b-row>

        <div>
            <!-- Modal Component -->
            <b-modal ref="selectedCatModal" :rabbit="'rabbit'" ok-only ok-title="Close" ok-variant="dark">
                <h1 class="my-2">{{ selectedCat.name }}</h1>
                <li class="my-4">{{ selectedCat.breed }}, {{selectedCat.gender}}, {{ selectedCat.weight }} pounds</li>
                <li class="my-4">From {{ selectedCat.source }} on {{ selectedCat.created_at | moment("dddd, MMMM Do YYYY" )}}</li>
                <div class="my-4">{{ selectedCat.description }}</div>
            </b-modal>
        </div>
    </div>
</template>

<script>
    import { mapActions, mapGetters } from "vuex";

    export default {
        name: 'rabbits',
        data() {
            return {
                name: '',
                rabbit: '',
                search: '',
                selectedCat: '',
            }
        },
        computed: {
            filteredRabbits() {
                var self=this;

                return this.$store.state.animals.filter(animal => animal.name.toLowerCase().indexOf(self.search.toLowerCase())>=0 || animal.breed.toLowerCase().indexOf(self.search.toLowerCase())>=0 || animal.species.toLowerCase().indexOf(self.search.toLowerCase())>=0);
            },
        ...mapGetters(['isAuthenticated', 'currentUser', 'getCats'])},
        methods: {
            showModal (item) {
                this.selectedCat = item;
                this.$refs.selectedRabbitModal.show()
            },
            hideModal () {
                this.$refs.selectedRabbitModal.hide()
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
