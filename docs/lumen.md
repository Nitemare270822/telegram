Install Guzzle
```bash
composer require guzzlehttp/guzzle
```

Enable Facades in `bootstrap/app.php` to prevent _"A facade root has not been set"_ error
```php
$app->withFacades();
```

Add the package ServiceProvider in the **_Register Service Providers_** section of your `bootstrap/app.php`
```php
$app->register(SergioItem\Telegram\TelegramServiceProvider::class);
```

