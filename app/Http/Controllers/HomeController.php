<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BasePublicController;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends BasePublicController {

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
        $this->data['title']='home Page';
        return $this->view('welcome',$this->data);
    }



}
