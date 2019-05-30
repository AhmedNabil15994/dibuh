<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
//use App\Http\Controllers\Controller;
use App\Http\Controllers\Backend\BackendBaseController;
use App\Models\Language;
use DB;
use Config;
use File;
use Lang;
use App;
use Illuminate\Support\Facades\Session;

use App\Models\User;
use App\Models\Country;
use App\Models\UserProfile as Profile;
use App\Models\UserAddress as Address;
use App\Models\UserBankAccount as BankAccount;
use App\Models\UserBankDataType ;
use App\Models\Role;
use App\Models\Permission;
use App\Models\userRole;
use App\Models\UserSetting;
use App\Models\UserSettingType;
use App\Models\SalesInvoice;
use App\Models\SalesInvoiceItem;
use App\Models\Installment;
use App\Models\Contact;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Environment;

use Hash;

use Carbon;
use Auth;
use Illuminate\Support\Collection;


class LanguageController extends BackendBaseController {
    protected $data=[];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $data = Language::orderBy('id', 'DESC')->paginate(10);
        $languages= Language::pluck('name','id');
        $active_lang=Language::where('is_active','1')->first()->id;

        return $this->view('.languages.index', compact('data','languages','active_lang'))
                        ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    public function create() {

        return $this->view('.languages.add',compact([]));
    }
    // store new Language
    public function store(Request $request){
      $this->validate($request, [

          'code' => 'required|unique:languages,code',
          'name' => 'required',
          'native_name' => 'required',
          'dir' => 'required',
          'txt_dir' => 'required',
          'regional' => 'required',
          'flag' => 'required',
        //  'is_default' => 'required',
      ]);
        $input = $request->all();
        $lanuage= new Language();
        $lanuage->create($input);
          //chmod('../resources/lang',0777);
        if (is_writable('../resources/lang')) {
                  File::copyDirectory('../resources/lang/ar','../resources/lang/'.$request->code);
                  File::copyDirectory('../resources/lang/ar','../resources/lang/vendor/adminlte_lang/'.$request->code);
                }else{
                  return redirect()->route('admin::languages.index')
                                  ->with('danger', 'Lang folder is not writable');
                }
        $this->generateConfig();
        return redirect()->route('admin::languages.index')
                        ->with('success', 'Language added sucessfully');

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $tbl = Language::find($id);
        return $this->view('.languages.show', compact('user'));
    }
    /**
     * Show the form for Add the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $data = Language::find($id);


        return $this->view('.languages.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $this->validate($request, [

            'code' => 'required',
            'name' => 'required',
            'native_name' => 'required',
            'dir' => 'required',
            'txt_dir' => 'required',
            'regional' => 'required',
            'flag' => 'required',
          //  'is_default' => 'required',
        ]);
        // only 1 language must be default
        // make all languages is not default
      //  $is_default = Language::where('is_default', '=', 1)->update(['is_default' => 0]);

        $input = $request->all();
    //    dd($input);
        // update the selected language to be updated to be defaul from /view input
        $data = Language::find($id);
        $data->update($input);
       //$this->generateConfig();
        return redirect()->route('admin::languages.index')
                        ->with('success', 'Settings updated successfully');
    }

    public function generateConfig() {
        // Grab languages from database as a list
        $languages = Language::get(array('code', 'name', 'native_name', 'dir', 'txt_dir', 'flag', 'regional', 'is_active', 'is_default'))->keyBy('code')->toArray();
       //this mean active language
       $default_language = Language::get()->where('is_active', 1)->first();
    //   dd("in generate".$default_language->code);

        if (!isset($default_language) || empty($default_language) ) {
                $default_language='ar';
        }  else {
                $default_language=$default_language->code;
        }
        // Generate and save config file
        $filePath = config_path() . '/languages.php';
        $content = '';
        $content .= '<?php ' . "\n" . ' return ' . " [ \n\n 'available_locales' =>  " . var_export($languages, true) . " \n\n ,";
        $content .= "  \n\n 'default_locale' =>   '" . $default_language . "' " . " \n\n ,";
        $content .= "  \n\n 'fallback_locale' =>   'ar' " ." \n\n";
        $content .= " \n\n ]" . ';';
        //$content .= " \n" . var_export($languages, true) . ';';
        File::put($filePath, $content);
    }

    public function destory($id)
   {
     $lang=Language::find($id);
     if($lang->code=="ar")
     return redirect()->route('admin::languages.index')
                     ->with('danger', 'Not allowed to delete the basic language');

     $file= File::deleteDirectory('../resources/lang/'.$lang->code);
     File::deleteDirectory('../resources/lang/vendor/adminlte_lang/'.$lang->code);
     $lang->delete();
     $this->generateConfig();


     return redirect()->route('admin::languages.index')
                     ->with('success', 'language deleted successfully');

  }
  /*
  //specified with the public files and the index for language files//
  */
  public function languageFiles($id,Request $request)
  {
    //  dd(Language::find($id));
    $code=Language::find($id)->code;
      $this->data['id']=$id;
      $this->data['lang_name']=Language::find($id)->name;

    //  Lang::setLocale($code);
    $filePath ='../resources/lang/'.$code;
    // auth file
    $content_auth=Lang::get('auth',[],$code);
    $this->data['content_auth']=$this->custom_pagination($content_auth,count($content_auth));
  //  dd($this->data['content_auth']);
    /////button file
    $content_button=Lang::get('button',[],$code);
    $this->data['content_button']=$this->custom_pagination($content_button,count($content_button));
  //  dd($this->data['content_button']);
    //// master file
    $content_master=Lang::get('master',[],$code);
    $this->data['content_master']=$this->custom_pagination($content_master,count($content_master));
    //// message file
    $content_message=Lang::get('message',[],$code);
    $this->data['content_message']=$this->custom_pagination($content_message,count($content_message));
    //// pagination file
    $content_pagination=Lang::get('pagination',[],$code);
    $this->data['content_pagination']=$this->custom_pagination($content_pagination,count($content_pagination));
    //// password file
    $content_password=Lang::get('passwords',[],$code);
    $this->data['content_password']=$this->custom_pagination($content_password,count($content_password));



  return $this->view('.languages.files.index',$this->data);
  }

