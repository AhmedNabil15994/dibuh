@extends(Config::get('back_theme').'.layouts.app')

@section('htmlheader_title')
{{ trans('backend/main.view') }}
@endsection

@section('contentheader_title')
{{ trans('backend/main.view') }}

@endsection

@section('contentheader_description')
@endsection

@section('previous_breadcrumb')
{{ trans('backend/main.invoices') }}
@endsection
<!--breadcrumb current page-->
@section('current_breadcrumb')
{{ trans('backend/main.view') }}
@endsection


@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

	<div class="invoices" id="invoices-page">
        <div class="row">
            <div class="col-md-1 hidden-print"></div>
            <div class="col-lg-8 col-md-8 col-12 letter" id="tab1">
                <div class="row">
                    <div class="header_right col-sm-6 col-xs-12">
                        <h2><span class="firstLogo">{{$data_admin->company}} </span></h2>
                        <p class="myCompany">{{$data_admin->postal_code}} |{{$data_admin->district}} | {{$data_admin->phone}}</p>
                        <p>{{$data_admin->getFullNameAttribute()}}</p>
                        <p>{{$address_admin->street}} {{$address_admin->house_no}} </p>
                        <p>{{$address_admin->postal_code}} {{$address_admin->city}}</p>
                        <p> {{$address_admin->country->name}}</p>
                    </div>
                </div>

                <div class="row pay_details">
                    <div class="col-xs-7 left">
                        <h6 style="display: inline-block;">{{trans('backend/main.write')}} : </h6>
                        <p class="p">{{$data->getFullNameAttribute()}}</p><br>
                        <strong>{{trans('backend/main.phone')}} : </strong><p>{{$data->phone}}</p><br>
                        <strong class="pull-left" style="display: inline-block;width: 70px;">{{trans('backend/main.address')}} : </strong>
                        <div class="pull-left" style="display: inline-block;width: calc(100% - 70px);">
                            <p>{{$address->street}}  {{$address->house_no}}</p><br>
                            <p>{{$address->postal_code}} {{$address->city}}</p><br>
                            <p>{{$address->country->name}}</p>
                        </div>
                    </div>
                    <div class="col-xs-5 right">
                        <strong>{{trans('backend/main.inv_no')}} : </strong><p> {{$invoice->serial_number}}</p><br>
                        <strong>{{trans('backend/main.inv_date')}} : </strong><p> {{$invoice->invoice_date}}</p><br>
                        <h5 style="width: 100%;display: inline-block;float: left;">{{trans('backend/main.duration')}} : </h5>
                        <div style="width: 100% ;display: inline-block;float: left;">
                            <h6 style="margin-top: 0;margin-bottom: 0;"> {{trans('backend/main.from')}} : {{$invoice->from_date}}</h6>
                            <h6 style="margin-top: 3px;"> {{trans('backend/main.to')}} : {{$invoice->to_date}}</h6>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-right: 0;margin-left: 0;">
                    <hr>
                </div>

                <div class="table-responsive">
                    <table class="table  table-bordered">
                        <thead class="tabel-head ">
                            <tr>
                                <th>{{trans('backend/main.plan')}}</th>
                                <th>{{trans('backend/main.bf_tax')}}</th>
                                <th>{{trans('backend/main.af_tax')}}</th>
                                <th>{{trans('backend/main.all')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$price_plan->name}}</td>
                                <td>1000</td>
                                <td>1096</td>
                                <td>1096</td>
                            </tr>
                            <tr>

                            </tr>
                        </tbody>
                    </table>
                </div>

                <hr class="visible-print" style="margin-bottom: 0;">



                <footer class="print_footer">
                    <div class="row" style="margin-right: 0;margin-left: 0;">
                        <hr style="margin-bottom: 10px;">
                    </div>

                    <div class="col-xs-4">
                      <p style="margin-top:10px">{{$data_admin->company}}</p>
                      <p>{{$data_admin->address}}</p>
                      <p>{{$data_admin->district}}</p>
                      <p>{{$data_admin->country->name}} {{$data_admin->postal_code}} </p>
                    </div>
                    <div class="col-xs-4">
                      <p style="margin-top:10px">{{trans('backend/main.phone')}} : {{$data_admin->phone}}</p>
                      <p >{{trans('backend/main.fax')}}: {{$data_admin->fax}}</p>
                      <p >{{$data_admin->user->email}}</p>
                      <p>{{$data_admin->url}}</p>
                    </div>

                    <div class="col-xs-4" style="text-align: left;">
                        <div>
                          <p style="margin-top:10px"> {{trans('backend/main.iban')}}: IBAN </p>
                        </div>
                        <div>
                            <p>{{trans('backend/main.bic')}}: BIC</p>
                        </div>
                        <div>
                          <p>{{trans('backend/main.bank')}}  : Bank</p>
                        </div>
                    </div>

                </footer>
            </div>
            <div class="col-md-3 hidden-print">
                <button type="button" data-style="expand-right" id="btnSendmailPrint"  class="btn btn-inverse waves-effect waves-light ladda-button" led="btnSendmailPrint" data-toggle="modal" data-target="#myModal">
                    <span class="ladda-label"><i class="fa fa-send"></i>Send Email </span>
                    <span class="ladda-spinner"></span>
                </button>
                <button class="btn btn-inverse"> <i class="fa fa-download"></i> <a href="{{route('admin::invoice.downloadPdf',$invoice->id)}}">Download</a></button>
                <button class="btn btn-inverse" onclick="window.print()"> <i class="fa fa-print"></i> Print</button>

            </div>
        </div>
        <!--start model to send email -->
        <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <!--start user form for sending Email-->
      <form id="EmailUserForm" url="route('admin::invoice.sendEmail')" method="post">


              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">إرسال فاتورة </h4>
              </div>
              <div class="modal-body">
            <input type="hidden" name="contact_id" value="{{$invoice->user_id}}">

            <div class="form-group" style="margin-top:10px">
                <div class="col-sm-4 col-xs-12">
                    <strong>الراســـل :</strong>
                </div>

                <div class="col-sm-8">
                    <input class="form-control" type="email" name="frmoemail" style="margin-bottom:15px;" value="{{Auth::user()->profile->first_name}} {{Auth::user()->profile->last_name}} <{{Auth::user()->email}}>">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-4 col-xs-12">
                    <strong>المرســل اليه :</strong>
                </div>
                <div class="col-sm-8">
                    <input class="form-control" type="email" id="ReciverEmail" value="{{$user_email}}" style="margin-bottom:15px;" >
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-4 col-xs-12">
                    <strong>Subject :</strong>
                </div>
                <div class="col-sm-8">
                    <?php
                        $temp =\DB::table('email_templates')->where('id','=',1)->first();

                        $old2 = ["[CLIENT_NAME]", "[PACKAGE]", "[INVOICE_NUMBER]"];
                        $new2   = [$data->getFullNameAttribute() , $price_plan->name , $invoice->serial_number ];
                        $phrase2 = $temp->subject;
                      //  $phrase2 = "subject2";
                        $newPhrase2 = str_replace($old2, $new2, $phrase2);
                    ?>
                    <input class="form-control" type="text" name="subject" value="{{$newPhrase2}}" style="margin-bottom:15px;">
                </div>
            </div>

            <div class="row" id="header-row">
                <div class="col-md-12 col-xs-12" style="margin-bottom: 15px">
                    <textarea id="header_text" name="header_text">
                        <?php
                            $old = ["[CLIENT_NAME]", "[PACKAGE]", "[INVOICE_NUMBER]"];
                            $new   = [$data->getFullNameAttribute() , $price_plan->name , $invoice->serial_number ];
                            $phrase = $temp->content;
                            //  $phrase = "subject";
                            $newPhrase = str_replace($old, $new, $phrase);

                        ?>
                        {!!html_entity_decode($newPhrase)!!}
                    </textarea>
                </div>
            </div>



        </div>
              <div class="modal-footer">

                <button  name="submit"  data-style="expand-right"    data-dismiss="modal" type="button" class="btn btn-primary waves-effect waves-light m-r-5 ladda-button send  ">
                 {{trans('button.send')}}
                    <span class=""><i class="fa fa-share-square"></i> </span>
                </button>

                <button type="button" form="EmailUserForm" class="btn btn-danger" data-dismiss="modal">
                   {{trans('button.close')}}
                    <span><i class="fa fa-times-circle"></i></span>
                    </button>
              </div>
        </form>
            </div>

          </div>
        </div>

        <!--end letter section-->
    </div> <!--end row -->


    </div>
    <!--end all invoices-->

