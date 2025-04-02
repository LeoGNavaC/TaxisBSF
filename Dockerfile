# Usar una imagen oficial de PHP con Apache
FROM php:8.2-apache

# Instalar MySQLi y otras extensiones necesarias
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copiar archivos del proyecto al contenedor
COPY . /var/www/html/

# Asignar permisos correctos a los archivos del servidor web
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Exponer el puerto del servidor Apache
EXPOSE 80

# Arrancar Apache en segundo plano
CMD ["apache2-foreground"]
