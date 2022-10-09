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
TELEGRAM_CHAT_IDS="" # Can be multiple values separated by commas or semicolons 
TELEGRAM_MANAGE_WEBHOOK_URL="" # Default is telegram-manage-webhook
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
php artisan telegram:set-webhook {url?}
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

```bash
# View all the commands available in the telegram namespace
php artisan list telegram
# Display help for a command
php artisan help telegram:<command>
```

## Get updates via webhook

To automatically reply to user messages, you can use the webhook to receive user messages on your server.  

First use the command to set the webhook url
```bash
php artisan telegram:set-webhook {url?}
```

Create `App\Services\TelegramBotWebhookManagerService` in your project with the required method `manageResponseMessage`  

e.g
```php
<?php

namespace App\Services;

use SergioItem\Telegram\Interfaces\TelegramBotWebhookManagerInterface;

class TelegramBotWebhookManagerService implements TelegramBotWebhookManagerInterface
{
    /**
     * @param string $text
     * @param null $data
     * @return string
     */
    public function manageResponseMessage(string $text, $data = null)
    {
        switch (strtolower($text)) {
            case 'hi':
            case 'hello':
                return 'Hi ' . $data->firstName . '! welcome to this bot';
                break;
            case 'chat':
            case 'id':
                return 'Your chat id is: ' . $data->chatId;
                break;

            default:
                // return null; // No message will be sent
                return 'Sorry, I couldn\'t understand your message.';
                break;
        }
    }

}
```

The `data` object should have the following attributes  

```php
$data->chatId
$data->isBot
$data->firstName
$data->lastName
$data->username
$data->languageCode
$data->date
$data->messageId
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
