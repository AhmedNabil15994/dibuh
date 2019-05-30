<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use App\Http\Controllers\Frontend\FrontendBaseController;
use Config;
use DB;
use Auth;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class DashboardBaseController extends FrontendBaseController {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $baseFront = "Var  BaseFrontController";

    public function __construct() {
        parent::__construct();
        //$this->checkExpireDate();
    }

    public function view($name, $vars) {
        return view(Config::get('front_theme') . '.dashboard.' . $name, $vars);
    }

    public function checkExpireDate() {
        $today = \Carbon\Carbon::today()->toDateString();
        $expireDate = Auth::user()->profile->expire_date;

        $today_time = strtotime($today);
        $expire_time = strtotime($expireDate);

        if ($expire_time <= $today_time) {

            $userStatus = Auth::user()->profile->user_status_id;
            if ($userStatus != 2) {
                DB::table('user_profiles')->where('user_id', Auth::user()->id)->update(['user_status_id' => 2]);
                return redirect(Config::get('settings.backend_route') . '/dashboard');
            }
        }
    }

}
