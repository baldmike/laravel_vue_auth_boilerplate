<template>
  <div class="body">
    <b-row>
        <b-col>
            <b-form @reset="onReset" v-if="show">
                <b-row>
                    <b-col sm="12">
                        <b-btn class="buttonSelector" id="dogChosen" @click="selectDog"><i class="fas fa-dog" style="font-size: 36px;"></i></b-btn>
                        <b-btn class="buttonSelector" id="catChosen" @click="selectCat"><i class="fas fa-cat" style="font-size: 36px;" ></i></b-btn>
                        <b-btn class="buttonSelector" @click="selectMale"><i class="fas fa-male" style="font-size: 36px;" ></i></b-btn>
                        <b-btn class="buttonSelector" @click="selectFemale"><i class="fas fa-female" style="font-size: 36px;" ></i></b-btn>
                        <b-btn class="buttonSelector" @click="selectCacc" style="font-size: 24px;">CACC</b-btn>
                        <b-btn class="buttonSelector" @click="selectCrisp" style="font-size: 24px;">CRISP</b-btn>
                        <b-btn class="buttonSelector" @click="selectStray" style="font-size: 24px;">STRAY</b-btn>
                        <b-btn class="buttonSelector" @click="selectAlive" style="font-size: 24px;">ALIVE</b-btn>

                        <b-btn class="buttonSelector" @click="fixed"><i class="fas fa-check-circle" style="font-size: 36px; color: limegreen;" ></i></b-btn>
                        <b-btn class="buttonSelector" @click="unFixed"><i class="fas fa-exclamation-circle" style="font-size: 36px; color: red;" ></i></b-btn>
                    </b-col>
                    
                    <b-col sm="12" md="4">
                            <b-form-input id="animalName"
                                        class="input-box"
                                        type="text"
                                        v-model="form.name"
                                        required
                                        :state="!$v.form.name.$invalid"
                                        placeholder="What is their name?"/>
                            <b-form-invalid-feedback id="nameLiveFeedback">
                                Red fields are required.
                            </b-form-invalid-feedback>
                    </b-col>
                    <b-col sm="4" md="3">
                            <b-form-select id="gender"
                                    class="input-box" 
                                    :options="gender"
                                    required
                                    v-model="form.gender"
                                    :state="!$v.form.gender.$invalid">
                            </b-form-select>
                    </b-col>                    
                    <b-col sm="3" md="4">
                            <b-form-select id="source"
                                        class="input-box"
                                        :options="sources"
                                        required
                                        v-model="form.source"
                                        :state="!$v.form.source.$invalid">
                            </b-form-select>
                    </b-col>
                    <b-col sm="4">
                        <b-form-radio-group id="fixed" 
                                     
            
                                    v-model="form.fixed" 
                                    :options="fixedOptions" 
                                    name="fixed" 
                                    inline/>
                    </b-col>
                </b-row>
                
                <b-row>
                    
                    <b-col>
                            <b-form-select id="breed"
                                        class="input-box"
                                        :options="breeds"
                                        v-model="form.breed">
                            </b-form-select>
                    </b-col>

                    <b-col>
                            <b-form-input id="microchipNumber"
                                        class="input-box"
                                        type="text"
                                        v-model="form.microchipNumber"
                                        placeholder="What is their microchip number?">
                            </b-form-input>
                    </b-col>
                </b-row>

                <b-row>
                    <b-col>
                            <b-form-input id="birthdate"
                                        class="input-box"
                                        type="date"
                                        v-model="form.birthdate">
                            </b-form-input>
                    </b-col>

                    <b-col>
                            <b-form-input id="weight"
                                    class="input-box"
                                    type="number"
                                    v-model="form.weight">
                            </b-form-input>
                    </b-col>
                </b-row>

                <b-row>
                    <b-col>
                            <b-form-textarea id="description"
                                    class="input-box"
                                    :rows="3"
                                    :max-rows="6"
                                    v-model="form.description"
                                    placeholder="Please give a short description:">
                            </b-form-textarea>
                    </b-col>
                </b-row>
                <b-row>
                    <b-col sm="12" md="4" offset="5" v-if="!images.length">
                        <!-- <label for="profilePhoto">Select a file</label> -->
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

                <b-button class="my-3" variant="dark" :disabled="$v.form.$invalid" @click="createAnimal">Welcome to Alive, {{ form.name }}</b-button>
                <b-button class="my-3" type="reset" variant="danger">Reset</b-button>
            </b-form>
        </b-col>
    </b-row>
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
                species: [
                    { text: 'What Kind of animal?', value: null },
                    'Dog', 'Cat', 'Rabbit'
                ],
                breeds: [
                    { text: "What breed are they?'", value: null },
                    'Pit Bull', 'Chihuahua', 'Terrier', 'Calico', 'Siamese', 'Tabby', 'Rabbit'
                ],
                sources: [
                    { text: 'Where are they from?', value: null },
                    'CACC', 'CRISP', 'Stray', 'Alive'
                ],
                gender: [
                    { text: 'Male or Female?', value: null },
                    'Male', 'Female'
                ],
                fixedOptions: [
                    'Not Fixed', 'Fixed'
                ],
                show: true,
                isDragging: false,
                dragCount: 0,
                files: [],
                image: '',
                images: []
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
                this.form.species = dog;
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
            OnDragEnter(e) {
            e.preventDefault();
            
            this.dragCount++;
            this.isDragging = true;
            return false;
            },
            OnDragLeave(e) {
                e.preventDefault();
                this.dragCount--;
                if (this.dragCount <= 0)
                    this.isDragging = false;
            },
            onInputChange(e) {
                this.form.profilePhoto = e.target.files[0];

                const files = e.target.files;
                
                Array.from(files).forEach(file => this.addImage(file));
            },
            onDrop(e) {
                e.preventDefault();
                e.stopPropagation();
                this.isDragging = false;
                const files = e.dataTransfer.files;
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
            }
        }
    }
</script>










<style lang="scss" scoped>
    .buttonSelector {
        width: 100px;
        border-radius: 25px;
        margin: 10px;
    }
    .body {
        background-color: #2196F3;
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
        width: 50%;
    }
    .selectedButton {
        background-color: white;
    }
    .uploader {
    background: #fff;
    color: #fff;
    padding: 20px;
    text-align: center;
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
</style>
