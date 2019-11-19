<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use App\Company;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

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
    protected $redirectTo = '/home';

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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:companies','unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'company'=>['required','string', 'unique:companies'],
            'phone'=>['required','string','unique:users'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        $user = new User;
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->company = $data['company'];
        $user->phone = $data['phone'];
        $user->role= 'admin';
        $user->save();
        if($data['company']!='msalecrm'){
            $this->createDB($data['company']);
            $this->migrateTables($data['company']);
            $newuser = $user->replicate();
            $newuser->id = $user->id;
            $newuser->save();
        }
        return $user;
    }

    public function createDB($company){
        if(!defined('STDIN'))  define('STDIN',  fopen('php://stdin',  'rb'));
        
        if(!defined('STDOUT')) define('STDOUT', fopen('php://stdout', 'wb'));
        
        if(!defined('STDERR')) define('STDERR', fopen('php://stderr', 'wb'));
        
        Artisan::call('db:create', ['name' => $company]);
    }

    public function migrateTables($company){
        Artisan::call('migrate:install');
        Artisan::call('migrate');
    }
}
