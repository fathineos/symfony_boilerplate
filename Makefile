container:
	docker build -t app .

init: container
	docker-compose run --rm composer install
	docker-compose up -d mysql; sleep 15;
	docker-compose run --rm console doctrine:migrations:migrate

run:
	docker-compose up app

clear_cache:
	docker-compose run --rm console doctrine:cache:clear-metadata
