#!/bin/bash

# Duplicate .env.dist to .env
cp ./docker/.env.dist ./docker/.env

# Set environment variables
APP_FOLDER=$(pwd)
sed -i '' "s|APP_FOLDER=.*|APP_FOLDER='$APP_FOLDER'|" ./docker/.env
sed -i '' 's/POSTGRES_DB=.*/POSTGRES_DB=testWikiCamper/' ./docker/.env
sed -i '' 's/POSTGRES_PASSWORD=.*/POSTGRES_PASSWORD=root/' ./docker/.env
sed -i '' 's/POSTGRES_USER=.*/POSTGRES_USER=root/' ./docker/.env

# Start Docker containers
docker-compose --env-file ./docker/.env --profile testWikiCamper up -d

# Execute commands inside PHP container
docker exec php_testWikiCamper bash -c "
cd app &&
composer install &&
cp .env .env.local &&
sed -i '' 's|DATABASE_URL=.*|DATABASE_URL=\"postgresql://root:root@db_testWikiCamper:5432/testWikiCamper?serverVersion=16&charset=utf8\"|' .env.local &&
sed -i '' 's|MAILER_DSN=.*|MAILER_DSN=\"smtp://maildev_docker_testwikicamper:25\"|' .env.local &&
symfony console d:m:m &&
symfony console d:f:l &&
symfony console assets:install &&
symfony console importmap:install &&
symfony console asset-map:compile &&
symfony console messenger:consume async
"

# Update hosts file
echo "127.0.0.1     testwikicamper.local" | sudo tee -a /etc/hosts
