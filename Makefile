check:
	composer check

csfix:
	composer fix

start:
	docker-compose up

start.daemon:
	docker-compose up -d

stop:
	docker-compose down

restart: stop start.daemon

update:
	composer install