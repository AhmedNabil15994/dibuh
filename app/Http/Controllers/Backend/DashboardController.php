<?php namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Http\Requests;
use Illuminate\Http\Request;
use Config;
use Storage;
use File;
/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

      //   $this->middleware('admin_auth');
      //  $this->middleware('auth');
       // $this->middleware('user_type:admin');

    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {

        return view(Config::get('back_theme').'.home');
    }

    public function change(Request $requst){

       //return Storage::copy(resource_path('views\frontend\u_bold\en\web.blade'),resource_path('views/frontend/u_bold'));
        //$filePath = resource_path('views\frontend\u_bold\en\a.txt');
        //$filePath2 = resource_path('views\frontend\u_bold\en\b.txt');
        //File::copy($filePath, $filePath2);
        /*copy($filePath, $filePath2);*/
       // Storage::copy($filePath,$filePath2);
        //Storage::disk('local')->put($filePath2, $filePath);
        /*$contents = Storage::get($filePath);
        Storage::disk('s3')->put($filePath2,$contents);*/
       /* if (\File::copy($filePath , $filePath2)) {
            dd("success");
        }   */
        /*$filePath3 = Storage::disk('local')->get('test.txt');
        $filePath4 = Storage::get();
        File::copy($filePath3, $filePath4);*/

        //Storage::move($filePath, $filePath2);
       /* if (!copy($filePath, $filePath2)) {
            echo "failed to copy $file...\n";
        }else{
            echo "copied $file into $newfile\n";
        }*/
       // Storage::move($filePath, $filePath2); // keep the same folder to just rename
        $path = resource_path() . '/views/frontend/u_bold/en/web.blade.php' ;
        $path2 = resource_path() . '/views/frontend/u_bold/web.blade.php' ;
        $path3 = resource_path() . '/views/frontend/u_bold/ar/web.blade.php' ;
        $lang = $requst->lang;
        if($lang == "English"){
            File::delete($path2);
            File::copy($path,$path2);
        }elseif ($lang == "Arabic") {
            File::delete($path2);
            File::copy($path3,$path2);
        }

    }
}
