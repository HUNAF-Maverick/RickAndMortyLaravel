<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Installing

Clone the repository and then create a normal .env file for Laravel (settng up database, app name etc) run composer install, composer update and npm install command

### Startin app

Run npm run dev in your console and check your running app at http://localhost:8080 or any kind of virtual host you install it on

## Usage

Firstly you have to syncronize the episodes with characters form the Rick And Morty API. To do that you just simply need to push the "Start episode sync" button on the main page. Now you just have to wait for sync to complete and then you will be redirected to the episodes page where the episodes are listed. You can reach this page from the navbar too. If you click on one of the rows of the table, the list of characters in that episode will appear in a modal.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
