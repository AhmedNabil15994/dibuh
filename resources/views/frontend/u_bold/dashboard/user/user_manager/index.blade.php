@extends(Config::get('front_theme').'.layouts.default')
@section('title')
- {{$page_title}}
@endsection

@section('page-styles')
<style type="text/css">
.row{
	padding: 0 !important;
	/* margin: 0 !important; */
}

div.bhoechie-tab-container{
  z-index: 10;
  background-color: #ffffff;
  padding: 0 !important;
  border-radius: 4px;
  -moz-border-radius: 4px;
  border:1px solid #ddd;
  margin-top: 20px;
  margin-left: 50px;
  -webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
  box-shadow: 0 6px 12px rgba(0,0,0,.175);
  -moz-box-shadow: 0 6px 12px rgba(0,0,0,.175);
  background-clip: padding-box;
  opacity: 0.97;
  filter: alpha(opacity=97);
  margin-left: 0;
  float: right !important;
}
div.bhoechie-tab-menu{
  padding-right: 0;
  padding-left: 0;
  padding-bottom: 0;
  float: right !important;
}
div.bhoechie-tab-menu div.list-group{
  margin-bottom: 0;
}
div.bhoechie-tab-menu div.list-group>a{
  margin-bottom: 0;
}
div.bhoechie-tab-menu div.list-group>a .glyphicon,
div.bhoechie-tab-menu div.list-group>a .fa {
  color: #5fbeaa;
}
div.bhoechie-tab-menu div.list-group>a:first-child{
  border-top-right-radius: 0;
  -moz-border-top-right-radius: 0;
}
div.bhoechie-tab-menu div.list-group>a:last-child{
  border-bottom-right-radius: 0;
  -moz-border-bottom-right-radius: 0;
}
div.bhoechie-tab-menu div.list-group>a.active,
div.bhoechie-tab-menu div.list-group>a.active .glyphicon,
div.bhoechie-tab-menu div.list-group>a.active .fa{
  background-color: #5fbeaa;
  background-image: #5fbeaa;
  color: #ffffff;
}
div.bhoechie-tab-menu div.list-group>a.active:after{
  	content: '';
    position: absolute;
    left: -4%;
    top: 50%;
    margin-top: -13px;
    border-left: 0;
    border-bottom: 13px solid transparent;
    border-top: 13px solid transparent;
    border-left: 10px solid #5fbeaa;
    transform: rotateZ(180deg);
}

div.bhoechie-tab-content{
  background-color: #ffffff;
  /* border: 1px solid #eeeeee; */
  padding-left: 20px;
  padding-top: 10px;
}

div.bhoechie-tab div.bhoechie-tab-content:not(.active){
  display: none;
}
.list-group-item.active, 
.list-group-item.active:hover, 
.list-group-item.active:focus{
	border-color: #5fbeaa;
}
@media(max-width: 767px){
	div.bhoechie-tab-menu div.list-group>a.active:after{
		display: none;
	}
}
@media(max-width: 991px){
	.breadcrum_sec{
		margin-top: 0px;
	}
}
@media (min-width:992px) and (max-width:1065px){
	.breadcrum_sec{
		margin-top: 70px;
	}
}
@media(min-width: 1066px){
	.breadcrum_sec{
		margin-top: 60px;
	}
}
@media(min-width: 768px){
	.form-group{
		margin-bottom: 50px;
	}
}
.modal-dialog{
	width: 100%;
}
.btn-default{
	float: left;
	margin-left: 10px;
	margin-top: 30px;
}
.modal-header h4{
	margin-bottom: 20px;
}
.select2-container--default .select2-selection--single .select2-selection__rendered{
	text-align: right;
	line-height: 30px !important;
    font-size: 15px;
}
/*.select2-container .select2-selection--single .select2-selection__rendered {
    line-height: 30px !important;
    font-size: 16px;
    padding-left: 12px !important;
}*/

