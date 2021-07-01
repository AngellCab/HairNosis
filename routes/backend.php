<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Http\Controllers\DataTableController;

/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('angel', function() {
    echo "backend";
});

Route::get('datatable/resources', [DataTableController::class, 'datatable'])->name('datatables.resource');