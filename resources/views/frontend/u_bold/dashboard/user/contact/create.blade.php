@extends(Config::get('front_theme').'.dashboard.'.$userType.'.'.$module.'.partials.layout')

@section('content_dashboard')
<!-- right column -->



<style>
    .checkbox.checkbox-inline{margin-top: 20px;margin-bottom: 20px;font-size: 16px;}
</style>
 <!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">


        <h4 class="page-title" style="margin-top: -50px;">أضافة عميل</h4>
        <p class=" page-title-alt">من هنا يمكنك تحدد واضافة العملاء</p>
    </div>
</div>
 <!-- end row -->

<div class="col-md-offset-1 col-md-10">
    <form action="{{route('contact.store')}}" method="post">
        {{ csrf_field() }}
        <div class="panel">
            <div class="panel-body page-create with-padding">
                <div class="row">
                    <div class="col-xs-12 ">
                        <h3 class="pull-left label label-def" data-toggle="customer-row">أضافة عميل جديد   </h3>
                    </div>
                </div>

                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                {{--{{dd(Session::all())}}--}}
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
                    <?php
                        if (old('customer_input') == 'on' && old('supplier_input') == 'on'){
                            $customerCheck = 'checked';
                            $supplierCheck = 'checked';
                        }elseif (old('customer_input')=='on' ) {
                            $customerCheck = 'checked';
                            $supplierCheck = '';
                        }elseif(old('supplier_input') == 'on'){
                            $customerCheck = '';
                            $supplierCheck = 'checked';
                        }else{
                            $customerCheck = 'checked';
                            $supplierCheck = '';
                        }
                    ?>
                <div class="row">
                    <!-- first row-->
                    <div class="row">
                        <div class="col-xs-4 col-sm-1">
                            <div class="checkbox checkbox-custom checkbox-inline ">
                                <input type="checkbox" name="customer_input" {{$customerCheck}} id="customer_input" href="javascript:void(0);">
                                <label for="customer_input">عميل</label>
                            </div>
                        </div>

                        <div class="col-xs-4 col-sm-2">
                            <div class="checkbox checkbox-custom checkbox-inline">
                                <input type="checkbox" name="supplier_input" {{$supplierCheck}} id="supplier_input" href="javascript:void(0);">
                                <label for="supplier_input">مورد</label>
                            </div>
                        </div>
                    </div>

                    <!-- end first row-->

                    <div class="col-sm-3 col-xs-12">
                        <div class="form-group has-feedback ">
                            <label class="control-label">الاسم الاول :</label>
                            <input class="form-control" name="first_name" type="text"  placeholder="" value="{{old('first_name') ? old('first_name') : ''}}">
                            <span class="fa fa-user fa-fw form-control-feedback"></span>
                        </div>
                    </div>

                    <div class="col-sm-3 col-xs-12">
                        <div class="form-group has-feedback ">
                            <label class="control-label">الاسم الاخير :</label>
                            <input class="form-control" name="last_name" type="text"  placeholder="" value="{{old('last_name') ? old('last_name') : ''}}">
                            <span class="fa fa-user fa-fw form-control-feedback"></span>
                        </div>
                    </div>

                    <div class="col-sm-3 col-xs-12">
                        <div class="form-group has-feedback ">
                            <label class="control-label">الوظيفة :</label>
                            <input class="form-control" name="job" type="text"  placeholder="" value="{{old('job') ? old('job') : ''}}">
                            <span class="fa fa-briefcase fa-fw form-control-feedback"></span>
                        </div>
                    </div>

                    <div class="col-sm-3 col-xs-12">
                        <div class="form-group has-feedback ">
                            <label class="control-label">المنظمة :</label>
                            <input class="form-control" name="company" type="text"  placeholder="" value="{{old('company') ? old('company') : ''}}">
                            <span class="fa fa-building fa-fw form-control-feedback"></span>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-sm-3 col-xs-12" id="customer_label" style="{{$customerCheck == 'checked' ? '' : 'display:none;'}}">
                            <div class="form-group  ">
                                <label  class="control-label">رقم العميل :</label>
                                <input class="form-control" name="customer_code" type="number" placeholder="" value="{{old('customer_code') ? old('customer_code') : $customer_number}}" readonly>
                            </div>
                        </div>

                        <div class="col-sm-3 col-xs-12" id="customer_r_label" style="{{$customerCheck == 'checked' ? '' : 'display:none;'}}">
                            <div class="form-group ">
                                <label  class="control-label">الرقم المرجعي للعميل :</label>
                                <input class="form-control" name="customer_reference_code" type="number" placeholder=""  value="{{old('customer_reference_code') ? old('customer_reference_code') : ''}}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-3 col-xs-12" id="supplier_label" style="{{$supplierCheck == 'checked' ? '' : 'display:none;'}}">
                            <div class="form-group  ">
                                <label  class="control-label">رقم المورد :</label>
                                <input class="form-control" name="supplier_code" type="number" placeholder="" value="{{old('supplier_code') ? old('supplier_code') :$supplier_number}}" readonly>
                            </div>
                        </div>

                        <div class="col-sm-3 col-xs-12" id="supplier_r_label" style="{{$supplierCheck == 'checked' ? '' : 'display:none;'}}">
                            <div class="form-group ">
                                <label  class="control-label">الرقم المرجعي للمورد :</label>
                                <input class="form-control" name="supplier_reference_code" type="number" placeholder=""  value="{{old('supplier_reference_code') ? old('supplier_reference_code') : ''}}">
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-lg-12 below_form">
                        <ul class="nav nav-tabs navtab-bg nav-justified">
                            <li class="active" >
                                <a href="#adresse_tab" data-toggle="tab" aria-expanded="false">
                                    <span class="visible-xs"><i class="fa fa-home"></i></span>
                                    <span class="hidden-xs">العنوان</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="#profile1" data-toggle="tab" aria-expanded="true">
                                    <span class="visible-xs"><i class="fa fa-user"></i></span>
                                    <span class="hidden-xs">تفاصيل الاتصال</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="#messages1" data-toggle="tab" aria-expanded="false">
                                    <span class="visible-xs"><i class="fa fa-envelope-o"></i></span>
                                    <span class="hidden-xs">معلومات البنك</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="#settings1" data-toggle="tab" aria-expanded="false">
                                    <span class="visible-xs"><i class="fa fa-cog"></i></span>
                                    <span class="hidden-xs">ملاحظات</span>
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content" style="padding: 20px 0">
                            <div class="tab-pane active" id="adresse_tab" >
                                <div id="adresse">
                                    @if(count(old('adresse')))
                                                <?php $index = 0   ?>
                                        @foreach(old('adresse') as $adress)
                                                <?php $index++ ?>
                                                {!! $index > 1 ? '<div class="page-create"><hr></div>' : '' !!}
                                                <div class=" row adresse_block">
                                                <div class="form-group col-xs-11 ">
                                                     <label>اسم الشارع ورقم البيت :</label>
                                                    <input type="text" name="adresse[{{$index}}][address_number]" placeholder="" class="form-control" value="{{$adress['address_number'] ? $adress['address_number'] : '' }}">
                                                </div>

                                                <div class="col-xs-1 trash">
                                                    <a href="javascript:void(0);"  class="remCF" {{$index > 1 ? "onclick=removeAdres(remCF$index) id=remCF$index" : ""}} ><i class="fa fa-trash fa-2x " style="color:#5FBEAA;margin-top: 27px;"></i></a>
                                                </div>

                                                <div class="form-group col-xs-3 ">
                                                    <label>الرقم البريدى :</label>
                                                    <input type="number" name="adresse[{{$index}}][code_tax]" placeholder="" class="form-control"  value="{{$adress['code_tax'] ? $adress['code_tax'] : '' }}">
                                                </div>

                                                <div class="form-group col-xs-3">
                                                    <label>اسم المركز :</label>
                                                    <input type="text" name="adresse[{{$index}}][region]" placeholder="" class="form-control"  value="{{$adress['region'] ? $adress['region'] : '' }}" >
                                                </div>


                                                <div class="form-group col-xs-3">
                                                    <label>اسم المحافظة:</label>


                                                    <select name="adresse[{{$index}}][governorate]" class="form-control" >
                                                        @foreach($governorates as $key => $governorate)

                                                            <option value="{{$key}}" >{{$governorate}}</option>
                                                        @endforeach

                                                    </select>
                                                </div>

                                                <div class="form-group col-xs-3">
                                                    <label>اسم الدولة :</label>
                                                    <select name="adresse[{{$index}}][country]" class="form-control">
                                                        @foreach($countries as $key => $country)
                                                            <option value="{{$key}}">{{$country}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class=" row adresse_block">
                                            <div class="form-group col-xs-11 ">
                                                <label>اسم الشارع ورقم البيت :</label>
                                                <input type="text" name="adresse[1][address_number]" placeholder="" class="form-control">
                                            </div>

                                            <div class="col-xs-1 trash">
                                                <a href="javascript:void(0);" class="remCF" ><i class="fa fa-trash fa-2x " style="color:#5FBEAA;margin-top: 27px;"></i></a>
                                            </div>

                                            <div class="form-group col-xs-3 ">
                                                <label>الرقم البريدى :</label>
                                                <input type="number" name="adresse[1][code_tax]" placeholder="" class="form-control" >
                                            </div>

                                            <div class="form-group col-xs-3">
                                                <label>اسم المركز :</label>
                                                <input type="text" name="adresse[1][region]" placeholder="" class="form-control" >
                                            </div>


                                            <div class="form-group col-xs-3">
                                                <label>اسم المحافظة:</label>
                                                <select name="adresse[1][governorate]" class="form-control" >
                                                    @foreach($governorates as $key => $governorate)
                                                        <option value="{{$key}}" >{{$governorate}}</option>
                                                        @if($key=="6")
                                                        <option value="{{$key}}" selected>{{$governorate}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group col-xs-3">
                                                <label>اسم الدولة :</label>
                                                <select name="adresse[1][country]" class="form-control">
                                                    @foreach($countries as $key => $country)
                                                        <option value="{{$key}}">{{$country}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <button type="button" class="btn btn-default btn-custom btn-rounded waves-effect waves-light" id="add_adress">+إضافه عنوان</button>

                            </div>

                            <div class="tab-pane " id="profile1">
                                 <div class="row">
                                    <div class="contact_details_header col-xs-12">
                                        <label>التليفون :</label>
                                    </div>
                                    <div class="tel_block">
                                        @if(count(old('phones')))
                                            <?php $index2 = 0 ?>
                                            @foreach(old('phones') as $phone)
                                                <?php $index2++ ?>
                                                <div class="Tel_add ">
                                                    <div class="form-group col-xs-5 ">
                                                        <input type="number" name="phones[{{$index2}}][phone_number]" placeholder="" class="form-control "  value="{{$phone['phone_number'] ? $phone['phone_number'] : '' }}">
                                                    </div>
                                                    <div class="col-xs-1 trash">
                                                        <a href="javascript:void(0);" class="remCF"  {{$index2 > 1 ? "onclick=removePhone(remPH$index2) id=remPH$index2" : ""}} ><i class="fa fa-trash fa-2x" style="color:#5FBEAA;"></i></a>
                                                    </div>
                                                 </div>
                                            @endforeach
                                        @else
                                            <div class="Tel_add ">
                                                <div class="form-group col-xs-5 ">
                                                    <input type="number" name="phones[1][phone_number]" placeholder="" class="form-control ">
                                                </div>
                                                <div class="col-xs-1 trash">
                                                    <a href="javascript:void(0);" class="remCF"><i class="fa fa-trash fa-2x" style="color:#5FBEAA;"></i></a>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                 </div>
                                <button type="button" class="btn btn-default btn-custom btn-rounded waves-effect waves-light" id="add_tel">+إضافه تليفون </button>
                            </div>
                            <div class="tab-pane" id="messages1">
                                <div class="bank_information row">
                                    <div class="form-group col-xs-3 ">
                                            <label>IBAN :</label>
                                            <input type="number" name="IBAN"  placeholder="" class="form-control" value="{{old('IBAN') ? old('IBAN') : ''}}">
                                    </div>

                                    <div class="form-group col-xs-3">
                                        <label>BIC :</label>
                                        <input type="text" name="BIC" placeholder="" class="form-control" value="{{old('BIC') ? old('BIC') : ''}}">
                                    </div>


                                    <div class="form-group col-xs-3">
                                        <label>رقم الضرائب :</label>
                                        <input type="number" name="tax_number" placeholder="" class="form-control" value="{{old('tax_number') ? old('tax_number') : ''}}">
                                    </div>

                                    <div class="form-group col-xs-3">
                                        <label>Debitoren :</label>
                                        <input type="text" name="Debitoren" placeholder="" class="form-control" value="{{old('Debitoren') ? old('Debitoren') : ''}}">
                                    </div>

                                    <div class="form-group col-xs-3">
                                        <label>اسم البنك :</label>
                                        <input type="text" name="bank_name" placeholder="" class="form-control" value="{{old('bank_name') ? old('bank_name') : ''}}">
                                    </div>

                                    <div class="form-group col-xs-3">
                                        <label>رقم الحساب :</label>
                                        <input type="text" name="bank_number" placeholder="" class="form-control" value="{{old('bank_number') ? old('bank_number') : ''}}">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="settings1" >
                                <!-- Start SummerNote -->
                                <div class="row" id="header-row">
                                    <div class="col-md-12 col-xs-12" style="margin-bottom: 15px">
                                        <textarea id="header_text" name="header_text">{{old('header_text') ? old('header_text') : ''}}</textarea>
                                    </div>
                                </div>
                                <!-- End SummerNote -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                <div class="row">
                    <div class="form-group text-right m-b-0 ">
                        <button class="btn btn-default waves-effect waves-light col-md-2" type="submit">تاكيد</button>
                        <button type="reset" class="btn btn-danger waves-effect waves-light m-l-5 col-md-2">الغاء</button>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>

<!-- End Section Main Content -->
@endsection

@section('page-scripts')
          <!--datepicker js for date -->
        <script src="plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
        <!--Summernote js-->
        <script src="plugins/tinymce/tinymce.min.js"></script>


<script>

    function removeAdres(id) {
        $(id).parent().parent().remove();
    }
    function removePhone(id) {
        $(id).parent().parent().remove();
    }
    $('#customer_input').click(function () {
        if($(this).prop( "checked" )){
            $('#customer_label').show();
            $('#customer_r_label').show();

        }
        else{
            $('#customer_label').hide();
            $('#customer_r_label').hide();
        }
    });

    $('#supplier_input').click(function () {
        if($(this).prop( "checked" )){
            $('#supplier_label').show();
            $('#supplier_r_label').show();

        }
        else{
            $('#supplier_label').hide();
            $('#supplier_r_label').hide();
        }
    });




    jQuery(document).ready(function(){
        var adresse_rowNum = 1;
        var phone_number_rowNum=1;
        $("#add_adress").click(function () {
            adresse_rowNum++;

            $("#adresse").append('<div class="page-create"><hr></div>' +
                    '<div class=" row adresse_block">' +
                         '<div class="form-group col-xs-11 ">' +
                            '<label>اسم الشارع ورقم البيت :</label>' +
                            '<input type="text"  name="adresse[' + adresse_rowNum + '][address_number]"  placeholder="" class="form-control">' +
                        '</div>' +
                        '<div class="col-xs-1 trash">' +
                            '<a href="javascript:void(0);" class="remCF"><i class="fa fa-trash fa-2x " style="color:#5FBEAA;margin-top: 27px;"></i></a>' +
                        '</div>' +
                        '<div class="form-group col-xs-3 ">' +
                            '<label>الرقم البريدى :</label>' +
                            '<input type="number"  name="adresse[' + adresse_rowNum + '][code_tax]"  placeholder="" class="form-control" >' +
                        '</div>' +
                        '<div class="form-group col-xs-3">' +
                            '<label>اسم المدينة :</label>' +
                        '<input type="text"  name="adresse[' + adresse_rowNum + '][region]" placeholder="" class="form-control" >' +
                        '</div>' +
                        '<div class="form-group col-xs-3">' +
                             '<label>اسم المحافظة :</label>' +
                            '<select  name="adresse[' + adresse_rowNum + '][governorate]"  class="form-control">' +
                                @foreach($governorates as $key => $governorate)
                                '<option value="{{$key}}">{{$governorate}}</option>' +
                                @endforeach
                            '</select>' +
                        '</div>' +
                        '<div class="form-group col-xs-3">' +
                            '<label>اسم الدولة :</label>' +
                            '<select name="adresse[' + adresse_rowNum + '][country]"  class="form-control">' +
                                @foreach($countries as $key => $country)
                                '<option value="{{$key}}">{{$country}}</option>' +
                                @endforeach
                            '</select>' +
                        '</div>' +
                    '</div>');


            $(".remCF").on('click', function () {
                adresse_rowNum--;
                $(this).parent().parent().remove();
            });

        });

        $("#add_tel").click(function () {
            phone_number_rowNum++;
            $(".tel_block").append('<div class="Tel_add ">' +
                    '<div class="form-group col-xs-5 ">' +
                        '<input type="number" name="phones['+ phone_number_rowNum +'][phone_number]"  placeholder="" class="form-control ">' +
                    '</div>' +
                    '<div class="col-xs-1 trash">' +
                        '<a href="javascript:void(0);" class="remCF"><i class="fa fa-trash fa-2x " style="color:#5FBEAA;" ></i></a>' +
                    '</div>' +
                '</div>');
            $(".remCF").on('click', function () {
                phone_number_rowNum--;
                $(this).parent().parent().remove();
            });
        });


          if($("#header_text").length > 0){
            tinymce.init({
                selector: "textarea#header_text,textarea#footer_text",
                theme: "modern",
                height:100,
                menubar: true,
                statusbar: true,
                plugins: [
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                    "save table contextmenu directionality emoticons  paste textcolor"
                ],
                toolbar: "rtl | insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
                style_formats: [
                    {title: 'Bold text', inline: 'b'},
                    {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                    {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                    {title: 'Example 1', inline: 'span', classes: 'example1'},
                    {title: 'Example 2', inline: 'span', classes: 'example2'},
                    {title: 'Table styles'},
                    {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
                ]
            });
        }


    });
</script>





@endsection
