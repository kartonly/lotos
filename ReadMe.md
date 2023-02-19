# Апи сайта для отеля с аутентификацией, поиском свободных мест, бронью номеров и доп.услуг, админ-панелью
## Запускаем:
###Для запуска программы вам понадобится приложение Docker Desktop(https://www.docker.com/products/docker-desktop)

1. make
2. make exec-php-fpm
3. php artisan migrate:install
4. php artisan migrate <br>
   ##Наполняем тестовыми данными
1. php artisan db:seed --class=RolesAndPermissionsSeeder
2. php artisan tinker
3. Room::factory()->count(1)->make()
4. Booking::factory()->count(1)->make()
