<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Client;
use App\Models\Location;
use App\Models\Appointment;
use Session;

class AppointmentController extends Controller
{
    /**
     * Table prefix
     *
     * @var string
     */
    protected $routeName = 'appointments';

    /**
     * Permission name
     */
    protected $permissionName = 'admin.appointments';

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
        $title = 'admin.appointments';

        $columnHeaders = [
            __('admin.id'),
            __('admin.client'),
            __('admin.phone'),
            __('admin.apply_date'),
            __('admin.hour'),
            __('admin.status'),
            __('admin.actions'),
        ];

        $columnArray = [
            "{data: 'id',         name: 'id'},",
            "{data: 'client_id',  name: 'client_id'},",     
            "{data: 'phone',      name: 'phone'},",  
            "{data: 'apply_date', name: 'apply_date'},",        
            "{data: 'hour',       name: 'hour'},",
            "{data: 'status',     name: 'status'},",
            "{data: 'actions',    name: 'actions', orderable: false, searchable: false}"
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

        $company_id = Session::get('company_id');
        $clients    = Client::company($company_id)->pluck('name', 'hash');
        $locations  = Location::Fromcompany($company_id)->pluck('name', 'hash');
        $status     = [
            '0' => 'Pendiente',
            '1' => 'Confirmado',
            '2' => 'Cancelado'
        ];

        $form = View::make('admin.patch', compact('submitButtonText', 'formAction', 'clients', 'locations', 'status'))->render();
    
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
        $client   = Client::where('hash', $request->client_id)->first();
        $location = Location::where('hash', $request->location_id)->first();

        $request['client_id']   = $client->id;
        $request['location_id'] = $location->id;

        Appointment::create($request->all());
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
    public function edit(Appointment $appointment, Request $request)
    {
        $formAction       = 'update';
        $submitButtonText = __('admin.update');

        $company_id = Session::get('company_id');
        $formModel  = $appointment;
        $clients    = Client::company($company_id)->pluck('name', 'hash');
        $locations  = Location::Fromcompany($company_id)->pluck('name', 'hash');
        $url        = route($this->routeName.'.update', $appointment->id);
        $status     = [
            '0' => 'Pendiente',
            '1' => 'Confirmado',
            '2' => 'Cancelado'
        ];

        $form = View::make('admin.patch', compact('submitButtonText', 'formAction', 'formModel' ,'clients', 'locations', 'status', 'url'))->render();
    
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
    public function update(Request $request, Appointment $appointment)
    {
        $client   = Client::where('hash', $request->client_id)->first();
        $location = Location::where('hash', $request->location_id)->first();

        $request['client_id']   = $client->id;
        $request['location_id'] = $location->id;
        
        $appointment->update($request->except('hash'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Service $service
     * @param  Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Appointment $appointment, Request $request) {
        
        $this->gateCheck($request);
        $appointment->delete();
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
        $appointment = Appointment::withTrashed()->findOrFail($id);
        $appointment->restore();
        
        return $appointment;
    }
}
