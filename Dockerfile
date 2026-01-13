FROM php:8.2-apache

# Habilita extensão MySQL
RUN docker-php-ext-install mysqli

# Copia o projeto para o servidor
COPY . /var/www/html/

# Permissões
RUN chown -R www-data:www-data /var/www/html

# Porta usada pelo Render
EXPOSE 80

# Define as variáveis de ambiente no Dockerfile
ENV hostname = b05fb0e20b14b09d19e61bf5e00515c6
ENV DB_NAME=3e533f2998b32f02b29c7ee29b9b4614
ENV DB_PASS=aa8bc69338a39dca5c82c6c166b1606f
ENV DB_USER=1731da55401954a745b414443ea9c3be
