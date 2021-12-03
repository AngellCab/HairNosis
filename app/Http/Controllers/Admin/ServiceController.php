<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Client;
use App\Models\User;
use App\Models\Product;
use App\Models\ClientHelper;
use Session;

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
            __('admin.treatments'),
            __('admin.actions'),
        ];

        $columnArray = [
            "{data: 'id',                 name: 'id'},",
            "{data: 'client_id',          name: 'client_id'},",     
            "{data: 'formula',            name: 'formula'},",  
            "{data: 'apply_date',         name: 'apply_date'},",         
            "{data: 'treatments',         name: 'treatments'},",
            "{data: 'actions',            name: 'actions', orderable: false, searchable: false}"
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

        $treatments =[
            '0' => 'Ninguno',
            '1' => 'Power Mix',
            '2' => 'Brazilian Blow Out',
            '3' => 'Shampoo Sencillo',
            '4' => 'Inoar Keratina',
            '5' => 'X-Tenso',
            '6' => 'Chemistry',
            '7' => 'PH Bonder',
            '8' => 'Heat Cure',
            '9' => 'Aura Botanica: Brillo saludable y natural',
            '10' => 'Elixir Ultime: Brillo sublime',
            '11' => 'Chronologiste: Regeneración',
            '12' => 'Desintoxicación del cabello: Ritual purificante',
            '13' => 'Protocolo para eliminar caspa',
            '14' => 'Ritual para eliminar la pérdida del cabello',
            '15' => 'Ritual Calmante para cuero cabelludo',
            '16' => 'Fusion Dose'
        ];

        $stylists = User::stylists()->pluck('name', 'hash');    
        $clients  = Client::company(Session::get('company_id'))->pluck('name', 'hash');
        $products = Product::whereCompanyId(Session::get('company_id'))->get()->groupBy('brand_id');
        $redken   = (isset($products[2])) ? $products[2]->pluck('name', 'hash') : [];
        $loreal   = (isset($products[3])) ? $products[3]->pluck('name', 'hash') : [];
        $kerestase= (isset($products[4])) ? $products[4]->pluck('name', 'hash') : [];
        $form     = View::make('admin.patch', 
            compact('submitButtonText', 'formAction', 'clients', 'stylists', 'treatments', 'redken', 'loreal', 'kerestase'))
            ->render();
        
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
        // Get the request parameters
        $redken    = ($request->redken_products == null) ? null : implode(',', $request->redken_products);
        $kerestase = ($request->kerestase_products == null) ? null : implode(',', $request->kerestase_products);
        $loreal    = ($request->loreal_products == null) ? null : implode(',', $request->loreal_products);

        $request['location_id']        = Session::get('branch_id');
        $request['redken_products']    = $redken;
        $request['kerestase_products'] = $kerestase;
        $request['loreal_products']    = $loreal;

        $client = Client::whereHash($request->client_id)->first();
        $request['client_id'] = $client->id;
        
        $service = Service::create($request->all());
        if ($request->has('stylist_helpers')) {
            foreach($request->stylist_helpers as $helper) {
                $stylist = User::whereHash($helper)->first();
                ClientHelper::create([
                    'client_id'   => $client->id,
                    'name'        => $client->name,
                    'email'       => $client->email,
                    'phone'       => $client->phone,
                    'location_id' => $client->location_id,
                    'stylist_id'  => $stylist->id,
                    'type'        => 1,
                    'status'      => 1,
                    'type_id'     => $service->id
                ]);
            }
        }

        return $service;
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

        $treatments =[
            '0' => 'Ninguno',
            '1' => 'Power Mix',
            '2' => 'Brazilian Blow Out',
            '3' => 'Shampoo Sencillo',
            '4' => 'Inoar Keratina',
            '5' => 'X-Tenso',
            '6' => 'Chemistry',
            '7' => 'PH Bonder',
            '8' => 'Heat Cure',
            '9' => 'Aura Botanica: Brillo saludable y natural',
            '10' => 'Elixir Ultime: Brillo sublime',
            '11' => 'Chronologiste: Regeneración',
            '12' => 'Desintoxicación del cabello: Ritual purificante',
            '13' => 'Protocolo para eliminar caspa',
            '14' => 'Ritual para eliminar la pérdida del cabello',
            '15' => 'Ritual Calmante para cuero cabelludo',
            '16' => 'Fusion Dose'
        ];

        $stylists  = User::stylists()->pluck('name', 'hash');    
        $clients   = Client::company(Session::get('company_id'))->pluck('name', 'hash');
        $products  = Product::whereCompanyId(Session::get('company_id'))->get()->groupBy('brand_id');
        $redken    = (isset($products[2])) ? $products[2]->pluck('name', 'hash') : [];
        $loreal    = (isset($products[3])) ? $products[3]->pluck('name', 'hash') : [];
        $kerestase = (isset($products[4])) ? $products[4]->pluck('name', 'hash') : [];

        $stylist_helpers_id = $service->stylistHelpers->pluck('stylist_id');
        $stylist_helpers    = User::whereIn('id', $stylist_helpers_id)->pluck('hash');
        $formModel = $service;
        $url       = route($this->routeName.'.update', $service->id);
        $form      = View::make('admin.patch', compact('submitButtonText', 'formAction', 'formModel', 'url',
            'stylists', 'clients', 'products', 'redken', 'loreal', 'kerestase', 'treatments', 'stylist_helpers'))->render();
        
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
    public function update(Request $request, Service $service)
    {
        $redken    = ($request->redken_products == null) ? null : implode(',', $request->redken_products);
        $kerestase = ($request->kerestase_products == null) ? null : implode(',', $request->kerestase_products);
        $loreal    = ($request->loreal_products == null) ? null : implode(',', $request->loreal_products);

        $request['location_id']        = Session::get('branch_id');
        $request['redken_products']    = $redken;
        $request['kerestase_products'] = $kerestase;
        $request['loreal_products']    = $loreal;

        $client = Client::whereHash($request->client_id)->first();
        $request['client_id'] = $client->id;

        if ($request->has('stylist_helpers')) {

            #Destroy all helpers
            $stylist_helpers = $service->stylistHelpers;
            foreach($stylist_helpers as $helper) {
                $helper->delete();
            }

            foreach($request->stylist_helpers as $helper) {
                $stylist = User::whereHash($helper)->first();
                ClientHelper::create([
                    'client_id'   => $client->id,
                    'name'        => $client->name,
                    'email'       => $client->email,
                    'phone'       => $client->phone,
                    'location_id' => $client->location_id,
                    'stylist_id'  => $stylist->id,
                    'type'        => 1,
                    'status'      => 1,
                    'type_id'     => $service->id
                ]);
            }
        }

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
        
        $this->gateCheck($request);
        
        #Destroy all helpers
        $stylist_helpers = $service->stylistHelpers;
        foreach($stylist_helpers as $helper) {
            $helper->delete();
        }

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

        $this->gateCheck($request);
        $service = Service::withTrashed()->findOrFail($id);
        $service->restore();

        #Destroy all helpers
        $stylist_helpers = $service->stylistHelpersDeleted;
        foreach($stylist_helpers as $helper) {
            $helper->restore();
        }

        return $service;
    }
}
