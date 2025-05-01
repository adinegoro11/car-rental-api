FROM php:8.3-fpm

# Accept build args for user
ARG user
ARG uid

# Set working directory
WORKDIR /var/www

# Install system dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \  
    libzip-dev \ 
    pkg-config \  
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
 && apt-get clean \
 && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
 && docker-php-ext-install gd

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin --filename=composer

# Create user for Laravel
RUN groupadd -g ${uid} ${user} && \
    useradd -u ${uid} -ms /bin/bash -g ${user} ${user}

# Copy application files and set ownership
COPY --chown=${user}:${user} . /var/www

# Ensure Laravel write permissions
RUN chmod -R 775 storage bootstrap/cache || true

# Switch to app user
USER ${user}

EXPOSE 9000
CMD ["php-fpm"]
