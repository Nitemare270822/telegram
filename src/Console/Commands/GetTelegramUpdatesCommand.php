<?php

namespace SergioItem\Telegram\Console\Commands;

use SergioItem\Telegram\Services\TelegramUpdatesService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * USAGE
 *
 * php artisan telegram:get-updates
 * php artisan telegram:get-updates --offset {updateId}
 * php artisan telegram:get-updates -O {updateId}
 */
class GetTelegramUpdatesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'telegram:get-updates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Telegram bot updates';

    /**
     * @return array[]
     */
    protected function getOptions()
    {
        return [
            ['--offset', '-O', InputOption::VALUE_REQUIRED, 'updateId offset value'],
        ];
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $offset = $this->option('offset');

        $TelegramUpdatesService = new TelegramUpdatesService();
        $updates = $TelegramUpdatesService->getUpdates($offset);
        $updateData = [];

        if ($updates->ok && is_array($updates->result) && count($updates->result)) {
            foreach ($updates->result as $update) {
                $data = [
                    'chat_id' => $update->message->chat->id,
                    'update_id' => $update->update_id,
                    'message_id' => $update->message->message_id,
                    'name' => $update->message->from->first_name . ' ' . $update->message->from->last_name,
                    'username' => $update->message->from->username,
                    'message' => $update->message->text,
                    'language_code' => $update->message->language_code,
                    'date' => Carbon::parse($update->message->date)->setTimezone(config('app.timezone'))->format('d-m-Y H:i'),
                ];

                array_push($updateData, $data);
            }
            $this->table(
                [
                    'Chat Id',
                    'Update Id',
                    'Message Id',
                    'Name',
                    'Username',
                    'Message',
                    'Language',
                    'Date'
                ],
                $updateData
            );
        } else {
            $this->info('There are no updates available');
        }

        return 0;
    }
}