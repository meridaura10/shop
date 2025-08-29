# Shop Laravel Project

## Підготовка середовища

### 1. Налаштування NGINX
- Додайте конфігурацію для вашого проекту в NGINX.

### 2. Додати запис у hosts
```bash
sudo nano /etc/hosts
```
Додайте рядок з вашим локальним або ngrok-доменом.

### 3. Перезапуск NGINX
```bash
docker compose restart nginx
```

### 4. Зайти в контейнер workspace
```bash
dcexec
```

### 5. Перейти до проекту для mac
```bash
cd /Users/admin/Work/laravel/shop2
```

### 6. Встановити залежності
```bash
composer install
```

### 7. Додати файл `.env`
Створіть `.env` на основі `.env.example` та додайте налаштування:

```dotenv
APP_NAME=Shop
APP_ENV=local
APP_KEY=base64:oboZOqiiuU8bYv6YwzUh+8+VT1akJsSamqI0FKO5CPE=
APP_DEBUG=true
APP_URL=https://thankful-just-termite.ngrok-free.app

APP_LOCALE=uk
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

APP_MAINTENANCE_DRIVER=file
APP_MAINTENANCE_STORE=database
PHP_CLI_SERVER_WORKERS=4

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=shop
DB_USERNAME=root
DB_PASSWORD=root

SESSION_DRIVER=file
SESSION_LIFETIME=11120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database

CACHE_STORE=file
CACHE_PREFIX=
MEMCACHED_HOST=127.0.0.1

REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_SCHEME=null
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=6bf63160efcf15
MAIL_PASSWORD=5a3b223e6e1ddc
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

TURBOSMS_API_TOKEN=a2fc51b8f39f90c9217a1fb4b1655f2535ea160a
TURBOSMS_SENDER=TAXI
TURBOSMS_IS_TEST=false

GITHUB_CLIENT_ID=ff46499f4e63aa6170fc
GITHUB_CLIENT_SECRET=0d0f49339443d6098c4c21b052601188f89f7df0
GITHUB_REDIRECT_URL=https://thankful-just-termite.ngrok-free.app/github/login/callback

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

NGROK_URL=https://thankful-just-termite.ngrok-free.app

VITE_APP_NAME="${APP_NAME}"
```

### 8. Міграції бази даних можна дописати --seed що додасть як основні так і фейкові данні
```bash
php artisan migrate
```

### 9. Наповнення бази даних
- Основні дані:
```bash
php artisan db:seed --class=PrimarySeeder
```
- Тестові дані:
```bash
php artisan db:seed --class=DummySeeder
```

### 10. запустити ngrok
```bash
ngrok http --domain=thankful-just-termite.ngrok-free.app --host-header=rewrite {$siteName:80}
```

### 11. для картинок
```bash
php artisan storage:link
```



