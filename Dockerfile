FROM php:8.3-cli 
WORKDIR /var/www/html

COPY composer.json ./

RUN apt-get update && apt-get install -y \
    unzip \
    git \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-plugins --no-scripts --no-interaction

COPY . .

EXPOSE 8080

USER 1000

CMD ["php", "-S", "0.0.0.0:8080", "-t", "/var/www/html"]

