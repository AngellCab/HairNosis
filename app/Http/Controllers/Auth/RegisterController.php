<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Company;
use App\Roles;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'     => ['required', 'string',  'max:255'],
            'email'    => ['required', 'string',  'email', 'max:255', 'unique:users'],
            'phone'    => ['required', 'numeric', 'unique:users'],
            'password' => ['required', 'string',  'min:8', 'confirmed'],

            #Company fields required
            'company_name'  => ['required', 'string', 'max:255'],
            'address'       => ['required', 'string', 'max:255'],
            'company_phone' => ['required', 'numeric'],
            'company_email' => ['required', 'string', 'email'],
            'policies'      => ['accepted']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        #Create new user
        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'phone'    => $data['phone'],
            'password' => Hash::make($data['password']),
        ]);

        #Create a new company
        $company = Company::create([
            'name'     => $data['company_name'], 
            'address'  => $data['address'],
            'phone'    => $data['company_phone'],
            'email'    => $data['company_email'],
            'owner_id' => $user->id
        ]);

        #Assign Role and location to this user
        $locationDefault = 0;
        $user->assignRoles($company->id, [$locationDefault], [Roles::OWNER]);

        return $user;
    }

    // Register
    public function showRegistrationForm()
    {
        $pageConfigs = ['blankPage' => true];

        return view('/auth/register', [
            'pageConfigs' => $pageConfigs
        ]);
    }
}
