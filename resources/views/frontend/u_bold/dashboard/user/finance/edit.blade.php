@extends(Config::get('front_theme').'.dashboard.'.$userType.'.'.$module.'.partials.layout')



@section('title',$page_title)

@section('page-styles')
    <link rel="stylesheet" type="text/css" href="plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
    <!-- Ladda buttons css -->
    <link href="{{URL::to('').Config::get('assets_frontend')}}/plugins/ladda-buttons/css/ladda-themeless.min.css" rel="stylesheet" type="text/css" />
    <style>
        .radio-custom{
            margin-top: 20px;
            margin-bottom: 20px;
            font-size: 16px;
        }
        #card_details,#treasury_details{
            display:none
        }
    </style>
@endsection

@section('content_dashboard')

 <!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">


        <h4 class="page-title" style="margin-top: -50px;"> تعديل بنك\ خزينه\كارت ائتمان </h4>
        <p class=" page-title-alt"> من هنا يمكنك تعديل الخزائن والبنوك وكروت الائتمان </p>
    </div>
</div>
 <!-- end row -->

<div class="col-md-offset-1 col-md-10">

        {!! Form::Model($data,['route'=>['finance.update',$data->id],'id'=>'idform','method'=>'patch'])!!}
               {{Form::hidden('type',$type)}}
        <div class="panel">
            <div class="panel-body page-create with-padding">
                <div class="alerts">
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

                </div>
                <div class="row">
                    <div class="col-xs-12 ">
                      @if($type==1)
                        <h3 class="pull-left label label-def" data-toggle="customer-row"> تعديل بنك {{$data->account_owner}}</h3>
                      @elseif($type==2)
                          <h3 class="pull-left label label-def" data-toggle="customer-row"> تعديل خزينه {{$data->treasury_name}}</h3>
                      @elseif($type==3)
                            <h3 class="pull-left label label-def" data-toggle="customer-row"> تعديل كارت ائتمان  {{$data->credit_owner}}</h3>
                      @endif
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-3 col-xs-12">

                        <div class="form-group has-feedback ">
                            <label  class="control-label">رقم تسلسلى :</label>
                            <input class="form-control" type="text" placeholder=""  value="{{$data->serial_number}}" name="serial_number" id="serial_number" readonly>
                            <span class="fa fa-hashtag fa-fw form-control-feedback"></span>
                        </div>
                    </div>
                </div>

                <!-- Start bank details -->
          @if($type==1)
                <!-- <div id="back_details"> -->
                    <div class="row">
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group has-feedback ">
                                <label class="control-label">صاحب الحساب :</label>
                                <input class="form-control" type="text"  placeholder="" value="{{$data->account_owner}}" name="account_owner">
                                <span class="fa fa-user fa-fw form-control-feedback"></span>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-12">
                            <div class="form-group has-feedback ">
                                <label class="control-label">رصيد البنك :</label>
                                <input class="form-control" type="text"  placeholder="" value="{{$data->bank_balance}}" name="bank_balance">
                                <span class="fa fa-money fa-fw form-control-feedback"></span>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-12">
                            <div class="form-group has-feedback ">
                                <label class="control-label" for="start_date" >تاريخ الرصيد :</label>
                                <input class="form-control" type="text"  placeholder="" value="{{$data->start_date}}" name="start_date" id="start_date">
                                <span class="fa fa-calendar fa-fw form-control-feedback"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3 col-xs-12">
                            <div class="form-group has-feedback ">
                                <label class="control-label">IBAN :</label>
                                <input class="form-control" type="text"  placeholder="" value="{{$data->IBAN}}" name="IBAN">
                                <span class="fa fa-building fa-fw form-control-feedback"></span>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-12">
                            <div class="form-group has-feedback">
                                <label  class="control-label">Swift International<small class="text-muted">(11 char).</small></label>
                                <input class="form-control" type="number" placeholder="" value="{{$data->swift_international}}" name="swift_international">
                                <span class="fa fa-hashtag fa-fw form-control-feedback"></span>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-12">
                            <div class="form-group has-feedback">
                                <label  class="control-label">رقم الحساب :</label>
                                <input class="form-control" type="number" placeholder=""  value="{{$data->account_number}}" name="account_number">
                                <span class="fa fa-hashtag fa-fw form-control-feedback"></span>
                            </div>
                        </div>

                        <div class="col-sm-3 col-xs-12">
                            <div class="form-group has-feedback ">
                                <label  class="control-label">Swift national<small class="text-muted">(9 char)</small></label>
                                <input class="form-control" type="number" placeholder="" value="{{$data->swift_national}}" name="swift_national">
                                <span class="fa fa-hashtag fa-fw form-control-feedback"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group has-feedback ">
                                <label  class="control-label">أسم البنك :</label>
                                <input class="form-control" type="text" placeholder=""  value="{{$data->bank_name}}" name="bank_name">
                                <span class="fa fa-university fa-fw form-control-feedback"></span>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-12">
                            <div class="form-group has-feedback ">
                                <label  class="control-label">اسم الفرع :</label>
                                <input class="form-control" type="text" placeholder=""  value="{{$data->branch_name}}" name="branch_name">
                                <span class="fa fa-building fa-fw form-control-feedback"></span>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-12">
                            <div class="form-group has-feedback ">
                                <label  class="control-label">كود الفرع :</label>
                                <input class="form-control" type="number" placeholder=""  value="{{$data->branch_code}}" name="branch_code">
                                <span class="fa fa-hashtag fa-fw form-control-feedback"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group has-feedback ">
                                <label  class="control-label">عنوان الفرع :</label>
                                <input class="form-control" type="text" placeholder=""  value="{{$data->branch_address}}" name="branch_address">
                                <span class="fa fa-map-marker fa-fw form-control-feedback"></span>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-12">
                            <div class="form-group has-feedback ">
                                <label  class="control-label">أسم المدينة :</label>
                                <input class="form-control" type="text" placeholder=""  value="{{$data->city}}" name="city">
                                <span class="fa fa-map-marker fa-fw form-control-feedback"></span>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-12 " >
                            <div class="form-group ">
                                <label  class="control-label">أسم المحافظة :</label>
                                <!-- <select class="form-control" name="governorate">
                                    @foreach($governorates as $key => $governorate)
                                     @if($key==$data->governorate_id)
                                          <option value="{{$key}}" selected>{{$governorate}}</option>

                                      @endif
                                    @endforeach
                                </select> -->
                                {{Form::select('governorate',$governorates,$data->governorate_id,['class'=>"form-control"])}}

                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12 " >
                            <div class="form-group ">
                                <label for="bank_currency" class="control-label">نوع العمله :</label>
                                <!-- <select class="form-control" name="bank_currency" id="bank_currency">
                                    @foreach($currency as $key => $curr)
                                       @if($key==$data->currency_id)
                                        <option value="{{$key}}" selected>{{$curr}}</option>
                                        @endif
                                        <option value="{{$key}}" >{{$curr}}</option>
                                    @endforeach
                                </select> -->
                                {{Form::select('bank_currency',$currency,$data->currency_id,['class'=>"form-control"])}}

                            </div>
                        </div>
                    </div>
                <!-- </div> -->
                <!-- End bank details -->

                <!-- ٍStart save details -->
              @elseif($type==2)
                <!-- <div id="treasury_details"> -->
                    <div class="row">
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group has-feedback ">
                                <label class="control-label">أسم الخزنة :</label>
                                <input class="form-control" type="text"  placeholder="" value="{{$data->treasury_name}}" name="treasury_name">
                                <span class="fa fa-unlock-alt fa-fw form-control-feedback"></span>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-12">
                            <div class="form-group has-feedback ">
                                <label class="control-label" for="treasury_start_date">تاريخ افتتاح الخزنة :</label>
                                <input class="form-control" type="text"  placeholder="" value="{{$data->start_date}}" name="treasury_start_date" id="treasury_start_date">
                                <span class="fa fa-calendar fa-fw form-control-feedback"></span>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-12">
                            <div class="form-group has-feedback ">
                                <label class="control-label">المبلغ عند الافتتاح :</label>
                                <input class="form-control" type="text"  placeholder="" value="{{$data->start_balance}}" name="start_balance">
                                <span class="fa fa-money fa-fw form-control-feedback"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12 " >
                            <div class="form-group ">
                                <label for="treasury_currency" class="control-label">نوع العمله :</label>

                                {{Form::select('treasury_currency',$currency,$data->currency_id,['class'=>"form-control"])}}
                            </div>
                        </div>
                    </div>
                <!-- </div> -->
                <!-- End save details -->

                <!-- Start card details -->
            @elseif($type==3)
                <!-- <div id="card_details"> -->
                    <div class="row">
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group has-feedback ">
                                <label class="control-label">صاحب الحساب :</label>
                                <input class="form-control" type="text"  placeholder="" value="{{$data->credit_owner}}" name="credit_owner">
                                <span class="fa fa-user fa-fw form-control-feedback"></span>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-12">
                            <div class="form-group has-feedback ">
                                <label class="control-label">رصيد البنك :</label>
                                <input class="form-control" type="text"  placeholder="" value="{{$data->credit_balance}}" name="credit_balance">
                                <span class="fa fa-money fa-fw form-control-feedback"></span>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-12">
                            <div class="form-group has-feedback ">
                                <label class="control-label">تاريخ الرصيد :</label>
                                <input class="form-control" type="text"  placeholder="" value="{{$data->credit_start_date}}" id="credit_start_date" name="credit_start_date">
                                <span class="fa fa-calendar fa-fw form-control-feedback"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3 col-xs-12">
                            <div class="form-group has-feedback ">
                                <label  class="control-label">أسم البنك :</label>
                                <input class="form-control" type="text" placeholder=""  value="{{$data->credit_bank_name}}" name="credit_bank_name">
                                <span class="fa fa-university fa-fw form-control-feedback"></span>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-12">
                            <div class="form-group has-feedback ">
                                <label class="control-label">رقم كارت بطاقه الائتمان :</label>
                                <input class="form-control" type="text"  placeholder="" value="{{$data->credit_number}}" name="credit_number">
                                <span class="fa fa-hashtag fa-fw form-control-feedback"></span>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-12">
                            <div class="form-group has-feedback ">
                                <label class="control-label">نوع الكارت :</label>
                                <select class="form-control" name="credit_type">
                                @if($data->credit_type==1)
                                      <option value="1" checked>فيرا</option>
                                      <option value="2" >مستر</option>
                                @elseif($data->credit_type==2)
                                     <option value="1">فيرا</option>
                                     <option value="2" checked>مستر</option>
                                @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-12">
                            <div class="form-group has-feedback ">
                               <label for="credit_end_date" class="control-label">تاريخ الانتهاء :</label>
                               <input class="form-control" type="text" name="credit_end_date" id="credit_end_date" placeholder="mm/yyyy" value="{{$data->credit_end_date}}" data-date="">
                               <span class="fa fa-calendar fa-fw form-control-feedback"></span>
                            </div>
                        </div>
                    </div>
                <!-- </div> -->
                <!-- End card details -->
          @endif

                {{--<div class="row">--}}
                    {{--<div class="col-md-12">--}}
                        <button data-style="expand-right" type="button" class="btn btn-default waves-effect waves-light  ladda-button btnSave" id="btnSave" led="btnSave">
                            <span class="ladda-label"> حفظ البيانات <i class="fa fa-floppy-o"></i></span>
                            <span class="ladda-spinner"></span>
                        </button>

                        {{--<button class="btn btn-default waves-effect waves-light col-md-2" type="submit">تاكيد</button>--}}
                        <button type="reset" class="btn btn-danger waves-effect waves-light m-l-5 "> الغاء <i class="fa fa-close"></i></button>
                    {{--</div>--}}
                {{--</div>--}}
            </div>

        </div>
         {!! Form::Close() !!}
