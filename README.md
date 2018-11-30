# laraVueBoilerplate
This is a basic boilerplate for integrating a Vue front end into a Laravel back end. This example shows a simple navbar (powered by bootstrap-vue) and routing between three FRONT END ROUTES. There are no WEB ROUTES set up, so the party is over when you refresh. This is a key Vue concept, so these were left out on purpose.

Once you clone the repo, run the following commands to install dependencies: vuex (state-mgmt - scaffolded, not used), vue-router (your front end router), bootstrap-vue (Vue-specific version of Bootstrap) and axios (http library):

```
npm install
``` 

And then, to compile and serve the app on localhost:8000, run the following command (which executes: php artisan serve & npm run development with a watch flag)

```
npm run live
``` 

Now, you have 3 Vue single file components, compiled by Webpack and served up by Laravel.  Enjoy!
