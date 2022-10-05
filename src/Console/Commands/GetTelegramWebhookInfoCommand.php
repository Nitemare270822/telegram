<?php

namespace SergioItem\Telegram\Console\Commands;

use SergioItem\Telegram\Services\TelegramWebhookService;
use Carbon\Carbon;
use Illuminate\Console\Command;

/**
 * USAGE
 *
 * php artisan telegram:get-webhook-info
 */
class GetTelegramWebhookInfoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'telegram:get-webhook-info';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Telegram bot webhook info';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $TelegramWebhookService = new TelegramWebhookService();
        $webhookInfo = $TelegramWebhookService->getWebhookInfo();

        if ($webhookInfo->ok && $webhookInfo->result && strlen($webhookInfo->result->url)) {
            $webhookInfoData[0] = [
                'url' => $webhookInfo->result->url,
                'has_custom_certificate' => $webhookInfo->result->has_custom_certificate ?? null,
                'pending_update_count' => $webhookInfo->result->pending_update_count ?? null,
                'last_error_date' => $webhookInfo->result->last_error_date ?? null,
                'max_connections' => $webhookInfo->result->max_connections ?? null,
                'allowed_updates' => $webhookInfo->result->allowed_updates ?? null,
            ];

            $this->table(
                [
                    'Url',
                    'Has certificate',
                    'Pending update',
                    'Last error',
                    'Max connections',
                    'Allowed updates'
                ],
                $webhookInfoData
            );
        } else {
            $this->info('No webhook info available');
        }

        return 0;
    }
}
