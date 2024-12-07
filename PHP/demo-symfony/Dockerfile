FROM php:8.2-apache

# Install des packages nécessaires pour symfony
RUN apt update && apt install -y curl zip unzip libzip-dev libpng-dev

# Install des extensions php nécessaires pour symfony
RUN docker-php-ext-configure gd \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install mysqli pdo pdo_mysql 

# Install composer dans le container 
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Se placer dans le dossier /var/www/html
WORKDIR /var/www/html/

# COPY du contenu vers le conteneur 
COPY . /var/www/html/

# Activer le module pour la réecriture des liens dans apache
RUN a2enmod rewrite

# Changer le dossier root d'apache vers le dossier public de symfony
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Mettre à jour la configuration de vhost pour pointer vers le document root
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf


# Changer l'user pour docker (sinon c'est root )
USER 1000

# Installer les modules de composer
RUN composer install



# Expose le port 80
EXPOSE 80

# Démarrer apache2
CMD ["apache2-foreground"]



