FROM php:8.2-apache

# Instala dependências necessárias do PostgreSQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Copia arquivos da aplicação
COPY . /var/www/html/

EXPOSE 80
