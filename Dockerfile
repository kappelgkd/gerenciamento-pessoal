FROM php:8.2-apache
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Install Composer
# Install Composer
RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer
#RUN composer install

# Enable mod_rewrite
RUN a2enmod rewrite
RUN service apache2 restart