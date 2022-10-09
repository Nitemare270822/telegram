<?php

namespace SergioItem\Telegram\Traits;

trait TelegramBotWebhookManagerTrait
{

    /**
     * Check if TelegramBotWebhookManagerService exists in project code
     *
     * @return bool
     */
    public function validateTelegramBotWebhookManagerServiceExists()
    {
        return class_exists('App\\Services\\TelegramBotWebhookManagerService');
    }

    /**
     * Get new TelegramBotWebhookManagerService instance
     *
     * @return \App\Services\TelegramBotWebhookManagerService|null
     */
    public function getTelegramBotWebhookManagerService()
    {
        if ($this->validateTelegramBotWebhookManagerServiceExists()) {
            return new \App\Services\TelegramBotWebhookManagerService();
        }
        return null;
    }

    /**
     * @param $message
     * @return \stdClass
     */
    public function getMessageData($message)
    {
        $data = new \stdClass();

        $data->chatId = $message['from']['id'];
        $data->isBot = $message['from']['is_bot'];
        $data->firstName = $message['from']['first_name'];
        $data->lastName = $message['from']['last_name'];
        $data->username = $message['from']['username'];
        $data->languageCode = $message['from']['language_code'];
        $data->date = $message['date'];
        $data->messageId = $message['message_id'];

        return $data;
    }

    public function getMissingTelegramBotWebhookManagerServiceMessage()
    {
        return 'Missing TelegramBotWebhookManagerService, please implement this Service in your code and manageResponseMessage';
    }
}