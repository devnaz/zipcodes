#!/bin/bash

echo -e "\033[42;33;1mCopying configs\e[0m"
cp .env.local .env
cp src/.env.local src/.env
cp docker-compose.yml.local docker-compose.yml

echo -e "\033[42;33;1mDocker assembly\e[0m"
docker-compose down -v --remove-orphans
docker-compose build
docker-compose up -d
sleep 3

echo -e "\033[42;33;1mCreate mongodb user\e[0m"
docker-compose exec mongodb mongo -u root_login -p root_password --eval 'db=db.getSiblingDB("zips");db.createUser({"user":"zips_login","pwd":"zips_password","roles":[{"role":"readWrite","db":"zips"}]})'
docker-compose exec mongodb mongo -u root_login -p root_password --eval 'db=db.getSiblingDB("zips_test");db.createUser({"user":"zips_login_test","pwd":"zips_password_test","roles":[{"role":"readWrite","db":"zips_test"}]})'

echo -e "\033[42;33;1mClearing caches and installing vendor\e[0m"
docker-compose run -u root cli scripts/init.sh

echo -e "\033[42;33;1mAuto configure packages\e[0m"
docker-compose run cli ./artisan package:discover

echo -e "\033[42;33;1mRuns migrations\e[0m"
docker-compose run cli ./artisan migrate

echo -e "\033[42;33;1mRuns tests Unit\e[0m"
docker-compose run cli /bin/bash -c "./vendor/bin/phpunit ./tests/Unit"
echo -e "\033[42;33;1mRuns tests Feature\e[0m"
docker-compose run cli /bin/bash -c "./vendor/bin/phpunit ./tests/Feature"

echo -e "\033[42;33;1mRuns seeding\e[0m"
docker-compose run cli /bin/bash -c "php ./artisan db:seed"
