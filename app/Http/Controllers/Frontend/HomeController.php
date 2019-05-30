<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Frontend\FrontendBaseController;
use Config;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends FrontendBaseController {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();

    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index() {
  

        $this->data['title']='Web Page';
        return view(Config::get('front_theme').'.web',$this->data);
    }



}
