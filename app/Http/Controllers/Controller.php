<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Gate;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $routeName       = null;
    protected $prefix          = null;
    protected $permissionName  = null;
    protected $permissionError = null;

    public function __construct() {

        view()->share('routeName', $this->routeName);
        view()->share('prefix', $this->prefix);
    }

    /** Verify if has permission to execute the task 
     * 
     * 
     * @param Request $request
     */
    protected function gateCheck(Request $request) {

        if (Gate::denies($this->permissionName)) {
            if ($request->ajax()) {
                return response(['message' => $this->permissionError, 403]);
            }
            abort(403, $this->permissionError);
        }

        return null;
    }
}
