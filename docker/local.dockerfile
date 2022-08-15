FROM php:7.4-fpm

# Arguments defined in docker-compose.yml
ARG user
ARG uid

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libmcrypt-dev \
    openssl \
    libcurl4-openssl-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    wget \
    zlib1g-dev \
    libicu-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install \
    mbstring \
    exif \
    pcntl \
    bcmath \
    curl \
    gd \
    json \
    mysqli \
    opcache \
    pdo \
    pdo_mysql

# Install PHP Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install NodeJS
RUN curl -sL https://deb.nodesource.com/setup_14.x -o nodesource_setup.sh
RUN bash nodesource_setup.sh
RUN apt-get install -y nodejs

# Copy existing application directory permissions
COPY . /var/www/html/app

# Set working directory
WORKDIR /var/www/html/app

# Assign permissions of the working directory to the www-data user
RUN chown -R www-data:www-data /var/www/html

# Expose port 80 and start php-fpm server (for FastCGI Process Manager)
EXPOSE 80
CMD ["php-fpm"]
