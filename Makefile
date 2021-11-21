### Команды для запуска приложения
app-start-dev: app-build app-up

app-build: # собираем проект
	docker-compose build
app-up: # поднимаем с колен
	docker-compose up -d
app-up-no-d: # поднимаем с колен не в фоне
	docker-compose up
app-stop: # останавливаем эту машину
	docker-compose stop
app-down: # удаляем контейнеры
	docker-compose down

### Команды для работы с контейнерами приложения
exec-nginx: # заходим в контейнер с nginx
	docker-compose exec hh-nginx bash
exec-php-fpm: # заходим в контейнер с php
	docker-compose exec hh-php-fpm bash
exec-percona: # заходим в контейнер с percona
	docker-compose exec hh-percona bash

