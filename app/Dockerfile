# Usamos una imagen oficial que ya trae PHP y Apache (igual que XAMPP)
FROM php:8.2-apache

# Copiamos tus archivos al directorio donde Apache busca la web
# (En XAMPP era 'htdocs', aquí es '/var/www/html')
COPY . /var/www/html/

# Abrimos el puerto 80
EXPOSE 80