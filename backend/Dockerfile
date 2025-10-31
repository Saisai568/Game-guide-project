# backend/Dockerfile
FROM php:8.3-fpm-alpine

# 安裝必要的擴展、依賴，以及修復 usermod 錯誤所需的 'shadow' 包
# 'shadow' 包含 usermod 等用戶管理工具
RUN apk add --no-cache \
    nginx \
    $PHPIZE_DEPS \
    sqlite-dev \
    git \
    curl \
    bash \
    icu-dev \
    libzip-dev \
    zlib-dev \
    libpng-dev \
    freetype-dev \
    libjpeg-turbo-dev \
    shadow  

# 安裝 pdo_sqlite
RUN docker-php-ext-install pdo pdo_sqlite zip

# 安裝 GD 庫（如果需要圖片處理）
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

# 安裝 Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 設定工作目錄
WORKDIR /var/www/html

# 設置權限 (現在 usermod 應該能成功執行了)
RUN usermod -u 1000 www-data

EXPOSE 9000
CMD ["php-fpm"]