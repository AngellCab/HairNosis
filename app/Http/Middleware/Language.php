<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;
use App;

class Language
{

    /**
     * Languages availables
     * 
     * @param Array $languages
     */
    private $languages = ['es', 'en'];

    /**
     * Default language
     * 
     * @param Array $languages
     */
    private $default = '';

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $this->default = env('APP_DEFAULT_LANG', 'es');
        $this->configLanguage();
        return $next($request);
    }

    /**
     * Config language
     * 
     */
    private function configLanguage() {
        
        if (Session::has('locale') && in_array(Session::get('locale'), $this->languages)) {
            App::setLocale(Session::get('locale'));
        } else {
            $this->setDefault();
        }
    }

    /**
     * Config default language
     *  
     */
    private function setDefault() {

        Session::put('locale', $this->default);
        App::setLocale($this->default);
    }
}
