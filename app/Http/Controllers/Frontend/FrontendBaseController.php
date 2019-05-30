<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\BasePublicController;
use Config;
/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class FrontendBaseController extends BasePublicController {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $baseFront = "Var  BaseFrontController";
    protected $dashboardPath = '' ;


    public function __construct() {
        parent::__construct();
        $this->dashboardPath = Config::get('front_theme') . '.dashboard' ;
    }

    public function view($name, $vars) {
        return view(Config::get('front_theme') . $name, $vars);
    }

}
