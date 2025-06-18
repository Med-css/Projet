FROM php:8.2-cli

RUN apt-get update && \
    apt-get install -y \
        ffmpeg \
        ghostscript \
        imagemagick \
        libmagickwand-dev \
        libzip-dev \
        p7zip-full \
        unoconv \
        unzip \
        zip && \
    rm -rf /var/lib/apt/lists/* && \
    docker-php-ext-install zip && \
    pecl install imagick && \
    docker-php-ext-enable imagick && \
    echo "upload_max_filesize=300M" > /usr/local/etc/php/conf.d/uploads.ini && \
    echo "post_max_size=300M" >> /usr/local/etc/php/conf.d/uploads.ini && \
    echo "memory_limit=512M" >> /usr/local/etc/php/conf.d/uploads.ini && \
    echo "max_execution_time=300" >> /usr/local/etc/php/conf.d/uploads.ini


WORKDIR /var/www/html

EXPOSE 8082

CMD ["php", "-S", "0.0.0.0:8082"]
