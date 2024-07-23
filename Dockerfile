FROM php:8.2

RUN apt-get update -y && apt-get install -y openssl curl zip unzip git libpng-dev libonig-dev libxml2-dev zlib1g-dev libpq-dev libzip-dev

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-install pdo

RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql && docker-php-ext-install pdo pdo_pgsql pgsql zip bcmath gd

WORKDIR /app

COPY . /app

RUN composer install

CMD php artisan serve --host=localhost --port=9000

EXPOSE 9000