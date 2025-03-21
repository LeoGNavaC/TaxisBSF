# Usar una imagen oficial de PHP con Apache
FROM php:8.2-apache

# Instalar MySQLi y otras extensiones necesarias
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Habilitar las extensiones
RUN docker-php-ext-enable mysqli pdo pdo_mysql

# Copiar archivos del proyecto al contenedor
COPY . /var/www/html/

# Exponer el puerto del servidor Apache
EXPOSE 80
