<?php

namespace SergioItem\Telegram\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramWebhookService
{
    private $bot;
    private $webhookUrl;

    public function __construct()
    {
        $this->bot = config('telegram.bot');
    }

    /**
     * Set webhook url for the bot
     *
     * @return mixed
     */
    public function setWebhook()
    {
        $url = 'https://api.telegram.org/bot' . $this->bot . '/setWebhook?url=' . $this->webhookUrl;
        $getRequest = Http::get($url);

        // $response = json_decode($getRequest->getBody());
        // Log::channel('telegram')->info(json_encode($response));
        // return $response;
    }

    /**
     * Remove webhook url for the bot
     *
     * @return mixed
     */
    public function removeWebhook()
    {
        $url = 'https://api.telegram.org/bot' . $this->bot . '/deleteWebhook';
        $getRequest = Http::get($url);

        // $response = json_decode($getRequest->getBody());
        // Log::channel('telegram')->info(json_encode($response));
        // return $response;
    }

    /**
     * Get webhook info
     *
     * @return mixed
     */
    public function getWebhookInfo()
    {
        $url = 'https://api.telegram.org/bot' . $this->bot . '/getWebhookInfo';
        $getRequest = Http::get($url);
        $response = json_decode($getRequest->getBody());
        Log::channel('telegram')->info(json_encode($response));
        return $response;
    }

    /* *************************************************************************************************** Setters */

    /**
     * @param mixed $bot
     * @return TelegramWebhookService
     */
    public function setBot($bot)
    {
        $this->bot = $bot;
        return $this;
    }

    /**
     * @param mixed $webhookUrl
     * @return TelegramWebhookService
     */
    public function setWebhookUrl($webhookUrl)
    {
        $this->webhookUrl = $webhookUrl;
        return $this;
    }

}
