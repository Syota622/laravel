# laravel
docker-compose -f docker/compose.yml up
docker-compose -f docker/compose.yml build
docker-compose -f docker/compose.yml build --no-cache
docker-compose -f docker/compose.yml down -v

docker-compose -f docker/compose.yml exec app bash
docker-compose -f docker/compose.yml exec db mysql -u root -pPassw0rd -D laravel

# キャッシュクリア
docker-compose -f docker/compose.yml exec app php artisan route:clear
docker-compose -f docker/compose.yml exec app php artisan config:clear
docker-compose -f docker/compose.yml exec app php artisan cache:clear
docker-compose -f docker/compose.yml exec app php artisan view:clear

# マイグレーション
docker-compose -f docker/compose.yml exec app php artisan migrate
docker-compose -f docker/compose.yml exec app php artisan make:model User -m
docker-compose -f docker/compose.yml exec app php artisan make:controller Auth/RegisterController
