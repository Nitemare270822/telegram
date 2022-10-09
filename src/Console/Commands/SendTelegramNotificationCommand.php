<?php

namespace SergioItem\Telegram\Console\Commands;

use SergioItem\Telegram\Services\TelegramNotificationService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * USAGE
 *
 * php artisan telegram:send-notification {message}
 */
class SendTelegramNotificationCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $name = 'telegram:send-notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a telegram notification';

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['message', InputArgument::REQUIRED, 'The text of the notification to be sent'],
        ];
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $message = $this->argument('message');

        $TelegramNotificationService = new TelegramNotificationService();
        $TelegramNotificationService->setMessage($message)->sendNotification();

        return 0;
    }
}