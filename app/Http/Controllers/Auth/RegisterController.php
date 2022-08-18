<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Mail\UserCreatedMail;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


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
    protected $redirectTo = RouteServiceProvider::ADD_USERS;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // $data['name'] = $data['fname'] ." ". $data['lname'];
        $data['password']= \Str::random(8);
        return Validator::make($data, [
            'firstname' => 'required|regex:/^[a-zA-Z]+$/u|max:255|unique:users,name,',
            'lastname' => 'required|regex:/^[a-zA-Z]+$/u|max:255|unique:users,name,',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'phonenumber'=> ['required', 'string', 'max:10','min:10'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data )
    {   
        $data['name'] = $data['firstname'] ." ". $data['lastname'];
        $data['password']= \Str::random(8);
        $mailpassword=$data['password'];

        $result = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phnumber'=>$data['phonenumber'],
        ]);
        if($result)
         {   
            $result->mailpassword=$mailpassword;
            \Mail::to($result->email)->send(new UserCreatedMail($result));
            session()->flash('success','User successfully registered');
            return $result;
        }
    }
}
