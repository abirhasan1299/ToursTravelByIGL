<?php
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

if(!function_exists('settings'))
   {
       function settings()
       {
           return cache()->remember('settings', 3600, function () {
               return Setting::find(1);
           });
       }

       function mask_phone($phone)
       {
           $len = strlen($phone);

           if ($len <= 4) {
               return str_repeat('*', $len);
           }

           return substr($phone, 0, 2)
               . str_repeat('*', $len - 4)
               . substr($phone, -2);
       }

       function sendOtp($phone,$message)
       {
           $response = Http::asForm()->post(env('SMS_API_LINK'), [
               'api_key'   => env('SMS_API_KEY'),
               'contacts'  => $phone,
               'senderid'  => env('SMS_SENDER_ID'),
               'msg'       => $message
           ]);
           Log::info('SMS API Response: '.$response->body());
       }
   }