@endsection

@section('page-styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">

<style type="text/css">
    .btn-inverse,
    .btn-inverse:hover,
    .btn-inverse:active{
        margin-left: 10px;
        background-color: #4C5667;
        color: #FFF !important;
        display: inline-block;
        margin-bottom: 10px;
    }
    .btn-inverse i{
        margin-right: 5px;
    }
    .content-wrapper, .right-side , .wrapper{
        background-color: #EBEFF2 !important;
    }
    .invoices{
        margin-top: 50px;
    }
    .pay_details p{
        margin-bottom: 5px !important;
    }
   	.pag{
        margin-top: 50px;
        border: 1px solid #DDD;
        padding: 20px 20px;
        background-color: #FFF;
        border-radius: 5px;
        box-shadow: 5px 5px 5px #999;
    }
    .letter,.letter:after,.letter:before{
        border-radius: 10px;
    }
    .select2-selection.select2-selection--single,
    .select2-dropdown.select2-dropdown--below,
    select,input,textarea{
    	border: 1px solid #768188 !important;
    }
    .select2-container .select2-selection--single .select2-selection__rendered {
        line-height: 32px !important;
        padding-left: 25px !important;
        padding-right: 5px !important;
        font-size: 14px;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        top: 3px;
    }
    .select2-container--open .select2-dropdown--above {
        padding: 0;
    }

    textarea{
        margin-top: 10px;
        max-height: 150px;
        min-height: 150px;
        min-width: 100%;
        max-width: 100%;
    }
    .select2-search__field{
        font-size: 20px !important;
    }
    .select2-results__option,input,textarea,label{
        font-size: 15px !important;
    }
    body {
        background: linear-gradient(#ccc, #fff);
        font: 14px ;
    }
    .container{
        width:100% !important;
    }
    .section{
        padding-top:40px;
        padding-right: 20px;
    }
    .head{
        margin-bottom: 3rem;
    }
    .details{
        margin-top: 5rem;
    }
    @media (max-width:992px){
        .details{
            margin-top: 1rem;
        }
    }
        /*end div details*/
    .buttons{
        margin-top:1.5rem;
        margin-bottom:4rem;
    }
    @media (max-width:992px){
        .buttons{
            text-align: center;
        }
    }

    .letter {
        background: #fff;
        box-shadow: 0 0 10px rgba(0,0,0,0.3);
        padding: 25px 50px;
        position: relative;
        z-index: 51;
        margin-bottom: 70px;
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
            text-align:center;
        }
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
        margin-bottom: 5px;
    }
    .header_right .myCompany{
        font-size: 10px;
        margin-bottom: 15px;
    }
    .side_paper{
        margin-top: 1.6rem;
    }
    @media (max-width:768px){
        .side_paper{
            margin-top: 0 !important;
        }
    }
    .side_paper .side_paper_head {
        display: block;
        margin: 10px auto;
        text-align: center;
        color: #5fbeaa;
        font-weight: bold;
    }
    .side_paper .paper-li{
        list-style: none;
        padding-right:0
    }
    .side_paper .li-head{
        font-weight: bold;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 0;
    }
    .side_paper .small{
        text-align: center;
        margin-top: 5px;
        font-size: 18px;
    }
    /*end sidebar*/
    .pay_details{
        font-size:10px;
        box-shadow: 0 0 7px 1px rgba(0, 0, 0, 0.42);
        border: 1px solid rgba(51, 51, 51, 0.6);
        margin-top:20px;
        position:relative;
        width:100% ;
        display: inline-flex;
        margin-bottom:20px;
        margin-left: 0 !important;
    }
    .letter .row.pay_details{
        margin-left: 0 !important;
        margin-right: 0 !important;
    }
    .pay_details .right {
        padding:15px 20px 5px;
    }

    .pay_details .right .p{
        display:inline-block;
    }
    .pay_details .right p{
        line-height: 22px;
        margin: 0;
        font-size: 14px;
        display:inline-block;
    }
    .pay_details .left{
        background:rgba(204, 204, 204, 0.33);
        border-right: 1px solid;
        display:block;
        padding: 15px 20px 5px;
    }
    .pay_details .left strong,.pay_details .left p {
        display:inline-block;
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
        font-size: 13px;
    }
    tbody tr{
        font-size: 14px
    }
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

    .delete-form{
        margin-bottom: 0;
    }
    .deleteInstallment{
        border:solid 1px #92afa9;
        border-radius: 5px;
        background: rgba(255, 255, 255,0);
        width: 30px;
        line-height: 30px;
        -webkit-transition: background .5s ease-in-out;
        -moz-transition: background .5s ease-in-out;
        transition: background .5s ease-in-out;
        padding: 0;
    }
    .deleteInstallment:hover {
        background:black;
        color:#fff !important;

    }
    .show-print{
        display:none;
    }
    .invoice_footer{
        margin-bottom:30px;

    }
    @media print {
        .main-footer{
            display: none;
        }
        .letter {
            background: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
            padding: 25px;
            padding-bottom:10px;
            position: relative;
            width: 90%;
            margin-left: 5%;
            z-index: 51;
        }
        .header_right{
            padding-left: 10px;
            padding-right: 10px;
            width: 100%;
            float: left;
            text-align: left !important;
        }
        .firstLogo{
            word-spacing: -5px;
            font-weight:bold;
        }
        .header_right p{
            font-size: 14px;
            display: block;
            margin-top:3px;
            margin-bottom: -5px;
        }
        .header_right .myCompany{
           font-size: 12px;
           margin-bottom: 5px;
        }
        .side_paper{
            width:50%;
            text-align: left;
        }
        .side_paper .side_paper_head {
            margin-top:50px;
            font-size:20px;
            word-spacing:1px;
            font-weight:bold;
            display: block;
            margin-bottom:15px;
        }
        .paper_li{
            font-size:12px !important;
            margin:0;
        }
        .pay_details{
            margin-top: 0;
            margin-bottom:10px;
            margin-left: 0 !important;
        }
        .row{
            margin-left: 0 !important;
            margin-right: 0 !important;
        }
        .panel-heading,.pay_details{
            border:1px solid #f1f1f1 !important;
        }
        .pay_details .left{
            border-right: 1px solid #f1f1f1 !important;
        }
        .print_footer{
            margin-top: 200px;
            left: 0;
            margin-left: 0;
            width: 100% !important;
        }
        p,td,th{
            font-size: 12px;
            font-weight: normal;
        }
        .header_right{
            display:block;
            padding-top:30px;
            padding-bottom:20px;
            text-align: right;
        }
        .header_left{
            display:block;
            position:absolute;
            top:0;
            left:0
        }
        body {
            background: none;
            font: 16px sans-serif !important;
            font-size: 16px !important;
            padding: 0px;
            margin: 0px;
        }
        .wrapper,.container {
            padding: 0px;
            margin: 0px;
        }
        .invoice_header , .invoice_footer{
            text-align:center;
            border: 1px solid #ddd;
            display:block;
            font-weight:bold;
            padding-top: 10px;
            width:100%;
            background:red;
            margin-right:-10px !important;
            margin-bottom: 0;
        }
        .invoice_header{
            margin-top:20px;
        }
        .invoice_footer{
            margin-top:0 !important;
            margin-bottom: 30px !important;
        }
        .detail_sban{
            margin-bottom:0 !important;
            border: 1px solid #DDD;
        }
        .last-icon{
            display:none;
        }
        #thetable th:last-child{
            display:none;
        }
        .pay_details .right {
            padding: 15px 20px 5px;
        }
        .pay_details .left {
            background: rgba(204, 204, 204, 0.33);
            border-right: 1px solid;
            display: block;
            padding: 15px 20px 5px;
        }
        .pay_details {
            font-size: 10px;
            box-shadow: 0 0 7px 1px rgba(0, 0, 0, 0.42);
            border: 1px solid rgba(51, 51, 51, 0.6);
            position: relative;
            width: 100%;
            display: inline-flex;
            margin-bottom: 0px;
        }
        .tabel-head {
            background-color: #eeeeee;
            font-weight: 400;
            color: #7f8c9d;
            font-size: 13px;
        }
        p,strong{
            font-size: 15px !important;
        }

    }

    @media (min-width:0px) and (max-width:1199px) {
        .letter{
            margin: 0px auto ;
        }
        .letter:hover::before{
            left: -10px;
        }
        .side_paper {
            position:relative;
            top:0;
            left:0;
        }
    }
    .buttons a {
        color: white !important;
    }
    .buttons a:hover{
        color:white !important;
    }
    .buttons a:visited{
        color:white !important;
    }
    .buttons a:active{
        color:white !important;
    }
    #myModal label{
        width: 30%;
    }

