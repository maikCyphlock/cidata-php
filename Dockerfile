FROM php:8.2-apache

# Instalar dependencias necesarias para el envío de correos
RUN apt-get update && apt-get install -y msmtp && rm -rf /var/lib/apt/lists/*

# Habilitar módulos de Apache requeridos por el .htaccess
RUN a2enmod rewrite headers expires deflate

# Configurar PHP para usar msmtp apuntando al contenedor mailpit
RUN echo "sendmail_path = \"/usr/bin/msmtp -t --host=mailpit --port=1025\"" > /usr/local/etc/php/conf.d/mail.ini

# Configurar el directorio de trabajo
WORKDIR /var/www/html

# Ajustar permisos para que Apache pueda leer los archivos
RUN chown -R www-data:www-data /var/www/html
