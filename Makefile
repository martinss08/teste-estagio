build:
	docker compose up -d
	docker compose exec app chmod -R 777 storage bootstrap/cache
	docker compose exec app composer install	
	cp .env.example .env
	docker compose exec app php artisan key:generate
	docker compose exec app php artisan migrate --seed

up:
	docker compose up -d

down:
	docker compose down

test:
	docker compose exec app php artisan test

.PHONY: build up down test