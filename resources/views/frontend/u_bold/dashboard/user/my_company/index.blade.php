@extends(Config::get('front_theme').'.layouts.default')


@section('title',$page_title)

@section('page-styles')
<link rel="stylesheet" type="text/css" href="plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" type="text/css" href="plugins/select2/css/select2.min.css">

<style>
    .select2-container .select2-selection--single{
        height: 33px !important;
        direction: rtl !important;
    }
    .select2-container .select2-selection--single .select2-selection__rendered {
        line-height: 32px !important;
        padding-left: 25px !important;
        padding-right: 5px !important;
        font-size: 14px;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        top: 3px;
        right: inherit;
        left: 5px;
    }
    .select2-container--open .select2-dropdown--above {
        padding: 0;
        direction: rtl;
    }
    .tax_info_body{display:none;}
    .custom_note{
        background: #5fbeaa;
        height: 50px;
        color: #FFF;
        text-align: center;
        line-height: 50px;
        margin-bottom: 25px;
        border-radius: 010px;
    }

</style>

@endsection()


@section('subnav')

@include(Config::get('front_theme').'.dashboard.'.$userType.'.my_company.inc.subnav')

@endsection




@section('content')




<div class="row m-b-20" style="margin-top: 75px;">
    <div class="col-xs-12 ">
        <h4 class="page-title">شركتي</h4>
        <p class="text-muted page-title-alt m-b-0">من هنا يمكنك اضافة معلومات عن شركتك</p>
    </div>
</div>






<div class="panel panel-default page-panel col-md-offset-1 col-md-10 company_info_body" >

    <div class="panel-heading">
        <div class="row">

            <ul class="panel-nav pull-left">
                <li><a class="active company_info" href="javascript:void(0)" > معلومات الشركة</a></li>
                <li><a class=" tax_info"  href="javascript:void(0)" >معلومات الضرائب</a></li>
            </ul>

        </div>
    </div>



    <div class="panel-body with-padding ">
        <div class="row">
            <div class="col-xs-12 ">
                <h3 class="pull-left label label-def" data-toggle="customer-row">معلومات الشركة</h3>
            </div>
        </div>
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif            
        {!! Form::model($data, ['method' => 'patch','route' => [ 'mycompany.update', $data->id]]) !!}   
        <div class="row">               
            <div class="col-md-6 col-xs-12">

                <div class="form-group has-feedback ">
                    <label for="name" class="control-label">اسم الشركة :</label>
                    <input placeholder="اسم الشركة" id="name" class="form-control" name="company" value="{{$data->company}}" type="text" >                        
                    <span class="fa fa-user fa-fw form-control-feedback"></span>
                </div>


                <div class="form-group has-feedback  col-md-6 col-xs-12 ">
                    <label for="first_name" class="control-label">الاسم الاول :</label>
                    <input placeholder="الاسم الاول" id="first_name" class="form-control" name="first_name" value="{{$data->first_name}}" type="text" >                        
                    <span class="fa fa-user fa-fw form-control-feedback"></span>
                </div>



                <div class="form-group has-feedback col-md-6 col-xs-12">
                    <label for="last_name" class="control-label">الاسم الاخير :</label>
                    <input placeholder="الاسم الاخير" id="last_name" class="form-control" name="last_name" value="{{$data->last_name}}" type="text" >                        
                    <span class="fa fa-user fa-fw form-control-feedback"></span>
                </div>



                <div class="form-group has-feedback ">
                    <label for="name" class="control-label">العنوان :</label>
                    <input placeholder="العنوان"  class="form-control" name="address" id="address"   value="{{$data->address}}" type="text"  >                          
                    <span class="fa fa-map-marker  fa-fw form-control-feedback"></span>
                </div>

                <div class="col-md-6 col-xs-12">
                    <div class="form-group has-feedback ">
                        <label for="name" class="control-label">اسم الدولة :</label>
                        {!! Form::select('country_id', 
                        (['' => trans('master.select_item_from_list')] + $countries), 
                        $data->country_id,  
                        ['class' => 'form-control select2']) !!}                         

                        <span class="fa fa-map-marker  fa-fw form-control-feedback"></span>
                    </div>
                </div>

                <div class="col-md-6 col-xs-12">
                    <div class="form-group has-feedback ">
                        <label for="name" class="control-label">اسم المدينة :</label>
                        {!! Form::select('governorate_id', 
                        (['' => trans('master.select_item_from_list')] + $governorates), 
                        $data->governorate_id,  
                        ['class' => 'form-control select2']) !!}                            
