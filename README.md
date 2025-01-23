сборка докера - sudo docker compose up -d

применяем миграции - docker exec -i php sh -c "sh apply_migrations.sh"

инсталлируем зависимости - docker exec -i php sh -c "composer install"

запускаем тесты - docker exec -i php sh -c "./vendor/bin/phpunit"

