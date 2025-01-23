# Makefile

# Поднимаем контейнеры в фоновом режиме
docker-up:
	sudo docker compose up -d

# Применяем миграции
migrate:
	sudo docker exec -i php sh -c "sh apply_migrations.sh"

# Устанавливаем зависимости
install-deps:
	sudo docker exec -i php sh -c "composer install"

# Запускаем тесты
test:
	sudo docker exec -i php sh -c "./vendor/bin/phpunit"

# Команда для выполнения всех шагов по порядку
all: docker-up migrate install-deps test