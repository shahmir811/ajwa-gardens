<?php

namespace App\Console\Commands;

use Log;
use Carbon\Carbon;
use App\Models\{Message};
use Illuminate\Console\Command;

class DeleteSentMessages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:sms';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete all messages that are sent to the client';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $messages = Message::where('status', '=', 1)->get();
        $delete_msg_ids = [];

        foreach ($messages as $message) {
            array_push($delete_msg_ids, $message->id);
            $message->delete();
        }

        Log::info('DeleteSentSMS job is execute at ' . Carbon::now('Asia/Karachi'));
        Log::info("Removed messages with ids " . implode(" ", $delete_msg_ids));    
    }
}
