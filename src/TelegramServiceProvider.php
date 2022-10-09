<?php

namespace SergioItem\Telegram;

use Illuminate\Support\ServiceProvider;
use SergioItem\Telegram\Console\Commands\GetTelegramUpdatesCommand;
use SergioItem\Telegram\Console\Commands\GetTelegramWebhookInfoCommand;
use SergioItem\Telegram\Console\Commands\RemoveTelegramWebhookCommand;
use SergioItem\Telegram\Console\Commands\SendTelegramNotificationCommand;
use SergioItem\Telegram\Console\Commands\SetTelegramWebhookCommand;

class TelegramServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Load routes
         */
        $this->loadRoutesFrom(__DIR__ . '/../routes/telegram.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('telegram.php'),
            ], 'config');

            // Registering package commands.
            $this->commands([
                GetTelegramUpdatesCommand::class,
                SendTelegramNotificationCommand::class,
                SetTelegramWebhookCommand::class,
                RemoveTelegramWebhookCommand::class,
                GetTelegramWebhookInfoCommand::class,
            ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'telegram');

        // Add log channel to project
        $this->mergeConfigFrom(__DIR__ . '/../config/log-channel.php', 'logging.channels');

        // Register the main class to use with the facade
        $this->app->singleton('telegram', function () {
            return new Telegram;
        });
    }
}