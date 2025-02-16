# Use uma imagem base oficial do PHP com o FPM
FROM php:8.1-fpm

# Instalar dependências do sistema e extensões PHP necessárias
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev libzip-dev unzip libpq-dev && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd pdo_mysql zip

# Instalar Composer globalmente
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Definir o diretório de trabalho
WORKDIR /var/www

# Copiar os arquivos do projeto para dentro do contêiner
COPY . .

# Copy the start script
COPY start.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh


# Fazer run para chmod -R 775 storage
RUN chmod -R 775 /var/www/storage
RUN chmod -R 775 /var/www/bootstrap/cache
RUN chown -R www-data:www-data storage

# Definir as permissões adequadas para os arquivos do projeto
RUN chown -R www-data:www-data /var/www && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Expor a porta para o PHP-FPM
EXPOSE 9000

# Configuração de entrada do contêiner
CMD ["php-fpm"]