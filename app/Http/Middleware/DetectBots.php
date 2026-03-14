<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Jaybizzle\CrawlerDetect\CrawlerDetect;
use Symfony\Component\HttpFoundation\Response;

class DetectBots
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

        public function handle(Request $request, Closure $next)
        {
            $crawlerDetect = new CrawlerDetect;

            if ($crawlerDetect->isCrawler($request->userAgent())) {
                abort(403, 'Bots are not allowed.');
            }

            return $next($request);
        }

}
