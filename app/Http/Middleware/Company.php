<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;
use App;
use Auth;

class Company
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $this->setCompany();
        return $next($request);
    }

    /**
     * Assign company in session
     * 
     */
    protected function setCompany() {

        $user = Auth::user();
        if (Session::has('company_id')) {
            Session::put('company_id',  Session::get('company_id'));
        } else {
            $company = $user->company->first();
            if (!is_null($company)) {
                Session::put('company_id', $company->id);
            }
        }
    }
}
