for-linux-env:
	echo "UID=$$(id -u)" >> .env
	echo "GID=$$(id -g)" >> .env
install:
	@make build
	@make up
	docker compose exec app composer install
	docker compose exec app cp .env.example .env
	docker compose exec app php artisan key:generate
	docker compose exec app php artisan storage:link
	docker compose exec app chmod -R 777 storage bootstrap/cache
	@make fresh
create-project:
	mkdir src
	docker compose build
	docker compose up -d
	docker compose exec app composer create-project --prefer-dist laravel/laravel .
	docker compose exec app php artisan key:generate
	docker compose exec app php artisan storage:link
	docker compose exec app chmod -R 777 storage bootstrap/cache
	@make fresh
build:
	docker compose build
up:
	docker compose up --detach
stop:
	docker compose stop
down:
	docker compose down --remove-orphans
down-v:
	docker compose down --remove-orphans --volumes
restart:
	@make down
	@make up
destroy:
	docker compose down --rmi all --volumes --remove-orphans
remake:
	@make destroy
	@make install
ps:
	docker compose ps
web:
	docker compose exec web bash
app:
	docker compose exec app bash
tinker:
	docker compose exec app php artisan tinker
dump:
	docker compose exec app php artisan dump-server
test:
	docker compose exec app php artisan test
migrate:
	docker compose exec app php artisan migrate
fresh:
	docker compose exec app php artisan migrate:fresh --seed
seed:
	docker compose exec app php artisan db:seed
dacapo:
	docker compose exec app php artisan dacapo
rollback-test:
	docker compose exec app php artisan migrate:fresh
	docker compose exec app php artisan migrate:refresh
optimize:
	docker compose exec app php artisan optimize
optimize-clear:
	docker compose exec app php artisan optimize:clear
cache:
	docker compose exec app composer dump-autoload --optimize
	@make optimize
	docker compose exec app php artisan event:cache
	docker compose exec app php artisan view:cache
cache-clear:
	docker compose exec app composer clear-cache
	@make optimize-clear
	docker compose exec app php artisan event:clear
	docker compose exec app php artisan view:clear
db:
	docker compose exec db bash
sql:
	docker compose exec db bash -c 'mysql -u $$MYSQL_USER -p$$MYSQL_PASSWORD $$MYSQL_DATABASE'
redis:
	docker compose exec redis redis-cli
ide-helper:
	docker compose exec app php artisan clear-compiled
	docker compose exec app php artisan ide-helper:generate
	docker compose exec app php artisan ide-helper:meta
	docker compose exec app php artisan ide-helper:models --write --reset
pint:
	docker compose exec app ./vendor/bin/pint --verbose
pint-test:
	docker compose exec app ./vendor/bin/pint --verbose --test
composer-update:
	docker compose exec app composer update
npm-update:
	docker compose exec app npm update
npm-install:
	docker compose exec app npm install
npm-dev:
	docker compose exec app npm run dev
npm-build:
	docker compose exec app npm run build
npm-watch:
	docker compose exec app npm run dev -- --watch
npm-clean:
	docker compose exec app rm -rf node_modules package-lock.json
	@make npm-install
livewire-publish:
	docker compose exec app php artisan livewire:publish --config
frontend-dev:
	docker compose exec app concurrently "php artisan serve" "npm run dev"
assets-build:
	@make npm-install
	docker compose exec app npm run build
install-full:
	@make install
	@make npm-install
	@make npm-build