  public function languageFilesFront($id,Request $request)
  {

    $code=Language::find($id)->code;
    $this->data['lang_name']=Language::find($id)->name;
    //  Lang::setLocale($code);
    $filePath ='../resources/lang/frontend'.$code;
        $this->data['id']=$id;
    // account file
    $content_account=Lang::get('frontend/account',[],$code);

   $this->data['content_account'] =$this->custom_pagination($content_account,count($content_account));
    /////contact file
    $content_contact=Lang::get('frontend/contact',[],$code);
    $this->data['content_contact'] =$this->custom_pagination($content_contact,count($content_contact));

    //// cost file
    $content_cost=Lang::get('frontend/cost',[],$code);
    $this->data['content_cost'] =$this->custom_pagination($content_cost,count($content_cost));
  //  $this->data['content_cost']=$this->custom_pagination($content_cost);
    //// dashboard file
    $content_dashboard=Lang::get('frontend/dashboard',[],$code);
    $this->data['content_dashboard']=$this->custom_pagination($content_dashboard,count($content_dashboard));
    //// expense file
    $content_expense=Lang::get('frontend/expense',[],$code);
    $this->data['content_expense']=$this->custom_pagination($content_expense,count($content_expense));
    //// finance file
    $content_finance=Lang::get('frontend/finance',[],$code);
    $this->data['content_finance']=$this->custom_pagination($content_finance,count($content_finance));
    //// product file
    $content_product=Lang::get('frontend/product',[],$code);
    $this->data['content_product']=$this->custom_pagination($content_product,count($content_product));
    //// reports file
    $content_reports=Lang::get('frontend/reports',[],$code);
    $this->data['content_reports']=$this->custom_pagination($content_reports,count($content_reports));
    //// sales_invoice file
    $content_sales_invoice=Lang::get('frontend/sales_invoice',[],$code);
    $this->data['content_sales_invoice']=$this->custom_pagination($content_sales_invoice,count($content_sales_invoice));
    //// user file
    $content_user=Lang::get('frontend/user',[],$code);
    $this->data['content_user']=$this->custom_pagination($content_user,count($content_user));

           return $this->view('.languages.files.frontend',$this->data);
  }
  public function languageFilesBack($id,Request $request)
  {

    $code=Language::find($id)->code;
    $this->data['id']=$id;
    $this->data['lang_name']=Language::find($id)->name;
    // account file
    $content_account=Lang::get('backend/account',[],$code);
    $this->data['content_account']=$this->custom_pagination($content_account,count($content_account));

    // account_category file
    $content_account_category=Lang::get('backend/account_category',[],$code);
  //  Paginator::setPageName('page_account_category');
    $this->data['content_account_category']=$this->custom_pagination($content_account_category,count($content_account_category));

    // category file
    $content_category=Lang::get('backend/category',[],$code);
    $this->data['content_category']=$this->custom_pagination($content_category,count($content_category));

    // language file
    $content_language=Lang::get('backend/language',[],$code);
    $this->data['content_language']=$this->custom_pagination($content_language,count($content_language));

    // main file
    $content_main=Lang::get('backend/main',[],$code);
    $this->data['content_main']=$this->custom_pagination($content_main,count($content_main));

    // payment file
    $content_payment=Lang::get('backend/payment',[],$code);
    $this->data['content_payment']=$this->custom_pagination($content_payment,count($content_payment));

    // role file
    $content_role=Lang::get('backend/role',[],$code);
    $this->data['content_role']=$this->custom_pagination($content_role,count($content_role));

    // setting file
    $content_setting=Lang::get('backend/setting',[],$code);
    $this->data['content_setting']=$this->custom_pagination($content_setting,count($content_setting));

    // user file
    $content_user=Lang::get('backend/user',[],$code);
      $this->data['content_user']=$this->custom_pagination($content_user,count($content_user));


//account_to_company_type
   $account_to_company_type=Lang::get('backend/account_to_company_type',[],$code);
   $this->data['account_to_company_type']=$this->custom_pagination($account_to_company_type,count($account_to_company_type));

   //account_to_tax
   $account_to_tax=Lang::get('backend/account_to_tax',[],$code);
   $this->data['account_to_tax']=$this->custom_pagination($account_to_tax,count($account_to_tax));

    // dashboard
   $dashboard=Lang::get('backend/dashboard',[],$code);
   $this->data['dashboard']=$this->custom_pagination($dashboard,count($dashboard));

   //tax
   $tax=Lang::get('backend/tax',[],$code);
   $this->data['tax']=$this->custom_pagination($tax,count($tax));
   //tax_type
   $tax_type=Lang::get('backend/tax_type',[],$code);
   $this->data['tax_type']=$this->custom_pagination($tax_type,count($tax_type));

   //user_settings
   $user_settings=Lang::get('backend/user_settings',[],$code);
   $this->data['user_settings']=$this->custom_pagination($user_settings,count($user_settings));

       return $this->view('.languages.files.backend',$this->data);
  }

