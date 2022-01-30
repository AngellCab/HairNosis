<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\Client;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/createToken', function(Request $request) {

    // $request->validate([
    //     'email' => 'required|email',
    //     'password' => 'required',
    //     'device_name' => 'required',
    // ]);

    $user = Client::where('email', $request->email)->first();
    // if (!$user || ! Hash::check($request->password, $user->password)) {
    //     throw ValidationException::withMessage(['email' => ['The provided credentials are incorrect']]);
    // }

    return $user->createToken($request->input('device_name', $user->name))->plainTextToken;
});

Route::middleware('auth:sanctum')->get('client', function(Request $request) {

    $user = Client::where('email', $request->email)->first();
    return $user;
});
