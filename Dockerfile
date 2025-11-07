# Laravel için PHP + Node ortamı
FROM php:8.2-fpm

# Sistem bağımlılıkları
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libjpeg-dev libfreetype6-dev zip unzip libonig-dev libxml2-dev libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd

# Composer kur
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Çalışma dizini
WORKDIR /var/www

# Proje dosyalarını container’a kopyala
COPY . .

# Composer bağımlılıklarını yükle
RUN composer install --no-scripts --no-autoloader && composer dump-autoload

# Node.js ve npm kurulumu
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Vite build işlemi (isteğe bağlı, ilk build sonrası kapatılabilir)
RUN npm install && npm run build

# Port aç
EXPOSE 8000

# Laravel’i çalıştır
CMD pbash artisan serve --host=0.0.0.0 --port=8000