.wrapper{
	padding-bottom:50px;
}
/* start letter */ 
.letter {
     background: #fff;
     box-shadow: 0 0 10px rgba(0,0,0,0.3);
     max-width: 550px;
     padding: 25px;
     position: relative;
     width: 100%;
     z-index: 51;
     /* margin-bottom: 70px; */
	 margin-right:70px;
	 /* margin-top: 20px; */
}

 .letter:before, .letter:after {
     content: "";
     height: 98%;
     position: absolute;
     width: 100%;
     z-index: -1;
}
 .letter:before {
     background: #fafafa;
     box-shadow: 0 0 8px rgba(0,0,0,0.2);
     left: -10px;
     top: 4px;
     transform: rotate(-1.5deg);
     transition:all 0.5s ease-in-out;
     -webkit-transition:all 0.5s ease-in-out;
     -moz-transition:all 0.5s ease-in-out;
     -o-transition:all 0.5s ease-in-out;
}
 .letter:after {
     background: #ffffff;
     box-shadow: 0 0 3px rgba(0,0,0,0.2);
     right: -3px;
     top: 1px;
     transform: rotate(1.4deg);
}

@media (max-width:768px){
     .letter .header_right{
text-align:center;}
}
.dumy_background{
	background-color:#ddd;
	width:150px;
	padding:3px;
}
.dumy_background_footer{
	background-color:#ddd;
	padding:2px;
}	

 .firstLogo{
     color: #5fbeaa;
     word-spacing: -5px;
     font-weight:bold;
}
 .header_right p{
     font-size: 14px;
     line-height: 1.7;
     display: block;
     margin-bottom: 10px;
}

 .header_right .myCompany{
    font-size: 10px;
    margin-bottom: 15px;
}
/*end letter right section*/
 
/*end sidebar*/
 .pay_details{
     font-size:10px;
     box-shadow: 0 0 7px 1px rgba(0, 0, 0, 0.42);
     border: 1px solid rgba(51, 51, 51, 0.6);
     margin-top:20px;
     position:relative;
     width:100% ;
     display: inline-flex;
         /* margin-bottom:20px; */
	margin-top: 50px;
    margin-right: 3px;
	
}
 .pay_details .right {
    padding: 10px 7px 10px 3px;

}
 .pay_details .right h6{
    text-decoration: underline;
    display: inline-block;
    margin-bottom: 15px;
    font-weight: bold;
    }

 .pay_details .right .p ,  .pay_details .left .p{     
	line-height: 22px;
    margin: 0;
    font-size: 14px;
    display: inline-block;
    width: 30px;
    margin-top: 0px;
    vertical-align: text-bottom;
    margin-bottom: 6px;
    margin-right: 3px;
}
 .pay_details .left{
    background:rgba(204, 204, 204, 0.33);
     border-right: 1px solid;
     display:block;
	 padding: 10px 7px 10px 3px;

}
 .pay_details .left strong,.pay_details .left p {
    display:inline-block;
}
.pay_details strong{
	margin-bottom: 8px;

}
 .letter_footer .left{
    font-size :10px;
     font-size: 10px;
     text-align: left;
     display:block;
     float:left 
}
 .letter_footer .left ul {
    list-style: none;
     position:relative;
}
 .letter_footer .left ul li:after{
     content: " ";
     right: 44%;
     position: absolute;
     width: 50%;
     border: 1px solid rgba(51, 51, 51, 0.44);
    ;
}
 .header_left{
    position: absolute;
     left: 65px;
     top: 55px;
}
 .header_left p,.print_footer p {
    line-height: 0.9;
}
 .letter_footer .left p{
     margin-left: 15px;
     display:inline-block
}
.table-bordered {
    border: 1px solid #ebeff2 !important;
}
.tabel-head{
    background-color:#eeeeee;
    font-weight: 400;
        color: #7f8c9d;
    /* font-family: sans-serif; */
    font-size: 13px;
}

tbody tr{
    font-size: 14px
}
/*end letter*/
 @media (max-width:567px){
     .tabel-head{
         font-size: 10px !important;
         font-weight: 400 
    }
     .detail_sban{
         margin-bottom: 10px;
    }
     .tabel-body-font{
         font-size: 13px !important;
    }
}

 @page {
          footer: page-footer;
        }

@media (max-width:1199px){
	.letter{
		margin:50px auto;
	}
}
.modal-content{
	-webkit-box-shadow: 0 5px 15px rgba(0,0,0,.25);
	-moz-box-shadow: 0 5px 15px rgba(0,0,0,.25);
	-o-box-shadow: 0 5px 15px rgba(0,0,0,.25);
	box-shadow: 0 5px 15px rgba(0,0,0,.25);

}
.det,.dumy_background_footer{
	font-size: 9px !important;
}
</style>	
@endsection

 



