<?php

namespace SergioItem\Telegram\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use SergioItem\Telegram\Traits\TelegramBotWebhookManagerTrait;

class TelegramController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    use TelegramBotWebhookManagerTrait;

    private $bot;
    private $message;
    private $data;

    public function __construct()
    {
        $this->bot = config('telegram.bot');
    }

    /**
     * @param Request $request
     * @return mixed|void
     */
    public function manageWebhook(Request $request)
    {
        $this->message = $request->get('message');
        $this->data = $this->getMessageData($this->message);

        if ($TelegramBotWebhookManagerService = $this->getTelegramBotWebhookManagerService()) {
            $response = $TelegramBotWebhookManagerService->manageResponseMessage($this->message['text'], $this->data);
            return $this->respondToMessage($response);
        }

        return $this->respondToMessage($this->getMissingTelegramBotWebhookManagerServiceMessage());
    }

    /**
     * @param $responseMessage
     * @return mixed|void
     */
    private function respondToMessage($responseMessage)
    {
        if ($responseMessage) {
            try {
                $responseData = [
                    'chat_id' => $this->data->chatId,
                    'text' => $responseMessage,
                ];

                $url = 'https://api.telegram.org/bot' . $this->bot . '/sendMessage';
                $postRequest = Http::withBody(json_encode($responseData), 'application/json')
                    ->post($url);
            } catch (\Exception $exception) {
                Log::channel('telegram')->error($exception);
                return false;
            }
        }
    }

}