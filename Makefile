DOCKER_COMPOSE = docker-compose
API = $(DOCKER_COMPOSE) exec php
PWA = $(DOCKER_COMPOSE) exec pwa
PHP = $(API) php
CONSOLE = $(PHP) bin/console

start:
	$(DOCKER_COMPOSE) up

start-debug:
	XDEBUG_MODE=debug docker compose up --wait

stop:
	$(DOCKER_COMPOSE) down

bash-api:
	$(API) sh

bash-pwa:
	$(PWA) sh

migration:
	$(CONSOLE) make:migration

migrate:
	$(CONSOLE) doctrine:migrations:migrate

fixtures:
	$(CONSOLE) doctrine:fixtures:load --no-interaction

refactor:
	$(PHP) vendor/bin/rector process

api-schema:
	$(CONSOLE)  api:openapi:export  -o ./api.json
	mv ./api/api.json ./api.json
	npx openapi-typescript api.json --output ./pwa/api-schema/app-api-schema.ts
	rm -f api.json
