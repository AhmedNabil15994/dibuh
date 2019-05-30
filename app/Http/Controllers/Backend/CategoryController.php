<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
//use App\Http\Controllers\Controller;
use App\Http\Controllers\Backend\BackendBaseController;
use Auth;
use App\Models\User;
use App\Models\UserProfile As Profile;
use App\Models\Account;
use App\Models\AccountType;
use App\Models\Category;
use Config;
use Carbon;
use Illuminate\Contracts\Encryption\DecryptException;

class CategoryController extends BackendBaseController {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        //

        $data = Category::orderBy('id', 'DESC')->paginate(10);
        return $this->view('category.index', compact('data'))
                        ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //

        return $this->view('category.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        // 'name', 'tax', 'text', 'description', 'account_type', 'created_by', 'is_visible'
        $this->validate($request, [
       //     'code' => 'required|digits_between:1,10|unique:categories',
            'name' => 'required',
        ]);

        $input = $request->all();
        Category::create($input);


        return redirect()->route('admin::category.index')
                        ->with('success', ' Category created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
        $this->data['data'] = Category::find($id);




        return $this->view('category.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //


        $this->validate($request, [
         //   'code' => 'required|digits_between:1,10|unique:categories,code,' . $id,
            'name' => 'required',
            

        ]);

        $input = $request->all();

        $model = Category::find($id);
        $model->update($input);


        return redirect()->route('admin::category.index')
                        ->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //

        Category::find($id)->delete();
        return redirect()->route('admin::category.index')
                        ->with('success', 'Cateogry deleted successfully');
    }

    //=========================================================
    //Helper methods
    //=========================================================   
    public function setting_category(Request $request){
        $cat = Category::orderBy('id', 'ASC')->paginate(25);
        return view(Config::get('back_theme') . '.account_setting.category', compact('cat'))->with('i', ($request->input('page', 1) - 1) * 25);
    }

    public function addCat(Request $request) {
        // 'name', 'tax', 'text', 'description', 'account_type', 'created_by', 'is_visible'
        $this->validate($request, [
            'code' => 'required|digits_between:1,10|unique:categories',
            'name' => 'required',
        ]);

        $data = new Category ();
        $data->name = $request->name;
        $data->description = $request->description;
        $data->code = $request->code;
        $data->save ();
        return response ()->json ( $data );
    }

    public function editCat(Request $request) {
        //
        $this->validate($request, [
         //   'code' => 'required|digits_between:1,10|unique:categories,code,' . $request->id,
            'name' => 'required',
            

        ]);

        $cat = Category::find ($request->id);
        $cat->name = $request->name;
        $cat->save();
        return response()->json($cat);       
    }

    public function removeCat(Request $req) {
        //
        Category::find($req->id)->delete();
        return response()->json();
    }
}
