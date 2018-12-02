# laraVueBoilerplate
Boilerplate for integrating a Vue front end into a Laravel back end. This example shows a simple navbar (powered by bootstrap-vue) and routing between three random routes, Home, About and Dashboard. --Web routes use SpaController@index, which just renders the router-view. Vuex (store.js) is fully set up, and accessible globally.

Full Oauth token-based authentication on server (passport) and client (cookies, vuex & vue-router).


Once you clone the repo, run the following commands to install dependencies: vuex (state-mgmt - scaffolded, not used), vue-router (your front end router), bootstrap-vue (Vue-specific version of Bootstrap) and axios (http library):

```
npm install
``` 

And then, to compile and serve the app on localhost:8000, run the following command (which executes: php artisan serve & npm run development with a watch flag)

```
npm run live
``` 

Now, you have 3 Vue single file components, with full Oauth/token-based authentication, compiled by Webpack and served up by Laravel.  Enjoy!
