<template>
    <div class="body">
        <b-col sm="12" md="6" offset-md="3" class="create-animal-box">
            <b-form>
                <b-form-group id="nameGroup" v-if="formStep===1" class="form-box">
                    <h5 style="margin-bottom: 20px;">Please enter the animal's name:</h5>
                    <b-form-input id="animalName"
                    onkeypress="return event.keyCode != 13;"
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

                <b-form-group id="genderGroup" v-if="formStep===3" class="form-box">
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
                    
                <b-form-group id="sourceGroup" v-if="formStep===4" class="form-box">
                    <div class="selection-box">
                        <h5>Where is {{ form.name }} from?</h5>
                        <b-btn class="button-selector" :class="{ green: isCacc }" @click="selectCacc" style="font-size: 1rem;">CACC</b-btn>
                        <b-btn class="button-selector" :class="{ green: isCrisp }" @click="selectCrisp" style="font-size: 1rem;">CRISP</b-btn>
                        <b-btn class="button-selector" :class="{ green: isStray }" @click="selectStray" style="font-size: 1rem;">STRAY</b-btn>
                        <b-btn class="button-selector" :class="{ green: isAlive }" @click="selectAlive" style="font-size: 1rem;">ALIVE</b-btn>
                    </div>
                </b-form-group>

                <b-form-group id="genderGroup" v-if="formStep===5" class="form-box">
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
                
                <b-form-group id="microchipGroup" v-if="formStep===6" class="form-box">
                    <h5>If {{  form.name }} is chipped, enter {{ pronoun }} chip number:.</h5>
                    <b-form-input id="microchip"
                                onkeypress="return event.keyCode != 13;"
                                class="input-box"
                                type="text"
                                v-model="form.microchipNumber"
                                placeholder="Microchip number"/>                 
                </b-form-group>

                <b-form-group id="birthdateGroup" v-if="formStep===7" class="form-box">
                    <h5>What is {{ form.name }}'s birthday?</h5>
                    <b-form-input id="birthdate"
                                onkeypress="return event.keyCode != 13;"
                                type="date"
                                v-model="form.birthdate"/>
                </b-form-group>

                <b-form-group v-if="formStep===8" class="form-box">
                    <b-row>
                        <b-col sm="12" md="4" md-offset="5" v-if="!images.length">
                            <label for="profilePhoto">Select a file</label>

                            <input type="file"
                                    id="profilePhoto"
                                    :name="form.profilePhoto" 
                                    @change="onInputChange" 
                                    enctype="multipart/form-data">
                            
                        </b-col>
                        <b-col sm="12" md="4" offset-md="4">
                            <div class="images-preview">
                                <div  v-for="(image, index) in images" :key="index">
                                    <img :src="image" alt="uploaded image">
                                    <div class="details">
                                        <span class="name" v-text="files[index].name"></span>
                                        <span class="size" v-text="getFileSize(files[index].size)"></span>
                                    </div>
                                </div>
                            </div>
                        </b-col>
                    </b-row>
                </b-form-group>

                <b-form-group v-if="formStep===9" class="form-box">
                    <h5 style="margin-bottom: 20px;">How much does {{ form.name }} weigh:</h5>
                    <input type="number"
                            id="weight"
                            v-model="form.weight">

                    <b-row class="digit-row">
                        <b-btn class="button-digit" @click="select1" style="font-size: 1rem;">1</b-btn>
                        <b-btn class="button-digit" @click="select2" style="font-size: 1rem;">2</b-btn>
                        <b-btn class="button-digit" @click="select3" style="font-size: 1rem;">3</b-btn>
                    </b-row>

                    <b-row class="digit-row">
                        <b-btn class="button-digit" @click="select4" style="font-size: 1rem;">4</b-btn>
                        <b-btn class="button-digit" @click="select5" style="font-size: 1rem;">5</b-btn>
                        <b-btn class="button-digit" @click="select6" style="font-size: 1rem;">6</b-btn>
                    </b-row>

                    <b-row class="digit-row">
                        <b-btn class="button-digit" @click="select7" style="font-size: 1rem;">7</b-btn>
                        <b-btn class="button-digit" @click="select8" style="font-size: 1rem;">8</b-btn>
                        <b-btn class="button-digit" @click="select9" style="font-size: 1rem;">9</b-btn>
                    </b-row>

                    <b-row class="digit-row">
                        <b-btn class="button-digit" @click="select0" style="font-size: 1rem;">0</b-btn>
                        <b-btn class="button-digit" @click="deleteDigit" style="font-size: 1rem;">C</b-btn>
                    </b-row>
                    
                </b-form-group>

                <b-form-group class="submit-box" v-if="formStep>9">
                    <b-button class="my-3" variant="dark" :disabled="$v.form.$invalid" @click="createAnimal">Welcome to Alive, {{ form.name }}</b-button>
                </b-form-group>

            </b-form>

            <div class="progress">
                <div class="progress"
                style="background-color: white; margin: 0;"
                :style="{width: progress + '%'}"/>
            </div>

            

            <div class="nav-box">
                <b-row>
                    <b-btn class="nav-button" @click="previousFormStep" :disabled="formStep<2"><i class="fas fa-arrow-left"></i></b-btn>
                    <b-btn class="nav-button" @click="nextFormStep"><i class="fas fa-arrow-right"></i></b-btn>
                </b-row>

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
            pronoun() {
                if (this.form.gender === "male") {
                    return "his";
                } else {
                    return "her";
                }
            },
            fixed() {
                if (this.form.gender === "male") {
                    return "neutered"
                } else {
                    return "spayed"
                }
            },
            progress() {
                return this.formStep * 10;
            }
        },
        methods: {
            noenter(e) {
                e = e || window.event;
                var key = e.keyCode || e.charCode;
                //alert('e.type: ' + e.type + '; key: ' + key);
                return key !== 13; 
            },
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
                this.form.gender = "male";
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
                this.form.gender = "female";
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
            select1() {
                this.form.weight += '1';
            },
            select2() {
                this.form.weight += '2';
            },
            select3() {
                this.form.weight += '3';
            },
            select4() {
                this.form.weight += '4';
            },
            select5() {
                this.form.weight += '5';
            },
            select6() {
                this.form.weight += '6';
            },
            select7() {
                this.form.weight += '7';
            },
            select8() {
                this.form.weight += '8';
            },
            select9() {
                this.form.weight += '9';
            },
            select0() {
                this.form.weight += '0';
            },
            deleteDigit() {
                this.form.weight = this.form.weight.slice(0, -1);
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





<style lang="scss" scoped>

        

        .uploader {
        width: 100%;
        background: #2196F3;
        color: #fff;
        padding: 40px 15px;
        text-align: center;
        border-radius: 10px;
        border: 3px dashed #fff;
        font-size: 20px;
        position: relative;

        &.dragging {
            background: #fff;
            color: #2196F3;
            border: 3px dashed #2196F3;

            .file-input label {
                background: #2196F3;
                color: #fff;
            }
        }

        i {
            font-size: 85px;
        }

        .file-input {
            width: 200px;
            margin: auto;
            height: 68px;
            position: relative;

            label,
            input {
                background: #fff;
                color: #2196F3;
                width: 100%;
                position: absolute;
                left: 0;
                top: 0;
                padding: 10px;
                border-radius: 4px;
                margin-top: 7px;
                cursor: pointer;
            }

            input {
                opacity: 0;
                z-index: -2;
            }
        }

        .images-preview {
            display: flex;
            flex-wrap: wrap;
            margin-top: 20px;
            margin-left: auto;

            .img-wrapper {
                width: 160px;
                display: flex;
                flex-direction: column;
                margin: 10px;
                height: 150px;
                justify-content: space-between;
                background: #fff;
                box-shadow: 5px 5px 20px #3e3737;

                img {
                    max-height: 105px;
                }
            }

            .details {
                font-size: 12px;
                background: #fff;
                color: #000;
                display: flex;
                flex-direction: column;
                align-items: self-start;
                padding: 3px 6px;

                .name {
                    overflow: hidden;
                    height: 18px;
                }
            }
        }

        .upload-control {
            position: absolute;
            width: 100%;
            background: #fff;
            top: 0;
            left: 0;
            border-top-left-radius: 7px;
            border-top-right-radius: 7px;
            padding: 10px;
            padding-bottom: 4px;
            text-align: right;

            button, label {
                background: #2196F3;
                border: 2px solid #03A9F4;
                border-radius: 3px;
                color: #fff;
                font-size: 15px;
                cursor: pointer;
            }

            label {
                padding: 2px 5px;
                margin-right: 10px;
            }
        }
    }









    .body {
        height: 100vh;
    }
    .button-selector {
        width: 6rem;
        height: 6rem;
        border-radius: 25px;
        margin: 1rem;
        font-size: 3rem;
    }
    .button-digit {
        width: 3rem;
        height: 3rem;
        border-radius: 25px;
        margin-left: auto;
        margin-right: auto;
        font-size: 1rem;
    }
    .nav-box {
        text-align: center;
        position: absolute;
        width: 50%;
        left: 25%;
        bottom: 0;
    }
    .nav-button {
        width: 6rem;
        height: 3rem;
        font-size: 1rem;
        border-radius: 25px;
        margin: 1rem;
        background-color: lightgray;
    }
    .input-box {
        width: 80%;
        margin-left: auto;
        margin-right: auto;
    }
    .create-animal-box {
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
        background-color: navy;
        height: 10px;
        transition: width 500ms;
        border-right: 2px solid black
    }
    .form-box {
        height: 300px;
    }
    .pic-box {
        margin-left: auto;
        margin-right: auto;
        text-align: center;
    }
    .digit-row {
        margin-left: auto;
        margin-right: auto;
        margin-top: 1rem;
    }

    table {
        margin-left: auto;
        margin-right: auto;
    }

    @media only screen and (max-width: 900px) {
        .nav-box {
            text-align: center;
            color: red;
            position: absolute;
            width: 50%;
            left: 25%;
            bottom: 0;
        }

        .nav-button {
            width: 4rem;
            height: 3rem;
            font-size: 1rem;
            border-radius: 25px;
            margin: .4rem;
            background-color: lightgray;
        }
    }
</style>
