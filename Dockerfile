FROM php:8.0-apache

# Mettre à jour les paquets et installer les dépendances
RUN apt update && apt install -y apache2 git
RUN apt update && apt install -y \
    libicu-dev \
    libpq-dev \
    libzip-dev \
    zip \
    zlib1g-dev \
    npm \
    git

# Installer les extensions PHP
RUN docker-php-ext-install \
    intl \
    opcache \
    pdo \
    pdo_pgsql \
    pgsql \
    exif
# Installer l'extension PHP pdo_mysql
RUN docker-php-ext-install pdo_mysql

# Installer les dépendances pour l'extension gd
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev

# Configurer l'extension gd avec les options nécessaires
RUN docker-php-ext-configure gd --with-freetype --with-jpeg

# Installer l'extension PHP gd
RUN docker-php-ext-install gd

# Installer l'extension PHP zip
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
  && docker-php-ext-install zip


# Installer Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Définir le répertoire de travail
RUN git clone https://github.com/redhox/laravel_blog_2.git /var/www/laravel/
WORKDIR /var/www/laravel

# Copier les fichiers de l'application dans le conteneur
COPY . .
COPY apacheconf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite
RUN service apache2 restart
# Installer les dépendances de l'application avec Composer et npm
RUN composer install && composer fund && npm install

# Exécuter la migration de la base de données
#RUN php artisan migrate --force

# Configurer Apache pour servir le répertoire public de Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/laravel/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Définir les permissions pour les répertoires storage et bootstrap/cache
RUN chown -R www-data:www-data /var/www/laravel
RUN find /var/www/laravel -type f -exec chmod 644 {} \;   
RUN find /var/www/laravel -type d -exec chmod 755 {} \;
RUN chown -R $USER:www-data .
RUN find . -type f -exec chmod 664 {} \;
RUN find . -type d -exec chmod 775 {} \;
# Exposer le port 80
EXPOSE 80

