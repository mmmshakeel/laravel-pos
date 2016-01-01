<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Staff;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectPath = '/dashboard';
    // protected $loginPath = '/login';
    protected $username = 'login_name';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
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
            'code' => 'required',
            'title' => 'required',
            'first_name' => 'required|max:120',
            'gender' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
            'address' => 'required',
            'city' => 'required',
            'contact_person_title' => 'required',
            'scontact_person_first_name' => 'required',
            'contact_person_relation' => 'required',
            'contact_person_contact_no' => 'required',
            'login_name' => 'required|max:100',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {


    }
}
