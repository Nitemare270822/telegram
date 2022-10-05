<?php

namespace SergioItem\Telegram\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramUpdatesService
{
    private $bot;

    public function __construct()
    {
        $this->bot = config('telegram.bot');
    }

    /**
     * Get bot updates with optional offset
     *
     * @param $offset
     * @return mixed
     */
    public function getUpdates($offset = null)
    {
        $url = 'https://api.telegram.org/bot' . $this->bot . '/getUpdates';
        if ($offset) {
            $url .= '?offset=' . $offset;
        }
        $getRequest = Http::get($url);
        $response = json_decode($getRequest->getBody());
        Log::channel('telegram')->info(json_encode($response));
        return $response;
    }

    /* *************************************************************************************************** Setters */

    /**
     * @param mixed $bot
     * @return TelegramUpdatesService
     */
    public function setBot($bot)
    {
        $this->bot = $bot;
        return $this;
    }
}
