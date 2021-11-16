<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Location;
use App\Roles;
use Session;
use Auth;
use DB;

class DataTableController extends Controller
{
    /**
     * Used to display action buttons on datatable;
     * 
     */
    private $buttons = null;

    /**
     * route name
     * 
     */
    protected $routeName;

    /**
     * Process information from model
     * 
     */
    public function datatable(Request $request) {

        $this->routeName = $request->routeName;
        switch($this->routeName) {
            case '':
            break;
            default:
                return $this->{$this->routeName}($request);
            break;
        }
    }

    /**
     * users source data
     * 
     * @param Request $request
     */
    public function users($request) {

        $users = DB::table('users')
            ->where(function($query) use ($request) {
                #filters
                if ($request->has('status')) {
                    if ($request->status == 'active') {
                        $query->whereNull('deleted_at');
                    }
                    if ($request->status == 'inactive') {
                        $query->whereNotNull('deleted_at');
                    }
                }
            })
            ->select('users.*', DB::raw('CONCAT("Maintainer") as role'))->get();

        $table = Datatables::of($users)
            ->addColumn('actions', function($query) {
                
                $buttons = ['show', 'edit', 'delete'];
                if (!is_null($query->deleted_at)){
                    $buttons = ['restore'];
                }

                $id        = $query->id;
                $routeName = $this->routeName;

                return view('admin.actions', compact('buttons', 'id', 'routeName'));
            });

        return $table->make(true);
    }

    /**
     * Resource data table
     * 
     * @param Request $request
     */
    public function permissions($request) { 
        
        $permissions = DB::table('permissions')->select('*')->get();
        $table = Datatables::of($permissions)
            ->addColumn('actions', function($query) {

                $buttons = ['show', 'edit', 'delete'];
                if (!is_null($query->deleted_at)){
                    $buttons = ['restore'];
                }

                $id        = $query->id;
                $routeName = $this->routeName;

                return view('admin.actions', compact('buttons', 'id', 'routeName'));
            });

        return $table->make(true);
    }

    /**
     * Resource data table
     * 
     * @param Request $request
     */
    public function roles($request) { 
        
        $roles = DB::table('roles')->select('*')->get();
        $table = Datatables::of($roles)
            ->addColumn('actions', function($query) {

                $buttons = ['show', 'edit', 'delete'];
                if (!is_null($query->deleted_at)){
                    $buttons = ['restore'];
                }

                $id        = $query->id;
                $routeName = $this->routeName;

                return view('admin.actions', compact('buttons', 'id', 'routeName'));
            });

        return $table->make(true);
    }

    /**
     * Resource data table
     * 
     * @param Request $request
     */
    public function companies($request) { 
        
        $companies = DB::table('companies')->select('*')->get();
        $table = Datatables::of($companies)
            ->addColumn('actions', function($query) {

                $buttons = ['show', 'edit', 'delete'];
                if (!is_null($query->deleted_at)){
                    $buttons = ['restore'];
                }

                $id        = $query->id;
                $routeName = $this->routeName;

                return view('admin.actions', compact('buttons', 'id', 'routeName'));
            });

        return $table->make(true);
    }

    /**
     * Resource data table
     * 
     * @param Request $request
     */
    public function locations($request) { 
        
        $locations = DB::table('locations')
            ->where('company_id', Session::get('company_id'))
            ->select('*')->get();

        $table = Datatables::of($locations)
            ->addColumn('actions', function($query) {

                $buttons = ['show', 'edit', 'delete'];
                if (!is_null($query->deleted_at)){
                    $buttons = ['restore'];
                }

                $id        = $query->id;
                $routeName = $this->routeName;

                return view('admin.actions', compact('buttons', 'id', 'routeName'));
            });

        return $table->make(true);
    }

    /**
     * Resource data table
     * 
     * @param Request $request
     */
    public function products($request) {

        $products = DB::table('products')
            ->where('company_id', Session::get('company_id'))
            ->select('*')->get();
        
        $table = Datatables::of($products)
            ->editColumn('brand_id', function($query) {
                
                #Show the brand by name
                $brands = [
                    1 =>  'N/A', 
                    2 => 'Redken', 
                    3 => 'Loreal', 
                    4 => 'Kerestase'
                ];

                return $brands[$query->brand_id];
            })
            ->addColumn('actions', function($query) {

                $buttons = ['show', 'edit', 'delete'];
                if (!is_null($query->deleted_at)){
                    $buttons = ['restore'];
                }

                $id        = $query->id;
                $routeName = $this->routeName;

                return view('admin.actions', compact('buttons', 'id', 'routeName'));
            });

        return $table->make(true);
    }

    /**
     * Resource data table
     * 
     * @param Request $request
     */
    public function services($request)  {

        #Get all branches in current company
        $branches = Location::withTrashed()
            ->where('company_id', Session::get('company_id'))
            ->pluck('id');
        
        $services = DB::table('services')->whereIn('location_id', $branches)->select('*')->get();
        $table    = Datatables::of($services)
            ->addColumn('actions', function($query) {
                
                $buttons = ['show', 'edit', 'delete'];
                if (!is_null($query->deleted_at)){
                    $buttons = ['restore'];
                }

                $id        = $query->id;
                $routeName = $this->routeName;

                return view('admin.actions', compact('buttons', 'id', 'routeName'));
            });

        return $table->make(true);
    }

    /**
     * Resource data table
     * 
     * @param Request $request
     */
    public function clients($request) {
     
        $clients = DB::table('clients')
            ->leftJoin('locations', 'clients.location_id', '=', 'locations.id')
            ->leftJoin('users',     'clients.stylist_id',  '=', 'users.id')
            ->where(function($query) use ($request) {
                if (Auth::user()->isAdmin() || Auth::user()->isManager()) {

                    #Get all branches in current company
                    $branches = Location::withTrashed()
                        ->where('company_id', Session::get('company_id'))
                        ->pluck('id');

                    $query->whereIn('location_id', $branches);
                } else {
                    $query->where('location_id', Session::get('branch_id'));
                }

                if ($request->has('location_id') && $request->location_id > 0) {
                    $query->where('location_id', $request->location_id);
                }
            })
            ->select('clients.*', 'locations.name as location_name', 'users.name as stylist_name')->get();

        $table = Datatables::of($clients)
            ->editColumn('location_id', function($query) {
                return $query->location_name;
            })
            ->editColumn('stylist_id', function($query) {
                return $query->stylist_name;
            })
            ->addColumn('actions', function($query) {
                
                $buttons = ['show', 'edit', 'delete'];
                if (!is_null($query->deleted_at)){
                    $buttons = ['restore'];
                }

                $id        = $query->id;
                $routeName = $this->routeName;

                return view('admin.actions', compact('buttons', 'id', 'routeName'));
            });

        return $table->make(true);
    }

    /**
     * Resource data table
     * 
     * @param Request $request
     */
    public function stylists($request) {

        $stylists = DB::table('users')
            ->leftJoin('role_user', 'users.id', '=', 'role_user.user_id')
            ->where('role_user.company_id', Session::get('company_id'))
            ->where('role_user.role_id',    Roles::STYLIST)
            ->select('*')->get();

        $table = Datatables::of($stylists)
            ->addColumn('actions', function($query) {

                $buttons = ['show', 'edit', 'delete'];
                if (!is_null($query->deleted_at)){
                    $buttons = ['restore'];
                }

                $id        = $query->id;
                $routeName = $this->routeName;

                return view('admin.actions', compact('buttons', 'id', 'routeName'));
            });
        
        return $table->make(true);
    }
}
