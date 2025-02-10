FROM php:8.2-fpm

# 必要なパッケージのインストールと拡張モジュール追加
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    git \
    curl \
    libpng-dev \
    && docker-php-ext-install zip pdo_mysql gd

# Composerのインストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 作業ディレクトリの設定
WORKDIR /var/www/html

# 権限設定
RUN chown -R www-data:www-data /var/www/html
