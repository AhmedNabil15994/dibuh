<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BasePublicController;
use Config;
/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class BackendBaseController extends BasePublicController {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $baseFront = "Var  BaseFrontController";
    protected $rowPerPage = '';

    public function __construct() {
        parent::__construct();
        $this->rowPerPage=10;
    }

    public function view($name, $vars) {
        return view(Config::get('back_theme') . '.' . $name, $vars);
    }

}
