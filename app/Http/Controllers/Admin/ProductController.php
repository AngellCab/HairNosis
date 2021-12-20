<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Helpers\Brands;
use Session;

class ProductController extends Controller
{
    /**
     * Table prefix
     *
     * @var string
     */
    protected $routeName = 'products';

    /**
     * Permission name
     */
    protected $permissionName = 'admin.products';

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
        $title = 'admin.products';

        $columnHeaders = [
            __('admin.id'),
            __('admin.name'),
            __('admin.brand'),
            __('admin.url_image'),
            __('admin.actions'),
        ];

        $columnArray = [
            "{data: 'id',        name: 'id'},",
            "{data: 'name',      name: 'name'},",
            "{data: 'brand_id',  name: 'brand_id'},",         
            "{data: 'url_image', name: 'url_image'},",
            "{data: 'actions',   name: 'actions', orderable: false, searchable: false}"
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
        $brands = [Brands::NA => 'N/D', Brands::REDKEN => 'Redken', Brands::LOREAL => 'Loreal', Brands::KERESTASE => 'Kerestase'];
        $form   = View::make('admin.patch', compact('submitButtonText', 'formAction', 'brands'))->render();

        $this->gateCheck($request);

        return response()->json(['error' => false, 'message' => null, 'form' => $form]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        // Get the request parameters
        Product::create([
            'name'       => $request->name,
            'brand_id'   => $request->input('brand_id', 0),
            'company_id' => Session::get('company_id'),
            'url_image'  => $request->url_image
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Product $product
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function edit($id, Request $request)
    {
        $formAction       = 'update';
        $submitButtonText = __('admin.update');
        $product          = Product::whereHash($id)->first();
        $formModel        = $product;
        $url              = route($this->routeName.'.update', $product->hash);
        $brands = [Brands::NA => 'N/D', Brands::REDKEN => 'Redken', Brands::LOREAL => 'Loreal', Brands::KERESTASE => 'Kerestase'];
        $form   = View::make('admin.patch', compact('submitButtonText', 'formAction', 'formModel', 'url', 'brands'))->render();
        
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
    public function update(Request $request, $id)
    {
        // Get the request parameters
        $product = Product::whereHash($id)->first();
        $product->update($request->except(['company_id', 'hash']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Product $product
     * @param  Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id, Request $request) {
        
        $this->gateCheck($request);
        $product = Product::whereHash($id)->first();
        $product->delete();
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
        $product = Product::withTrashed()->whereHash($id)->first();
        $product->restore();

        return $product;
    }
}
