<?php


/*
|--------------------------------------------------------------------------
| Telegram Routes
|--------------------------------------------------------------------------
|
| Routes for telegram bot
|
*/

Route::post('/' . trim(config('telegram.manage_webhook_url'), '/'), ['as' => 'telegram-manage-webhook', 'uses' => 'SergioItem\Telegram\Http\Controllers\TelegramController@manageWebhook']);