<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Hướng dẫn cài đặt

- Download <a href="https://www.apachefriends.org/download.html">XAMPP</a> và <a href="https://getcomposer.org/download/">Composer</a> và tiến hành cài đặt
- Truy cập vào **XAMPP** tạo database và table
- Sau khi đã clone project, truy cập thư mục gốc chứa các file và folder của project, mở cmd hoặc PowerShell chạy lệnh **composer install**
- Copy file **.env.example** và paste nó vào trong folder gốc, sửa tên thành **.env**, sủa lại các biến **DB_HOST**, **DB_PORT**, **DB_DATABASE**, **DB_USERNAME**, **DB_PASSWORD** tùy vào việc setup database trên **XAMPP**
- VD setting **.env**<br/>
DB_HOST=localhost<br/>
DB_PORT=3306<br/>
DB_DATABASE=clothes_shopping<br/>
DB_USERNAME=root<br/>
DB_PASSWORD=<br/>
- Tiếp theo, Ở cmd chạy lệnh **php artisan migrate** và **php artisan db:seed**
- Sau đó chạy lệnh **php artisan serve**, nó sẽ mở 1 server ảo với cổng 8000, giữ nguyên tiến trình cmd đang chạy, vào web **http://localhost:8000** để vào màn hình user, **http://localhost:8000/admin/dashboard** để vào màn hình admin
