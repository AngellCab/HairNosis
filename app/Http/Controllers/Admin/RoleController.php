<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\Role;
use Auth;

class RoleController extends Controller
{
    /**
     * Table/Route prefix
     *
     * @var string
     */
    protected $routeName = 'roles';

    /**
     * Role string
     *
     * @var string
     */
    protected $permissionName = 'admin.roles';
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
        
        $title = 'Roles';

        $columnHeaders = [
            ' Id',
            __('nicenames.name'),
            __('nicenames.label'),
            __('controllers.actions'),
        ];

        $columnArray = [
            "{data: 'id', name: 'id'},",
            "{data: 'name', name: 'name'},",
            "{data: 'label', name: 'label'},",
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
        Role::create($request->all());
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  Role $role
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function edit(Role $role, Request $request)
    {
        $formAction       = 'update';
        $submitButtonText = __('admin.update');
        $formModel        = $role;
        $url              = route($this->routeName.'.update', $role->id);
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
    public function update(Request $request, Role $role)
    {
        // Get the request parameters
        $role->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Role $role
     * @param  Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Role $role, Request $request) {
        
        //this->gateCheck($request);
        $role->delete();
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
        $role = Role::withTrashed()->findOrFail($id);
        $role->restore();

        return $role;
    }
}
