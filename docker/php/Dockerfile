FROM php:8.2-fpm

ENV TZ Asia/Tokyo

EXPOSE 5173

RUN apt-get update && \
	apt-get install -y git unzip libzip-dev libicu-dev libonig-dev && \
	docker-php-ext-install intl pdo_mysql zip bcmath && \
  curl -sL https://deb.nodesource.com/setup_18.x | bash - && \
  apt-get install -y nodejs
		
COPY ./docker/php/php.ini /usr/local/etc/php/php.ini

COPY --from=composer:2.5 /usr/bin/composer /usr/bin/composer

WORKDIR /app