<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class Locator {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
        if(Session::has('currency'))
            return $next($request);
        $ip=$_SERVER['REMOTE_ADDR'];
        $data= \SypexGeo::get($ip);
        $currency = 'BYR';
        if(isset($data['country']['iso']))
        {
            switch($data['country']['iso'])
            {
                case 'KZ':
                case 'RU':
                    $currency = 'RUB';
                    break;
                case 'BY':
                    $currency = 'BYR';
                    break;
                //Euro zone countries
                case 'AT':
                case 'BE':
                case 'DE':
                case 'GR':
                case 'IE':
                case 'IT':
                case 'ES':
                case 'CY':
                case 'LV':
                case 'LT':
                case 'LU':
                case 'MT':
                case 'NL':
                case 'PT':
                case 'SK':
                case 'SI':
                case 'FI':
                case 'FR':
                case 'EE':
                    $currency = 'EUR';
                    break;
                case 'GB':
                    $currency = 'GBP';
                    break;
                default:
                    $currency = 'USD';
                    break;
            }
        }
        Session::put('currency', $currency);
        $isInBase=\App\Location::where('ip', $ip)->twentyFour()->first();
        if(!$isInBase)
        {
            \App\Location::create(['ip' => $ip]);
        }
        return $next($request);
	}

}
