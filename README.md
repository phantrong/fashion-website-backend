## Requirement
Docker (version >=20.10)

## Setup Laravel environment
```bash
cp .env.example .env
cd docker
cp .env.example .env

docker compose up -d
docker compose exec php bash
composer install
php artisan key:generate
```
