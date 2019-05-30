<?php

namespace App\Http\Controllers\Frontend\Dashboard\User;

use Illuminate\Http\Request;
//use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\Dashboard\DashboardBaseController;
use Auth;
use App\Models\User;
use App\Models\UserProfile As Profile;
use App\Models\Account;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Unit;
use Illuminate\Support\Facades\Response;
use Config;
use Carbon;
use View;
use Illuminate\Contracts\Encryption\DecryptException;

class ProductController extends DashboardBaseController {
    protected $userType = 'user';
    protected $module = 'product';

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
        //
        $this->data['page_title'] = trans('frontend/product.title') ;

        return $this->view($this->userType . '.'.$this->module.'.'.'main', $this->data);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        //
//        $this->data['page_title'] =   trans('frontend/product.title') ;
//        $this->data['user_type'] = Auth::user()->roles;
//        $this->data['data'] = Product::orderBy('id', 'DESC')->paginate(10);
//        return $this->view($this->userType . '.'.$this->module.'.'.'index', $this->data)
//                        ->with('i', ($request->input('page', 1) - 1) * 10);

        $this->data['data'] = Product::orderBy('id','DESC')->get();
        if ($request->ajax()) {
            return view($this->dashboardPath . '.' . $this->userType . '.' . $this->module . '.ajax.load_product_with_types' ,  $this->data)->render();
        }

