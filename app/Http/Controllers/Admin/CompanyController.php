<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Models\Company;
use Auth;

class CompanyController extends Controller
{
    /**
     * Table/Route prefix
     *
     * @var string
     */
    protected $routeName = 'companies';

    /**
     * Role string
     *
     * @var string
     */
    protected $permissionName = 'admin.companies';
    /**
     * Error message when auth fails
     *
     * @var string
     */
    protected $permissionError = 'Error';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function index(Request $request) {
        
        $title = 'Companies';

        $columnHeaders = [
            ' Id',
            __('nicenames.name'),
            __('nicenames.phone'),
            __('nicenames.email'),
            __('nicenames.address'),
            __('controllers.actions'),
        ];

        $columnArray = [
            "{data: 'id',      name: 'id'},",
            "{data: 'name',    name: 'name'},",
            "{data: 'phone',   name: 'phone'},",
            "{data: 'email',   name: 'email'},",
            "{data: 'address', name: 'address'},",
            "{data: 'actions', name: 'action', orderable: false, searchable: false, class:'text-center'}"
        ];

        $orderstring = "[[0,'desc']]";

        // $this->gateCheck($request);

        return view('admin.table', compact('title', 'columnArray', 'columnHeaders', 'orderstring'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $formAction = 'create';
        $submitButtonText = __('admin.create');
        $form  = View::make('admin.patch', compact('submitButtonText', 'formAction'))->render();
        
        // $this->gateCheck($request);

        return response()->json(['error' => false, 'message' => null, 'form' => $form]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Get the request parameters
        Company::create($request->all());
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  Company $company
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function edit(Company $company, Request $request)
    {
        $formAction       = 'update';
        $submitButtonText = __('admin.update');
        $formModel        = $company;
        $url              = route($this->routeName.'.update', $company->id);
        $form             = View::make('admin.patch', compact('submitButtonText', 'formAction', 'formModel', 'url'))->render();
        
        //$this->gateCheck($request);

        return response()->json(['error' => false, 'message' => null, 'form' => $form]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        // Get the request parameters
        $company->update($request->except('owner_id'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Company $company
     * @param  Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Company $company, Request $request) {
        
        //this->gateCheck($request);
        $company->delete();
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param   $id
     * @param  Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function restore($id, Request $request) {

        //$this->gateCheck($request);
        $company = Company::withTrashed()->findOrFail($id);
        $company->restore();

        return $company;
    }
}
