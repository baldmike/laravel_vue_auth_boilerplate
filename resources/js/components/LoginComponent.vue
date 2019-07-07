<template>
    <div class="container-fluid">
      <b-col cols="4">
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
      </b-col>
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
		
		// this is out of scope in catch -- set this to self
		let self=this;

        axios.post("/api/login", formData).then(({data}) => {

            this.$cookie.set('token', data.token)
            this.$cookie.set('user', data.user.email)
            auth.setAuthToken(data.token)
            auth.login(data.token, data.user.email);
    
			this.$router.push({path: 'dashboard'});
			
			self.$notify({
				group: 'notifications',
				type: 'success',
				title: 'Success!',
				text: 'You are now logged in',
				duration: '15000',
				width: '100%'
			});
        })
        .catch(function (error) {

			self.$notify({
				group: 'notifications',
				type: 'error',
				title: error,
				text: 'INVALID CREDENTIALS - PLEASE TRY AGAIN.',
				duration: '15000',
				width: '100%'
			});
        });
        
      },
      register() {
        console.log("[LoginComponent]->register")
      }
    },
    computed: mapGetters(['isAuthenticated']),
    mounted() {
		
    }
}

</script>