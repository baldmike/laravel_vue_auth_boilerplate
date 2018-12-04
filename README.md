# laraVueBoilerplate
Boilerplate for integrating a Vue front end into a Laravel back end. This example shows a simple navbar (powered by bootstrap-vue) and routing between three random routes, Home, About and Dashboard. --Web routes use SpaController@index, which just renders the router-view. Vuex (store.js) is fully set up, and accessible globally.

Full Oauth token-based authentication on server (passport) and client (cookies, vuex & vue-router).


Once you clone the repo, run the following commands to install dependencies: vuex (state-mgmt - scaffolded, not used), vue-router (your front end router), bootstrap-vue (Vue-specific version of Bootstrap) and axios (http library):

```
composer install
npm install
php artisan key:generate

``` 

set up your database and update the following lines in .ENV file:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE={ WHATEVER YOU NAMED YOUR SCHEMA }
DB_USERNAME={ YOUR USERNAME }
DB_PASSWORD={ YOUR PASSWORD }
```

run the migrations and seed the DB with dummy data:
```
php artisan migrate
php artisan db:seed
```

install Passport and generate client tokens:
```
php artisan passport:install
```

run the migration to add passport tables: 
```
php artisan migrate
```

in your DB, find oauth_clients table and copy the 'secret' for id=2 (Laravel Password Grant Client) - this was created by passport:install, above.  Then paste the following lines in .ENV file, using that 'secret':

```
PASSPORT_LOGIN_ENDPOINT = 'localhost:8000'
PASSPORT_CLIENT_ID=2
PASSPORT_CLIENT_SECRET={ THE 'SECRET' OF LARAVEL PASSWORD GRANT CLIENT }
```

Now restart literally EVERYTHING in your house, your fridge, the TV, the coffee maker, the cute little speaker that's listening to everything you say so it can sell you stuff and run:

```
npm run live
``` 

grab an email from your db and use the password that is set in the factory to login and adopt your next dog or cat from your local shelter or rescue group, please and thank you.
