# Gvary web-reader

## About

Gvary web-reader is a Laravel 10 MPA (Multi Page Application).

## How to run locally

You need to install docker, PHP 8.2, Composer and PHP extensions (TODO: List extensions)

1. Start up temporary MySQL database, Mailpit for emails (use can access UI at localhost::8025)

```shell
docker run -d -p 3306:3306 -e MYSQL_ROOT_PASSWORD=root -e MYSQL_DATABASE=gvary -e MYSQL_USER=gvary-user -e MYSQL_PASSWORD=gvary-pwd mysql:5.7
```

```shell
docker run -d -p 8025:8025 -p 1025:1025 axllent/mailpit
```

2. Run migration for the DB

```shell
php artisan migrate
```

2.1. If you have errors, try
```shell
php artisan config:cache
php artisan config:clear
```

3. Start the MPA

```shell
php artisan serve
```
