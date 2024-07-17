FROM php:8.3-cli
WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    unzip \
    git \
    libpq-dev \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
  && docker-php-ext-install pdo pgsql pdo_pgsql

COPY composer.json ./

RUN composer install --no-plugins --no-scripts --no-interaction

COPY . .

EXPOSE 8080

CMD ["php", "-S", "0.0.0.0:8080", "-t", "/var/www/html"]