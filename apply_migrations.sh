#!/bin/bash

# Проверка наличия обязательных переменных окружения
if [ -z "${DB_HOST}" ] || [ -z "${DB_USER}" ] || [ -z "${DB_PASSWORD}" ] || [ -z "${DB_NAME}" ]; then
    echo "Error: Missing required environment variables."
    exit 1
fi

# Указание директории с миграциями
MIGRATIONS_DIR="migrations"
SEEDS_DIR="seeds"

# Применение миграций
for migration_file in $(find $MIGRATIONS_DIR -name "*.sql" | sort); do
    echo "Applying migration: $migration_file"
    PGPASSWORD=${DB_PASSWORD} psql -h ${DB_HOST} -U ${DB_USER} -d ${DB_NAME} -f "$migration_file"
done

# Применение seeds (инициализационных данных)
if [ -d "$SEEDS_DIR" ]; then
    for seed_file in $(find $SEEDS_DIR -name "*.sql" | sort); do
        echo "Applying seed: $seed_file"
        PGPASSWORD=${DB_PASSWORD} psql -h ${DB_HOST} -U ${DB_USER} -d ${DB_NAME} -f "$seed_file"
    done
else
    echo "Seeds directory not found, skipping seeds."
fi

echo "All migrations and seeds applied successfully."
