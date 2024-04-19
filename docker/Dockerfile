# PHP stage
FROM php:8.2-fpm AS php_stage

# 環境変数 PATH に php-fpm のパスを明示的に追加
ENV PATH="/usr/local/sbin:${PATH}"

# Install dependencies
RUN apt-get update && apt-get install -y \
  git \
  zip \
  unzip \
  libpng-dev \
  libonig-dev \
  libxml2-dev \
  libzip-dev

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /app

# Nginx stage
FROM nginx:latest AS nginx_stage

# Copy Nginx config
COPY default.conf /etc/nginx/conf.d/default.conf

# Set working directory
WORKDIR /app
