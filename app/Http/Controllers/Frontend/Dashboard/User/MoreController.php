<?php

namespace App\Http\Controllers\Frontend\Dashboard\User;

use Illuminate\Http\Request;
//use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\Dashboard\DashboardBaseController;
use Auth;
use App\Models\User;
use App\Models\UserProfile As Profile;
use App\Models\Cost;
use App\Models\InvoiceStatus;
use App\Models\Contact;
use App\Models\Account;
use App\Models\UserFile;
use Config;
use Carbon;
use View;
use Illuminate\Contracts\Encryption\DecryptException;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class MoreController extends DashboardBaseController {

    protected $userType = 'user';
    protected $module = 'more';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
        View::share('userType', $this->userType);
        View::share('module', $this->module);
    }

    public function main(Request $request) {
        $this->data['page_title'] = trans('frontend/more.title');

        return $this->view($this->userType . '.' . $this->module . '.' . 'main', $this->data);
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index() {

        $this->data['page_title'] = $this->userType . ' Dashboard';
        return $this->view($this->userType . '.dashboard', $this->data);
    }

}
