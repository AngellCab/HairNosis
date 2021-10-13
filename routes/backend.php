<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataTableController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\DashboardController;

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

Route::get('/', [DashboardController::class,'dashboardEcommerce'])->name('dashboard-ecommerce');

Route::group(['prefix' => 'dashboard'], function () {
    Route::get('analytics', [DashboardController::class,'dashboardAnalytics'])->name('dashboard-analytics');
    Route::get('ecommerce', [DashboardController::class,'dashboardEcommerce'])->name('dashboard-ecommerce');
});

#Clients Routes
Route::post('clients/restore/{id}', [ClientController::class, 'restore'])->name('clients.restore');
Route::resource('clients', ClientController::class);

#Services Routes
Route::post('services/restore/{id}', [ServiceController::class, 'restore'])->name('services.restore');
Route::resource('services', ServiceController::class);

#Products Routes
Route::post('products/restore/{id}', [ProductController::class, 'restore'])->name('products.restore');
Route::resource('products', ProductController::class);

#Companies Routes
Route::post('locations/restore/{id}', [LocationController::class, 'restore'])->name('locations.restore');
Route::resource('locations', LocationController::class);

#Companies Routes
Route::post('companies/restore/{id}', [CompanyController::class, 'restore'])->name('companies.restore');
Route::resource('companies', CompanyController::class);

#User Routes
Route::post('users/restore/{id}', [UserController::class, 'restore'])->name('users.restore');
Route::resource('users', UserController::class);

#Permission Routes
Route::post('permissions/restore/{id}', [PermissionController::class, 'restore'])->name('permissions.restore');
Route::resource('permissions', PermissionController::class);

#Roles Rooutes
Route::post('roles/restore/{id}', [RoleController::class, 'restore'])->name('roles.restore');
Route::resource('roles', RoleController::class);

Route::get('datatable/resources', [DataTableController::class, 'datatable'])->name('datatables.resource');