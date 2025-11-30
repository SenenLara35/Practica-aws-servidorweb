FROM php:8.2-apache

# --- AGREGAMOS ESTA LÍNEA ---
# Instalamos la extensión mysqli y la habilitamos
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
# ----------------------------

COPY . /var/www/html/

EXPOSE 80