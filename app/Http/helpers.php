<?php

function apiBaseUrl()
{
  return '/api/v1';
}

function can($action,$model = null) //For Authorizations
{
  if ($model == null)
    return auth()->user()->can($action);

  return auth()->user()->can($action,$model);
}

function getParam($param)
{
  $paramValue = \Request::get($param);
  return $paramValue;
}

function getRouteParam($param)
{
  if ( array_key_exists($param, \Route::current()->parameters() )) {
    return \Route::current()->parameters()[$param];
  }else{
    return '';
  }
}


function rr() {
    echo '<pre>';
    array_map(function($x) {
        print_r($x);
    }, func_get_args());

    echo '</pre>';
}


function curl_get_file_contents($URL) { //send request for api urls and recieve response
    $c = curl_init();
    curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($c, CURLOPT_URL, $URL);
    $contents = curl_exec($c);
    $err  = curl_getinfo($c,CURLINFO_HTTP_CODE);
    curl_close($c);
    if ($contents) return $contents;
    else return FALSE;
}

function get_last_query() { // get query sql excuted for debugging
  // you must use this line first
    // \DB::connection()->enableQueryLog();
    // i used it in appserviceprovider

  $queries = DB::getQueryLog();
  $sql = end($queries);

  if( ! empty($sql['bindings']))
  {
    $pdo = DB::getPdo();
    foreach($sql['bindings'] as $binding)
    {
      $sql['query'] =
        preg_replace('/\?/', $pdo->quote($binding),
          $sql['query'], 1);
    }
  }

  return $sql['query'];
}

// check if some keys are nested and exist in a given array
function check_nested_keys_in_array($array = [],$keys = [])
{
  $keysCount = count($keys);

  for ($i=0; $i < $keysCount; $i++) {
     if (array_key_exists($keys[$i],$array)) {
      if ($i == $keysCount - 1) {
          return true;
      }
      if (is_array($array[ $keys[$i] ]) ) {
         $array = $array[ $keys[$i] ]; // make array hold the current array with current key
      }else{
        return false;
      }
    }else{
      return false;
    }
  }
}

function array_map_assoc($callback, $array )
{
  $r = array();
  foreach ($array as $key=>$value)
    $r[$key] = $callback($key,$value);
  return $r;
}

function getModelFillables($modelName) {
  return App::make($modelName)->getFillable();
}

function getEmbedYoutube($string) {
    return preg_replace(
        "/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
        "https://www.youtube.com/embed/$2",
        $string
    );
}

function localizeDate($date)
{
  $locale = App::getLocale();

  switch ($locale) {
    case 'en':
        return $date;
      break;

    case 'ar':

          $smallDays           = [ "Sat", "Sun", "Mon", "Tue", "Wed" , "Thu", "Fri" ];
          $arDays              = [ "السبت", "الأحد", "الإثنين", "الثلاثاء", "الأربعاء", "الخميس", "الجمعة" ];
          $date                = str_replace($smallDays, $arDays, $date);

          $smallMonths         = [ "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec" ];
          $arMonths            = [ "يناير", "فبراير", "مارس", "أبريل", "مايو", "يونيو", "يوليو", "أغسطس", "سبتمبر", "أكتوبر", "نوفمبر", "ديسمبر" ];
          $date                = str_replace($smallMonths, $arMonths, $date);

          header('Content-Type: text/html; charset=utf-8');
          $standard_nums       = [ "0","1","2","3","4","5","6","7","8","9" ];
          $eastern_arabic_nums = [ "٠","١","٢","٣","٤","٥","٦","٧","٨","٩" ];
          $date                = str_replace($standard_nums , $eastern_arabic_nums , $date);

          $enAmPm              = [ "AM" , "PM" ];
          $arAmPm              = [ "ص" , "م" ];
          $date                = str_replace($enAmPm , $arAmPm , $date);

        return $date;
      break;

    default:
        return $date;
      break;
  }
}

function is_base64($s){
    // Check if there are valid base64 characters
    if (!preg_match('/^[a-zA-Z0-9\/\r\n+]*={0,2}$/', $s)) return false;

    // Decode the string in strict mode and check the results
    $decoded = base64_decode($s, true);
    if(false === $decoded) return false;

    // Encode the string again
    if(base64_encode($decoded) != $s) return false;

    return true;
}

//to check if array has duplicated values or not.
function array_has_dupes($array) {
   return count($array) !== count(array_unique($array));
}

//to fix the New Version of Chrome issue, as it cannot render dd function in network preview window (inspect element)
function ddd($args){
    http_response_code(500);
    call_user_func_array('dd', $args);
}
