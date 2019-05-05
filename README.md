Project Installation
===================

Build containers
----------------
docker-compose up -d --build

Install dependencies
--------------------
docker exec -itu www-data:www-data cebep_php_1 composer install

Install node modules
--------------------
docker exec -itu www-data:www-data cebep_php_1 yarn install

Generate assets
---------------
docker exec -itu www-data:www-data cebep_php_1  yarn run encore dev



Other
=====

PHP bash
--------
docker exec -itu www-data:www-data cebep_php_1 /bin/bash

Update schema
-------------
docker exec -itu www-data:www-data cebep_php_1 bin/console doctrine:schema:update --force

Load fixtures
-------------
docker exec -itu www-data:www-data cebep_php_1 bin/console doctrine:fixtures:load