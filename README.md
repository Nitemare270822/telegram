# Telegram Bot Utilities
> Laravel Package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/sergio-item/telegram.svg?style=flat-square)](https://packagist.org/packages/sergio-item/telegram)
[![Total Downloads](https://img.shields.io/packagist/dt/sergio-item/telegram.svg?style=flat-square)](https://packagist.org/packages/sergio-item/telegram)


## Installation

You can install the package via composer:

```bash
composer require sergio-item/telegram
```


Add Telegram variables to your `.env` file
```dotenv
TELEGRAM_BOT=""
TELEGRAM_CHAT_IDS="" # Can be multiple values separated by comma or semicolon 
```

## Usage

Use the `Telegram` Facade to send a notification

```php
use SergioItem\Telegram\Facades\Telegram;

Telegram::sendNotification($message);
```

## Commands

Webhook related commands
```bash
php artisan telegram:set-webhook {url}
php artisan telegram:remove-webhook
php artisan telegram:get-webhook-info
```

Get updates command (offset option available)
```bash
php artisan telegram:get-updates
php artisan telegram:get-updates --offset {updateId}
php artisan telegram:get-updates -O {updateId}
```

Send Notification command
```bash
php artisan telegram:send-notification {message}
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

-   [Sergio](https://github.com/sergio-item)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
