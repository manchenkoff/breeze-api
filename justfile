#!/usr/bin/env just --justfile

set quiet := true

sail := "./vendor/bin/sail"

# show help
help:
    just --list

# Install Composer dependencies (w/o Sail)
[group('project')]
_composer-install:
    test -d 'vendor' && echo "Vendor directory exists, skip" || docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs

# Build Laravel Sail application image
[group('project')]
build:
    test -f '.env' && echo "Env file exists, skip" || cp .env.example .env
    just _composer-install
    {{sail}} build --no-cache
    just start
    just deps
    just migrate
    just stop

# Start Laravel Sail containers
[group('project')]
start:
    {{sail}} up -d

# Restart Laravel Sail containers
[group('project')]
restart:
    {{sail}} restart

# Stop Laravel Sail containers
[group('project')]
stop:
    {{sail}} down

# Stop Laravel Sail containers and remove volumes
[group('project')]
purge:
    {{sail}} down -v

# Install Composer dependencies
[group('sail')]
deps:
    {{sail}} composer install

# Attach PHP container console
[group('sail')]
shell:
    {{sail}} shell

# Run Laravel scheduler (cron)
[group('sail')]
schedule:
    {{sail}} artisan schedule:work

# Run Laravel worker (queue)
[group('sail')]
queue:
    {{sail}} artisan queue:listen -v --timeout=0

# Run command inside of Laravel Sail PHP container, e.g. [just sail artisan help]
[group('sail')]
sail +command:
    {{sail}} {{command}}

# Optimize Laravel cache
[group('sail')]
cache:
    {{sail}} artisan optimize
    {{sail}} artisan event:cache
    {{sail}} artisan config:cache
    {{sail}} artisan route:cache
    {{sail}} artisan view:cache
    {{sail}} artisan storage:link

# Clear Laravel cache
[group('sail')]
cache-clear:
    {{sail}} artisan cache:clear
    {{sail}} artisan config:clear
    {{sail}} artisan event:clear
    {{sail}} artisan optimize:clear
    {{sail}} artisan route:clear
    {{sail}} artisan view:clear

# Run Laravel Sail application tests
[group('sail')]
test:
    {{sail}} test

# Run database migrations
[group('sql')]
migrate:
    {{sail}} artisan migrate

# Attach SQL container console
[group('sql')]
sql:
    {{sail}} artisan db

# Recreate database from scratch
[group('sql')]
migrate-fresh:
    {{sail}} artisan migrate:fresh

# Seed initial records into database
[group('sql')]
seed:
    {{sail}} artisan migrate:fresh --seed

# Generate Laravel stubs and model comments
[group('tools')]
stubs:
    {{sail}} artisan clear-compiled
    {{sail}} artisan ide-helper:models -W
    just fmt

# Run Code Style formatter
[group('tools')]
fmt:
    {{sail}} composer fmt

# Run static analysis
[group('tools')]
lint:
    {{sail}} composer validate
    {{sail}} composer lint