        $this->data['page_title'] = trans('frontend/product.title') ;
        $this->data['user_type'] = Auth::user()->roles;
        return $this->view($this->userType . '.' . $this->module . '.' . 'index', $this->data)
                        ->with('i', ($request->input('page', 1) - 1) * 10);

    }
    //ajax request
    public function LoadAjaxFilterType(Request $request,$type){
        if ($type == 0 ){
            $data = Product::orderBy('id', 'DESC')->get();
        }else{
            $productType = ProductType::find($type);
            $data = $productType->product()->get();
        }

        if ($request->ajax()) {
            return view($this->dashboardPath . '.' . $this->userType . '.' . $this->module . '.ajax.load_product_with_types' , ['data' => $data])->render();
        }

        $page_title = trans('frontend/product.title');
        $user_type = Auth::user()->roles;
        return $this->view($this->userType . '.' . $this->module . '.' . 'index', compact('page_title','user_type','data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }
    public function getTaxData(Request $request){
        $tax_type_id=$request->tax_type_id;
        $responce= \App\Models\Tax::where('tax_type_id', $tax_type_id)->get();

        return Response::json($responce);;
    }
    public function getAccountsJson(Request $request) {
        $account =\DB::table('accounts')->join('accounts_to_screens','accounts.id','=','accounts_to_screens.account_id')->where('accounts_to_screens.screen_id' , '=' ,13)->where('is_major','=',0)
            ->where(function ($query) use ($request){
                $query->where('name', 'like', "%$request->text%")
                ->orWhere('account_code','like',"%$request->text%");
            })->latest()->get(['accounts.id','accounts.name','accounts.account_code']);
        return Response::json($account);
    }

    public function filter(Request $request,$productNumber = null,$name = null,$price=null , $pages=10){
      if ($productNumber != -1 ){
          $data = Product::where('product_code',$productNumber)->orderBy('id', 'DESC')->get();
      }elseif($productNumber == -1 && $name == -1 && $price== -1 ){
           $data = Product::orderBy('id','DESC')->get();
      }else{
        if($name != -1 && $price != -1 ){
          $data = Product::where('name',"$name")->where('price',$price)->orderBy('id', 'DESC')->get();
        }else{
          $data = Product::where('name',"$name")->orwhere('price',$price)->orderBy('id', 'DESC')->get();

        }

      }

      if ($request->ajax()) {
          return view($this->dashboardPath . '.' . $this->userType . '.' . $this->module . '.ajax.load_product_with_types' , ['data' => $data])->render();
      }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
        $this->data['page_title'] =   trans('frontend/product.create_new') ;
        $this->data['product_type'] = ProductType::all()->pluck('name', 'id')->all(); //\DB::table('product_type')->pluck('name', 'id');
        $this->data['unit'] = Unit::all()->pluck('name', 'id')->all();
    //    $this->data['accounts'] = \App\Models\User::accounts()->get()->pluck('full_desc', 'id')->all();
//        $this->data['accounts'] = \App\Models\User::find( Auth::user()->id)->accounts()->orderBy('lineage', 'ASC')->get()->pluck('full_desc','id')->all();
//        $this->data['accounts'] = \App\Models\Screen::find( 13)->accounts()->orderBy('lineage', 'ASC')->get()->pluck('full_desc','id')->all();
//        $this->data['accounts'] =\DB::table('accounts_to_screens')
//                                                        ->join('accounts', 'accounts_to_screens.account_id', '=', 'accounts.id')
//                                                        ->join('accounts_to_users', 'accounts.id', '=', 'accounts_to_users.account_id')
//                                                        ->where('accounts_to_screens.screen_id',  13)
//                                                        ->where('accounts_to_users.user_id',  Auth::user()->id)
//                                                        ->select('accounts.id', 'accounts.name')
//                                                        ->get();
        /*$this->data['accounts'] =\DB::table('v_user_accounts')
                                                        ->where('screens', 'like', '%|13|%')
                                                        ->where('user_id',  Auth::user()->id)
                                                        ->select('account_id as id', 'account_code', 'name','category_id')
                                                        ->get();           */
     //   $this->data['accounts'] = \App\Models\Screen::find( 13)->accounts()->users->all();
   //     $this->data['accounts'] =$this->data['accounts']->screen->all();
        $this->data['category'] = \App\Models\Category::all();
        $this->data['accounts_major'] = \App\Models\User::find(Auth::user()->id)->accounts()->where('is_major',1)->get()->pluck('id')->toArray();
        $this->data['tax_type'] = \App\Models\TaxType::get()->pluck('name', 'id')->all(); //\DB::table('product_type')->pluck('name', 'id');
        $this->data['user_id'] = Auth::user()->id;
    //    dd($this->data['accounts_major']);
        $this->data['product_code'] = Product::orderBy('created_at', 'desc')->first();
        return $this->view($this->userType . '.'.$this->module.'.'.'create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        // 'name', 'tax', 'text', 'description', 'product_type', 'created_by', 'is_visible'
        $this->validate($request, [
            'product_code' => 'required|unique:products,user_id',
            'name' => 'required',
            'price' => 'required',
            'product_type_id' => 'required',

        ]);
        $input = $request->all();

        //get current user id for created by user:
        $input['user_id'] = Auth::user()->id; //this is only for frontend method
       // dd(  $input['created_by']);
        /*Product::create($input);

        return redirect()->route('product.index')
                        ->with('success', 'Product created successfully');*/
        $tax_id = $input['tax_id'];
        $tax_rate = $input['tax_rate'];
        $taxType_id = $input['taxType_id'];
        $data = new Product;
        $data->product_code = $request->product_code;
        $data->name = $request->name;
        $data->price = $request->price;
        $data->account_id = $request->account_id;
        $data->description = $request->description;
        $data->comment = $request->comment;
        $data->product_type_id = $request->product_type_id;
        $data->unit_id = $request->unit_id;
        $data->user_id = $request->user_id;
        $data->save();
        $insertedId = $data->product_code;

            //dd($tax_id[0].$tax_id[1]);
            for ($i=0 ; $i < count($taxType_id) ; $i++ ) {


                \DB::table('products_to_taxtypes')->insert(
                    ['product_code' => $insertedId , 'tax_type_id' => $taxType_id[$i]]
                );

            }
            for ($i=0 ; $i < count($tax_id) ; $i++ ) {


                \DB::table('products_to_taxes')->insert(
                    ['product_code' => $insertedId , 'tax_id' => $tax_id[$i]]
                );

            }
        //dd($tax_id);
       return redirect()->route('product.index')
                        ->with('success', 'Product created successfully');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($product_code) {
        //
        $this->data['page_title'] =   trans('frontend/product.edit') ;
        $this->data['data'] = Product::find($product_code);
        $this->data['product_type'] = ProductType::all()->pluck('name', 'id')->all(); //\DB::table('product_type')->pluck('name', 'id');
        $this->data['unit'] = Unit::all()->pluck('name', 'id')->all();
        $this->data['accounts'] = \App\Models\User::find( Auth::user()->id)->accounts()->orderBy('lineage', 'ASC')->get()->pluck('full_desc','id')->all();
        $this->data['accounts_major'] = \App\Models\User::find(Auth::user()->id)->accounts()->where('is_major',1)->get()->pluck('full_desc','id')->all();

        $this->data['tax_type'] = \App\Models\TaxType::get()->pluck('name', 'id')->all(); //\DB::table('product_type')->pluck('name', 'id');
        $this->data['user_id'] = Auth::user()->id;





        return  $this->view($this->userType . '.'.$this->module.'.'.'edit', $this->data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $product_code) {
        //


        $this->validate($request, [
            'product_code' => 'required|unique:products,product_code,' . $product_code,
            'name' => 'required',
            'price' => 'required',
            'product_type_id' => 'required',

        ]);

        $input = $request->all();


        $model = Product::find($product_code);
        $model->update($input);


        return redirect()->route('product.index')
                        ->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //

        Product::find($id)->delete();
        return redirect()->route('product.index')
                        ->with('success', 'Product deleted successfully');
    }

    //=========================================================
    //Helper methods
    //=========================================================
    public function selectUserID() {

        $select = Profile::get(['user_id', 'first_name', 'last_name'])->flatten()->all();
        foreach ($select as $v) {
            $profiles[$v->user_id] = $v->first_name . ' ' . $v->last_name;
        }
        return $profiles;
    }

}
