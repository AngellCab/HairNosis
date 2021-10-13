<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Table prefix
     *
     * @var string
     */
    protected $routeName = 'permissions';

    /**
     * Permission name
     */
    protected $permissionName = 'admin.permissions';

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
        $title = 'admin.permissions';

        $columnHeaders = [
            __('admin.id'),
            __('admin.name'),
            __('admin.label'),
            __('admin.actions'),
        ];

        $columnArray = [
            "{data: 'id',       name: 'id'},",
            "{data: 'name',     name: 'name'},",
            "{data: 'label',    name: 'label'},",         
            "{data: 'actions',  name: 'actions', orderable: false, searchable: false}"
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
        Permission::create($request->all());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Permission $permission
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function edit(Permission $permission, Request $request)
    {
        $formAction       = 'update';
        $submitButtonText = __('admin.update');
        $formModel        = $permission;
        $url              = route($this->routeName.'.update', $permission->id);
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
    public function update(Request $request, Permission $permission)
    {
        // Get the request parameters
        $permission->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Permission $permission
     * @param  Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Permission $permission, Request $request) {
        
        //this->gateCheck($request);
        $permission->delete();
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
        $permission = Permission::withTrashed()->findOrFail($id);
        $permission->restore();

        return $permission;
    }
}
