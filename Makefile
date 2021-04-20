#!/bin/bash
include .env
SHELL := /bin/bash # Use bash syntax

export TZ=${APP_TIMEZONE}

export

.PHONY: help
.DEFAULT_GOAL := up

##@ Docker
up: ## Start all project containers
	@echo -e "\n~~> Starting up containers for ${PROJECT_NAME}..."
	@docker-compose up -d
	@echo -e "~> Access Application through url: http://localhost:${DOCKER_APP_PORT}"

watch: ## Start frontend hot reload
	@echo -e "\n~~> Compiling frontend and hot reload ${PROJECT_NAME}..."
	@npm run dev && npm run hot

stop: ## Stop all project containers
	@echo -e "\n~~> Stoping all containers for ${PROJECT_NAME}..."
	@docker-compose stop
	@docker-compose rm -f
	@echo -e "done!\n"

in: ## Enter in backend app container
	@docker exec -it "${PROJECT_NAME}-app" bash

in-db: ## Enter in app container
	@docker exec -it "${PROJECT_NAME}-db" bash

ps: ## List the project containers
	@docker-compose ps

##@ Composer

install: ## Composer install dependencies
	@echo -e "~~> Installing composer dependencies..."
	@docker exec -it "${PROJECT_NAME}-app" composer install -o
	@echo -e "done!\n"

require: ## Run the composer require. (e.g make require PACKAGE="vendor/package")
	@echo -e "~~> Installing ${PACKAGE} Composer package..."
	@docker exec -it "${PROJECT_NAME}-app" composer require -o "${PACKAGE}"
	@echo -e "done!\n"

require-dev: ## Run the composer require with dev dependency flag. (e.g make require-dev PACKAGE="vendor/package")
	@echo -e "~~> Installing ${PACKAGE} Composer Development package..."
	@docker exec -it "${PROJECT_NAME}-app" composer require --dev -o "${PACKAGE}"
	@echo -e "done!\n"

update: ## Run the composer update. (e.g make update)
	@echo -e "~~> Updating Composer packages..."
	@docker exec -it "${PROJECT_NAME}-app" composer update -o
	@echo -e "done!\n"

dump: ## Run the composer dump
	@docker exec -it "${PROJECT_NAME}-app" composer dump-autoload -o

##@ Quality Tools
cs: ## Run Code Sniffer Tool
	@echo -e "~~> Running PHP Code Sniffer Tool..."
	@docker exec -it "${PROJECT_NAME}-app" composer run code-sniffer
	@echo -e "done!\n"

fixer: ## Run PHP Code Fixer Tool
	@echo -e "~~> Running PHP Code Fixer Tool..."
	@docker exec -it "${PROJECT_NAME}-app" composer run code-fixer
	@echo -e "done!\n"

##@ Laravel and Application

migrate: ## Run all the yii migrations
	@echo -e "\n~~> Running app migrations..."
	@docker exec -it "${PROJECT_NAME}-app" php artisan migrate
	@echo -e "done!\n"

migrate-create: ## Run all the create tool (e.g make migrate-create NAME="migrateName")
	@docker exec -it "${PROJECT_NAME}-app" php artisan make:migration "${NAME}" --create=tasks

migrate-down: ## Run all the migrate/down
	@docker exec -it "${PROJECT_NAME}-app" ./yii migrate/down

model: ## Create a laravel model (e.g make model TABLE=users MODEL=User)
	@docker exec -it "${PROJECT_NAME}-app" php artisan make:model "${MODEL}"

key: ## Generates a app key
	@docker exec -it "${PROJECT_NAME}-app" php artisan key:generate

##@ PHP Unit - Tests

test: ## Run the all suite test
	@docker exec -it "${PROJECT_NAME}-app" composer run test

test-unit: ## Run the application unit tests only
	@docker exec -it "${PROJECT_NAME}-app" composer run test-unit

test-filter: ## Run a single test by method name (e.g make test-single NAME=testYourTestName)
	@docker exec -it "${PROJECT_NAME}-app" composer run test-filter "${NAME}"

test-coverage: ## Run the all suite test and generate the Code Coverage
	@docker exec -it "${PROJECT_NAME}-app" composer run coverage

##@ Database

db-backup: ## Backup database
	@docker exec "${PROJECT_NAME}-db" /usr/bin/mysqldump -u "${DB_USERNAME}" -p"${DB_PASSWORD}" "${DB_DATABASE}" > database/dump.sql

db-restore: ## Restore database
	@cat database/dump.sql | docker exec -i "${PROJECT_NAME}-db" /usr/bin/mysql -u "${DB_USERNAME}" -p"${DB_PASSWORD}" "${DB_DATABASE}"

help:  ## Display this help
	@awk 'BEGIN {FS = ":.*##"; printf "\nUsage:\n  make \033[36m<target>\033[0m\n"} /^[a-zA-Z_-]+:.*?##/ { printf "  \033[36m%-15s\033[0m %s\n", $$1, $$2 } /^##@/ { printf "\n\033[1m%s\033[0m\n", substr($$0, 5) } ' $(MAKEFILE_LIST)
