<?php

namespace App\Http\Controllers\Auth1;

use App\Http\Controllers\Frontend\FrontendBaseController;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;


class AuthController extends FrontendBaseController {
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

use AuthenticatesAndRegistersUsers,
    ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/test';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct() {
        //$this->middleware($this->guestMiddleware(), ['except' => 'getLogout']);
        $this->middleware('user.guest', ['except' => 'getLogout']);        
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
                    'name' => 'required|max:255',
                    'email' => 'required|email|max:255|unique:users',
                    'password' => 'required|confirmed|min:6',
                    'terms' => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data) {
//        return User::create([
//                    'name' => $data['name'],
//                    'email' => $data['email'],
//                    'password' => bcrypt($data['password']),
//        ]);
        $user=User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => bcrypt($data['password']),
        ]);        
         $user->roles()->attach($data['user_role']); // id only   to assign role id to the created user;
         return $user;
    }

    public function getLogin() {

        return view('frontend.auth.login');
    }

    public function postLogin(Request $request) {

        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ];
        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames([
            'email' => 'email',
            'password' => 'password',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        } else {
            if ($request->input('remember')) {
                $remember = true;
            } else {
                $remember = false;
            }

            if (auth()->attempt(['email' => $request->input('email'), 'password' => $request->input('password')], $remember)) {
                return redirect('/dashboard');
            } else {
                session()->flash('error', 'Somethng wrong with your login data!');
                return redirect()->back();
            }
            // return $request->all();  
        }
    }

    public function getLogout() {
        Auth::logout();
        return redirect('/login');
    }

    public function getRegister() {
          
        return view('frontend.auth.register');
    }

}
