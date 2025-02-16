#!/bin/sh

# Log de início
echo "Iniciando o setup..." > /var/www/startup.log

# Rodar composer install e logar a saída
echo "Executando composer install..." >> /var/www/startup.log
composer install --no-interaction --prefer-dist --optimize-autoloader >> /var/www/startup.log 2>&1

# Rodar as migrations e logar
echo "Executando as migrations..." >> /var/www/startup.log
php artisan migrate >> /var/www/startup.log 2>&1

# Rodar os testes e logar
echo "Executando os testes..." >> /var/www/startup.log
php artisan test >> /var/www/startup.log 2>&1

# Iniciar o PHP-FPM
echo "Iniciando PHP-FPM..." >> /var/www/startup.log
php-fpm