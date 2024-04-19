# laravel
docker-compose -f docker/compose.yml up
docker-compose -f docker/compose.yml build
docker-compose -f docker/compose.yml build --no-cache
docker-compose -f docker/compose.yml down -v

docker-compose -f docker/compose.yml exec app bash
docker-compose -f docker/compose.yml exec db mysql -u root -pPassw0rd

# キャッシュクリア
docker-compose -f docker/compose.yml exec app php artisan config:cache
docker-compose -f docker/compose.yml exec app php artisan cache:clear

# マイグレーション
docker-compose -f docker/compose.yml exec app php artisan migrate
