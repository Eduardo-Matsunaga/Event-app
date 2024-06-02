# Use a imagem PHP oficial com Apache
FROM php:8.3-apache

# Instale as dependências necessárias
RUN apt-get update && \
    apt-get install -y \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        libzip-dev \
        zip \
        unzip \
        sqlite3 \
        libsqlite3-dev \
        git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_sqlite zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Instale o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Defina o diretório de trabalho
WORKDIR /var/www/html

# Copie o código-fonte do projeto para o contêiner
COPY . .

# Instale as dependências do Composer
RUN composer install --no-dev --optimize-autoloader

# Copie a configuração do Apache
COPY docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf

# Ativar o mod_rewrite do Apache
RUN a2enmod rewrite

# Defina as permissões adequadas para o Laravel
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Exponha a porta 80 do contêiner
EXPOSE 80

# Comando padrão para executar o servidor Apache
CMD ["apache2-foreground"]
