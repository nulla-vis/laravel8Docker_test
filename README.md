# laravel8Docker_test
API for users

# Setup Project
+ Unordered sub-list. 

requirements:
+ Already install docker for desktop (https://www.docker.com/get-started/) and the app is running.
+ Already install composer (https://getcomposer.org/).

Project installation:
+ Clone the app.
+ On project root path, run command: `docker-compose build && docker-compose up -d`.
+ Move to src folder, run command : `composer install`.

Project Settings:

+ To check list of cantainers, run cammand: `docker container ls`.

  To Enter mysql cli, run command: `docker exec -it mysql bash `.

+ rename .env.example to .env file

  Inside .env file change database setting to be same as mysql setting inside docker-compose.yml and set the DB_HOST to mysql.

+ To turn off docker, run command `docker-compose down`.

# Laravel command

to run laravel command, use `docker-compose exec php php /var/www/html/artisan <laravel-command>`.
