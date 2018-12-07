<template>
    <!-- <div class="page">
        <b-table striped hover :items="dogs" :fields="fields" :sort-by.sync="sortBy" :sort-desc.sync="sortDesc" class="table--default table--left"></b-table>
    </div> -->
    <div>
        <b-row>
            <b-col v-for="(dog, index) in getDogs"
                    :key="index" cols="4">
                <b-card 
                    img-src="https://picsum.photos/1024/400/?image=41"
                    img-alt="Image"
                    img-top
                    tag="article"
                    
                    class="mb-2">
                    <p class="card-text">
                        {{ dog.name }}, {{ dog.breed }}
                    </p>
                </b-card>
            </b-col>
        </b-row>
    </div>
    
</template>

<script>
    import { mapActions, mapGetters } from "vuex";

    export default {
        name: 'dog',
        data() {
            return {

            }
        },
        computed: mapGetters(['isAuthenticated', 'currentUser', 'getDogs']),
        methods: {
            init() {
                this.$store.dispatch('getAllDogs');
                console.log("DogsComponent - init method - THIS.DOGS: ");
            },
        },
        mounted() {
            this.init();

            console.log('Dogs Component mounted.')
        }
    }
</script>
