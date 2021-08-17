#Composer Cache Clear
composer dump-autoload
composer clear-cache

# Laravel Cache Clear
php artisan config:cache
php artisan cache:clear
php artisan route:clear
php artisan view:clear
php artisan clear-compiled