<!--                        <input placeholder="اسم المدينة"  class="form-control" type="text">         -->
                        <span class="fa fa-map-marker  fa-fw form-control-feedback"></span>
                    </div>
                </div>
                <div class="col-md-12 col-xs-12">
                    <div class="form-group has-feedback ">
                        <label for="name" class="control-label">اسم المركز :</label>

                        <input placeholder="اسم المركز"  class="form-control" name="district" id="address"   value="{{$data->district}}" type="text"  >                                
                        <span class="fa fa-map-marker  fa-fw form-control-feedback"></span>
                    </div>
                </div>

            </div>    




            <div class="col-md-6 col-xs-12">
                <div class="row">
                    <div class="col-md-6 col-xs-12">

                        <div class="form-group has-feedback ">
                            <label class="control-label">    رقم التليفون   :</label>
                            <input placeholder="رقم التليفون" class="form-control" name="phone" value="{{$data->phone}}"  type="text">                        
                            <span class="fa fa-phone fa-fw form-control-feedback"></span>
                        </div>                                
                    </div>

                    <div class="col-md-6 col-xs-12">

                        <div class="form-group has-feedback ">
                            <label class="control-label">    رقم الفاكس   :</label>
                            <input placeholder="رقم الفاكس" class="form-control" name="fax" value="{{$data->fax}}"  type="text">                   
                            <span class="fa fa-fax fa-fw form-control-feedback"></span>
                        </div>                                
                    </div>

                    <div class="col-md-6 col-xs-12">

                        <div class="form-group has-feedback ">
                            <label class="control-label">   البريد الالكترونى  :</label>

                            <input placeholder="البريد الالكترونى" class="form-control" name="email" value="{{$user->email}}"  type="text" readonly="yes">                 
                            <span class="fa fa-envelope fa-fw form-control-feedback"></span>
                        </div>                                
                    </div>

                    <div class="col-md-6 col-xs-12">
                        <div class="form-group has-feedback ">
                            <label class="control-label">    الرقم البريدى   :</label>
                            <input placeholder="الرقم البريدي" class="form-control" name="postal_code" value="{{$data->postal_code}}"  type="text">                      
                            <span class="fa fa-hashtag fa-fw form-control-feedback"></span>
                        </div>                                
                    </div>
                    
                    <div class="col-md-12 col-xs-12">
                        <div class="form-group has-feedback ">
                            <label class="control-label">      رابط الموقع   :</label>
                            <input placeholder="رابط الموقع  " class="form-control" name="url" value="{{$data->url}}"  type="text">                      
                            <span class="fa fa-hashtag fa-fw form-control-feedback"></span>
                        </div>                                
                    </div>
                    
                </div> 


                <div class="row">

                    <div class="form-group has-feedback ">
                        <label for="comment" class="  control-label">  التعليقات :</label>
                        <textarea placeholder="التعليقات" rows="6" style="height: 50px;" class="form-control"  cols="50" name="notes">{{$data->notes}}</textarea>                       

                    </div>

                </div>




            </div>                <div class="col-md-12 col-xs-12">
                <div class="form-group">
                    <!--<input type="submit" class="btn btn-primary" value="Save">     -->
                    <button type="submit" class="btn w-sm btn-default waves-effect waves-light">حفظ</button>         
                </div>
            </div>


        </div>
        </form>
    </div>

</div>
<!--ُEnd company_info_body-->

