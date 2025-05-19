FROM php:8.2-fpm

WORKDIR /var/www

# Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user
RUN groupadd -g 1000 www && \
    useradd -u 1000 -ms /bin/bash -g www www

# Copy application files
COPY --chown=www:www . /var/www

# Set working directory permissions
RUN chown -R www:www /var/www

USER www

EXPOSE 9000
CMD ["php-fpm"]
