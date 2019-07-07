# changoZephyr
Vue front end, Laravel back end.  Just like I like 'em... Throw in a little Oauth token-based authentication on server (passport) and client (cookies, vuex & vue-router) and you got yourself a stew.


Run the following commands to install dependencies: vuex, vue-router (front end router), bootstrap-vue (Vue-specific version of Bootstrap) and axios (http library) & Passport (Laravel's Oauth implementation).  key:generate needs to be run only once, after cloning the repo.

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

install Passport and generate client tokens:
```
php artisan passport:install
```

This will generate two keys, copy the 'secret' for id=2 (Laravel Password Grant Client) - this was created by passport:install, above, and is needed for Vue to connect.  Then paste the following lines in .ENV file, using that 'secret':

```
PASSPORT_LOGIN_ENDPOINT = 'localhost:8000'
PASSPORT_CLIENT_ID=2
PASSPORT_CLIENT_SECRET={ THE 'SECRET' OF LARAVEL PASSWORD GRANT CLIENT }
```

run the migrations, seed db with admin, add passport tables (this gives you client (vue) token): 
```
php artisan migrate
php artisan db:seed
```


Now restart literally EVERYTHING in your house, your fridge, the TV, the coffee maker, the cute little speaker that's listening to everything you say so it can sell you stuff and run:

```
npm run live
``` 

Use 'email@example.com' and 'password' to login and adopt your next dog or cat from your local shelter or rescue group, please and thank you.
