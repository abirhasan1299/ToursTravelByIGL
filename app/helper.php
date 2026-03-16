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
       function getDaysFromRange($range)
       {
           [$start, $end] = explode(' to ', $range); $startDate = Carbon::parse($start); $endDate = Carbon::parse($end);
           return $startDate->diffInDays($endDate) + 1;
       }
       function mask_phone($phone)
       {
           return str_repeat('*', strlen($phone) - 2) . substr($phone, -2);
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
