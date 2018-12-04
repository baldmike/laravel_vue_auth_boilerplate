<template>
    <div class="page">
        <b-table striped hover :items="dogs" :fields="fields" :sort-by.sync="sortBy" :sort-desc.sync="sortDesc" class="table--default table--left"></b-table>
    </div>
    
    
</template>

<script>
    import { mapActions, mapGetters } from "vuex";

    export default {
        name: 'dog',
        data() {
            return {

                fields: [ 
            {
                key: 'name',
                label: 'Name',
                sortable: true,
                // thStyle: 'width: 10%'
            },
            {
                key: 'gender',
                label: 'Gender',
                sortable: true,
                // thStyle: 'width: 10%;'
            },
            {
                key: 'birthdate',
                label: 'Birthdate',
                sortable: true,
                // thStyle: 'width: 10%'
            }, 
            {
                key: 'breed',
                label: 'Breed',
                sortable: true,
                // thStyle: 'width: 10%'
            },
            {
                key: 'weight',
                label: 'Weight',
                sortable: true,
                // thStyle: 'width: 10%'
            },
            {
                key: 'fixed',
                label: 'Fixed',
                sortable: true,
                // thStyle: 'width: 10%'
            },
            {
                key: 'created_at',
                label: 'Alive Date',
                sortable: true,
                // thStyle: 'width: 10%'
            },
        ],
                dogs: [],
                sortBy: 'name',
                sortDesc: true,
            }
        },
        computed: mapGetters(['isAuthenticated', 'user']),
        methods: {
            init() {
                axios.call("get", "/api/dogs").then(({ data }) => {
                    console.log("[API call to dogs]: " + data);

                    this.dogs = data.data;
                })
                .catch(error => {
                    console.log("API call error: " + error);
                });
            },

        },
        mounted() {
            this.init();

            console.log('Dogs Component mounted.')
        }
    }
</script>
