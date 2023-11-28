FROM php:8.2-apache
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Atualize a lista de pacotes e instale o Composer
RUN apt-get update && \
    apt-get install -y --no-install-recommends \
        unzip \
        && rm -rf /var/lib/apt/lists/* \
        && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


# Crie e defina o diretório de trabalho
WORKDIR /var/www/html

# Copie o arquivo composer.json para o diretório de trabalho
COPY composer.json .

# Instale as dependências, incluindo a biblioteca firebase/php-jwt (que suporta JWT)
RUN composer install --no-scripts --no-autoloader

# Copie o restante dos arquivos da aplicação para o diretório de trabalho
COPY . .

# Execute o carregamento automático do Composer
RUN composer dump-autoload --optimize


# Execute o carregamento automático do Composer
RUN composer dump-autoload --optimize

# Enable mod_rewrite
RUN a2enmod rewrite
RUN service apache2 restart