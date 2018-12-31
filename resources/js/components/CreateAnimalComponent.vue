<template>
    <div class="body">
        <b-col cols="6" offset="3" class="create-animal-box">
            <b-form>
                <b-form-group id="nameGroup" v-if="formStep===1">
                    <h5>Please use the navigation buttons!</h5>
                    <b-form-input id="animalName"
                    onkeypress="return event.keyCode != 13;"
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
                    
                <b-form-group id="sourceGroup" v-if="formStep===4">
                    <div class="sourceBox">
                        <h5>Where is {{ form.name }} from?</h5>
                        <b-btn class="buttonSelector" :class="{ green: isCacc }" @click="selectCacc" style="font-size: 24px;">CACC</b-btn>
                        <b-btn class="buttonSelector" :class="{ green: isCrisp }" @click="selectCrisp" style="font-size: 24px;">CRISP</b-btn>
                        <b-btn class="buttonSelector" :class="{ green: isStray }" @click="selectStray" style="font-size: 24px;">STRAY</b-btn>
                        <b-btn class="buttonSelector" :class="{ green: isAlive }" @click="selectAlive" style="font-size: 24px;">ALIVE</b-btn>
                    </div>
                </b-form-group>

                <b-form-group id="genderGroup" v-if="formStep===5">
                    <div class="genderBox">
                        <h5>Is {{ form.name }} {{ fixed }}?</h5>
                        <table>
                            <tbody>
                                <tr>
                                    <td>
                                        <b-btn class="buttonSelector" :class="{ green: isAltered }" @click="altered"><i class="fas fa-check-circle" style="font-size: 36px;" ></i></b-btn>
                                    </td>
                                    <td>
                                        <b-btn class="buttonSelector" :class="{ red: isUnaltered }" @click="unaltered"><i class="fas fa-exclamation-circle" style="font-size: 36px;" ></i></b-btn>
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
                
                <b-form-group id="nameGroup" v-if="formStep===6">
                    <h5>If {{  form.name }} is chipped, enter {{ pronoun }} chip number:.</h5>
                    <b-form-input id="microchip"
                    class="input-box"
                    type="text"
                    v-model="form.microchipNumber"
                    placeholder="Microchip number"/>                 
                </b-form-group>

                <b-form-group id="birthdateGroup" v-if="formStep===7">
                    <b-col>
                        <b-form-input id="birthdate"
                                    
                                    type="date"
                                    v-model="form.birthdate">
                        </b-form-input>
                        <v-date-picker></v-date-picker>
                    </b-col>
                </b-form-group>

                <b-form-group v-if="formStep===10">
                    <b-row>
                        <b-col sm="12" md="4" md-offset="5" v-if="!images.length">
                            <label for="profilePhoto">Select a file</label>
                            <button @click="upload">Upload</button>
                            <input type="file"
                                    id="profilePhoto"
                                    class="fas fa-cloud-upload-alt"
                                    :name="form.profilePhoto" 
                                    @change="onInputChange" 
                                    enctype="multipart/form-data">
                            <img id="image" ref="image" :src="image">
                        </b-col>
                        <b-col sm="12" md="4" offset="5">
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

                <b-form-group class="navBox">
                    <b-btn class="navButton" @click="previousFormStep" v-if="formStep>1"><i class="fas fa-arrow-left" style="font-size: 44px;"></i></b-btn>
                    <b-btn class="navButton" @click="nextFormStep"><i class="fas fa-arrow-right" style="font-size: 44px;"></i></b-btn>
                </b-form-group>

                <b-form-group class="submitBox" v-if="formStep>7">
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
                }, 700);
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
                }, 700);
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
                }, 700);
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
                }, 700);
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
                }, 700);
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
                }, 700);
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
                }, 700);
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
                }, 700);
                // add to "profile" as user builds
            },
            altered() {
                this.form.fixed = true;
                this.isAltered = true;

                if (this.isUnaltered) { 
                    this.isUnaltered = false;
                }

                let self = this;
                setTimeout(function() {
                    self.formStep += 1;
                }, 700);
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
    
    .input-box {

        width: 100%;
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
    .sourceBox {
        text-align: center;
    }
    .navBox {
        text-align: center;
        padding-bottom: 25px;
    }
    .submitBox {
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

    table {
        margin-left: auto;
        margin-right: auto;
    }
</style>
