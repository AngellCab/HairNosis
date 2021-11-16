<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
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
            __('admin.label'),
            __('admin.name'),
            __('controllers.actions'),
        ];

        $columnArray = [
            "{data: 'id',      name: 'id'},",
            "{data: 'label',   name: 'label'},",
            "{data: 'name',    name: 'name'},",
            "{data: 'actions', name: 'action', orderable: false, searchable: false, class:'text-center'}"
        ];

        $orderstring = "[[0,'desc']]";

        $this->gateCheck($request);

        return view('admin.table', compact('title', 'columnArray', 'columnHeaders', 'orderstring'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $formAction       = 'create';
        $submitButtonText = __('admin.create');
        $permissions      = Permission::pluck('label', 'id');
        $form = View::make('admin.patch', 
            compact('submitButtonText', 'formAction', 'permissions'))->render();
        
        $this->gateCheck($request);

        return response()->json(['error' => false, 'message' => null, 'form' => $form]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        // Get the request parameters
        $role = Role::create($request->all());
        $role->assignPermissions($request->permission_list);
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
        $permissions      = Permission::pluck('label', 'id');
        $url              = route($this->routeName.'.update', $role->id);
        $form             = View::make('admin.patch', compact('submitButtonText', 'formAction', 'formModel', 'url', 'permissions'))->render();
        
        $this->gateCheck($request);

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
        $role->assignPermissions($request->input('permission_list'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Role $role
     * @param  Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Role $role, Request $request) {
        
        $this->gateCheck($request);
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

        $this->gateCheck($request);
        $role = Role::withTrashed()->findOrFail($id);
        $role->restore();

        return $role;
    }
}
