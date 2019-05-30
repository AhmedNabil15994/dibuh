<?php

namespace App\Http\Controllers;

use App;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller {

    public function switchLang($lang, Request $request) {
  
        // if (array_key_exists($lang, Config::get('languages.available_locales'))) {
        //     Session::put('applocale', $lang);
        // }
        //
        // $strURIOld = route(Session::get('PreviousRoute'), [], false);
        // $oldURIArr = explode("/", $strURIOld);
        // $count = count($oldURIArr);
        // $redirectURI = [];
        // $locale = $request->segment(1);
        //
        // if (array_key_exists($locale, Config::get('languages.available_locales'))) {
        //         for ($i = 1; $i < $count; $i++) {
        //             if ($i == 1) {
        //                 $redirectURI[$i] = $lang;
        //             } else {
        //                 $redirectURI[$i] = $oldURIArr[$i];
        //             }
        //         }
        //
        // } else {
        //         $redirectURI[0] = $lang; // if $locale not found we add my selected language for first segment : $request->segment(1);
        //         for ($i = 1; $i < $count; $i++) {
        //             $redirectURI[$i] = $oldURIArr[$i];
        //         }
        //
        // }
        //     $newURIToRedirect = implode("/", $redirectURI);
        //     return redirect($newURIToRedirect);

    }

}
