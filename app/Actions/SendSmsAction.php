<?php

namespace App\Actions;

use Lorisleiva\Actions\Concerns\AsAction;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Http;

class SendSmsAction
{
    use AsAction;

    public function handle($message, $phone)
    {
        // $mtnStarts = ['0803','0816','0903','0810','0806','0703','0706','0813','0814','0906'];
        $firstFour = substr($phone,0,4);

        if($firstFour !== "+234" ){

            $account_sid = config('services.sms_api.secret_id');
            $auth_token = config('services.sms_api.secret_token');
            $twilio_number = config('services.sms_api.number');
            $client = new Client($account_sid, $auth_token);
            $client->messages->create($phone, ['from' => $twilio_number, 'body' => $message]);

            return $client;
        }else {

            $response = Http::retry(3, 100)->withHeaders([
                'Content-type' => 'application/json',
            ])->withOptions(['verify' => false])->get('https://termii.com/api/sms/send', [
                'to' => $phone,
                'from' => 'GABTaxi',
                'type' => 'plain',
                'channel' => 'dnd',
                'sms' => $message,
                'api_key' => 'TLvVyZW8qPTNkB4NTBnj4KZmWyGxehN5jsPRVwrBGpWVTTYkduJTOe60jf6n7m',
            ]);

            return $response->json();
        }


    }
}