</style>
@endsection

@section('page-scripts')



<!-- ladda js -->
<script src="plugins/ladda-buttons/js/spin.min.js"></script>
<script src="plugins/ladda-buttons/js/ladda.min.js"></script>
<script src="plugins/ladda-buttons/js/ladda.jquery.min.js"></script>
<script src="plugins/select2/select2.full.min.js"></script>
<script src="plugins/iCheck/icheck.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/select/1.2.4/js/dataTables.select.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.0/js/buttons.bootstrap.min.js"></script>
<script src="{{URL::to('').Config::get('assets_frontend')}}plugins/tinymce/tinymce.min.js"></script>
<script src="{{URL::to('').Config::get('assets_frontend')}}plugins/notifications/notify.min.js"></script>




<script type="text/javascript">
	$(function(){


		$('.breadcrumb .prev').toggle();
        $('.breadcrumb .prev a').click(function (e) {
            e.preventDefault();
            e.stopPropagation();
            window.location.href = "{{route('admin::invoices.index')}}";
        });




        /*********Send Email************/
            $('.send').on('click',function(e){
                e.preventDefault();
                e.stopPropagation();
                $('.alerts').html('');
                var led = $(this).attr('led')
                var lada = '.ladda-button[led="' + led + '"]'
                $(lada).ladda('start');
                var url = "{{route('admin::invoice.sendEmail')}}";
                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'user_id': $('#myModal input[name="contact_id"]').val(),
                        'user_name':"{{$data->getFullNameAttribute()}}",
                        'email' : $('#myModal #ReciverEmail').val(),
                        'subject' : $('#myModal input[name="subject"]').val(),
                        'message' : $('#myModal textarea').text(),
                        'company' : "{{$data->company}}",
                        'serial_number' : "{{$invoice->serial_number}}",
                        'price_plan_id' : "{{$invoice->price_plan_id}}",
                        'invoice_id' : "{{$invoice->id}}"
                    },
                    success: function(data)
                    {

                  //     $.Notification.autoHideNotify('success', 'top right', 'Email Sent successfully');
                      //  location.reload();
                      if (isNaN(data)){
                          console.log(data['errors']);
                          var err = "<ul>";
                          $.each(data['errors'], function(i, item) {
                            console.log("in each");
                            //  $.Notification.autoHideNotify('error', 'top right', 'Whoops',item +' Whoops Whoops Whoops Whoops Whoops Whoops ');
                             $("#myModal").notify(item,{ position:"top" ,className:"success"});
                              err += "<li>" + item + "</li>";
                          });
                          err += "</ul>";
                          $('.alerts').html('<div class="alert alert-danger">'+
                              '<strong>Whoops!</strong> There were some problems with your input.<br><br>'+
                              '<div>'+ err + '</div>' +
                              '</div>')
                      }else{
                          console.log("success"+data);
                        //  $.Notification.autoHideNotify('success', 'top right', 'Saved successfully','Data has been Saved successfully <br>');
                        
                            location.reload();
                      }
                    }
                });
            });

	});
</script>

@endsection
