<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Описание проекта:
Склонируйте проект в директорию с сервером 

```
git clone https://github.com/Vsechp/api_test_exore

```
Создайте базу данных в папке database с именем databse.sqlite и подключите ее, заполните поле файла .env 
```bash
  DB_CONNECTION=sqlite
```

Затем, открыв из папки проекта консоль, введите команду для установки/обновления пакетов ларавел:
```bash
  composer update
```

В открытой консоли директории проекта введите команду для генерации таблиц базы данных:
```bash
  php artisan migrate
```

Для запуска сидов в таблице categories используйте команду 
```bash
php artisan db:seed --class=CategorySeeder
```

В той же консоли для запуска сайта по адресу http://localhost:8000 введите команду:
```bash
  php artisan serve
```

В новой консоли для запуска NodeJS и корректной работы введите команду:
```bash
  npm install npm run dev
```
## Ссылки
Откройте сайт в браузере по адресу   http://127.0.0.1:8000/register и зарегистрируйтесь как manager, затем, используя ваш логин и пароль, залогиньтесь  перейдя по адресу http://127.0.0.1:8000/login 


