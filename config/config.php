<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Telegram
    |--------------------------------------------------------------------------
    |
    | Telegram package config variables
    |
    */

    'bot' => env('TELEGRAM_BOT', null),
    'chat_ids' => env('TELEGRAM_CHAT_IDS', null),
    'manage_webhook_url' => env('TELEGRAM_MANAGE_WEBHOOK_URL', 'telegram-manage-webhook'),

];