# Laravel Notifications for Laravel 5.2 / 5.1

[![Latest Version on Packagist](https://img.shields.io/packagist/v/laravel-notification-channels/backport.svg?style=flat-square)](https://packagist.org/packages/laravel-notification-channels/backport)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/laravel-notification-channels/backport/master.svg?style=flat-square)](https://travis-ci.org/laravel-notification-channels/backport)
[![StyleCI](https://styleci.io/repos/65912768/shield)](https://styleci.io/repos/65912768)
[![Quality Score](https://img.shields.io/scrutinizer/g/laravel-notification-channels/backport.svg?style=flat-square)](https://scrutinizer-ci.com/g/laravel-notification-channels/backport)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/laravel-notification-channels/backport/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/laravel-notification-channels/backport/?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/laravel-notification-channels/backport.svg?style=flat-square)](https://packagist.org/packages/laravel-notification-channels/backport) 

This package acts as a backport for the Laravel 5.3 notification system, to allow its usage with Laravel 5.1 and Laravel 5.2. 

## Installation

You can install the package via composer:

```bash
composer require laravel-notification-channels/backport
```

Next, you must load the service provider:

```php
// config/app.php
'providers' => [
    // ...
    Illuminate\Notifications\NotificationServiceProvider::class,
],
```

## Usage

Please refer to the [official Laravel Notification documentation](https://laravel.com/docs/master/notifications).

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
