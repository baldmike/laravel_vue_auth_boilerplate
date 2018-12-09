<template>
    <div>
        <b-row>
            <b-col v-for="(dog, index) in getDogs"
                    :key="index" cols="4">
                <b-card 
                    img-src="https://picsum.photos/1024/400/?image=31"
                    img-alt="Image"
                    img-top
                    tag="article"
                    class="mb-2">

                    <b-btn @click="showModal(dog)" dog="'dog.id'">{{ dog.name }}, {{ dog.breed }}</b-btn>
                    <p class="card-text">
                        
                    </p>
                </b-card>
            </b-col>
        </b-row>


        <div>
            <!-- Modal Component -->
            <b-modal ref="selectedDogModal" :dog="'dog'" ok-only ok-title="Close" ok-variant="dark">
                <h1 class="my-5">{{ selectedDog.name }}</h1>
                <li class="my-4">{{ selectedDog.breed }}, {{selectedDog.gender}}, {{ selectedDog.weight }} pounds</li>
                <li class="my-4">From {{ selectedDog.source }} on {{ selectedDog.created_at }}</li>
                <div class="my-4">{{ selectedDog.description }}</div>
            </b-modal>
        </div>
    </div>
</template>

<script>
    import { mapActions, mapGetters } from "vuex";

    export default {
        name: 'dog',
        data() {
            return {
                name: '',
                dog: '',
                selectedDog: '',
            }
        },
        computed: mapGetters(['isAuthenticated', 'currentUser', 'getDogs']),
        methods: {
            init() {
                
                this.$store.dispatch('getAllDogs');
                console.log("DogsComponent - init method - THIS.DOGS: ");
            },
            showModal (item) {
                this.selectedDog = item;
                this.$refs.selectedDogModal.show()
            },
            hideModal () {
                this.$refs.selectedDogModal.hide()
            },
        },
        created() {
            this.init();

            console.log('Dogs Component mounted.')
        }
    }
</script>
