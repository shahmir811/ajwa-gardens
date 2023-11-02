<?php

namespace App\Console\Commands;

use Log;
use Config;
use GuzzleHttp\Client;
use App\Models\{Message};
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

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
        $client = new \GuzzleHttp\Client();
        $api_key    = Config::get('customvariables.sms_key');
        $sms_sender = Config::get('customvariables.sms_sender');
        $endpoint   = "https://api.wolftechs.pk/sendsms.php";
        
        
        $messages = Message::where('status', '=', 0)->get();
        foreach ($messages as $message) {

            $client = new Client();
            $params = array('apikey' => $api_key , 
                            'phone' => $message->phone_number,
                            'sender' => $sms_sender,
                            'message' => $message->description
                        );
            
            // $url = $endpoint . '?' . http_build_query($params);

            $response = Http::get($endpoint, $params);        

            // $response = $client->request('GET', $endpoint, ['query' => [
            //     'apikey'    => $api_key, 
            //     'phone'     => $message->phone_number,
            //     'sender'    => $sms_sender,
            //     'message'   => $message->description
            // ]]);

            $statusCode = $response->getStatusCode();
            Log::info($statusCode);    
            // $contact_number = '92' . substr($message->phone_number, 1);
            // $sendSms = new SendSms($message);
            // $response = $sendSms->deliverMessage();
            // if($response) {
            //     $message->status = 1;
            // }
            $message->status = 1;
            $message->save();
        }

        return 0;
    }
}
