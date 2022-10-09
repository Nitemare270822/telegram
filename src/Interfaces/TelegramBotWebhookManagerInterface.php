<?php

namespace SergioItem\Telegram\Interfaces;

interface TelegramBotWebhookManagerInterface
{
    public function manageResponseMessage(string $text, $data);
}
