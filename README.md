## Instalation

### Using LAMP

- Go to project folder
- Run composer install (composer install)
- Create a .env from example (cp .env-example .env)
- Setup the .env file with your database credentials
- Generate app key (php artisan key:generate)
- Run migrations and seeders (php artisan:migrate --seed)

### Using Docker

- Go to project folder
- Create a .env from example (cp .env-example .env)
- Setup the .env file with your database credentials
- Setup docker-compose.yml service www with a free port to use the application 
- Run docker compose (docker-compose up -d)
- Go to container shell (docker container exec -it plusdin-api_web_1 sh)
- Generate app key (php artisan key:generate)
- Run migrations and seeders (php artisan:migrate --seed)
