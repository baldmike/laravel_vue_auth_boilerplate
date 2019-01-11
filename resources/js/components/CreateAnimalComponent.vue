<template>
    <div class="body">
        <b-col sm="12" md="6" offset-md="3" class="create-animal-box">
            <b-form v-on:submit.prevent="nextFormStep">
                <b-form-group id="nameGroup" v-if="formStep===1" class="form-box">
                    <h5 style="margin-bottom: 20px;">Please enter the animal's name:</h5>
                    <b-form-input id="animalName"
                        class="input-box"
                        type="text"
                        v-model="form.name"
                        required
                        :state="!$v.form.name.$invalid"
                        placeholder="Animal's name"/>                 
                </b-form-group>
                
                <b-form-group id="speciesGroup" v-if="formStep===2" class="form-box">
                    <div class="selection-box">
                        <h5>What is {{ form.name }}?</h5>
                        <table>
                            <tbody>
                                <tr>
                                    <td>
                                        <b-btn class="button-selector" id="dogChosen" :class="{ green: isDog }" @click="selectDog"><i class="fas fa-dog"></i></b-btn>
                                    </td>
                                    <td>
                                        <b-btn class="button-selector" id="catChosen" :class="{ green: isCat }" @click="selectCat"><i class="fas fa-cat"></i></b-btn>
                                    </td> 
                                </tr> 
                                <tr>
                                    <td>{{ form.name }}</td>
                                    <td>{{ form.name }}</td>
                                </tr>
                                <tr>
                                    <td>is a Dog.</td>
                                    <td>is a Cat.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </b-form-group>

                <b-form-group id="breedGroup" v-if="formStep===3" class="form-box">
                    <div class="selection-box">
                        <h5>What kind of {{ form.species }} is {{ form.name }}?</h5>
                        <b-form-select id="breedInputDogs"
                                    v-if="form.species==='dog'"
                                    :options="dogBreeds"
                                    class="input-box"
                                    required
                                    v-model="form.breed">
                        </b-form-select>
                        <b-form-select id="breedInputCats"
                                    v-if="form.species==='cat'"
                                    :options="catBreeds"
                                    class="input-box"
                                    required
                                    v-model="form.breed">
                        </b-form-select>
                        <b-form-select id="breedInputRabbits"
                                    v-if="form.species==='rab'"
                                    :options="rabBreeds"
                                    class="input-box"
                                    required
                                    v-model="form.breed">
                        </b-form-select>
                    </div>
                </b-form-group>

                <b-form-group id="genderGroup" v-if="formStep===4" class="form-box">
                    <div class="selection-box">
                        <h5>Is {{ form.name }} a boy {{ form.species }} or a girl {{ form.species }}?</h5>
                        <table>
                            <tbody>
                                <tr>
                                    <td>
                                        <b-btn class="button-selector" :class="{ green: isMale }" @click="selectMale"><i class="fas fa-male"></i></b-btn>
                                    </td>

                                    <td>
                                        <b-btn class="button-selector" :class="{ green: isFemale }" @click="selectFemale"><i class="fas fa-female"></i></b-btn>
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
                    
                <b-form-group id="sourceGroup" v-if="formStep===5" class="form-box">
                    <div class="selection-box">
                        <h5>Where is {{ form.name }} from?</h5>
                        <b-btn class="button-selector" :class="{ green: isCacc }" @click="selectCacc" style="font-size: 1rem;">CACC</b-btn>
                        <b-btn class="button-selector" :class="{ green: isCrisp }" @click="selectCrisp" style="font-size: 1rem;">CRISP</b-btn>
                        <b-btn class="button-selector" :class="{ green: isStray }" @click="selectStray" style="font-size: 1rem;">STRAY</b-btn>
                        <b-btn class="button-selector" :class="{ green: isAlive }" @click="selectAlive" style="font-size: 1rem;">ALIVE</b-btn>
                    </div>
                </b-form-group>

                <b-form-group id="animalNumGroup" v-if="formStep===6" class="form-box">
                    <div class="selection-box">
                        <h5>If {{ form.name }} has a CACC Animal Number, enter it here:</h5>
                        <b-form-input id="animal_number"
                                    onkeypress="return event.keyCode != 13;"
                                    class="input-box"
                                    type="text"
                                    v-model="form.animal_number"
                                    placeholder="Animal Number"/> 
                    </div>
                </b-form-group>
                
                <b-form-group id="microchipGroup" v-if="formStep===7" class="form-box">
                    <div class="selection-box">
                        <h5>If {{  form.name }} is chipped, enter {{ getPronoun1 }} chip number:.</h5>
                        <b-form-input id="microchip"
                                    onkeypress="return event.keyCode != 13;"
                                    class="input-box"
                                    type="text"
                                    v-model="form.microchipNumber"
                                    placeholder="Microchip number"/>                 
                    </div>
                </b-form-group>

                <b-form-group id="genderGroup" v-if="formStep===8" class="form-box">
                    <div class="selection-box">
                        <h5>Is {{ form.name }} {{ fixed }}?</h5>
                        <table>
                            <tbody>
                                <tr>
                                    <td>
                                        <b-btn class="button-selector" :class="{ green: isAltered }" @click="altered"><i class="fas fa-check-circle"></i></b-btn>
                                    </td>
                                    <td>
                                        <b-btn class="button-selector" :class="{ red: isUnaltered }" @click="unaltered"><i class="fas fa-exclamation-circle"></i></b-btn>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ form.name }}</td>
                                    <td>{{ form.name }}</td>
                                </tr>
                                <tr>
                                    <td>is {{ fixed }}.</td>
                                    <td>is not {{ fixed }}.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </b-form-group>

                <b-form-group id="birthdateGroup" v-if="formStep===9" class="form-box">
                    <h5>What is {{ form.name }}'s birthday?</h5>
                    <b-form-input id="birthdate"
                                onkeypress="return event.keyCode != 13;"
                                type="date"
                                class="input-box"
                                v-model="form.birthdate"/>
                </b-form-group>

                <b-form-group v-if="formStep===10" class="form-box">
                    <b-row>
                        
                            
                        
                        <b-col v-if="!images.length">
                            <h5 style="margin-bottom: 20px;">Select a picture of {{ form.name }} to upload</h5>
                        </b-col>
                        
                        <b-col sm="12" v-if="!images.length">
                            
                            <div class="image-wrapper">
                                <b-btn class="button-selector" @click="triggerSelectImage"><i class="fa fa-upload"></i></b-btn>
                                <div class="upload-button">
                                    <input type="file"
                                        id="profilePhoto"
                                        :name="form.profilePhoto" 
                                        @change="onInputChange" 
                                        ref="imageInput"
                                        enctype="multipart/form-data">
                                </div>
                            </div>
                        </b-col>
                        <b-col sm="12" md="4" offset-md="4">
                            <div class="image-preview">
                                <div  v-for="(image, index) in images" :key="index">
                                    <img :src="image" width="200" @click="deleteImageSelection" alt="uploaded image">
                                    <h6><em>click the image to delete</em></h6>
                                </div>
                            </div>
                        </b-col>
                    </b-row>
                </b-form-group>

                <b-form-group v-if="formStep===11" class="form-box">
                    <h5 style="margin-bottom: 20px;">How much does {{ form.name }} weigh:</h5>
                    <input type="number"
                            id="weight"
                            v-model="form.weight">
                </b-form-group>

                <b-form-group class="submit-box" v-if="formStep>11">
                    <div class="selection-box">
                        <h5>Check the following for accuracy, if you need to change anything, use the back arrow.</h5>
                        <h5> Welcome to Alive, {{ form.name }}!</h5>
                        <table>
                            <tbody>
                                <tr>
                                    <td>
                                        <li>{{ form.name }} is a {{ form.weight }} pound, {{ getGender }} {{ form.breed }} {{ form.species }} from {{ form.source }} who is {{ isFixed }} <span v-if="form.microchipNumber">and has a microchip, {{ form.microchipNumber }}</span></li>
                                        <li>{{ getPronoun1 }} birthday is {{ form. birthdate }}</li>
                                        <li v-if="!form.microchipNumber">{{ getPronoun2 }} is not microchipped.</li>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <b-col sm="12" md="4" offset-md="4">
                            <div class="image-preview">
                                <div  v-for="(image, index) in images" :key="index">
                                    <img :src="image" width="200" alt="uploaded image">
                                </div>
                            </div>
                        </b-col>
                    </div>

                    <b-button class="my-3" variant="dark" :disabled="$v.form.$invalid" @click="createAnimal">Submit</b-button>
                </b-form-group>

            </b-form>

            <div class="nav-box">
                <b-row>
                    <b-btn class="nav-button" @click="previousFormStep" :disabled="formStep<2"><i class="fas fa-arrow-left"></i></b-btn>
                    <b-btn class="nav-button" @click="nextFormStep" :disabled="formStep>11 || $v.form.name.$invalid"><i class="fas fa-arrow-right"></i></b-btn>
                </b-row>

                <div class="progress">
                    <div class="progress"
                    style="background-color: white; margin: 0;"
                    :style="{width: progress + '%'}"/>
                </div>
            </div>

            
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
                dogBreeds: [
                    { text: "Click to Select", value: null },
                    'Pit Bull', 'Chihuahua', 'Poodle','Terrier', 'Lhasa Ahpso', 'Samoyed'
                ],
                catBreeds: [
                    { text: "breed", value: null },
                    'Tabby', 'Siamese', 'Blue Ridge Tickler'
                ],
                rabbitBreeds: [
                    { text: "breed", value: null },
                    'Floppy', 'Fluffy', 'Delicious'
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
                isAltered: false,
                isUnaltered: false
            }
        },
        mixins: [
            validationMixin
        ],
        validations: {
            form: {
                name: {
                    required,
                    minLength: 1,
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
            getPronoun1() {
                if (this.form.gender === "M") {
                    return "his";
                } else {
                    return "her";
                }
            },
            getPronoun2() {
                if (this.form.gender === "M") {
                    return "he"
                } else {
                    return "she"
                }
            },
            getGender() {
                if (this.form.gender === "M") {
                    return "male"
                } else {
                    return "female"
                }
            },
            fixed() {
                if (this.form.gender === "M") {
                    return "neutered"
                } else {
                    return "spayed"
                }
            },
            isFixed() {
                if (this.form.fixed === 1) {
                    return this.fixed;
                } else {
                    return "not altered"
                }
            },
            progress() {
                return this.formStep * 8.5;
            }
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

                this.$store.dispatch('getAllAnimals');
                this.$router.push('/dashboard');
                
            },
            selectDog() {
                this.form.species = "dog";
                this.isDog = true;
                
                if (this.isCat) {
                    this.isCat = false;
                }
                
                let self = this;
                setTimeout(function() {
                    self.formStep += 1;
                }, 500);
            },
            selectCat() {
                this.form.species = "cat";
                this.isCat = true;

                if (this.isDog) {
                    this.isDog = false;
                } 
                let self = this;
                setTimeout(function() {
                    self.formStep += 1;
                }, 500);
                // add to "profile" as user builds
            },
            selectMale() {
                this.form.gender = "M";
                this.isMale = true;

                if (this.isFemale) {
                    this.isFemale = false;
                } 
                let self = this;
                setTimeout(function() {
                    self.formStep += 1;
                }, 500);
                // add to "profile" as user builds
            },
            selectFemale() {
                this.form.gender = "F";
                this.isFemale = true;

                if (this.isMale) {
                    this.isMale = false;
                } 
                let self = this;
                setTimeout(function() {
                    self.formStep += 1;
                }, 500);
                // add to "profile" as user builds
            },
            selectCacc() {
                this.form.source = "cacc";
                this.isCacc = true;

                if (this.isCrisp) {
                    this.isCrisp = false;
                }
                if (this.isStray) {
                    this.isStray = false;
                }
                if (this.isAlive) {
                    this.isAlive = false;
                }
                
                let self = this;
                setTimeout(function() {
                    self.formStep += 1;
                }, 500);
                // add to "profile" as user builds
            },
            selectCrisp() {
                this.form.source = "crisp";
                this.isCrisp = true;

                if (this.isStray) {
                    this.isStray = false;
                }
                if (this.isCacc) {
                    this.isCacc = false;
                }
                if (this.isAlive) {
                    this.isAlive = false;
                }

                let self = this;
                setTimeout(function() {
                    self.formStep += 1;
                }, 500);
                // add to "profile" as user builds
            },
            selectStray() {
                this.form.source = "stray";
                this.isStray = true;

                if (this.isCrisp) {
                    this.isCrisp = false;
                }
                if (this.isCacc) {
                    this.isCacc = false;
                }
                if (this.isAlive) {
                    this.isAlive = false;
                }

                let self = this;
                setTimeout(function() {
                    self.formStep += 1;
                }, 500);
                // add to "profile" as user builds
            },
            selectAlive() {
                this.form.source = "alive";
                this.isAlive = true;

                if (this.isCrsip) {
                    this.isCrisp = false;
                }
                if (this.isCacc) {
                    this.isCacc = false;
                }
                if (this.isStray) {
                    this.isStray = false;
                }

                let self = this;
                setTimeout(function() {
                    self.formStep += 1;
                }, 500);
                // add to "profile" as user builds
            },
            
            altered() {
                this.form.fixed = 1;
                this.isAltered = true;

                if (this.isUnaltered) { 
                    this.isUnaltered = false;
                }

                let self = this;
                setTimeout(function() {
                    self.formStep += 1;
                }, 500);
                // add to "profile" as user builds
            },
            unaltered() {
                this.isUnaltered = true;

                if (this.isAltered) {
                    this.isAltered = false;
                }
                let self = this;
                setTimeout(function() {
                    self.formStep += 1;
                }, 500);
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
                e.preventDefault();

                if (window.event.keyCode == 13 ) {
                    return false;
                }

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

            triggerSelectImage() {
                this.$refs.imageInput.click()
            },


            showModal() {
                this.$refs.formIndexModal.show()
            },
            init() {
                console.log("CreateAnimalComponent Mounted")
            },
            deleteImageSelection() {
                this.form.profilePhoto = null;
                this.files = [];
                this.images = [];
            }
        },
        mounted() {
            this.init();
        }
    }
</script>





<style lang="scss" scoped>
    .body {
        height: 90vh;
        width: 90vw;
    }
    .button-selector {
        width: 6rem;
        height: 6rem;
        border-radius: 25px;
        margin: 1rem;
        font-size: 3rem;
    }
    .button-digit {
        width: 4rem;
        height: 4rem;
        border-radius: 25px;
        margin-top: 1rem;
        margin-left: auto;
        margin-right: auto;
        font-size: 1rem;
    }
    .digit-row {
        margin-left: auto;
        margin-right: auto;
        margin-top: 1rem;
    }
    .nav-box {
        text-align: center;
        position: absolute;
        width: 50%;
        left: 25%;
        bottom: 10%;
    }
    .nav-button {
        width: 8rem;
        height: 3rem;
        font-size: 1rem;
        border-radius: 25px;
        margin: 1rem;
        margin-left: auto;
        margin-right: auto;
        background-color: lightgray;
    }
    .input-box {
        width: 12rem;
        margin-left: auto;
        margin-right: auto;
    }
    .upload-button {
        visibility: hidden;
        
        width: 100%;
    }
    .create-animal-box {
        padding: 20px;
        background-color: #2196F3;
        margin-top: 20px;
        padding-top: 20px;
        text-align: center;
        border: 2px solid black;
        box-shadow: 5px 5px;
        height: 90vh;
    }
    .selection-box {
        text-align: center;
    }
    .green {
        color: limegreen;
    }
    .red {
        color: red;
    }
    .grey {
        color: slategrey;
    }
    .progress {
        background-color: black;
        height: 10px;
        transition: width 500ms;
    }
    .form-box {
        height: 300px;
        padding-top: 2rem;
        margin-bottom: 20px;
    }
    .pic-box {
        margin-left: auto;
        margin-right: auto;
        text-align: center;
    }
    .image-wrapper {
        position: relative;
    }
    .upButton {
        color: slategray;
        margin-bottom: 2rem;
    }
    .image-preview {
        width: 200px;
    }

    table {
        margin-left: auto;
        margin-right: auto;
    }
    @media only screen and (max-width: 940px) {
        .nav-box {
            text-align: center;
            color: red;
            position: absolute;
            width: 50%;
            left: 25%;
            bottom: 10%;
        }

        .nav-button {
            width: 4rem;
            height: 3rem;
            font-size: 1rem;
            border-radius: 25px;
            margin: .5rem;
            margin-left: auto;
            margin-right: auto;
            background-color: lightgray;
        }

        .button-digit {
            width: 3rem;
            height: 3rem;
            border-radius: 25px;
            margin-left: auto;
            margin-right: auto;
            font-size: 1rem;
        }
    }
</style>
