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
     * Process information from model
     */
    public function datatable(Request $request) {

        $routeName = $request->routeName;
        switch($routeName) {
            case 'model':
                
            break;
            default:
                return $this->{$routeName}($request);
                break;
        }
    }

    public function users($request) {

        $users = DB::table('users')->get();
        $table = Datatables::of($users);

        return $table->make(true);
    }
}
