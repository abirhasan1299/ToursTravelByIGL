<?php
use App\Models\Setting;

   if(!function_exists('settings'))
   {
       function settings()
       {
           return cache()->remember('settings', 3600, function () {
               return Setting::find(1);
           });
       }
   }
