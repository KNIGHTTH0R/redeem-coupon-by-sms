<?php

namespace App\Http\Controllers\Api;

use App\Sms;
use App\Client;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SmsPromotionController extends Controller
{
    const MSG_TEMPLATES = [
        'morning' => 'Good morning! Your promocode is AM123',
        'afternoon' => 'Hello! Your promocode is PM456',
    ];

    public function show(Request $request)
    {
        $result = [];

        $phone = $request->get('phone');
        //Has she/he taken the promotion already
        $receivedCoupon = Client::where([
            'phone' => $phone,
        ])->exists();
        if ($receivedCoupon) {
            $result['errors'][] = 'SMS already sent to this number';

            return response()->json($result);
        }

        //Determine which message template to use
        $currentTime = Carbon::now()->format('H:i a');
        $now = Carbon::createFromFormat('H:i a', $currentTime);
        $morningStart = Carbon::createFromFormat('H:i a', '5:00 am');
        $morningEnd = Carbon::createFromFormat('H:i a', '11:59 am');
        if ($now > $morningStart && $now < $morningEnd) {
            ['morning' => $message] = self::MSG_TEMPLATES;
        } else {
            ['afternoon' => $message] = self::MSG_TEMPLATES;
        }

        //Send the message
        if (Sms::send($phone, $message)) {
            //Insert client
            Client::create([
                'phone' => $phone,
            ]);
        } else {
            $result['errors'][] = "Failed to send SMS, make sure that it starts with '+' i.e. +35799123456";
        }

        return response()->json($result);
    }
}
