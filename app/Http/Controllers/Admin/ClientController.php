<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Models\Client;
use Auth;

class ClientController extends Controller
{
    /**
     * Table/Route prefix
     *
     * @var string
     */
    protected $routeName = 'clients';

    /**
     * Role string
     *
     * @var string
     */
    protected $permissionName = 'admin.clients';
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
        
        $title = 'Clients';

        $columnHeaders = [
            ' Id',
            __('nicenames.name'),
            __('nicenames.phone'),
            __('nicenames.email'),
            __('nicenames.location'),
            __('nicenames.stylist'),
            __('controllers.actions')
        ];

        $columnArray = [
            "{data: 'id',          name: 'id'},",
            "{data: 'name',        name: 'name'},",
            "{data: 'phone',       name: 'phone'},",
            "{data: 'email',       name: 'email'},",
            "{data: 'location_id', name: 'location_id'},",
            "{data: 'stylist_id',  name: 'stylist_id'},",
            "{data: 'actions',     name: 'action', orderable: false, searchable: false, class:'text-center'}"
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
        Client::create($request->all());
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param Client $client
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function edit(Client $client, Request $request)
    {
        $formAction       = 'update';
        $submitButtonText = __('admin.update');
        $formModel        = $client;
        $url              = route($this->routeName.'.update', $client->id);
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
    public function update(Request $request, Client $client)
    {
        // Get the request parameters
        $client->update($request->except('owner_id'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Client $client
     * @param  Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Client $client, Request $request) {
        
        //this->gateCheck($request);
        $client->delete();
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
        $client = Client::withTrashed()->findOrFail($id);
        $client->restore();

        return $client;
    }
}
