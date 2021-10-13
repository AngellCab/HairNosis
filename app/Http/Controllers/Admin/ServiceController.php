<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    /**
     * Table prefix
     *
     * @var string
     */
    protected $routeName = 'services';

    /**
     * Permission name
     */
    protected $permissionName = 'admin.services';

    /**
     * Permission error
     * 
     */
    protected $permissionError = '';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'admin.services';

        $columnHeaders = [
            __('admin.id'),
            __('admin.client'),
            __('admin.formula'),
            __('admin.apply_date'),
            __('admin.redken_products'),
            __('admin.loreal_products'),
            __('admin.kerestase_products'),
            __('admin.treatments'),
            __('admin.actions'),
        ];

        $columnArray = [
            "{data: 'id',                 name: 'id'},",
            "{data: 'client_id',          name: 'client_id'},",     
            "{data: 'formula',            name: 'formula'},",     
            "{data: 'apply_date',         name: 'apply_date'},",     
            "{data: 'redken_products',    name: 'redken_products'},",    
            "{data: 'loreal_products',    name: 'loreal_products'},",     
            "{data: 'kerestase_products', name: 'kerestase_products'},",         
            "{data: 'treatments',         name: 'treatments'},",
            "{data: 'actions',            name: 'actions', orderable: false, searchable: false}"
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
        Service::create($request->all());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Service $service
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function edit(Service $service, Request $request)
    {
        $formAction       = 'update';
        $submitButtonText = __('admin.update');
        $formModel        = $service;
        $url              = route($this->routeName.'.update', $service->id);
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
    public function update(Request $request, Service $service)
    {
        // Get the request parameters
        $service->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Service $service
     * @param  Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Service $service, Request $request) {
        
        //this->gateCheck($request);
        $service->delete();
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
        $service = Service::withTrashed()->findOrFail($id);
        $service->restore();

        return $service;
    }
}
