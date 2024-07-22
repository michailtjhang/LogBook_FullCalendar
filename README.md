# About HRIS Pintar
HRIS Pintar adalah sistem informasi sumber daya manusia yang dirancang untuk menyederhanakan pengelolaan data karyawan. Nikmati kemudahan dalam mengakses, menganalisis, dan mengelola informasi karyawan Anda.

## Requirements

<a href="https://laravel.com/docs/10.x"><img src="https://img.shields.io/badge/laravel-v10-blue" alt="version laravel"></a>
<a href="https://windows.php.net/download#php-8.2"><img src="https://img.shields.io/badge/PHP-v8.2.4-blue" alt="version php"></a>
<a href="https://nodejs.org/en/blog/release/v10.1.0"><img src="https://img.shields.io/badge/NPM-v10.1.0-green" alt="version note js"></a>
<a href="https://getcomposer.org/download/2.6.5/composer.phar"><img src="https://img.shields.io/badge/COMPOSER-v2.6.5-brown" alt="version composer"></a>

## Setup

-   buka direktori project di terminal anda.
-   ketikan command di terminal :
    ```bash
    copy .env.example .env
    ```
    untuk Linuk, ketikan command :
    ```bash
    cp .env.example .env
    ```
-   instal package-package di laravel, ketikan command :
    ```bash
    composer install
    ```
-   menginstal npm UI di website, ketikan command :
    ```bash
    npm install
    ```
-   Generate app key, ketikan command :
    ```bash
    php artisan key:generate
    ```

### Command Run Website

-   menjalanlan Laravel di website, ketikan command :
    ```bash
    php artisan serve
    ```
-   menjalanlan UI Laravel di website, ketikan command :
    ```bash
    npm run dev
    ```