@section('content')
<div class="breadcrum_sec">
    <!-- <div class="container">
        <ol class="breadcrumb">
            <li><a href="{{ route('home.index') }}">{{trans('master.home')}}</a></li>              
            <li><a href="{{ route('dashboard.index') }}">{{trans('master.dashboard')}}</a></li>      
            @yield('module_breadcrumb')

  			<li class="active">{{trans('frontend/dashboard.user_manager')}}</li> 


        </ol>	
    </div> -->
</div>   
<div class="container">      
	<div class="alert alert-danger hidden" >
        <strong>Whoops!</strong> {{ trans('adminlte_lang::message.someproblems') }}<br><br>
        <ul></ul>
    </div>
	<div class="row">
	   	<div class="col-lg-7 col-md-12 col-sm-12 col-xs-12 bhoechie-tab-container pull-right">
	        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 bhoechie-tab-menu pull-right">
	              <div class="list-group">
	                <a href="#" class="list-group-item active text-center">
	                  <h4 class="glyphicon glyphicon-user"></h4><br/>الحساب الشخصي
	                </a>
	                <a href="#" class="list-group-item text-center">
	                  <h4 class="fa fa-user-circle fa-2x" style="background-color: transparent; "></h4><br/>المعلومات الشخصية
	                </a>
	                <a href="#" class="list-group-item text-center">
	                  <h4 class="fa fa-building fa-2x"></h4><br/>الشركة
	                </a>
	                <a href="#" class="list-group-item text-center">
	                  <h4 class="fa fa-university fa-2x"></h4><br/>الحساب البنكي
	                </a>
	                <a href="#" class="list-group-item text-center">
	                  <h4 class="glyphicon glyphicon-credit-card"></h4><br/>الضرائب والدفع
	                </a>
	              </div>
	        </div>
	        <form>
	        	<input type="hidden" name="_token" value="{{ csrf_token() }}">    
	        	<?php 
	        		$id = \Auth::user()->id;
	        		$user = \DB::table('user_profiles')->where('user_id','=',$id)->first();
	        	?>
		        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 bhoechie-tab">
		            <div class="bhoechie-tab-content active">                	 
		                <div class="modal-dialog" >
						    <div class="modal-content">
						        <div class="modal-header">
						                <h4 class="box-title" style="border-bottom: 1px solid #DDD; padding-bottom: 15px;">معلومات الحساب الشخصي</h4>
						                <div class="box-body">
						                    <div class="col-xs-12 col-sm-12 col-md-12">
						                        <div class="form-group">
						                            <div class="col-sm-4 col-xs-12">
						                                <strong>البريد الالكتروني :</strong>
						                            </div>
						                            <div class="col-sm-8">
						                            	<input class="form-control" type="email" name="email" value="{{\Auth::user()->email}}" disabled>
						                            </div>	
						                            	
						                        </div>
						                    </div>

						                    <div class="col-xs-12 col-sm-12 col-md-12">
						                        <div class="form-group">
						                            <div class="col-sm-4 col-xs-12">
						                                <strong>كلمة السر :</strong>
						                            </div>    
						                            <div class="col-sm-8">
						                            	<input class="form-control" type="password" name="password" placeholder="كلمة السر الجديدة">
						                            </div>
						                        </div>
						                    </div>

						                    <div class="col-xs-12 col-sm-12 col-md-12">
						                        <div class="form-group">
						                            <div class="col-sm-4 col-xs-12">
						                                <strong>تاكيد كلمة السر :</strong>
						                            </div>    
						                            <div class="col-sm-8">
						                            	<input class="form-control" type="password" name="password_confirmation" placeholder="تاكيد كلمة السر الجديدة">
						                            </div>
						                        </div>
						                    </div>
						                </div>


						                <div class="box-footer">
						                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
						                              
						                        <button type="button" class="btn btn-default waves-effect waves-light" style="margin-right: 5px;"><i class="fa fa-save"></i> {{ trans('button.edit') }}</button>
						                    </div>
						                </div> 
						        </div>    
						    </div>
						</div>
		            </div>
		            <div class="bhoechie-tab-content">
		                <div class="modal-dialog" >
						        <div class="modal-content">
						            <div class="modal-header">
						                <h4 class="box-title" style="border-bottom: 1px solid #DDD; padding-bottom: 15px;">المعلومات الشخصية</h4>
						                
						                <div class="box-body">
						                    <div class="col-xs-12 col-sm-12 col-md-12">
						                        <div class="form-group">
						                            <div class="col-sm-4 col-xs-12">
						                                <strong>الاسم الاول :</strong>
						                            </div>
						                            <div class="col-sm-8">
						                            	<input class="form-control" type="text" name="first_name" value="{{$user->first_name}}">
						                            </div>	
						                            	
						                        </div>
						                    </div>

						                    <div class="col-xs-12 col-sm-12 col-md-12">
						                        <div class="form-group">
						                            <div class="col-sm-4 col-xs-12">
						                                <strong>الاسم الاخير :</strong>
						                            </div>    
						                            <div class="col-sm-8">
						                            	<input class="form-control" type="text" name="last_name" value="{{$user->last_name}}">
						                            </div>
						                        </div>
						                    </div>

						                    <div class="col-xs-12 col-sm-12 col-md-12">
						                        <div class="form-group">
						                            <div class="col-sm-4 col-xs-12">
						                                <strong>رقم التليفون :</strong>
						                            </div>    
						                            <div class="col-sm-8">
						                            	<input class="form-control" type="text" name="phone" value="{{$user->phone}}">
						                            </div>
						                        </div>
						                    </div>

						                    <div class="col-xs-12 col-sm-12 col-md-12">
						                        <div class="form-group">
						                            <div class="col-sm-4 col-xs-12">
						                                <strong>العنوان :</strong>
						                            </div>    
						                            <div class="col-sm-8">
						                            	<input class="form-control" type="text" name="address" value="{{$user->address}}">
						                            </div>
						                        </div>
						                    </div>
						                    <div class="col-xs-12 col-sm-12 col-md-6">
						                        <div class="form-group">
						                            <div class="col-sm-4 col-xs-12">
						                                <strong>المركز :</strong>
						                            </div>    
						                            <div class="col-sm-8">
						                            	<input class="form-control" type="text" name="district" value="{{$user->district}}">
						                            </div>
						                        </div>
						                    </div>

						                    <div class="col-xs-12 col-sm-12 col-md-6">
						                        <div class="form-group">
						                            <div class="col-sm-7 col-xs-12">
						                                <strong>الرقم البريدي :</strong>
						                            </div>    
						                            <div class="col-sm-5">
						                            	<input class="form-control" type="text" name="postal_code" value="{{$user->postal_code}}">
						                            </div>
						                        </div>
						                    </div>

						                    @if($user->country_id == 1)
						                    <div class="col-xs-12 col-sm-12 col-md-6">
						                        <div class="form-group">
						                            <div class="col-sm-5 col-xs-12">
						                                <strong>المحافظة :</strong>
						                            </div>    
						                            <div class="col-sm-7">
						                            	<select class="form-control select2" name="governorate_id">
							                                <option>{{trans('master.select_item_from_list')}}</option>

							                                <?php $govern = \DB::table('governorates')->get(); ?>
							                                @foreach($govern as $one)
							                                @if($one->id == $user->governorate_id)
							                                <option value="{{$one->id}}" selected>{{$one->name_ar}}</option>
							                                @else
							                                <option value="{{$one->id}}">{{$one->name_ar}}</option>
							                                @endif
							                                @endforeach

							                            </select>
						                            </div>
						                        </div>
						                    </div>
						                    @endif

						                    <div class="col-xs-12 col-sm-12 col-md-6">
						                        <div class="form-group">
						                            <div class="col-sm-4 col-xs-12">
						                                <strong>الدولة :</strong>
						                            </div>    
						                            <div class="col-sm-8">
						                            	<select class="form-control select2" name="country_id">
							                                <option>{{trans('master.select_item_from_list')}}</option>

							                                <?php $countries = \DB::table('countries')->get(); ?>
							                                @foreach($countries as $one)
							                                @if($one->id == $user->country_id)
							                                <option value="{{$one->id}}" selected>{{$one->name_ar}}</option>
							                                @else
							                                <option value="{{$one->id}}">{{$one->name_ar}}</option>
							                                @endif
							                                @endforeach

							                            </select>
						                            </div>
						                        </div>
						                    </div>

						                    
						                </div>


						                <div class="box-footer">
						                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
						                        <button type="button" class="btn btn-default waves-effect waves-light" style="margin-right: 5px;"><i class="fa fa-save"></i> {{ trans('button.edit') }}</button>
						                    </div>
						                </div> 
						            </div>    
						        </div>
						</div>
		            </div>
		            <div class="bhoechie-tab-content">
		                <div class="modal-dialog" >
						        <div class="modal-content">
						            <div class="modal-header">
						                <h4 class="box-title" style="border-bottom: 1px solid #DDD; padding-bottom: 15px;">معلومات الشركة</h4>
						                
						                <div class="box-body">
						                    <div class="col-xs-12 col-sm-12 col-md-12">
						                        <div class="form-group">
						                            <div class="col-sm-4 col-xs-12">
						                                <strong>اسم الشركة :</strong>
						                            </div>
						                            <div class="col-sm-8">
						                            	<input class="form-control" type="text" name="company" value="{{$user->company}}">
						                            </div>	
						                            	
						                        </div>
						                    </div>

						                    <div class="col-xs-12 col-sm-12 col-md-12">
						                        <div class="form-group">
						                            <div class="col-sm-4 col-xs-12">
						                                <strong>نوع الشركة :</strong>
						                            </div>    
						                            <div class="col-sm-8">
						                            	<?php $types = \DB::table('company_types')->orderBy('id','ASC')->get(); ?>
						                            	<select class="form-control select2 company_type_id">
						                            		<option>{{trans('master.select_item_from_list')}}</option>
						                            		@foreach($types as $one)
						                            		@if($one->id == $user->company_type_id)
						                            		<option value="{{$one->id}}" selected>{{$one->name_ar}}</option>
						                            		@else
						                            		<option value="{{$one->id}}">{{$one->name_ar}}</option>
						                            		@endif
						                            		@endforeach
						                            	</select>
						                            </div>
						                        </div>
						                    </div>

						                    <div class="col-xs-12 col-sm-12 col-md-12">
						                        <div class="form-group">
						                            <div class="col-sm-4 col-xs-12">
						                                <strong>عدد الموظفين :</strong>
						                            </div>    
						                            <div class="col-sm-8">
						                            	<input type="hidden" name="employees2" class="employees2" value="{{$user->employees}}">
						                            	<select class="form-control employees select2">
						                            		<option>{{trans('master.select_item_from_list')}}</option>
			                                                <option>10 : 25</option>
			                                                <option>25 : 50</option>
			                                                <option>50 : 100</option>
			                                                <option>100 : 250</option>
			                                            </select>
						                            </div>
						                        </div>
						                    </div>
						                </div>


						                <div class="box-footer">
						                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
						                        <button type="button" class="btn btn-default waves-effect waves-light" style="margin-right: 5px;"><i class="fa fa-save"></i> {{ trans('button.edit') }}</button>
						                    </div>
						                </div> 
						            </div>    
						        </div>
						</div>
		            </div>
		            <div class="bhoechie-tab-content" id="bank">
		            	<div class="modal-dialog" >
						    <div class="modal-content">
						            <div class="modal-header">
						                <h4 class="box-title" style="border-bottom: 1px solid #DDD; padding-bottom: 15px;position: relative;">معلومات الحساب البنكي <i class="fa fa-eye fa-1x" style="position: absolute;left: 20px;cursor: pointer;"></i></h4>
						                
						                <div class="box-body">
						                    <div class="col-xs-12 col-sm-12 col-md-12">
						                        <div class="form-group">
						                            <div class="col-sm-4 col-xs-12">
						                                <strong>نوع الحساب :</strong>
						                            </div>    
						                            <div class="col-sm-8">
						                            	<?php 
						                            		$bank_types = \DB::table('bank_data_types')->orderBy('id','ASC')->get(); 
						                            		$id = \Auth::user()->id;
						                            		$user_bank = \DB::table('user_bank_accounts')->where('user_id','=',$id)->first();	
						                            	?>
						                            	<select class="form-control select2 bank_type">
						                            		<option>{{trans('master.select_item_from_list')}}</option>
						                            		@foreach($bank_types as $one)
						                            		@if(!empty($user_bank))
							                            		@if($one->id == $user_bank->bank_data_type_id)
							                            		<option value="{{$one->id}}" selected>{{$one->name_ar}}</option>
							                            		@else
							                            		<option value="{{$one->id}}">{{$one->name_ar}}</option>
							                            		@endif
							                            	@else
							                            		<option value="{{$one->id}}">{{$one->name_ar}}</option>
						                            		@endif
						                            		@endforeach
						                            	</select>
						                            </div>
						                        </div>
						                    </div>
						                    <?php 
						                    	$bank_name;
						                    	$id_number;
						                    	$owner_name;
						                    	$iban;
						                    	$bic;
						                    	if(!empty($user_bank->bank_name) && !empty($user_bank->id_number) && !empty($user_bank->owner_name) && !empty($user_bank->iban) && !empty($user_bank->bic)){
						                    		$bank_name  = decrypt($user_bank->bank_name);
						                    		$id_number  = decrypt($user_bank->id_number);
						                    		$owner_name = decrypt($user_bank->owner_name);
						                    		$iban 		= decrypt($user_bank->iban);
						                    		$bic        = decrypt($user_bank->bic);
						                    	}else{
						                    		$bank_name  = '';
						                    		$id_number  = '';
						                    		$owner_name = '';
						                    		$iban		= '';
						                    		$bic 		= '';
						                    	}

						                    ?>
						                    <div class="col-xs-12 col-sm-12 col-md-12">
						                        <div class="form-group">
						                            <div class="col-sm-4 col-xs-12">
						                                <strong>أسم البنك :</strong>
						                            </div>    
						                            <div class="col-sm-8">
						                            	<input class="form-control" type="text" name="bank_name" value="{{$bank_name}}">
						                            </div>
						                        </div>
						                    </div>

						                    <div class="col-xs-12 col-sm-12 col-md-12">
						                        <div class="form-group">
						                            <div class="col-sm-4 col-xs-12">
						                                <strong>رقم الحساب :</strong>
						                            </div>    
						                            <div class="col-sm-8">
						                            	<input class="form-control" type="text" name="id_number" value="{{$id_number}}">
						                            </div>
						                        </div>
						                    </div>       

						                    <div class="col-xs-12 col-sm-12 col-md-12">
						                        <div class="form-group">
						                            <div class="col-sm-4 col-xs-12">
						                                <strong>اسم العميل :</strong>
						                            </div>    
						                            <div class="col-sm-8">
						                            	<input class="form-control" type="text" name="owner_name" value="{{$owner_name}}">
						                            </div>
						                        </div>
						                    </div>       

						                    <div class="col-xs-12 col-sm-12 col-md-12">
						                        <div class="form-group">
						                            <div class="col-sm-4 col-xs-12">
						                                <strong>iban :</strong>
						                            </div>    
						                            <div class="col-sm-8">
						                            	<input class="form-control" type="text" name="iban" value="{{$iban}}">
						                            </div>
						                        </div>
						                    </div>       

						                    <div class="col-xs-12 col-sm-12 col-md-12">
						                        <div class="form-group">
						                            <div class="col-sm-4 col-xs-12">
						                                <strong>bic :</strong>
						                            </div>    
						                            <div class="col-sm-8">
						                            	<input class="form-control" type="text" name="bic" value="{{$bic}}">
						                            </div>
						                        </div>
						                    </div>       
						                </div>


						                <div class="box-footer">
						                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
						                        <button type="button" class="btn btn-default waves-effect waves-light" style="margin-right: 5px;"><i class="fa fa-save"></i> {{ trans('button.edit') }}</button>
						                    </div>
						                </div> 
						            </div>    
						    </div>
						</div>    
		            </div>
		            <div class="bhoechie-tab-content">
		            	<div class="modal-dialog" >
						    <div class="modal-content">
						            <div class="modal-header">
						                <h4 class="box-title" style="border-bottom: 1px solid #DDD; padding-bottom: 15px;">معلومات الضرائب والدفع</h4>
						                
						                <div class="box-body">
						                    <div class="col-xs-12 col-sm-12 col-md-12">
						                        <div class="form-group">
						                            <div class="col-sm-4 col-xs-12">
						                                <strong>السجل التجاري :</strong>
						                            </div>    
						                            <div class="col-sm-8">
						                            	<input class="form-control" type="text" name="comercial_no" value="{{$user->comercial_no}}">
						                            </div>
						                        </div>
						                    </div>
						                    <div class="col-xs-12 col-sm-12 col-md-12">
						                        <div class="form-group">
						                            <div class="col-sm-4 col-xs-12">
						                                <strong>البطاقة الضريبة :</strong>
						                            </div>    
						                            <div class="col-sm-8">
						                            	<input class="form-control" type="text" name="tax_file_no" value="{{$user->tax_file_no}}">
						                            </div>
						                        </div>
						                    </div>

						                    <div class="col-xs-12 col-sm-12 col-md-12">
						                        <div class="form-group">
						                            <div class="col-sm-4 col-xs-12">
						                                <strong>الرقم الضريبي :</strong>
						                            </div>    
						                            <div class="col-sm-8">
						                            	<input class="form-control" type="text" name="tax_no" value="{{$user->tax_no}}">
						                            </div>
						                        </div>
						                    </div>       

						                    <div class="col-xs-12 col-sm-12 col-md-12">
						                        <div class="form-group">
						                            <div class="col-sm-4 col-xs-12">
						                                <strong>الباقة :</strong>
						                            </div>    
						                            <div class="col-sm-8">
						                            	<?php $plans = \DB::table('price_plans')->orderBy('id','ASC')->get(); ?>
						                            	<select class="form-control select2 price_plan_id">
						                            		<option>{{trans('master.select_item_from_list')}}</option>
						                            		@foreach($plans as $one)
						                            		@if($one->id == $user->price_plan_id)
						                            		<option value="{{$one->id}}" selected>{{$one->name}}</option>
						                            		@else
						                            		<option value="{{$one->id}}">{{$one->name}}</option>
						                            		@endif
						                            		@endforeach
						                            	</select>
						                            </div>
						                        </div>
						                    </div>       
						                </div>


						                <div class="box-footer">
						                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
						                        <button type="button" class="btn btn-default waves-effect waves-light" style="margin-right: 5px;"><i class="fa fa-save"></i> {{ trans('button.edit') }}</button>
						                    </div>
						                </div> 
						            </div>    
						    </div>
						</div>    
		            </div>
		        </div>
	        </form>
	    </div>
		<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 pull-left">
			<div class="invoices"> 
	 			<div class="col-lg-12  col-12 letter" id="tab1">
	  				<div class="row">
	   					<div class="header_right col-sm-6 col-xs-12">

	   						<h3 class="dumy_background firstLogo">{{@$profile['company']}}</h3>
            				<p class="dumy_background det">{{@$profile['postal_code']}} | {{@$country['name_ar']}} | {{@$profile['phone']}}</p>
							<p class="dumy_background"></p>
							<p class="dumy_background"></p>
				 		</div>
			 		</div>
				  	<div class="row pay_details">
				        <div class="col-xs-7 right">
				            <h6>حررت هذه الفاتورة ل :</h6>
				            <p class="p dumy_background"></p><br>
				            <strong>التليفون : </strong><p class="p dumy_background"></p><br>
				            <strong>العنوان : </strong><p class="p dumy_background"></p><br>
				        </div>
				        <div class="col-xs-5 left">
				            <strong>رقم الفاتورة : </strong><p class="p dumy_background"> </p><br>
				            <strong>تاريخ الفاتورة : </strong><p class="p dumy_background"> </p><br>
				            <strong>رقم العميل : </strong><p  class="p dumy_background"></p><br>
				        </div>
    				</div>
					<div class="row">
					   <footer name="page-footer" style=" margin-top:90px; direction: rtl;">
								<hr style="margin-bottom: 5px;">
				                <div class="col-xs-4 pull-left" style="float:right; width:33.3333%;text-align: right;">
				                    <p class="dumy_background_footer">{{@$profile['company']}}</p>
				                    <p class="dumy_background_footer">{{@$profile['address']}}</p>
				                    <p class="dumy_background_footer">{{@$profile['postal_code']}} {{@$profile['district']}}</p>
				                    <p class="dumy_background_footer">{{@$governorate->name_ar}} {{@$country['name_ar']}} </p>
				                </div>

				                <div class="col-xs-4 pull-left" style="float:right;width:33.3333%;text-align: right;">
				                    <p class="dumy_background_footer">التليفون : {{@$profile['phone']}}</p>
				                    <p class="dumy_background_footer">فاكس : {{@$profile['fax']}}</p>
				                    <p class="dumy_background_footer">{{Auth::user()->email}}</p>
				                    <p class="dumy_background_footer">{{@$profile['url']}}</p>
				                </div>
				                <div class="col-xs-4 pull-left" style="float:right;width:33.3333%;text-align: right;">
				                	<span class="dumy_background_footer" style="width: 40px;display: inline-block;float: right;">IBAN : </span><span class="dumy_background_footer pull-left" style="width: calc(100% - 40px);font-size: 9px;">{{@$iban}}</span>
				                	<div class="clearfix"></div>
				                	
				                	<span class="dumy_background_footer" style="width: 40px;display: inline-block;float: right;">BIC : </span><span class="dumy_background_footer pull-left" style="width: calc(100% - 40px);font-size: 9px;">{{@$bic}}</span>
				                	<div class="clearfix"></div>

				                	<span class="dumy_background_footer" style="width: 40px;display: inline-block;float: right;">BANK : </span><span class="dumy_background_footer pull-left" style="width: calc(100% - 40px);font-size: 9px;">{{@$bank_name}}</span>
				                	<div class="clearfix"></div>

				                </div>
				  		</footer>
  					</div>
	
		 		</div>
 	 		</div> 
		</div>
	</div>
