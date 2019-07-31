#!/bin/bash

echo -e "# Restart demo database."
docker-compose exec mysql mysql -e 'DROP DATABASE IF EXISTS db_soccer_game ; CREATE DATABASE db_soccer_game;'

echo -e "# Create testing data."
docker-compose exec mysql sh -c "mysql db_soccer_game < docker-entrypoint-initdb.d/database.sql"

echo -e "# Run tests."
docker-compose exec php-fpm sh -c "composer test"
