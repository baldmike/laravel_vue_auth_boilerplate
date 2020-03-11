# Laravel Vue Auth Boilerplate

## Local Setup (Docker Optional)
```
cd laravel_vue_auth_boilerplate
cp example.env .env
cp docker-compose.yml.example docker-compose.yml
```

Tweak any settings in the docker-compose.yml, like database values.

If using Docker, spin up container (assumes you have docker desktop running):
```
docker-compose build && docker-compose up
```

Run the following commands to install dependencies:

Locally:
```
composer install
```

or using a container:
```
docker run --rm --interactive --tty \
  --volume $PWD:/app \
  composer install
```

Locally:
```
npm install
```

or

from your container:
```
docker-compose exec php npm install
```

Locally:
```
php artisan key:generate
```

or

from your container:
```
docker-compose exec php php artisan key:generate
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

For Docker you should match these values to the variables you use in the MySQL environment variables from your `docker-compose.yml`


run the migrations, seed db with admin, add passport tables (this gives you client (vue) token):
```
docker-compose exec php php artisan migrate
docker-compose exec php php artisan db:seed
docker-compose exec php php artisan passport:install
```

This will generate two keys, copy the 'secret' for id=2 (Laravel Password Grant Client) - this was created by passport:install, above, and is needed for Vue to connect.  Then paste the following lines in `.env` file, using that 'secret':

```
PASSPORT_LOGIN_ENDPOINT = 'localhost:8088'
PASSPORT_CLIENT_ID={ Client ID }
PASSPORT_CLIENT_SECRET={ THE 'SECRET' OF LARAVEL PASSWORD GRANT CLIENT }
```

Kill your docker container and run:

```
docker-compose down
docker-compose up
```
You don't need to use a Docker container to run this - follow the same steps without Docker, and run

```
npm run live
```
The project will be running on `localhost:8088`

Use 'baldmike@example.com' and 'password' to login, you'll be taken to dashboard and adopt your next dog or cat from your local shelter or rescue group, please and thank you.
