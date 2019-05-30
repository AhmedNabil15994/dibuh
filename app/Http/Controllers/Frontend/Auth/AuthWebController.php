<?php
namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Frontend\FrontendBaseController;
use App\Models\User;
use App\Models\UserProfile as Profile;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ActivationService; // for email
use App\Http\Requests;
use Response;
use Auth;
use Config;
use Socialite;
use Carbon;
use App\Models\Setting;
use View;
use Input;
use Hash;
use App\Models\SalesInvoice;
use Socialize;
 

class AuthWebController extends FrontendBaseController {
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


    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '';
    protected $activationService;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(ActivationService $activationService , Socialite $socialite) {
        //$this->middleware($this->guestMiddleware(), ['except' => 'getLogout']);
        $this->middleware('user.guest', ['except' => 'getLogout']);
        $this->activationService = $activationService; // this for email 
        $this->socialite = $socialite;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
               //     'name' => 'required|max:255',
                    'email' => 'required|email|max:255|unique:users',
                    'password' => 'required|confirmed|min:6',
                    'terms' => 'required',
                    'captcha' => 'required|captcha',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */

    public function getPlans(Request $request){
     $plan =  \DB::table('price_plans')->where('id','=',$request->id)->first();
     $discount = $plan->discount;
     
     if($discount == 0){
      $price = $plan->price;

     }else{
      $price = $plan->price - ($plan->price * $plan->discount/100);
     }
      return "\nالمدة : ".$plan->period."\n"."السعر : ".$price." جنيها \n"."التحديثات : ".$plan->updates."\n"."الدعم الفني : ".$plan->avail_support."\n";
    }

    protected function create(array $data , $governorate_id , $country_id) {
        $user = User::create([
                    'email' => $data['email'],
                    'password' => bcrypt($data['password']),
                    'is_activated' => 0,

        ]);
        $user->roles()->attach($data['user_role']); // id only   to assign role id to the created user;

        $expireDate = Carbon::today()->addWeeks(1)->toDateString(); // add 1 week from Register Date for expire Date in user profile

        $profile = new Profile(array(
            'user_status_id' => 3,
            'expire_date' => $expireDate,
            'company'     => $data['company'],
            'employees'   => $data['employees'],
            'company_type_id' => $data['company_type_id'],
            'first_name'  => $data['first_name'],
            'last_name'   => $data['last_name'],
            'phone'     => $data['phone'],
            'postal_code'  => $data['postal_code'],
            'address'   => $data['address'],
            'district'   => $data['district'],
            'governorate_id'     => $governorate_id,
            'country_id'  => $country_id,
            'comercial_no'   => $data['commercial_no'],
            'tax_file_no'   => $data['tax_file_no'],
            'tax_no'     => $data['tax_no'],
            'price_plan_id' => $data['price_plan_id'], 
        ));

        
         $user->profile()->save($profile);        
        return $user;
    }

    public function getLogin() {

        return view(Config::get('front_theme') . '.auth.login');
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
                    $user=User::where('email',$request->input('email'))->first();
                    $user->last_login_at = \Carbon::now();
                    $user->save();                
                return redirect(route('dashboard.index'));
            } else {
                session()->flash('error', 'Somethng wrong with your login data!');
                return redirect()->back();
            }
            // return $request->all();  
        }
    }

    public function getLogout() {
        Auth::logout();
       // return redirect(route('login'));
        return redirect(route('home.index'));        
    }

    public function getRegister() {
        $this->data['terms']= Setting::where('key','=','terms_conditions')->first()->value;

        return view(Config::get('front_theme') . '.auth.register',$this->data);
    }

    public function register(Request $request) {
      $masterRules =[
          'email' => 'required|email|unique:users',
          'password'=>'required|min:6',
          'password_confirmation' => 'required|min:6|same:password',
          'terms' => 'required',
          'captcha' => 'required',
      ];
      $validator = $this->validator($request->all(), $masterRules);

        if ($validator->fails()) {
           
             return Response::json(array(
                  'success' => false,
                  'errors' => $validator->getMessageBag()->toArray()

              ), 400); // 400 being the HTTP code for an invalid request.
                      
        }
        $govern_name = $request->governorate;
        $country_name = $request->country;

        $governorates = \DB::table("governorates")->where('name_en','like', '%'.$govern_name.'%' )->first(); 
        $countries = \DB::table("countries")->where('name_en','like', '%'.$country_name.'%' )->first(); 
        
        $governorate_id = $governorates->id;
        $country_id     = $countries->id;

        $user = $this->create($request->all(),$governorate_id,$country_id);
        $this->activationService->sendActivationMail($user);
        
    }

    public function authenticated(Request $request, $user) {
        if (!$user->activated) {
            $this->activationService->sendActivationMail($user);
            auth()->logout();
            return back()->with('warning', 'You need to confirm your account. We have sent you an activation code, please check your email.');
        }
        return redirect()->intended($this->redirectPath());
    }

    public function activateUser($token) {
        if ($user = $this->activationService->activateUser($token)) {
            auth()->login($user);
            return redirect(route('dashboard'));
        }
        abort(404);
    }


    public function redirectToProvider($provider=null){
      return Socialite::driver($provider)->redirect();
    }
    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider=null){
        $user = Socialite::driver($provider)->user();
       
        $exist_user = User::where('email', '=', $user->getEmail())->first();
        if ($exist_user === null) {
          $new = new User;
          $new->name = $user->getName();
          $new->activated;
          $new->email = $user->getEmail();
          $new->password = bcrypt("socialite");
          $new->is_activated = 1;
          $new->is_admin=0;
          $new->last_login_at= \Carbon::now();
          $new->save();
          $value = 2;
          $new->attachRole($value);
          $expireDate = Carbon::today()->addWeeks(1)->toDateString(); 
          $profile = new Profile(array(
              'user_status_id' => 3,
              'expire_date' => $expireDate,
          ));
          $new->profile()->save($profile);        
          
        }
        
        if (auth()->attempt(['email' => $user->getEmail(), 'password' => "socialite"])) {
                    $user=User::where('email',$user->getEmail())->first();
                    $user->last_login_at = \Carbon::now();
                    $user->save();     

                    
                    $this->data['page_title'] = trans('frontend/dashboard.main_dashboard');
            
                    $this->data['invoices']=SalesInvoice::take(5)->get();
                    $this->data['user']= 'user id:' .Auth::user()->id . ' user :' .Auth::user()->name .'<hr><br/>'.Auth::user()->roles;
                    $userType = 'user';
                    $this->data['page_title']=$userType.' Dashboard';
                    
                    $this->data['date_now']=\Carbon\Carbon::now();
                    //return view(Config::get('front_theme') . '.dashboard'.'.user'.'.dashboard' , $this->data);               
                    return redirect()->route('users.main');
            } else {
                session()->flash('error', 'Somethng wrong with your login data!');
                return redirect()->back();
            }
    }


    public function redirectToProvider2(){
      return Socialize::with('graph')->redirect();
    }

    public function handleProviderCallback2(){
        $user = Socialize::with('graph')->user();
        
        $exist_user = User::where('email', '=', $user->getEmail())->first();
        if ($exist_user === null) {
          $new = new User;
          $new->name = $user->getName();
          $new->activated;
          $new->email = $user->getEmail();
          $new->password = bcrypt("socialite");
          $new->is_activated = 1;
          $new->is_admin=0;
          $new->last_login_at= \Carbon::now();
          $new->save();
          $value = 2;
          $new->attachRole($value);
          $expireDate = Carbon::today()->addWeeks(1)->toDateString(); 
          $profile = new Profile(array(
              'user_status_id' => 3,
              'expire_date' => $expireDate,
          ));
          $new->profile()->save($profile);        
          
        }
        
        if (auth()->attempt(['email' => $user->getEmail(), 'password' => "socialite"])) {
                    $user=User::where('email',$user->getEmail())->first();
                    $user->last_login_at = \Carbon::now();
                    $user->save();     

                    
                    $this->data['page_title'] = trans('frontend/dashboard.main_dashboard');
            
                    $this->data['invoices']=SalesInvoice::take(5)->get();
                    $this->data['user']= 'user id:' .Auth::user()->id . ' user :' .Auth::user()->name .'<hr><br/>'.Auth::user()->roles;
                    $userType = 'user';
                    $this->data['page_title']=$userType.' Dashboard';
                    
                    $this->data['date_now']=\Carbon\Carbon::now();
                    //return view(Config::get('front_theme') . '.dashboard'.'.user'.'.dashboard' , $this->data);               
                    return redirect()->route('users.main');
            } else {
                session()->flash('error', 'Somethng wrong with your login data!');
                return redirect()->back();
            }
    }
}
