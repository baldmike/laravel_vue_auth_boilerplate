<template>
    <transition name="slide">
        <animals-component></animals-component>
    </transition>
    
</template>

<script>

    import AnimalsComponent from './AnimalsComponent';
    import { mapActions, mapGetters } from "vuex";

    export default {
        name: 'dashboard',
        components: {
            AnimalsComponent,
        },
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
            if (this.$store.state.animals.length === 0) {
                this.init();
            }

            console.log('Dashboard Component mounted.')
        }
    }
</script>

<style scoped>
    
</style>