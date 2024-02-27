# Gvary web-reader

- [Gvary web-reader](#gvary-web-reader)
  - [About](#about)
  - [How to install tools](#how-to-install-tools)
    - [Installing PHP 8.3 (Linux)](#installing-php-83-linux)
    - [How to install Composer](#how-to-install-composer)
    - [How to install docker](#how-to-install-docker)
    - [How to install NodeJS](#how-to-install-nodejs)
  - [How to run locally](#how-to-run-locally)
  - [How to authenticate SPA](#how-to-authenticate-spa)
    - [How to make POST request?](#how-to-make-post-request)

## About

Gvary web-reader is a Laravel 10 MPA (Multi Page Application).

## How to install tools

### Installing PHP 8.3 (Linux)

1. Pre-requirements
```shell
sudo apt-get install ca-certificates apt-transport-https software-properties-common
```

2. Add apt repo
```shell
sudo add-apt-repository ppa:ondrej/php
```

3. Install PHP 8.3
```shell
sudo apt install php8.3
```

4. Install PHP extensions (modules)
```shell
sudo apt install php8.3-dom php8.3-mysqli php8.3-mbstring php8.3-curl
```

### How to install Composer

1. Run the script
```shell
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === 'edb40769019ccf227279e3bdd1f5b2e9950eb000c3233ee85148944e555d97be3ea4f40c3c2fe73b22f875385f6a5155') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
```

2. Make executable accessible globally
```shell
sudo mv composer.phar /usr/local/bin/composer
```

### How to install docker

1. Install [docker](https://docs.docker.com/engine/install/ubuntu/)
2. Add current user to [docker group](https://docs.docker.com/engine/install/linux-postinstall/)

### How to install NodeJS

1. Install `nvm` script to manage NodeJS versions
```shell
curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.7/install.sh | bash
```

2. Install LTS Iron version 
```shell
nvm install lts/iron
```

3. Before using node or npm
```shell
nvm use lts/iron
```

## How to run locally

Make sure you have 

```text
Docker version 25.0.3, build 4debf41
PHP 8.3.3-1+ubuntu22.04.1+deb.sury.org+1 (cli) (built: Feb 15 2024 18:38:52) (NTS)
Composer version 2.7.1 2024-02-09 15:26:28
nvm 0.39.7
```

and the next PHP extensions(modules)

<details>
  <summary>PHP extensions</summary>
  
  You can see your currently installed extensions using
  ```shell
php -m
  ```
  
  My extensions look like so. Install them
  ```text
[PHP Modules]
calendar
Core
ctype
curl
date
dom
exif
FFI
fileinfo
filter
ftp
gettext
hash
iconv
json
libxml
mbstring
mysqli
mysqlnd
openssl
pcntl
pcre
PDO
pdo_mysql
Phar
posix
random
readline
Reflection
session
shmop
SimpleXML
sockets
sodium
SPL
standard
sysvmsg
sysvsem
sysvshm
tokenizer
xml
xmlreader
xmlwriter
xsl
Zend OPcache
zlib

[Zend Modules]
Zend OPcache
  ```
  
</details>

1. Start up temporary MySQL database

```shell
docker run -d -p 3306:3306 -e MYSQL_ROOT_PASSWORD=root -e MYSQL_DATABASE=gvary -e MYSQL_USER=gvary-user -e MYSQL_PASSWORD=gvary-pwd mysql:8.3
```

2. Start up temporary Mailpit for emails (you can access UI at localhost::8025)
```shell
docker run -d -p 8025:8025 -p 1025:1025 axllent/mailpit
```

3. Run migration for the DB

```shell
php artisan migrate
```

3.1. If you have errors, try

```shell
php artisan config:cache
php artisan config:clear
php artisan cache:clear
```

4. Select LTS Iron by running:

```shell
nvm use lts/iron
```

4. Build static assets

```shell
npm run build
```

4.1. Start vite server for hot reload

```shell
npm run dev
```

5. Start the MPA

```shell
php artisan serve
```

## How to authenticate SPA

There is a good [official documentation](https://laravel.com/docs/10.x/sanctum#spa-authentication) that describes the theory. In this section we will take a look a the practice.

1. Login to the MPA (path `127.0.0.1/login`)
2. Get `laravel_session` cookies using dev tools
3. Execute the next curl

> Fill in value for `laravel_session` cookie. 
> `Accept`, `Content-Type` and `Origin` headers are mandatory!

```shell
curl -v \
-H "Accept: application/json" \
-H "Content-Type: application/json" \
-H "Origin: http://localhost:3000" \
-b "laravel_session=" \
-b ./cookie.txt -c ./cookie.txt \
127.0.0.1:8000/api/user
```

<details>
  <summary>curl example</summary>

```shell
curl -v \
-H "Accept: application/json" \
-H "Content-Type: application/json" \
-H "Origin: http://localhost:3000" \
-b "laravel_session=eyJpdiI6IlhSd3luWmsyaUpZUU1vSVR0QzdtRmc9PSIsInZhbHVlIjoiWDFOVVpHcmtVN1FvckcwNzRRb3BNL1QvaHZEL0dRaWErNnJjUWRHbmM2R0hiQUtvZ0EyblI3bjkyTDhHTngwMUZpaElsMjJCQmJCeGNFV3JLUUdpZDc2MWtROVlxcFA4MHl3QlpPdHBSbDVGWXc0cm1WNHVrd09oS0hvdXpjbmMiLCJtYWMiOiJiZjRhYjc5MzkzODBhMDJkYzU1YzdlMzIwN2I1MWM5YTUzNWY2ZmMzOWYwMWI4NTU3MDgyYmY1NmE2ZWY4YWRhIiwidGFnIjoiIn0%3D" \
127.0.0.1:8000/api/user
```
</details>

4. You should receive 200 - OK with response such as

```json
{"user_id":2,"login":"olen","email":"olen@olen.com","email_verified_at":null,"created_at":"2024-02-27T07:26:39.000000Z","updated_at":"2024-02-27T07:26:39.000000Z","pen_name":"olen","first_name":"olen","last_name":"olen"}
```

5. Now your session cookie is saved to `cookie.txt` file so you can make requests without `-b` flag. E.g:

```shell
curl -v \
-H "Accept: application/json" \
-H "Content-Type: application/json" \
-H "Origin: http://localhost:3000" \
-b ./cookie.txt -c ./cookie.txt \
127.0.0.1:8000/api/user
```

### How to make POST request?

You should add `X-XSRF-TOKEN` header to your request. Copy value of `XSRF-TOKEN` cookie from your `cookie.txt`.

> Note: Do NOT copy last three symbols `%3D`!

Example:

```shell
curl \
-H "Accept: application/json" \
-H "Content-Type: application/json" \
-H "Origin: http://localhost:3000" \
-b ./cookie.txt -c ./cookie.txt \
-H "X-XSRF-TOKEN: eyJpdiI6IkV0Z1FTMnpKNFVKbWgzVHdJRGlRS1E9PSIsInZhbHVlIjoiRWZnSk5rZk9VN0xBZGxTNVduSVFWMFdxdmpGK3N0d1VWcks4bmVDSVR2YlhLQ1E2a0JNVlhsYTd6RjRaUm5uMTRGMHFUejRiL0QwWHJZZytCSXRESFRJS1JFVzE4UFJsVVRmV2dBNTQ1a3BTZjAzSWkxN0U5S2dNMGc1TWtka2MiLCJtYWMiOiIwOTA2ZDQyMjZjNmJkODMwODQ5MzE1NDhlZDE4YmU4N2VlY2I3MDkyNTkyNzcwZjczYWQwYzU2ZWY3Mzc0Yjc3IiwidGFnIjoiIn0" \
-X POST \
-d '{"title": "chapter one", "cover_id": 4}' \
127.0.0.1:8000/api/chapters
```

