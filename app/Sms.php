<?php

namespace App;

use Twilio\Rest\Client;
use Twilio\Exceptions\RestException;

class Sms
{
    public static function send(string $recipient, string $body): bool
    {
        $sid = env('TWILIO_SID');
        $token = env('TWILIO_TOKEN');
        $client = new Client($sid, $token);
        $from = env('TWILIO_NUMBER');

        try {
            $client->messages->create($recipient, compact('from', 'body'));

            return true;
        } catch (RestException $e) {
            return false;
        }
    }
}
