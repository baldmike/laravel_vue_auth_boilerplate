<template>
  <b-row>
      <b-col cols="6" offset="3">
          <b-form @reset="onReset" v-if="show">
            <b-row>
                <b-col cols="4">
                    <b-form-group id="nameInputGroup"
                            label="Animal Name:"
                            label-for="animalName">
                        <b-form-input id="animalName"
                                    type="text"
                                    v-model="form.name"
                                    required
                                    :state="!$v.form.name.$invalid"
                                    placeholder="Enter Animal's Name"/>
                        <b-form-invalid-feedback id="nameLiveFeedback">
                            Red fields are required.
                        </b-form-invalid-feedback>
                    </b-form-group>
                </b-col>
                <b-col cols="3">
                    <b-form-group id="genderInputGroup"
                        label="Gender:"
                        label-for="gender">
                        <b-form-select id="gender" 
                                :options="gender"
                                required
                                v-model="form.gender"
                                :state="!$v.form.gender.$invalid">
                        </b-form-select>
                    </b-form-group>
                </b-col>

                <b-col cols="1">
                    <b-form-group id="fixedInputGroup"
                        label="Fixed"
                        label-for="fixed">
                        <b-form-checkbox-group v-model="form.fixed" id="fixed">
                            <b-form-checkbox value="1" unchecked-value="0"></b-form-checkbox>
                        </b-form-checkbox-group>
                    </b-form-group>
                </b-col>

                
                <b-col cols="4">
                    <b-form-group id="sourceInputGroup"
                            label="Source:"
                            label-for="source">
                        <b-form-select id="source"
                                    :options="sources"
                                    required
                                    v-model="form.source"
                                    :state="!$v.form.source.$invalid">
                        </b-form-select>
                    </b-form-group>
                </b-col>
            </b-row>
            
            <b-row>
                <b-col>
                    <b-form-group id="speciesInputGroup"
                            label="Species:"
                            label-for="species">
                        <b-form-select id="species" 
                                :options="species"
                                required
                                v-model="form.species"
                                :state="!$v.form.species.$invalid">
                        </b-form-select>
                    </b-form-group>
                </b-col>
                
                <b-col>
                    <b-form-group id="breedInputGroup"
                                label="Breed:"
                                label-for="breed">
                        <b-form-select id="breed"
                                    :options="breeds"
                                    v-model="form.breed">
                        </b-form-select>
                    </b-form-group>
                </b-col>

                <b-col>
                    <b-form-group id="microchipInputGroup"
                            label="Microchip Number:"
                            label-for="microchip">
                        <b-form-input id="microchipNumber"
                                    type="text"
                                    v-model="form.microchipNumber"
                                    placeholder="Enter microchip number, if available">
                        </b-form-input>
                    </b-form-group>
                </b-col>
            </b-row>

            <b-row>
                <b-col>
                    <b-form-group id="birthdateInputGroup"
                            label="Birthdate:"
                            label-for="birthdate">
                        <b-form-input id="birthdate"
                                    type="date"
                                    v-model="form.birthdate">
                        </b-form-input>
                    </b-form-group>
                </b-col>

                <b-col>
                    <b-form-group id="weightInputGroup"
                        label="Weight:"
                        label-for="weight">
                        <b-form-input id="weight"
                                type="number"
                                v-model="form.weight">
                        </b-form-input>
                    </b-form-group>
                </b-col>
            </b-row>

            <b-row>
                <b-col>
                    <b-form-group id="descriptionInputGroup"
                        label="Description:"
                        label-for="description">
                        <b-form-textarea id="description"
                                :rows="3"
                                :max-rows="6"
                                v-model="form.description">
                        </b-form-textarea>
                    </b-form-group>
                </b-col>
            </b-row>

            <b-button class="my-3" variant="dark" :disabled="$v.form.$invalid" @click="createAnimal">Welcome to Alive, {{ form.name }}</b-button>
            <b-button class="my-3" type="reset" variant="danger">Reset</b-button>
        </b-form>
      </b-col>
  </b-row>
</template>

<script>

    import { validationMixin } from "vuelidate";
    import { required, minLength, email, between } from "vuelidate/lib/validators";

    export default {
        data () {
            return {
                form: {
                    name: '',
                    species: null,
                    breed: null,
                    source: null,
                    microchipNumber: null,
                    gender: null,
                    checked: [],
                    fixed: 0,
                    birthdate: '',
                    weight: '',
                    description: '',
                },
                species: [
                    { text: 'Choose Species', value: null },
                    'Dog', 'Cat', 'Rabbit'
                ],
                breeds: [
                    { text: 'Choose Breed', value: null },
                    'Pit Bull', 'Chihuahua', 'Terrier', 'Calico', 'Siamese', 'Tabby', 'Rabbit'
                ],
                sources: [
                    { text: 'Choose Source', value: null },
                    'CACC', 'CRISP', 'Stray', 'Alive'
                ],
                gender: [
                    { text: 'Gender', value: null },
                    'Male', 'Female'
                ],
                show: true
            }
        },
        mixins: [
            validationMixin
        ],
        validations: {
            form: {
                name: {
                    required,
                    minLength: minLength(2)
                },
                species: {
                    required,
                },
                gender: {
                    required
                },
                source: {
                    required
                },
                breed: {
                    required
                },
            }
        },
        computed: {
            selectedSpecies() {
                return this.form.species;
            },
        },
        methods: {
            createAnimal() {
                let fd = new FormData();
                Object.keys(this.form).forEach(key => {
                    fd.append(key, this.form[key])
                })

                axios.post("/api/animals", fd, {headers: {'Content-Type': 'multipart/form-data'}}).then(({data}) => {
                    this.$notify({
                        group: 'notifications',
                        title: 'Success',
                        text: this.form.name + 'Animal added',
                        duration: '6000',
                        width: '100%'
                    });
                    console.log("CreateAnimalComponent -- createAnimal -- createAnimal()" + data.name);
                }).catch((error) => {
                    console.log(error);
                })

                this.$router.push('dashboard');
                
            },

            onReset (evt) {
                evt.preventDefault();

                /* Reset our form values */
                this.form.name = null;
                this.form.gender = null;
                this.form.fixed = 0;
                this.form.source = null;
                this.form.species = null;
                this.form.breed = null;
                this.form.microchipNumber = '';
                this.form.birthdate = '';
                this.form.weight = '';
                this.form.description = '';
                
                this.form.checked = [];
                /* Trick to reset/clear native browser form validation state */
                this.show = false;
                this.$nextTick(() => { this.show = true });
            }
        }
    }
</script>

<style scoped>

</style>
