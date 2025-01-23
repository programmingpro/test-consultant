#!/bin/bash

# Проверка наличия обязательных переменных окружения
if [ -z "${DB_HOST}" ] || [ -z "${DB_USER}" ] || [ -z "${DB_PASSWORD}" ] || [ -z "${DB_NAME}" ]; then
    echo "Error: Missing required environment variables."
    exit 1
fi

# Указание директории с миграциями
MIGRATIONS_DIR="migrations"

# Применение миграций
for migration_file in $(find $MIGRATIONS_DIR -name "*.sql" | sort); do
    echo "Applying migration: $migration_file"
    PGPASSWORD=${DB_PASSWORD} psql -h ${DB_HOST} -U ${DB_USER} -d ${DB_NAME} -f "$migration_file"
done

echo "All migrations applied successfully."
