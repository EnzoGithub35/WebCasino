# Utiliser une image PHP officielle
FROM php:8.1-fpm

# Installer les extensions nécessaires
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    git \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Installer Composer
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

# Copier le code de l'application dans le conteneur
COPY . /var/www/html

# Définir le répertoire de travail
WORKDIR /var/www/html

# Installer les dépendances Laravel
RUN composer install --no-dev --optimize-autoloader

# Exposer le port pour le serveur web
EXPOSE 9000

# Lancer le serveur PHP
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=10000"]