<div class="panel panel-default page-panel col-md-offset-1 col-md-10 tax_info_body" >

    <div class="panel-heading">
        <div class="row">

            <ul class="panel-nav pull-left">
                <li><a class="company_info"    href="javascript:void(0)" >معلومات الشركة</a></li>
                <li><a class="active tax_info"  href="javascript:void(0)" >معلومات الضرائب</a></li>
            </ul>

        </div>
    </div>



    <div class="panel-body with-padding ">
        <div class="row">
            <div class="col-xs-12 ">
                <h3 class="pull-left label label-def">معلومات الضرائب</h3>
            </div>
        </div>
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif            
        {!! Form::model($data, ['method' => 'patch','route' => [ 'mycompany.update_tax', $data->id]]) !!}   
        <div class="row">               
            <div class="col-md-6 col-xs-12">


                <!--                    <div class="form-group has-feedback ">
                
                                        <label for="product_type" class="control-label">الحساب :</label>
                                        <select class="form-control select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                            <option selected="selected">اختار من القائمة ...</option>
                                            <option value="1">حساب 1</option>
                                            <option value="2">حساب 2</option>
                                        </select>
                
                                    </div>-->


                <div class="form-group has-feedback ">

                    <label for="product_type" class="control-label">نوع ضريبة المبيعات :</label>
                    <select class="form-control select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                        <option selected="selected">اختار من القائمة ...</option>
                        <option value="1">حساب 1</option>
                        <option value="2">حساب 2</option>
                    </select>

                </div>


                <div class="form-group has-feedback ">
                    <label class="control-label">      السجل التجاري   :</label>
                    <input placeholder="  السجل الضريبي" class="form-control" name='comercial_no'  value="{{$data->comercial_no}}" type="text">                        
                    <span class="fa fa-hashtag fa-fw form-control-feedback"></span>
                </div>    

                <div class="form-group has-feedback ">
                    <label class="control-label">      الرقم الضريبي   :</label>
                    <input placeholder="الرقم الضريبى" class="form-control" value="{{$data->tax_no}}" name='tax_no' type="text">                        
                    <span class="fa fa-hashtag fa-fw form-control-feedback"></span>
                </div>     

                <div class="form-group has-feedback ">
                    <label class="control-label">    الرقم الملف الضريبي   :</label>
                    <input placeholder="  رقم الملف الضريبي" class="form-control"name='tax_file_no' value="{{$data->tax_file_no}}"   type="text">                        
                    <span class="fa fa-hashtag fa-fw form-control-feedback"></span>
                </div>     



                <div class="form-group has-feedback ">
                    <label class="control-label">   المنطقة الضريبة  :</label>
                    <input placeholder=" المنطقة الضريبة" class="form-control" type="number">                        
                    <span class="fa fa-map-marker fa-fw form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback ">

                    <label for="product_type" class="control-label">مدة دفع الضريبة :</label>
                    <select class="form-control select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                        <option selected="selected">اختار من القائمة ...</option>
                        <option value="1">شهرى</option>
                        <option value="2">سنوى</option>
                    </select>

                </div> 

            </div>
            <div class="col-md-6 col-xs-12 panel-custom">

                <div >
                    <h6 class="custom_note">يمكنك اخيار  احد الحسابات اللى ليك من هنا</h6>
                </div>

                <div >
                    <h6 class="custom_note">يمكنك نوع الضريبة من هنا</h6>
                </div>
            </div>

        </div>    




        <div class="col-md-12 col-xs-12">
            <div class="form-group">
                <!--<input type="submit" class="btn btn-primary" value="Save">     -->
                <button type="submit" class="btn w-sm btn-default waves-effect waves-light">حفظ</button>         
            </div>
        </div>
        </form>

    </div>

</div>

</div>
<!--ُEnd company_info_body-->

@endsection


@section('page-scripts')
<script src="plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="plugins/select2/js/select2.min.js"></script>
<script src="plugins/tinymce/tinymce.min.js"></script>
<script>

$('.company_info').click(function () {
    $('.tax_info_body').slideToggle();
    $('.company_info_body').slideToggle();

});

$('.tax_info').click(function () {
    $('.company_info_body').slideToggle();
    $('.tax_info_body').slideToggle();
});


jQuery(document).ready(function ($) {



    $("#product_type_id").select2({
        width: '100%',
        minimumResultsForSearch: -1
    });
    $("#unit_id").select2({
        width: '100%',
        minimumResultsForSearch: -1
    });

    $(".select2").select2({
        width: '100%',
        minimumResultsForSearch: -1
    });

});


</script>


@endsection



