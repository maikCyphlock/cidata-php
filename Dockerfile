FROM php:8.2-apache

# Instalar dependencias
RUN apt-get update && apt-get install -y msmtp && rm -rf /var/lib/apt/lists/* \
 && docker-php-ext-install pdo pdo_mysql

# Habilitar módulos de Apache
RUN a2enmod rewrite headers expires deflate

# Configurar PHP para usar msmtp apuntando al contenedor mailpit
RUN echo "sendmail_path = \"/usr/bin/msmtp -t --host=mailpit --port=1025\"" > /usr/local/etc/php/conf.d/mail.ini

# Simular estructura cPanel: el proyecto vive en /home/cidata/
# public_html/ es la raíz web; archivos privados quedan fuera
ENV CPANEL_HOME=/home/cidata

# Configurar VirtualHost apuntando a public_html con permisos correctos
RUN echo '<VirtualHost *:80>\n\
    DocumentRoot /home/cidata/public_html\n\
    <Directory /home/cidata/public_html>\n\
        Options Indexes FollowSymLinks\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

WORKDIR /home/cidata/public_html
