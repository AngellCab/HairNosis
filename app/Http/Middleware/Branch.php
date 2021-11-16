<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;
use Auth;

class Branch
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
        $this->setBranchOffice();

        return $next($request);
    }

    private function setBranchOffice() {

        #If has not session we can't set branch ID
        if (!Session::has('company_id')) {
            return false;
        }

        $company  = Auth::user()->company->first();
        $branches = $company->locations;

        if (Session::has('branch_id') && in_array(Session::get('branch_id'), $branches->pluck('id')->toArray())) {
            Session::put('branch_id', Session::get('branch_id'));
        } else {

            if ($branches->count()) {
                $branch = $branches->first();
                Session::put('branch_id', $branch->id);
            }
        }
    }
}
