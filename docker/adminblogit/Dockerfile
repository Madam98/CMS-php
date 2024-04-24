# Podstawowy obraz PHP z Apache
FROM php:7-apache

# Instalacja rozszerzenia PDO dla MySQL
RUN docker-php-ext-install pdo_mysql

# Instalacja rozszerzenia MySQLi
RUN docker-php-ext-install mysqli

# Włączenie modułu mod_rewrite
RUN a2enmod rewrite

# Kopiowanie plików do kontenera
COPY ./admin /var/www/html
COPY ./blogit /var/www/html

# Ustawienie odpowiednich uprawnień dla Apache
RUN chown -R www-data:www-data /var/www/html

# Zrestartowanie Apache, aby zastosować zmiany
RUN service apache2 restart