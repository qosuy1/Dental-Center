FROM php:8.2-fpm

# تثبيت الحزم المطلوبة
RUN apt-get update && apt-get install -y \
    git curl zip unzip libzip-dev libpng-dev libonig-dev libxml2-dev \
    libicu-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath intl xml zip gd

# تثبيت Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# إعداد مجلد العمل
WORKDIR /var/www

# نسخ الملفات إلى الحاوية
COPY . .

# تثبيت الحزم عبر Composer
RUN composer install --no-dev --optimize-autoloader

# Link storage to public
RUN php artisan storage:link


# إعطاء صلاحيات للمجلدات المطلوبة
RUN chmod -R 775 storage bootstrap/cache
# RUN chown -R www-data:www-data storage bootstrap/cache

# منفذ التطبيق
EXPOSE 8000

# أمر التشغيل
# CMD php artisan serve --host=0.0.0.0 --port=8000
CMD php -S 0.0.0.0:${PORT} -t public