    public function saveFile($id,$folder_name,$file_name,Request $request)
    {
      $new_array=$request->except('_token');
    //  $new_array=$new_array->toArray();
;
      $code=Language::find($id)->code;
      $lang_file=explode('.',$file_name);

      if($folder_name=="public")
      {
          $filePath ='../resources/lang/'.$code.'/'.$file_name;
          $old_array=Lang::get($lang_file[0],[],$code);
        }
      else
      {
          $filePath ='../resources/lang/'.$code.'/'.$folder_name.'/'.$file_name;
          $old_array=Lang::get($folder_name.'/'.$lang_file[0],[],$code);
       }
  //  dd($old_array);
       [$keys, $values] = array_divide($new_array);
        $slice_array = array_except($old_array, $new_array);

//slice array as the new array
     for($i=0;$i<count($new_array);$i++)
        {
          $slice_array=array_prepend($slice_array,$values[$i],$keys[$i]);
        }
//dd($slice_array);
      $content="<?php return ".var_export($slice_array,true).";";
      File::put($filePath,$content);

      return redirect()->route('admin::language.files',$id)
                      ->with('success', 'Translation saved successfully');

    }
    public function custom_pagination($array,$count=null){
      $currentPage = LengthAwarePaginator::resolveCurrentPage();

      $col = new Collection($array);
      if($count!=null)
         $perPage=$count;
      else
         $perPage = 7;
      $currentPageSearchResults = $col->slice(($currentPage - 1) * $perPage, $perPage)->all();
      $entries = new LengthAwarePaginator($currentPageSearchResults, count($col), $perPage, $currentPage,['path' => LengthAwarePaginator::resolveCurrentPath()] );

     return $entries;
   }

   public function changeLanguage(Request $request)
   {
    $new_lang=Language::find($request->lang_id);
//dd($new_lang->code);
    $langs=Language::all();
      foreach($langs as $lang)
      {
         $lang->is_active=0;
         $lang->save();
       }

       $new_lang=Language::find($request->lang_id);
       $new_lang->is_active=1;
    //   dump($new_lang->is_active);
       $new_lang->update();

       App::setLocale($new_lang->code);
        Session::put('applocale', $new_lang->code);
        $this->generateConfig();
      //  dd(App::getLocale());
       return back()->with('success','Language updated');

   }
}
