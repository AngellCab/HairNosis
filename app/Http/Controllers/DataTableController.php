<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use DB;

class DataTableController extends Controller
{
    /**
     * Used to display action buttons on datatable;
     */
    private $buttons = null;

    /**
     * route name
     * 
     * 
     */
    protected $routeName;

    /**
     * Process information from model
     */
    public function datatable(Request $request) {

        $this->routeName = $request->routeName;
        switch($this->routeName) {
            case 'model':
            break;
            default:
                return $this->{$this->routeName}($request);
            break;
        }
    }

    /**
     * users source data
     * 
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

    public function locations($request) { 
        
        $locations = DB::table('locations')->select('*')->get();
        $table     = Datatables::of($locations)
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

    public function products($request) {

        $products = DB::table('products')->select('*')->get();
        $table    = Datatables::of($products)
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

    public function services($request)  {

        $services = DB::table('services')->select('*')->get();
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

    public function clients($request) {

        $clients = DB::table('clients')->select('*')->get();
        $table   = Datatables::of($clients)
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
