# Laravel Vue Auth Boilerplate 

```
cd laravel_vue_auth_boilerplate
cp example.env .env
```

Run the following commands to install dependencies (this assumes both Composer and Node & NPM are installed).

```
composer install
npm install


php artisan key:generate

``` 

set up your database and update the following lines in .env file (this assumes a mysql db):
```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE={ WHATEVER YOU NAMED YOUR SCHEMA }
DB_USERNAME={ YOUR USERNAME }
DB_PASSWORD={ YOUR PASSWORD }
```

Spin up a Docker container
```
docker-compose build && docker-compose up
```

run the migrations, seed db with admin, add passport tables (this gives you client (vue) token): 
```
docker exec -it php php artisan migrate
docker exec -it php php artisan db:seed
docker exec -it php php artisan passport:install
```

This will generate two keys, copy the 'secret' for id=2 (Laravel Password Grant Client) - this was created by passport:install, above, and is needed for Vue to connect.  Then paste the following lines in .ENV file, using that 'secret':

```
PASSPORT_LOGIN_ENDPOINT = 'localhost:8088'
PASSPORT_CLIENT_ID={ Client ID }
PASSPORT_CLIENT_SECRET={ THE 'SECRET' OF LARAVEL PASSWORD GRANT CLIENT }
```

Kill you docker container and run:

```
docker-compose down 
docker-compose up
``` 

Use 'baldmike@example.com' and 'password' to login, you'll be taken to dashboard and adopt your next dog or cat from your local shelter or rescue group, please and thank you.