</div>
   											 
            
@endsection 

@section('page-scripts')
<script src="plugins/notifyjs/js/notify.js"></script>
<script src="plugins/notifications/notify-metro.js"></script>
<script type="text/javascript">
	$(document).ready(function () {

		$(".dumy_background_footer").each(function(){
		    if (!$(this).text().trim().length) {
		    	$(this).css('backgroundColor','#DDD');
			}else{
				$(this).css({'backgroundColor':'#FFF','padding':'0','margin':'0'});
			}
		});
		$(".dumy_background").each(function(){
		    if (!$(this).text().trim().length) {
		    	$(this).css('backgroundColor','#DDD');
			}else{
				$(this).css('backgroundColor','#FFF');
			}
		});

		$('select').select2();
   		 $("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
	        e.preventDefault();
	        $(this).siblings('a.active').removeClass("active");
	        $(this).addClass("active");
	        var index = $(this).index();
	        $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
	        $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
	    });

   		var emp = $('.employees2').val();
   		$('.employees').val(emp).trigger('change');

   		$('.fa-eye').on('click',function(){
   			$(this).toggleClass('fa-eye-slash');
   			if($('.fa-eye').hasClass('fa-eye-slash')){
   				$('#bank input[type="text"]').attr('type','password');
   			}else{
   				$('#bank input[type="password"]').attr('type','text');
   			}
   		});



   		$('.btn-default').on('click',function(e){
   			e.preventDefault();
   			$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
   			$.ajax({
   				type : "POST",
   				url  : "{{route('editUserMang')}}",
   				data : {
	   					'_token': $('input[name=_token]').val(),
	   					'id'	: <?php echo $id; ?>,
	   					'email' : $("input[name='email']").val(),
                        'password': $("input[name='password']").val(),
                        'password_confirmation': $("input[name='password_confirmation']").val(),
                        
                        'first_name' : $('input[name="first_name"]').val(),
                        'last_name' : $('input[name="last_name"]').val(),
                        'phone' : $('input[name="phone"]').val(),
                        'address' : $('input[name="address"]').val(),
                        'district' : $('input[name="district"]').val(),
                        'postal_code' : $('input[name="postal_code"]').val(),
                        'governorate' : $('select[name="governorate_id"]').val(),
                        'country' : $('select[name="country_id"]').val(),

                        'bank_data_type_id' : $('.bank_type option:selected').val(),
                        'bank_name' : $('input[name="bank_name"]').val(),
                        'id_number' : $('input[name="id_number"]').val(),
                        'owner_name' : $('input[name="owner_name"]').val(),
                        'iban' : $('input[name="iban"]').val(),
                        'bic' : $('input[name="bic"]').val(),

                        'company'   : $('input[name="company"]').val(),
                        'company_type_id' : $('.company_type_id option:selected').val(),
                        'employees' : $('.employees option:selected').text(),

                        'comercial_no' : $('input[name="comercial_no"]').val(),
                        'tax_file_no' : $('input[name="tax_file_no"]').val(),
                        'tax_no' : $('input[name="tax_no"]').val(),
                        'price_plan_id' : $('.price_plan_id option:selected').val(),
   				},
   				success:function(data) {
                    $.Notification.autoHideNotify('success', 'top right', 'Updated successfully','Your Information has been updated successfully<br>');
                     setTimeout(function () {
                        location.reload();
                    },2000)
                },
                error: function (data) {
                    var response = JSON.parse(data.responseText);
                    $.each(response.errors, function (key, val) {
                        $('.alert-danger').removeClass('hidden');
                        $('.alert-danger').append('<li>'+val+'</li>')
                    });
                }	
   			});
   		});



	});


</script>
@endsection