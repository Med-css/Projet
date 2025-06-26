FROM php:8.2-apache

ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update && \
    apt-get install -y \
        # Install required packages
        curl \
        ffmpeg \
        ghostscript \
        imagemagick \
        jq \
        libmagickwand-dev \
        libreoffice \
        libreoffice-writer \
        libzip-dev \
        p7zip-full \
        python3 \
        unoconv \
        unzip \
        zip && \
    # YT-DLP installation
    curl -L https://github.com/yt-dlp/yt-dlp/releases/latest/download/yt-dlp -o /usr/local/bin/yt-dlp && \
    chmod a+rx /usr/local/bin/yt-dlp && \
    # Clean up apt cache
    rm -rf /var/lib/apt/lists/* && \
    # Install PHP extensions
    docker-php-ext-install zip && \
    pecl install imagick && \
    docker-php-ext-enable imagick && \
    # Install and enable Apache modules
    a2enmod rewrite && \
    echo "ServerSignature Off\nServerTokens Prod" > /etc/apache2/conf-available/security.conf && \
    a2enconf security && \
    sed -i 's/Options Indexes FollowSymLinks/Options FollowSymLinks/' /etc/apache2/apache2.conf && \
    # Configure Apache
    echo "upload_max_filesize=300M" > /usr/local/etc/php/conf.d/uploads.ini && \
    echo "post_max_size=300M" >> /usr/local/etc/php/conf.d/uploads.ini && \
    echo "memory_limit=512M" >> /usr/local/etc/php/conf.d/uploads.ini && \
    echo "max_execution_time=300" >> /usr/local/etc/php/conf.d/uploads.ini && \
    echo "expose_php = Off" > /usr/local/etc/php/conf.d/custom.ini && \
    echo "display_errors = Off" >> /usr/local/etc/php/conf.d/custom.ini

WORKDIR /var/www/html

EXPOSE 80