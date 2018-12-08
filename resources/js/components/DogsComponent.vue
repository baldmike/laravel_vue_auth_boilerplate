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

                    <b-btn v-b-modal.modal1 style="width: 90%;">{{ dog.name }}, {{ dog.breed }}</b-btn>

                    <p class="card-text">
                        
                    </p>
                </b-card>
            </b-col>
        </b-row>


        <div>
            <!-- Modal Component -->
            <b-modal id="modal1" title="Bootstrap-Vue">
                <p class="my-4">{{ currentUser }}</p>
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
            }
        },
        computed: mapGetters(['isAuthenticated', 'currentUser', 'getDogs']),
        methods: {
            init() {
                
                this.$store.dispatch('getAllDogs');
                
                console.log("DogsComponent - init method - THIS.DOGS: ");
            },
        },
        created() {
            this.init();

            console.log('Dogs Component mounted.')
        }
    }
</script>
