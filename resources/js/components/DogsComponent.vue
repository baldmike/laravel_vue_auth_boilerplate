<template>
    <div>
        <b-row>
            <b-col v-for="(dog, index) in getDogs"
                    :key="index" cols="4">
                <b-card 
                    img-src="https://picsum.photos/1024/400/?image=13"
                    img-alt="Image"
                    img-top
                    tag="article"
                    class="mb-2">

                    <!-- <b-btn v-b-modal.modal1 style="width: 90%;">{{ dog.name }}, {{ dog.breed }}</b-btn> -->
                    <b-btn @click="showModal(dog)" dog="'dog.id'">{{ dog.name }}, {{ dog.breed }}</b-btn>
                    <p class="card-text">
                        
                    </p>
                </b-card>
            </b-col>
        </b-row>


        <div>
            <!-- Modal Component -->
            <b-modal ref="modal1" title="Bootstrap-Vue" :dog="'dog'">
                <p class="my-4">{{ currentUser }}</p>
                <p class="my-4">{{ selectedDog }}</p>
                <b-btn class="mt-3" variant="outline-danger" block @click="hideModal">Close Me</b-btn>
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
                this.$refs.modal1.show()
            },
            hideModal () {
                this.$refs.modal1.hide()
            },
        },
        created() {
            this.init();

            console.log('Dogs Component mounted.')
        }
    }
</script>
