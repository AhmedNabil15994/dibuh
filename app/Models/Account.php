<?php

namespace App\Models;

 
use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests;
use Config;
use Request;
use Illuminate\Support\Facades\Session;
use DB;

//define('STR_PAD_LEFT', 0);

class Account extends Model {

    //    use NodeTrait;
    //
    //account_nr (int), name (varchar), tax (float), text (varchar), description (varchar), account_type (fkey), created_by (fkey), common (tinyint/boolean)
    protected $fillable = array('account_code', 'parent_id', 'lft', 'rgt', 'lineage', 'depth', 'name', 'text', 'description','company_type_id', 'category_id', 'account_category_id', 'is_major', 'account_type_id', 'created_by', 'is_common','is_visible');
    protected $appends = ['full_desc','is_visible'];    
    //if you rename your table fields, also rename them here
    protected $table = 'accounts';
    protected $primary_key = 'id';
    protected $parent_col = 'parent_id';
    protected $lineage = 'lineage';
    protected $lineageLenth =10;        
    protected $deep = 'depth';
    protected $deepVal = '';


    // Fetch a single record based on the primary key. 
    // Returns row_array
    public function get_one($id) {
        $row = self::where($this->primary_key, $id)->first()->toArray(); // convert object to array
        
        return $row;
    }

    public function setDepthVal($parent_col) {

        if (!empty($parent_col)) {
            //get parent info
            $parent = $this->get_one($parent_col);
            $attributes[$this->deep] = $parent[$this->deep] + 1;
            return $this->deepVal = $attributes[$this->deep];
        }
    }

    public function createLineage($insertedId, $parent_col) {
       // $parent=DB::table($this->table)->where($this->primary_key, $parent_col)->first();
        $parent= (array) DB::table($this->table)->where($this->primary_key, $parent_col)->first(); // convert object to array to 
//        $parent=array_map(function($item){
//            return (array) $item;
//        },$parent);
      //  $parent = $this->get_one($parent_col);
        return (empty($parent[$this->lineage])) ? str_pad($insertedId, $this->lineageLenth, '0', STR_PAD_LEFT) : $parent[$this->lineage] . '-' . str_pad($insertedId, $this->lineageLenth, '0', STR_PAD_LEFT);
    }

    // updates record
    // returns update result
    public function doUpdate($id, $data) {

        $result = DB::table($this->table)
                ->where($this->primary_key, $id)
                ->update($data);

        return $result;
    }

    public function accountType() {

        return $this->belongsTo('App\Models\AccountType');
    }
     public function category() {

        return $this->belongsTo('App\Models\Category');
    }

    public function accountCategory() {

        return $this->belongsTo('App\Models\AccountCategory');
    }

    public function createdBy() {

        return $this->belongsTo('App\Models\UserProfile', 'created_by', 'user_id');
    }

    public function user() {

        return $this->belongsTo('App\Models\User');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Account', $this->parent_col);
    }
    
    public function taxes()
    {
        return $this->belongsToMany('App\Models\Tax', 'accounts_to_taxes', 'account_id', 'tax_id');
    }   
    
    public function companyType()
    {
        return $this->belongsToMany('App\Models\CompanyType', 'accounts_to_company_types', 'account_id', 'company_type_id');
    }    
    
    public function screen()
    {
        return $this->belongsToMany('App\Models\Screen', 'accounts_to_screens', 'account_id', 'screen_id');
    }       
    
    public function users()
    {
        return $this->belongsToMany('App\Models\Users', 'accounts_to_users', 'account_id', 'user_id');
    }          
//    public function companyType()
//    {
//        return $this->hasMany('App\Models\Tax', 'accounts_to_companytypes', 'account_id', 'company_type_id');
//    }      

//    public function getLftName() {
//        return 'lft';
//    }
//
//    public function getRgtName() {
//        return 'rgt';
//    }
//
//    public function getParentIdName() {
//        return 'parent_id';
//    }
//
//    // Specify parent id attribute mutator
//    public function setParentAttribute($value) {
//        $this->setParentIdAttribute($value);
//    }
//   
        public function getFullDescAttribute() {

        if (array_key_exists(Request::segment(1), Config::get('languages.available_locales'))) {
            $lang = Request::segment(1);
        } elseif (array_key_exists(Session::get('applocale'), Config::get('languages.available_locales'))) {
            $lang = Session::get('applocale');
        } else {
            $lang = Config::get('languages.default_locale');
        }

        return $this->account_code . ' -  ' . $this->name;
          }
          
        public function getIsVisibleAttribute() {

 

        return 1;
          }
              
    
    
}
