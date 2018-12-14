<template>
    <div>
        <b-card :title="currentUser"
                img-src="https://picsum.photos/600/300/?image=54"
                img-alt="Image"
                img-top
                tag="article"
                style="max-width: 33%;"
                class="mb-2">
            <p class="card-text">
            {{ currentUser }}
            </p>
            <b-button href="#" variant="primary">Go somewhere</b-button>
        </b-card>
    </div>
</template>

<script>

    import { mapActions, mapGetters } from "vuex";

    export default {
        name: 'dashboard',
        data() {
            return {
                
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

            console.log('Dashboard Component mounted.')
        }
    }
</script>

<style scoped>
    
</style>