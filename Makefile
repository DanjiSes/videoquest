init:
	docker-compose down -v --remove-orphans --rmi all
	docker-compose up --build --remove-orphans -d

up:
	docker-compose up -d

down:
	docker-compose down --rmi all

migrate:
	docker-compose exec phpfpm php artisan migrate

tinker:
	docker-compose exec phpfpm php artisan tinker

sh:
	docker-compose exec phpfpm bash
