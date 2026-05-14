<?php

use App\Models\Destination;
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
       function destination()
       {
           return cache()->remember('destination', 3600, function () {
               return Destination::select('id','country')->get();
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

       function sendOtp($phone, $message)
       {
           $response = Http::get(config('services.sms.url'), [
               'api_key'   => config('services.sms.key'),
               'contacts'  => $phone,
               'senderid'  => config('services.sms.sender'),
               'msg'       => $message
           ]);

           return $response->body();
       }


// app/Helpers/helpers.php

    if (!function_exists('getYouTubeIdFromEmbed')) {
        function getYouTubeIdFromEmbed($embedCode)
        {
            if (empty($embedCode)) {
                return 'N/A';
            }

            // Try to extract from iframe src
            preg_match('/src=["\'](?:https?:)?\/\/(?:www\.)?youtube\.com\/embed\/([^"\'&?]+)/', $embedCode, $matches);

            if (isset($matches[1])) {
                return $matches[1];
            }

            // Try to extract from youtu.be format
            preg_match('/youtu\.be\/([^"\'&?]+)/', $embedCode, $matches);

            if (isset($matches[1])) {
                return $matches[1];
            }

            // Try to extract from watch?v= format
            preg_match('/[?&]v=([^&]+)/', $embedCode, $matches);

            if (isset($matches[1])) {
                return $matches[1];
            }

            return 'Unknown';
        }
    }

    if (!function_exists('getYouTubeThumbnailFromEmbed')) {
        function getYouTubeThumbnailFromEmbed($embedCode)
        {
            $videoId = getYouTubeIdFromEmbed($embedCode);

            if ($videoId !== 'Unknown' && $videoId !== 'N/A') {
                $thumbnailUrl = "https://img.youtube.com/vi/{$videoId}/mqdefault.jpg";
                return '<img src="' . $thumbnailUrl . '" alt="YouTube Thumbnail" class="video-thumbnail" onerror="this.src=\'https://placehold.co/120x68/e2e8f0/64748b?text=No+Thumbnail\'">';
            }

            // Return a placeholder if no video ID found
            return '<div class="video-thumbnail d-flex align-items-center justify-content-center bg-light" style="width: 120px; height: 68px;">
                    <i class="fab fa-youtube fa-2x text-muted"></i>
                </div>';
        }
    }
   }
