FROM php:8.2-cli

WORKDIR /var/www/html

EXPOSE 8082

CMD ["php", "-S", "0.0.0.0:8082"]
