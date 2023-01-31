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

        $response = Http::retry(3, 100)->withHeaders([
            'Content-type' => 'application/json',
        ])->withOptions(['verify' => false])->get('https://termii.com/api/sms/send', [
            'to' => $phone,
            'from' => 'N-alert',
            'type' => 'plain',
            'channel' => 'dnd',
            'sms' => $message,
            'api_key' => 'TLRcKdkCeNnRequ4NH1RUIQqfsAef8a0NNTwRx0JLQ7GP536VVFOW0bxaVX7tg',
        ]);

        return $response->json();

    }
}
