Project Installation
===================

Build containers
----------------
docker-compose up -d --build

Install dependencies
--------------------
docker exec -itu www-data:www-data cebep_php_1 composer install


Other
=====

PHP bash
--------
docker exec -itu www-data:www-data cebep_php_1 /bin/bash
