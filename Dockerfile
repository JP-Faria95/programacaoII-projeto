FROM php:8.2-apache

# Habilita extensão MySQL
RUN docker-php-ext-install mysqli

# Copia o projeto para o servidor
COPY . /var/www/html/

# Permissões
RUN chown -R www-data:www-data /var/www/html

# Porta usada pelo Render
EXPOSE 80
