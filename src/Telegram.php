<?php

namespace SergioItem\Telegram;

use SergioItem\Telegram\Services\TelegramNotificationService;

class Telegram
{
    public function sendNotification($message)
    {
        $TelegramNotificationService = new TelegramNotificationService();
        $TelegramNotificationService->setMessage($message)->sendNotification();
    }

}