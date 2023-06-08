<?php

namespace App\Console\Commands;

use App\Models\{Message};
use Illuminate\Console\Command;

class SendSMS extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:sms';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $messages = Message::where('status', '=', 0)->get();
        foreach ($messages as $message) {
            // $contact_number = '92' . substr($message->phone_number, 1);
            // $sendSms = new SendSms($message);
            // $response = $sendSms->deliverMessage();
            // if($response) {
            //     $message->status = 1;
            // }
            // $message->save();
        }

        return 0;
    }
}
