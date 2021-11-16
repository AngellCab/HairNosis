<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Location;
use Session;

class Initizalize
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
        $branches = Location::where('company_id', Session::get('company_id'))->count();
        if ($branches == 0) {
            return redirect('/initialize');
        }

        return $next($request);
    }
}
