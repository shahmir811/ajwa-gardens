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
    protected $description = 'Send sms to the clients regarding there payments';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $client         = new \GuzzleHttp\Client();
        $username       = Config::get('customvariables.lrt_sms_username');
        $password       = Config::get('customvariables.lrt_sms_password');
        $api_key        = Config::get('customvariables.lrt_sms_apikey');
        $sender         = Config::get('customvariables.lrt_sms_sender');
        $endpoint       = "https://sms.lrt.com.pk/api/sms-single-or-bulk-api.php";
        
        
        $messages = Message::where('status', '=', 0)->get();
        foreach ($messages as $message) {

            $client = new Client();
            $params = array('username'  => $username , 
                            'password'  => $password,
                            'apikey'    => $api_key,
                            'sender'    => $sender,
                            'phone'     => $message->phone_number,
                            'type'      => 'English',
                            'message'   => $message->description
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
