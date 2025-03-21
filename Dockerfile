# Usar una imagen base de PHP con Apache
FROM php:8.2-apache

# Copiar los archivos de tu proyecto al contenedor
COPY . /var/www/html/

# Dar permisos a los archivos
RUN chown -R www-data:www-data /var/www/html/ \
    && chmod -R 755 /var/www/html/

# Exponer el puerto 80
EXPOSE 80

# Levantar el servidor de Apache
CMD ["apache2-foreground"]