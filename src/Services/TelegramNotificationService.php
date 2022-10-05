<?php

namespace SergioItem\Telegram\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramNotificationService
{
    private $bot;
    private $chats = [];
    private $message;

    public function __construct()
    {
        $this->bot = config('telegram.bot');
        $this->chats = preg_split('/[\s,;]+/', config('telegram.chat_ids'), -1, PREG_SPLIT_NO_EMPTY);
    }

    /**
     * Get bot updates with optional offset
     *
     * @param $offset
     * @return mixed
     */
    public function sendNotification()
    {
        try {
            if ($this->bot && $this->message) {
                foreach ($this->chats as $chat) {
                    $url = 'https://api.telegram.org/bot' . $this->bot . '/sendMessage?chat_id=' . $chat . '&silent=true&text=' . $this->message;
                    $getRequest = Http::get($url);
                }
                return true;
            }
        } catch (\Exception $exception) {
            Log::channel('telegram')->error($exception);
            return false;
        }
    }

    /* *************************************************************************************************** Setters */

    /**
     * @param mixed $bot
     * @return TelegramNotificationService
     */
    public function setBot($bot)
    {
        $this->bot = $bot;
        return $this;
    }

    /**
     * @param array $chats
     * @return TelegramNotificationService
     */
    public function addChat(string $chat)
    {
        if (!is_array($this->chats)) {
            $this->chats = [];
        }
        array_push($this->chats, $chat);
        return $this;
    }

    /**
     * @param array $chats
     * @return TelegramNotificationService
     */
    public function setChats(array $chats)
    {
        $this->chats = $chats;
        return $this;
    }

    /**
     * @param mixed $message
     * @return TelegramNotificationService
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }
}
