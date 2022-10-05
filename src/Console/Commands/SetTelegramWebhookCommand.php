<?php

namespace SergioItem\Telegram\Console\Commands;

use SergioItem\Telegram\Services\TelegramWebhookService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * USAGE
 *
 * php artisan telegram:set-webhook {url}
 */
class SetTelegramWebhookCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'telegram:set-webhook';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set Telegram bot webhook url';

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['url', InputArgument::REQUIRED, 'The url where webhooks will be sent'],
        ];
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $url = $this->argument('url');

        $TelegramWebhookService = new TelegramWebhookService();
        $TelegramWebhookService->setWebhookUrl($url)->setWebhook();

        $this->info('Webhook url set successfully');

        return 0;
    }
}
