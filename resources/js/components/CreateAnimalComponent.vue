<template>
  <div>
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
    <b-row>
        <div class="uploader"
            @dragenter="OnDragEnter"
            @dragleave="OnDragLeave"
            @dragover.prevent
            @drop="onDrop"
            :class="{ dragging: isDragging }">
            
            <div class="upload-control" v-show="images.length">
                <label for="file">Select a file</label>
                <button @click="upload">Upload</button>
            </div>


            <div v-show="!images.length">
                <i class="fas fa-cloud-upload-alt"></i>
                <p>Drag your images here</p>
                <div>OR</div>
                <div class="file-input">
                    <label for="file">Select a file</label>
                    <input type="file" id="file" @change="onInputChange" multiple>
                </div>
            </div>

            <div class="images-preview" v-show="images.length">
                <div class="img-wrapper" v-for="(image, index) in images" :key="index">
                    <img :src="image" :alt="`Image Uplaoder ${index}`">
                    <div class="details">
                        <span class="name" v-text="files[index].name"></span>
                        <span class="size" v-text="getFileSize(files[index].size)"></span>
                    </div>
                </div>
            </div>
        </div>
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
                show: true,
                isDragging: false,
                dragCount: 0,
                files: [],
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
                if (!file.type.match('image.*')) {
                    console.log("NOT AN IMAGE");
                    return;
                }
                this.files.push(file);
                const img = new Image(),
                    reader = new FileReader();
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
</style>
