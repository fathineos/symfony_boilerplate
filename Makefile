container:
	docker build -t app .

init:
	docker-compose run --rm composer install
	docker-compose run --rm console doctrine:database:create
	docker-compose run --rm console doctrine:migrations:migrate

run:
	docker-compose up --force-recreate app

clear_cache:
	docker-compose run --rm console doctrine:cache:clear-metadata
