<?php

namespace SergioItem\Telegram\Console\Commands;

use SergioItem\Telegram\Services\TelegramWebhookService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use SergioItem\Telegram\Traits\TelegramBotWebhookManagerTrait;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * USAGE
 *
 * php artisan telegram:set-webhook {url?}
 */
class SetTelegramWebhookCommand extends Command
{
    use TelegramBotWebhookManagerTrait;

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
            ['url', InputArgument::OPTIONAL, 'The url where webhooks will be sent (optional)'],
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

        if (!$url) {
            $url = url(config('telegram.manage_webhook_url'));

            $this->info('The default url for your webhook will be set to <comment>' . $url . '</comment>.');
            if (!$this->confirm('Do you wish to continue?', true)) {
                return 0;
            }
        }

        $TelegramWebhookService = new TelegramWebhookService();
        $TelegramWebhookService->setWebhookUrl($url)->setWebhook();

        $this->info('Webhook url set successfully');

        if (!$this->validateTelegramBotWebhookManagerServiceExists()) {
            $this->warn($this->getMissingTelegramBotWebhookManagerServiceMessage());
            $this->newLine();
        }

        return 0;
    }
}