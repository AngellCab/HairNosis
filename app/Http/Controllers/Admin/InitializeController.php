<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Location;
use Session;
use Auth;
use DB;

class InitializeController extends Controller
{
    /**
     * Display
     * 
     * @param Request $request
     */
    public function index(Request $request) {

        $company = Company::find(Session::get('company_id'));
        $title   = $company->name;

        #Verify branches available
        $branches = $company->locations->count();
        if ($branches) { return redirect('/'); }

        return view('admin.initialize', compact('title', 'branches'));
    }

    /**
     * Create first branch company
     * 
     * @param Request $request
     */
    public function createFirstBranch(Request $request) {

        $company = Company::find(Session::get('company_id'));

        #Create new Branch
        $branch = Location::create([
            'name'       => $request->name,
            'address'    => $request->address,
            'phone'      => $request->phone,
            'email'      => $request->email,
            'manager_id' => Auth::id(),
            'company_id' => $company->id
        ]);

        #Update register from locations
        DB::table('role_user')
            ->where('company_id', $company->id)
            ->where('user_id', Auth::id())
            ->update(['location_id' => $branch->id]);

        return $this->return_success(__('messages.branch_created_correctly'));
    }
}
