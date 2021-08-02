<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Table prefix
     *
     * @var string
     */
    protected $routeName = 'users';

    /**
     * Permission name
     */
    protected $permissionName = 'admin.users';

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
        $title   = 'admin.users';

        $columnHeaders = [
            __('admin.name'),
            __('admin.email'),
            __('admin.phone'),
            __('admin.roles'),
            __('admin.status'),
            __('admin.actions'),
        ];

        $columnArray = [
            "{data: 'name',     name: 'name'},",
            "{data: 'email',    name: 'email'},",
            "{data: 'phone',    name: 'phone'},",
            "{data: 'role',     name: 'role'},",
            "{data: 'deleted_at',  name: 'deleted_at'},",            
            "{data: 'actions',  name: 'actions', orderable: false, searchable: false}"
        ];

        $filters = [
            [
                'idname'      => 'status',
                'label'       => __('admin.status'),
                'width'       => 'col-md-4',
                'listArray'   => ['active' => __('admin.active'), 'inactive' => __('admin.inactive')],
                'placeholder' => __('admin.select_a_role'),
                'datacall'    => "d.status = $('select[name=status]').val();",
            ]
        ];

        $orderstring = "[[0,'desc']]";
        // $this->gateCheck($request);

        return view('admin.table', compact('title', 'columnArray', 'columnHeaders', 'orderstring', 'filters'));
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
        
        //$this->gateCheck($request);

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
        $name        = $request->input('name');
        $email       = $request->input('email');
        $password    = $request->input('password');
        $phone       = $request->input('phone');
        $view_report = true;

        if (!empty($password)) {
            $password = bcrypt($password);
            $user     = User::create(compact('name', 'email', 'password', 'phone', 'view_report'));
            // $user->assignRoles($request->input('role_list'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User $user
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function edit(User $user, Request $request)
    {
        $formAction       = 'update';
        $submitButtonText = __('admin.update');
        $formModel        = $user;
        $url              = route($this->routeName.'.update', $user->id);
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
    public function update(Request $request, User $user)
    {
        // Get the request parameters
        $name        = $request->input('name');
        $email       = $request->input('email');
        $password    = $request->input('password');
        $phone       = $request->input('phone');
        $view_report = true;
 
        if (!empty($password)) {
            $password = bcrypt($password);
            $user->update(compact('name', 'surname', 'email', 'password', 'phone'));
        } else {
            $user->update($request->except('password'));
        }
         
        // $user->assignRoles($request->input('role_list'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User $user
     * @param  Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(User $user, Request $request) {
        
        $this->gateCheck($request);
        $user->delete();
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
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();

        return $user;
    }
}