</div>

<!-- End Section Main Content -->
@endsection

@section('page-scripts')
<!--datepicker js for date -->
<script src="plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<!--Summernote js-->
<script src="plugins/tinymce/tinymce.min.js"></script>

<script src="plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<!-- ladda js -->
<script src="plugins/ladda-buttons/js/spin.min.js"></script>
<script src="plugins/ladda-buttons/js/ladda.min.js"></script>
<script src="plugins/ladda-buttons/js/ladda.jquery.min.js"></script>
<!-- Notification js -->
<script src="plugins/notifyjs/js/notify.js"></script>
<script src="plugins/notifications/notify-metro.js"></script>
<script>
    jQuery(document).ready(function(){
        var l = $('.ladda-button').ladda();
        // var S_D = $('#treasury_details') , C_D = $('#card_details') , B_D = $('#back_details');
        //
        // $('#radio1').click( function() {
        //     $('#serial_number').val($('#bank_serial_number').val());
        //     S_D.fadeOut();
        //     C_D .fadeOut();
        //     B_D.fadeIn();
        // });
        // $('#radio2').click( function() {
        //     $('#serial_number').val($('#treasury_serial_number').val());
        //     B_D.fadeOut();
        //     C_D.fadeOut();
        //     S_D.fadeIn();
        // });
        // $('#radio3').click( function() {
        //     $('#serial_number').val($('#credit_serial_number').val());
        //     B_D.fadeOut();
        //     S_D.fadeOut();
        //     C_D.fadeIn();
        // });

//        $('#credit_end_date').datepicker({
//               autoclose: true,
//               todayHighlight: true,
//                format: 'mm/yyyy',
//        });

        $('#start_date,#treasury_start_date,#credit_end_date,#credit_start_date').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'yyyy-mm-dd'
        });

        var old_start_date= "{{old('start_date')? old('start_date') : ''}}"
        var old_treasury_start_date= "{{old('treasury_start_date')? old('treasury_start_date') : ''}}"
        var old_credit_start_date= "{{old('credit_start_date')? old('credit_start_date') : ''}}"
        var old_credit_end_date= "{{old('credit_end_date')? old('credit_end_date') : ''}}"
        $("#start_date").datepicker("setDate",old_start_date ? old_start_date :  new Date());
        $("#treasury_start_date").datepicker("setDate",old_treasury_start_date ? old_treasury_start_date :  new Date());
        $("#credit_start_date").datepicker("setDate",old_credit_start_date ? old_credit_start_date :  new Date());
        $("#credit_end_date").datepicker("setDate",old_credit_end_date ? old_credit_end_date :  new Date());


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


        $('#btnSave').on('click',function () {
            $('.alerts').html('');
            $('.ladda-button[led="btnSave"]').ladda('start');
            var url = $("#idform").attr('action');
            $.ajax({
                type: "PATCH",
                url: url,
                data: $("#idform").serialize(),
                success: function(data)
                {
                    setTimeout(function () {
                        $('.ladda-button[led="btnSave"]').ladda('stop');
                    },2000)
                    if (isNaN(data)){
                        var err = "<ul>";
                        $.each(data['errors'], function(i, item) {
                            $.Notification.autoHideNotify('error', 'top right', 'Whoops',item +' Whoops Whoops Whoops Whoops Whoops Whoops ');
                            err += "<li>" + item + "</li>";
                        });
                        err += "</ul>";
                        $('.alerts').html('<div class="alert alert-danger">'+
                            '<strong>Whoops!</strong> There were some problems with your input.<br><br>'+
                            '<div>'+ err + '</div>' +
                            '</div>')
                    }else{
                        $.Notification.autoHideNotify('success', 'top right', 'Updated successfully','Data has been updated successfully <br>');
                        window.location.href = "{{route('finance.main')}}";
                    }
                },
                error: function(data){
                    setTimeout(function () {
                        $('.ladda-button[led="btnSave"]').ladda('stop');
                    },2000)
                    $('.alerts').html('<div class="alert alert-danger">'+
                        '<strong>Whoops!</strong> Error may be in connection to server <br><br>'+
                        '</div>');
                    $.Notification.autoHideNotify('error', 'top right', 'Whoops','Error may be in connection to server<br>');
                }
            });
        });
    });
</script>





@endsection
