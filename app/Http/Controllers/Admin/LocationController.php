<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Models\Location;
use Session;
use Auth;

class LocationController extends Controller
{
    /**
     * Table/Route prefix
     *
     * @var string
     */
    protected $routeName = 'locations';

    /**
     * Role string
     *
     * @var string
     */
    protected $permissionName = 'admin.branches';
    
    /**
     * Error message when auth fails
     *
     * @var string
     */
    protected $permissionError = 'Error';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'admin.locations';

        $columnHeaders = [
            ' Id',
            __('nicenames.name'),
            __('nicenames.phone'),
            __('nicenames.email'),
            __('nicenames.address'),
            __('controllers.actions'),
        ];

        $columnArray = [
            "{data: 'id',         name: 'id'},",
            "{data: 'name',       name: 'name'},",
            "{data: 'phone',      name: 'phone'},",
            "{data: 'email',      name: 'email'},",
            "{data: 'address',    name: 'address'},",
            "{data: 'actions',    name: 'action', orderable: false, searchable: false, class:'text-center'}"
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
        $form             = View::make('admin.patch', compact('submitButtonText', 'formAction'))->render();
        
        $this->gateCheck($request);

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
        $manager_id = ($request->has('manager_id')) ? $request->manager_id : Auth::id();

        // Get the request parameters
        Location::create([
            'name'       => $request->name,
            'address'    => $request->address,
            'phone'      => $request->phone,
            'email'      => $request->email,
            'company_id' => Session::get('company_id'),
            'manager_id' => $manager_id
        ]);
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
     * @param Location $location
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $formAction       = 'update';
        $submitButtonText = __('admin.update');
        $location         = Location::whereHash($id)->first();
        $formModel        = $location;
        $url              = route($this->routeName.'.update', $location->hash);
        $form             = View::make('admin.patch', compact('submitButtonText', 'formAction', 'formModel', 'url'))->render();
        
        $this->gateCheck($request);

        return response()->json(['error' => false, 'message' => null, 'form' => $form]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Location $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $location = Location::whereHash($id)->first();
        $location->update($request->except(['company_id', 'manager_id']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Location $location
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $this->gateCheck($request);
        $location = Location::whereHash($id)->first();
        $location->delete();
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
        $location = Location::withTrashed()->whereHash($id)->first();
        $location->restore();

        return $location;
    }
}
