include .env

default: up

conf = -f docker-compose.yml
UNAME_S := $(shell uname -s)

ifeq ($(UNAME_S),Darwin)
	conf := $(conf) -f docker-compose.override.mac.yml
endif

ifeq ($(TRAEFIK),ON)
	conf := $(conf) -f docker-compose.override.traefik.yml
endif

ifeq ($(XDEBUG),ON)
	conf := $(conf) -f docker-compose.override.xdebug.yml
endif

ifneq ("$(wildcard docker-compose.override.yml)","")
    conf := $(conf) -f docker-compose.override.yml
endif

COMPOSER_ROOT ?= /var/www/html
DRUPAL_ROOT ?= /var/www/html/web

## help	:	Print commands help.
.PHONY: help
ifneq (,$(wildcard docker.mk))
help : docker.mk
	@sed -n 's/^##//p' $<
else
help : Makefile
	@sed -n 's/^##//p' $<
endif

## up	:	Start up containers.
.PHONY: up
up:
	@echo "Starting up containers for $(PROJECT_NAME)..."
	docker-compose pull
	docker-compose $(conf) up -d --remove-orphans

.PHONY: mutagen
mutagen:
	docker-compose up -d mutagen
	mutagen project start -f mutagen/config.yml

## down	:	Stop containers.
.PHONY: down
down: stop

## start	:	Start containers without updating.
.PHONY: start
start:
	@echo "Starting containers for $(PROJECT_NAME) from where you left off..."
	@docker-compose $(conf) start

## stop	:	Stop containers.
.PHONY: stop
stop:
	@echo "Stopping containers for $(PROJECT_NAME)..."
	@docker-compose $(conf) stop

## prune	:	Remove containers and their volumes.
##		You can optionally pass an argument with the service name to prune single container
##		prune mariadb	: Prune `mariadb` container and remove its volumes.
##		prune mariadb solr	: Prune `mariadb` and `solr` containers and remove their volumes.
.PHONY: prune
prune:
	@echo "Removing containers for $(PROJECT_NAME)..."
	@docker-compose $(conf) down -v $(filter-out $@,$(MAKECMDGOALS))

## ps	:	List running containers.
.PHONY: ps
ps:
	@docker ps --filter name='$(PROJECT_NAME)*'

## shell	:	Access `php` container via shell.
##		You can optionally pass an argument with a service name to open a shell on the specified container
.PHONY: shell
shell:
	docker exec -ti -e COLUMNS=$(shell tput cols) -e LINES=$(shell tput lines) $(shell docker ps --filter name='$(PROJECT_NAME)_$(or $(filter-out $@,$(MAKECMDGOALS)), 'php')' --format "{{ .ID }}") sh

## composer	:	Executes `composer` command in a specified `COMPOSER_ROOT` directory (default is `/var/www/html`).
##		To use "--flag" arguments include them in quotation marks.
##		For example: make composer "update drupal/core --with-dependencies"
.PHONY: composer
composer:
	docker exec $(shell docker ps --filter name='^/$(PROJECT_NAME)_php' --format "{{ .ID }}") composer --working-dir=$(COMPOSER_ROOT) $(filter-out $@,$(MAKECMDGOALS))

## drush	:	Executes `drush` command in a specified `DRUPAL_ROOT` directory (default is `/var/www/html/web`).
##		To use "--flag" arguments include them in quotation marks.
##		For example: make drush "watchdog:show --type=cron"
.PHONY: drush
drush:
	docker exec $(shell docker ps --filter name='^/$(PROJECT_NAME)_php' --format "{{ .ID }}") drush -r $(DRUPAL_ROOT) $(filter-out $@,$(MAKECMDGOALS))

## logs	:	View containers logs.
##		You can optinally pass an argument with the service name to limit logs
##		logs php	: View `php` container logs.
##		logs nginx php	: View `nginx` and `php` containers logs.
.PHONY: logs
logs:
	@docker-compose logs -f $(filter-out $@,$(MAKECMDGOALS))

## setup: Setup Docker .env settings file.
.PHONY: setup
setup:
	@cp `pwd`/.env.dist `pwd`/.env

## analyze:	Analyze code project.
##		You can analyze code with custom docker container that use phpqa.
.PHONY: analyze
analyze:
	docker run -it -u $$(id -u) --rm -v "`pwd`/../":/user/app -w /user/app lucacracco/phpqa:3.1 phpqa --config=phpqa

## theme-shell:	Run and access node container via shell.
.PHONY: theme-shell
theme-shell:
	docker run -it -u node --rm -v "`pwd`/../web/themes/custom/$(PROJECT_THEME)":/user/app -w /user/app node:10 bash

## theme_start_dev:	Build assets and scripts for development
.PHONY: theme-dev
theme_dev:
	docker run -it -u node --rm -v `pwd`/../web/themes:/user/app -w /user/app -e NODE_ENV=development node:10 /bin/bash -c "cd custom/$(PROJECT_THEME); yarn install; yarn build:dev"

## theme_start_dev: Build assets and scripts for development and continue to monitoring.
theme_watch_dev:
	docker run -it -u node --rm -v `pwd`/../web/themes:/user/app -w /user/app -p 3000:3000 -p 3001:3001 -e NODE_ENV=development node:10 /bin/bash -c "cd custom/$(PROJECT_THEME); yarn install; yarn start:dev"

## theme-watch:	Build assets and scripts for development and continue to monitoring.
.PHONY: theme-watch
theme_watch:
	docker run -it -u node --rm -v "`pwd`/../web/themes":/user/app -w /user/app node:10 /bin/bash -c "cd custom/$(PROJECT_THEME); yarn install; yarn start"

## theme:	Build assets and scripts for production.
.PHONY: theme
theme:
	docker run -it -u node --rm -v "`pwd`/../web/themes":/user/app -w /user/app node:10 /bin/bash -c "cd custom/$(PROJECT_THEME); yarn install; yarn build"

# https://stackoverflow.com/a/6273809/1826109
%:
	@:
