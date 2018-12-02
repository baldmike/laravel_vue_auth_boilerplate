<template>
    <div class="container">
        <b-form @submit="login">
            <h3>login</h3>
            <b-form-group id="emailInputGroup"
                        label="Email"
                        label-for="email">
                <b-form-input id="email"
                            type="email"
                            v-model="form.email"
                            :state="!$v.form.email.$invalid"
                            aria-describedby="emailLiveFeedback"
                            placeholder="Enter email" />
                <b-form-invalid-feedback id="emailLiveFeedback">
                    Please enter a valid email address
                </b-form-invalid-feedback>
            </b-form-group>
            <b-form-group id="passwordLoginGroup"
                        label="Password"
                        label-for="password">
                <b-form-input id="password"
                                type="password"
                                :state="!$v.form.password.$invalid"
                                v-model="form.password" />
                <b-form-invalid-feedback id="input2LiveFeedback">
                    Your password must be at least 8 characters
                </b-form-invalid-feedback>
            </b-form-group>
            <b-button type="submit" @click.prevent="login" variant="dark" size="lg" :disabled="$v.form.$invalid">
                Login
            </b-button>
        </b-form>
    </div>
</template>


<script>

import { mapActions, mapGetters } from "vuex";
import { validationMixin } from "vuelidate";
import { required, minLength, email } from "vuelidate/lib/validators";

export default {
    name: "login",
    data() {
      return {
        
        form: {
          email: "",
          password: "",
        }
      }
    },
    mixins: [
      validationMixin
    ],
    validations: {
      form: {
        password: {
          required,
        },
        email: {
          required,
          email
        }
      }
    },
    methods: {
      login() {
        const formData = {
          email: this.form.email,
          password: this.form.password,
        };

        console.log("LOGIN - FORM DATA SET");

        axios.post("/api/login", formData).then(({data}) => {
            
            this.$cookie.set('token', data.token)
            auth.setAuthToken(data.token)

            // let theUser = JSON.parse(window.localStorage.getItem('user'));
            
            console.log("YOU DID IT! " + data.message);

            axios.get("/api/user").then((userData) => {
                console.log('[Login.vue] login() - fetched current user');
                console.log(userData.data.data);


                this.$cookie.set('user', userData.data.data);
                auth.login(data.token, userData.data.data);
                this.$router.push({path: 'dashboard'});
            }).catch((error) => {
                console.log(error);
                this.$store.dispatch('addNotificationMessage', "There was a problem loading your profile. " + error );
            })
        })
        .catch(function (error) {
          
          console.log("[LoginComponent] - api/login call: " + error);
        
        });
        
      },
      register() {
        console.log("[LoginComponent]->register")
      }
    },
    computed: mapGetters(['isAuthenticated']),
}

</script>