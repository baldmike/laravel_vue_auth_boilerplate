<template>
    <div class="body">
        <b-col cols="6" offset="3" class="create-animal-box">
            <b-form>
                <b-form-group id="nameGroup" v-if="formStep===1">
                    <h5>Please use the navigation buttons!</h5>
                    <b-form-input id="animalName"
                    class="input-box"
                    type="text"
                    v-model="form.name"
                    required
                    :state="!$v.form.name.$invalid"
                    placeholder="Animal's name"/>                 
                </b-form-group>
                
                <b-form-group id="speciesGroup" v-if="formStep===2">
                    <div class="speciesBox">
                        <h5>What is {{ form.name }}?</h5>
                        <table>
                            <tbody>
                                <tr>
                                    <td>
                                        <b-btn class="buttonSelector" id="dogChosen" :class="{ green: isDog }" @click="selectDog"><i class="fas fa-dog" style="font-size: 44px;"></i></b-btn>
                                    </td>
                                    <td>
                                        <b-btn class="buttonSelector" id="catChosen" :class="{ green: isCat }" @click="selectCat"><i class="fas fa-cat" style="font-size: 44px;" ></i></b-btn>
                                    </td> 
                                </tr> 
                                <tr>
                                    <td>{{ form.name }} is a Dog.</td>
                                    <td>{{ form.name }} is a Cat.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </b-form-group>

                <b-form-group id="genderGroup" v-if="formStep===3">
                    <div class="genderBox">
                        <h5>Is {{ form.name }} a boy {{ form.species }} or a girl {{ form.species }}?</h5>
                        <table>
                            <tbody>
                                <tr>
                                    <td>
                                        <b-btn class="buttonSelector" :class="{ green: isMale }" @click="selectMale"><i class="fas fa-male" style="font-size: 44px;"></i></b-btn>
                                    </td>
                                    <td>
                                        <b-btn class="buttonSelector" :class="{ green: isFemale }" @click="selectFemale"><i class="fas fa-female" style="font-size: 44px;"></i></b-btn>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ form.name }}</td>
                                    <td>{{ form.name }}</td>
                                </tr>
                                <tr>
                                    <td>is a boy {{ form.species }}</td>
                                    <td>is a girl {{ form.species }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </b-form-group>
                    
                <b-form-group>
                    <div class="sourceBox" v-if="formStep===4">
                        <h5>Where is {{ form.name }} from?</h5>
                        <b-btn class="buttonSelector" :class="{ green: isCacc }" @click="selectCacc" style="font-size: 24px;">CACC</b-btn>
                        <b-btn class="buttonSelector" :class="{ green: isCrisp }" @click="selectCrisp" style="font-size: 24px;">CRISP</b-btn>
                        <b-btn class="buttonSelector" :class="{ green: isStray }" @click="selectStray" style="font-size: 24px;">STRAY</b-btn>
                        <b-btn class="buttonSelector" :class="{ green: isAlive }" @click="selectAlive" style="font-size: 24px;">ALIVE</b-btn>
                    </div>
                </b-form-group>

                <b-form-group id="genderGroup" v-if="formStep===5">
                    <div class="genderBox">
                        <h5>Is {{ form.name }} fixed?</h5>
                        <table>
                            <tbody>
                                <tr>
                                    <td>
                                        <b-btn class="buttonSelector" @click="altered"><i class="fas fa-check-circle" style="font-size: 36px; color: limegreen;" ></i></b-btn>
                                    </td>
                                    <td>
                                        <b-btn class="buttonSelector" @click="unaltered"><i class="fas fa-exclamation-circle" style="font-size: 36px; color: red;" ></i></b-btn>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ form.name }}</td>
                                    <td>{{ form.name }}</td>
                                </tr>
                                <tr>
                                    <td>is altered.</td>
                                    <td>is not unaltered.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </b-form-group>
                
                <b-form-group id="nameGroup" v-if="formStep===6">
                    <h5>If {{  form.name }} is not chipped, just click right arrow.</h5>
                    <b-form-input id="microchip"
                    class="input-box"
                    type="text"
                    v-model="form.microchipNumber"
                    placeholder="Microchip number"/>                 
                </b-form-group>

                <b-form-group class="navBox">
                    <b-btn class="navButton" @click="previousFormStep"><i class="fas fa-arrow-left" style="font-size: 44px;"></i></b-btn>
                    <b-btn class="navButton" @click="nextFormStep"><i class="fas fa-arrow-right" style="font-size: 44px;"></i></b-btn>
                </b-form-group>

                <b-form-group class="submitBox" v-if="formStep>5">
                    <b-button class="my-3" variant="dark" :disabled="$v.form.$invalid" @click="createAnimal">Welcome to Alive, {{ form.name }}</b-button>
                </b-form-group>

                    
            </b-form>
        </b-col>  
    </div>
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
                    profilePhoto: ''
                },
                breeds: [
                    { text: "What breed are they?'", value: null },
                    'Pit Bull', 'Chihuahua', 'Terrier', 'Calico', 'Siamese', 'Tabby', 'Rabbit'
                ],
                show: true,
                formStep: 1,
                isDragging: false,
                dragCount: 0,
                files: [],
                image: '',
                images: [],
                isDog: false,
                isCat: false,
                isMale: false,
                isFemale: false,
                isCacc: false,
                isCrisp: false,
                isStray: false,
                isAlive: false,
            }
        },
        mixins: [
            validationMixin
        ],
        validations: {
            form: {
                name: {
                    required,
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
            }
        },
        computed: {
            selectedSpecies() {
                return this.form.species;
            },
        },
        methods: {
            onSubmit(e) {
                e.preventDefault();
            },
            createAnimal() {
                console.log("****************");
                console.log(this.form.profilePhoto);
                console.log("****************");

                let fd = new FormData();
                fd.append("name", this.form.name);
                fd.append("gender", this.form.gender);
                fd.append("fixed", this.form.fixed);
                fd.append("species", this.form.species);
                fd.append("breed", this.form.breed);
                fd.append("source", this.form.source);
                fd.append("microchip_number", this.form.microchipNumber);
                fd.append("birthdate", this.form.birthdate);
                fd.append("weight", this.form.weight);
                fd.append("description", this.form.description);
                fd.append("profile_photo", this.form.profilePhoto);
                // Object.keys(this.form).forEach(key => {
                //     fd.append(key, this.form[key])
                // })

                axios.post("/api/animals", fd, {headers: {'Content-Type': 'multipart/form-data'}}).then(({data}) => {
                    this.$notify({
                        group: 'notifications',
                        title: 'Success',
                        text: this.form.name + ' added',
                        duration: '6000',
                        width: '100%'
                    });
                    console.log("CreateAnimalComponent -- createAnimal -- createAnimal()" + data.toString());
                }).catch((error) => {
                    console.log(error);
                })

                this.$router.push('dashboard');
                
            },
            selectDog() {
                this.form.species = "dog";
                this.isDog = !this.isDog;
                console.log("this is active");
                let self = this;
                setTimeout(function() {
                    self.formStep += 1;
                }, 1000);
            },
            selectCat() {
                this.form.species = "cat";
                this.isCat = !this.isCat;
                let self = this;
                setTimeout(function() {
                    self.formStep += 1;
                }, 1000);
                // add to "profile" as user builds
            },
            selectMale() {
                this.form.gender = "male";
                this.isMale = !this.isMale;
                let self = this;
                setTimeout(function() {
                    self.formStep += 1;
                }, 1000);
                // add to "profile" as user builds
            },
            selectFemale() {
                this.form.gender = "female";
                this.isFemale = !this.isFemale;
                let self = this;
                setTimeout(function() {
                    self.formStep += 1;
                }, 1000);
                // add to "profile" as user builds
            },
            selectCacc() {
                this.form.source = "cacc";
                this.isCacc = !this.isCacc;
                let self = this;
                setTimeout(function() {
                    self.formStep += 1;
                }, 1000);
                // add to "profile" as user builds
            },
            selectCrisp() {
                this.form.source = "crisp";
                this.isCrisp = !this.isCrisp;
                let self = this;
                setTimeout(function() {
                    self.formStep += 1;
                }, 1000);
                // add to "profile" as user builds
            },
            selectStray() {
                this.form.source = "stray";
                this.isStray = !this.isStray;
                let self = this;
                setTimeout(function() {
                    self.formStep += 1;
                }, 1000);
                // add to "profile" as user builds
            },
            selectAlive() {
                this.form.source = "alive";
                this.isAlive = !this.isAlive;
                let self = this;
                setTimeout(function() {
                    self.formStep += 1;
                }, 1000);
                // add to "profile" as user builds
            },
            altered() {
                this.form.fixed = true;
                let self = this;
                setTimeout(function() {
                    self.formStep += 1;
                }, 700);
                // add to "profile" as user builds
            },
            unaltered() {
                let self = this;
                setTimeout(function() {
                    self.formStep += 1;
                }, 700);
                // add to "profile" as user builds
            },
            nextFormStep() {
                this.formStep += 1;
            },
            previousFormStep() {
                if (this.formStep > 1) {
                    this.formStep -= 1;
                }
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
                this.form.profilePhoto = '';
                
                this.form.checked = [];

                this.images = [];
                this.files = [];

                /* Trick to reset/clear native browser form validation state */
                this.show = false;
                this.$nextTick(() => { this.show = true });
            },

            onInputChange(e) {
                this.form.profilePhoto = e.target.files[0];

                const files = e.target.files;
                
                Array.from(files).forEach(file => this.addImage(file));
            },
            addImage(file) {
                
                this.files.push(file);
                
                let reader = new FileReader();

                reader.onload = (e) => this.images.push(e.target.result);

                reader.readAsDataURL(file);
                
            },
            getFileSize(size) {
                const fSExt = ['Bytes', 'KB', 'MB', 'GB'];
                let i = 0;
                
                while(size > 900) {
                    size /= 1024;
                    i++;
                }
                return `${(Math.round(size * 100) / 100)} ${fSExt[i]}`;
            },
            upload() {
                const formData = new FormData();
                
                this.files.forEach(file => {
                    formData.append('images[]', file, file.name);
                });
                axios.post('/images-upload', formData).then(response => {
                    this.$notify({
                        group: 'notifications',
                        title: 'Success',
                        text: 'Image successfully uploaded',
                        duration: '6000',
                        width: '100%'
                    });
                    this.images = [];
                    this.files = [];
                })
            },
            showModal() {
                this.$refs.formIndexModal.show()
            },
            init() {
                console.log("CreateAnimalComponent Mounted")
            }
        },
        mounted() {
            this.init();
        }
    }
</script>










<style scoped>
    .buttonSelector {
        width: 100px;
        height: 100px;
        border-radius: 25px;
        margin: 30px;
        margin-bottom: 5px;
        margin-top: 10px;
    }
    .navButton {
        width: 100px;
        height: 60px;
        border-radius: 25px;
        margin: 30px;
        margin-bottom: 5px;
        background-color: lightgray;
    }
    .body {
        background-color: #2196F3;
        height: 1000px;
        padding: 20px;
    }
    .imageInput {
        margin: 10px;
        margin-left: 0px;
        height: 4rem;
        background-color: white;
        text-align: center;
    }
    .input-box {
        margin: 10px;
        margin-left: 0px;
    }
    .selectedButton {
        background-color: white;
    }
    .create-animal-box {
        text-align: center;
    }
    .speciesBox {
        text-align: center;
    }
    .genderBox {
        text-align: center;
    }
    .navBox {
        text-align: center;
    }
    .submitBox {
        text-align: center;
    }
    .green {
        color: limegreen;
    }

    table {
        margin-left: auto;
        margin-right: auto;
    }
</style>
