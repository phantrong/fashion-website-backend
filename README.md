## Requirement

Docker (version >=20.10)

## Setup Laravel environment

```bash
cp .env.example .env

cd docker
cp .env.example .env

docker-compose build
docker-compose up -d
docker-compose exec php bash

composer install --ignore-platform-reqs
composer update
php artisan key:generate
php artisan storage:link
php artisan config:clear
php artisan config:cache
php artisan optimize
php artisan migrate
php artisan vietnamzone:import
php artisan db:seed  // for default data
php artisan db:seed FakeSeeder // for fake data
php artisan swagger:write
```
