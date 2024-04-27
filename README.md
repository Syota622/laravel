# URL
http://localhost:8000/

# docker-compose コマンド
docker-compose -f docker/compose.yml up
docker-compose -f docker/compose.yml up --build
docker-compose -f docker/compose.yml build
docker-compose -f docker/compose.yml build --no-cache
docker-compose -f docker/compose.yml down -v

# コンテナに入る
docker-compose -f docker/compose.yml exec app bash
docker-compose -f docker/compose.yml exec db mysql -u root -pPassw0rd -D laravel

# キャッシュクリア
docker-compose -f docker/compose.yml exec app php artisan route:clear
docker-compose -f docker/compose.yml exec app php artisan config:clear
docker-compose -f docker/compose.yml exec app php artisan cache:clear
docker-compose -f docker/compose.yml exec app php artisan view:clear

# マイグレーション
docker-compose -f docker/compose.yml exec app php artisan migrate
docker-compose -f docker/compose.yml exec app php artisan make:migration create_posts_table --create=posts
docker-compose -f docker/compose.yml exec app php artisan make:migration create_sqs_messages_table --create=sqs_messages

# コントローラーの生成
docker-compose -f docker/compose.yml exec app php artisan make:controller Auth/RegisterController
docker-compose -f docker/compose.yml exec app php artisan make:controller Auth/LoginController
docker-compose -f docker/compose.yml exec app php artisan make:controller PostController
docker-compose -f docker/compose.yml exec app php artisan make:controller MessageController
docker-compose -f docker/compose.yml exec app php artisan make:controller MessageProcessingController

# モデルの生成
docker-compose -f docker/compose.yml exec app php artisan make:model User -m
docker-compose -f docker/compose.yml exec app php artisan make:model Post
docker-compose -f docker/compose.yml exec app php artisan make:model SqsMessage

# ジョブの生成
docker-compose -f docker/compose.yml exec app php artisan make:job SendToSQS
docker-compose -f docker/compose.yml exec app php artisan make:job ProcessSqsMessage

# composer
docker-compose -f docker/compose.yml exec app composer require aws/aws-sdk-php

# queue
docker-compose -f docker/compose.yml exec app php artisan queue:restart
docker-compose -f docker/compose.yml exec app php artisan queue:work --verbose
docker-compose -f docker/compose.yml exec app php artisan queue:work sqs
docker-compose -f docker/compose.yml exec app php artisan queue:work sqs --verbose
