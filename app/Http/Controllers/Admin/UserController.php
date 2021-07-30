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
            __('admin.id'),
            __('admin.name'),
            __('admin.email'),
            __('admin.phone'),
            __('admin.roles'),
            __('admin.actions'),
        ];

        $columnArray = [
            "{data: 'id',       name: 'id'},",
            "{data: 'name',     name: 'name'},",
            "{data: 'email',    name: 'email'},",
            "{data: 'phone',    name: 'phone'},",
            "{data: 'role',     name: 'role'},",
            "{data: 'actions',  name: 'actions', orderable: false, searchable: false}"
        ];

        $filters = [
            [
                'idname'    => 'location_id',
                'label'     => __('admin.locations'),
                'width'     => 'col-md-4',
                'listArray' => [],
                'data'      => "data-zones = 'true'",
                'ignore'    => 'true',
                'datacall'  => "d.location_id = $('select[name=location_id]').val();",
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
        $submitButtonText = trans('create');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
