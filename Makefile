WORKDIR = /var/www/backend

install:
	docker run --rm --workdir="$(WORKDIR)" --volume="$(PWD)"/backend:"$(WORKDIR)" composer:2 install

up:
	docker-compose up -d

cli:
	docker-compose exec backend bash
