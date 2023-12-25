<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use App;
use Config;
use Curl;

class SetLocale
{
    /**
     *
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Session::has('locale')) {
            $locale = Session::get('locale', Config::get('app.locale'));
        } else {
            $locale = 'ms';//substr($request->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);

            if ($locale != 'en') {
                $locale = 'ms';
            }
        }

        App::setLocale($locale);

        


        

        return $next($request);
    }
}
