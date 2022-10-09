<?php

namespace SergioItem\Telegram\Console\Commands;

use SergioItem\Telegram\Services\TelegramWebhookService;
use Carbon\Carbon;
use Illuminate\Console\Command;

/**
 * USAGE
 *
 * php artisan telegram:remove-webhook
 */
class RemoveTelegramWebhookCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'telegram:remove-webhook';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove Telegram bot webhook url';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $TelegramWebhookService = new TelegramWebhookService();
        $TelegramWebhookService->removeWebhook();

        $this->info('Webhook url removed successfully');

        return 0;
    }
}