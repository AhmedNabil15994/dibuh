@extends(Config::get('front_theme').'.layouts.default')

@section('title',$page_title)

@section('page-styles')
    <link rel="stylesheet" type="text/css" href="{{URL::to('').Config::get('assets_frontend')}}/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="{{URL::to('').Config::get('assets_frontend')}}/plugins/select2/css/select2.min.css"> -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    <!-- Ladda buttons css -->
    <link href="{{URL::to('').Config::get('assets_frontend')}}/plugins/ladda-buttons/css/ladda-themeless.min.css" rel="stylesheet" type="text/css" />

    <!-- Custom box css -->
    <link href="{{URL::to('').Config::get('assets_frontend')}}/plugins/custombox/css/custombox.css" rel="stylesheet">

    <!-- Custom box scc -->
    <link href="{{URL::to('').Config::get('assets_frontend')}}/plugins/custombox/css/custombox.css" rel="stylesheet">

    <link rel="stylesheet" href="{{URL::to('').Config::get('assets_frontend')}}/plugins/PrintArea/print.css" media="print">





<style>
        body {
             background: linear-gradient(#ccc, #fff);
             font: 14px ;
             padding: 20px;
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
         #btnSendmailPrint{
             display: block;
             margin-top: 20px;
        }
        @media only screen and (max-width: 992px) {
            #btnSendmailPrint{
                 display:inline-block !important;
                 margin-top:0 !important;
            }
        }
        @media only screen and (max-width: 531px) {
             #btnSendmailPrint{
                 margin-top:20px !important;
            }
        }
        @media only screen and (max-width:338px) {
            #btnpaidPrint{
                 margin-top:20px !important;
            }
        }
        @media only screen and (max-width:242px) {
            #btndownloadPrint{
                 margin-top:20px !important;
            }
        }
        /*end section buttons*/
         .letter {
             background: #fff;
             box-shadow: 0 0 10px rgba(0,0,0,0.3);
             max-width: 550px;
             padding: 25px;
             position: relative;
             width: 80%;
             z-index: 51;
             margin-bottom: 70px;
        }
        /*.letter:hover::before{
             left: -130px;
             transition:all 0.5s ease-in-out;
             -webkit-transition:all 0.5s ease-in-out;
             -moz-transition:all 0.5s ease-in-out;
             -o-transition:all 0.5s ease-in-out;
        }
         .letter:hover .side_paper{
            left: -110px;
            opacity:1;
             transition:all 0.5s ease-in-out;
             -webkit-transition:all 0.5s ease-in-out;
             -moz-transition:all 0.5s ease-in-out;
             -o-transition:all 0.5s ease-in-out;
        }
         */
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
        /*end letter right section*/
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
             /*color: #5fbeaa */
        }
         .icon{
             color: #665656;
            /*border: 2px solid #5fbeaa;
             border-radius: 50%;
            */
             line-height: 100%;
            /*vertical-align: bottom;
             padding-right: 4px;
             padding-left: 4px;
             padding-bottom: 4px;
             padding-top: 2px;
            */
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
        }
         .pay_details .right {
        padding:15px 20px 5px;

        }
         .pay_details .right h6{
            text-decoration: underline;
            display: inline-block;
            margin-bottom: 15px;
            font-weight: bold;
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

        /*start media print */
         @media print {
             .letter {
                background: #fff;
             box-shadow: 0 0 10px rgba(0,0,0,0.3);
             max-width: 550px;
             padding: 25px;
             padding-bottom:10px;
             position: relative;
             width: 80%;
             z-index: 51;
             /* margin-top:140px; */
             margin-right:50px;
            }

        .header_right{

            padding-left: 10px;
            padding-right: 10px;
            width: 50%;
            float: right;

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
           font-size: 10px;
           margin-bottom: 5px;
        }
        /*end letter right section*/

        .side_paper{
            width:50%;
            text-align: center;
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
            }

             .panel-heading,.pay_details{
                 border:1px solid #f1f1f1 !important;
            }
             .pay_details .left{
                 border-right: 1px solid #f1f1f1 !important;
            }

             .print_footer{
                 position: fixed;
                 left:10px;
                 bottom: 0;
                 width: 90%;
                 margin-right:35px;
            }
             p,td,th{
                 font-size: 12px;
                 font-weight: normal;
            }
            *{
                text-align: right;
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
                 font: 13px sans-serif;
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
            /* margin-top: 20px; */
            position: relative;
            width: 100%;
            display: inline-flex;
            margin-bottom: 0px;
        }

        .tabel-head {
            background-color: #eeeeee;
            font-weight: 400;
            color: #7f8c9d;
            /* font-family: sans-serif; */
            font-size: 13px;
        }

        }

        /*end media print*/
        /*.side_paper{
            position:absolute;
            top: 40px;
             left: 25px;
             transition:all 0.5s ease-in-out;
             -webkit-transition:all 0.5s ease-in-out;
             -moz-transition:all 0.5s ease-in-out;
             -o-transition:all 0.5s ease-in-out;
        }
         */

         .tax{
            margin-bottom: 25px
        }
         @media (min-width:0px) and (max-width:1199px) {
            .letter{
                 margin: 0px auto ;
            }
            /*end media */
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
         #draft-image {
            /* background: url('img/draft.png') no-repeat center center fixed;
             -webkit-background-size: cover;
             -moz-background-size: cover;
             -o-background-size: cover;
             background-size: cover;
             */
             background-image: url('img/draft.png');
             background-position: 0 0;
             background-repeat: no-repeat;
             position: relative;
             background-position:center;
        }
         #draft-image img {
             position: relative;
             top: 0;
             left: 0;
             opacity: 0.3;
             filter:alpha(opacity=30);
        }


        /* style for Email Model */


        .form-control:focus{
            color: #495057;
            background-color: #fff;
            border-color: #80bdff;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25)
        }
        #myModal label{
            width: 30%;
        }
        #ReciverEmail , #UserAddress , #UserEmail{
            width:100%;
            display:inline-block;
            float: left;
        }
        #ReciverEmail {
            margin-bottom:2rem;
        }

        .label{
            margin-bottom:8px;
            font-weight:bold;
            color:#898989;
        }
        textarea{
            margin-top: 10px;
            max-height: 150px;
            min-height: 150px;
            min-width: 100%;
            max-width: 100%;
        }
        .align-right{
            text-align: right !important;
        }

</style>


<div class="section m-b-20">

</div>
<div class="row details">

            <!--start buttons div-->
    <div class="col-lg-4 col-md-5  col-12 hidden-print buttons">
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal" onclick="window.history.back();">رجوع</button>

                <button type="button" data-style="expand-right" id="btnSavePrint" onclick="window.print()" class="btn btn-inverse waves-effect waves-light ladda-button" led="btnSavePrint">
                    <span class="ladda-label"> طباعه <i class="fa fa-print"></i></span>
                    <span class="ladda-spinner"></span>
                </button>
                @if($sales_invoice->invoice_status_id == 1)
                <button type="button" data-style="expand-right" id="prices" class="btn btn-inverse waves-effect waves-light ladda-button" led="prices">
                    <span class="ladda-label">  <a href="{{route('sales_invoice.downloadprices',['id'=>$sales_invoice->id])}}">عرض الاسعار</a> <i class="fa fa-print"></i></span>
                    <span class="ladda-spinner"></span>
                </button>
                @endif
                <button type="button" data-style="expand-right" id="btndownloadPrint"  class="btn btn-inverse waves-effect waves-light ladda-button" led="btndownloadPrint">
                    <span class="ladda-label"> <a href="{{route('sales_invoice.downloadPdf',['id'=>$sales_invoice->id])}}">تحميل</a> <i class="fa fa-download"></i></span>
                    <span class="ladda-spinner"></span>
                </button>

                @if($sales_invoice->rest>0 && $sales_invoice->invoice_status_id!=1)
                <button type="button" data-toggle="modal"  data-target="#paid_modal"data-style="expand-right" id="btnpaidPrint"  class="btn btn-inverse waves-effect waves-light ladda-button" led="btnpaidPrint">
                    <span class="ladda-label">إضافة دفع <i ></i></span>
                    <span class="ladda-spinner"></span>
                </button>

                @endif

                <button type="button" data-style="expand-right" id="btnSendmailPrint"  class="btn btn-inverse waves-effect waves-light ladda-button" led="btnSendmailPrint" data-toggle="modal" data-target="#myModal">
                    <span class="ladda-label"> إرسال بالبريد الالكتروني <i class="fa fa-send"></i></span>
                    <span class="ladda-spinner"></span>
                </button>


    </div>
        <!--end buttons div-->


<!--start letter setion-->

    <!--<ul class='tabs'>
  <li><a href='#tab1'>Tab 1</a></li>
  <li><a href='#tab2'>Tab 2</a></li>
  <li><a href='#tab3'>Tab 3</a></li>
</ul>-->

    <div class="invoices">



    <!--end buttons-->



    <div class="col-lg-8 col-md-7 col-12 letter" id="tab1">
     <div class="row">
    <!--start header info -->
      <div class="header_right col-sm-6 col-xs-12">

            <h2>  <span class="firstLogo"> {{$data->company}} </span></h2>
            <p class="myCompany">   {{$data->postal_code}}  | {{$data->country->name}} | {{$data->phone}}</p>
            <?php
        //  dd($sales_invoice->contact->id);
            $address = \DB::table('contact_addresses')->where('contact_id', $sales_invoice->contact->id)->first();
            $contact = \DB::table('contacts')->where('id',$sales_invoice->contact->id)->first();
            $country = \DB::table('countries')->where('id',$address->country_id)->first();
            $governorate = \DB::table('governorates')->where('id',$address->governorate_id)->first();
            ?>
            @if($sales_invoice->invoice_status_id==1)
            <div id="draft-image">
                <img src="{{asset('img/draft.png')}}">
                <div class="contact_info col-xs-6 pull-right" style="position: absolute; top: 0; right: 0; height: 100%; padding: 10px; width: 100%;">
                    <p>{{@$sales_invoice->contact->full_name}}</p>
                    <p>{{$address->street}} {{$address->house_no}}</p>
                    <p>{{$address->postal_code }} {{$address->city}}</p>
                    @if(!empty($governorate) || !empty($country))
                    <p>{{$governorate->name_ar}} {{$country->name_ar}}</p>
                    @endif
                </div>
            </div>

            @else
            <p>{{@$sales_invoice->contact->full_name}}</p>
            <p>{{$address->street}} {{$address->house_no}}</p>
            <p>{{$address->postal_code }} {{$address->city}}</p>
            @if(!empty($governorate) || !empty($country))
            <p>{{$governorate->name_ar}} {{$country->name_ar}}</p>
            @endif
        @endif
        </div>
        <!--end header info-->



    <!--start side_paper-->
    <div class="side_paper col-sm-6 col-xs-12">
        <h4 class="side_paper_head">
        <!--<i class="fa  fa-credit-card"></i> -->

         <span class="firstLogo">الدفع</span></h4>

        <ul class="paper-li">
            <li>
            <p class="text-center li-head">

            المبلغ المتبقى
            </p>

            <p class="small">
            <i class="fa fa-dollar-sign" aria-hidden="true"></i>
             {{$sales_invoice->rest}}
            </p>
             </li>

             <li>
                <p class="text-center li-head">

             تاريخ أخر دفعه
            </p>
             <p class="small">
             <!--<i class="fa icon fa-envelope" aria-hidden="true"></i>-->
            @if(!empty($sales_invoice->installments))
            {{@$sales_invoice->installments->last()->paid_date}}
            @endif
             </p>
             </li>


        </ul>
    </div>
    <!--end side_paper -->

    </div> <!--end row -->
    @if(!empty($sales_invoice->header_text))
    <p class="show-print invoice_header">{{$sales_invoice->header_text}}</p>
    @endif
    <div class="row pay_details">
        <div class="col-xs-7 right">
            <h6>حررت هذه الفاتورة ل : </h6>
            <p class="p">  {{@$sales_invoice->contact->full_name}}</p><br>
            <strong>التليفون : </strong><p>{{@$sales_invoice->contact->phones->first()->phone_number}}</p><br>
            <strong style="float: right;">العنوان : </strong>
            <div style="display: inline-block;margin-right: 5px;">
                <p style="display: block;">  {{$address->street}} {{$address->house_no}}</p>
                <p style="display: block;">  {{$address->postal_code }} {{$address->city}}</p>
                @if(!empty($governorate) || !empty($country))
                <p style="display: block;">{{$governorate->name_ar}} {{$country->name_ar}}</p>
                @endif
            </div>
        </div>
        <div class="col-xs-5 left">
            <strong>رقم الفاتورة : </strong><p> {{$sales_invoice->invoice_number}}</p><br>
            <strong>تاريخ الفاتورة : </strong><p> {{$sales_invoice->invoice_date}}</p><br>
            <strong>رقم العميل : </strong><p> {{$sales_invoice->contact_id}}</p><br>
        </div>
    </div>
    @if(!empty($sales_invoice->footer_text))
    <p class="show-print invoice_footer">{{$sales_invoice->footer_text}}</p>
    @endif
    <div class="row">
     <hr>
    <!--    <p>محتوى راس الفاتورة</p>-->
    </div>

    <!--start table of detail-->
    <div class="table-responsive">

    <table class="table  table-bordered">
        <thead class="tabel-head ">
        <tr>
            <th>المنتج</th>
            <th>السعر</th>
            <th>الكمية</th>
            <th>المبلغ شامل الضرائب</th>
        </tr>
        </thead>


        <tbody>
            @foreach($sales_invoice->invoiceItems as $row)
            <tr>
                <td>{{$row->product->name}}</td>
                <td>{{$row->price}}</td>
                <td> {{$row->quantity}}</td>
                <td> {{$row->amount}}</td>
            </tr>
            @endforeach


        <tr>
            <td colspan="3">
            <p> الاجمالى بدون ضرائب</p>
            <p class="tax">الضرائب</p>

            <strong>اجمالى الفاتوره </strong>
            </td>
            <td>
            <p>{{$sales_invoice->total_amount}}</p>
            <p class="tax"><?php //echo $tax; ?> {{$sales_invoice->total_invoice-$sales_invoice->total_amount}}</p>

            <strong>{{$sales_invoice->total_invoice}}</strong>
            </td>
        </tr>
        </tbody>
        </table>

    </div>
    <!--end tabel resposive-->

    <hr class="visible-print" style="margin-bottom: 0">

    @if(!empty($sales_invoice->installments))
    <span class="pull-left label detail_sban label-def" style=" text-align:center;   margin-top: 2rem;
    margin-bottom: 1remك  background-color: #d7d7d7;
    padding: 7px"><strong> دفعات الفاتوره </strong></span>


        <!--start >فغات الفاتوره-->
    <div class="tabel-responsive">

        <table class="table table-bordered table-striped" id="thetable">
            <thead class="tabel-head">
                <tr>
                <th>المبلغ</th>
                <th>تاريخ الدفع </th>
                <th>حساب الدفع </th>
                <th> نص الدفع </th>
                <th> مسح</th>
                </tr>
            </thead>
            <tbody class="tabel-body-font">
                @foreach($sales_invoice->installments as $row)
                <tr>
                    <td>{{$row->paid}}</td>
                <td>{{$row->paid_date}}</td>
                @if($row->finance_type==1)
                <td>{{$row->finance_bank_name($row->finance_id)}}</td>
                @elseif($row->finance_type==2)
                    <td>{{$row->finance_treasury_name($row->finance_id)}}</td>
                @else
                    <td>{{$row->finance_credit_name($row->finance_id)}}</td>
                @endif
                <td>{{$row->finance_notes}}</td>
                <td class="last-icon">
                    {{Form::open(['class'=>'delete-form','route'=>'sales_invoice.sales_invoices_deleteInstallment'])}}
                    {{Form::hidden('id',$row->id,['id'=>'install_id'])}}
                    <!-- <button type="submit" class="fa fa-trash fa-2x" style="color:#5FBEAA;"></button> -->
                    <!--   -->
                    <button  type="submit" class="deleteInstallment" id="deleteInstallment_{{$row->id}}"  >

                    <span ><i class="fa fa-trash fa-2x" style="color:#5FBEAA;"></i> </span>
                </button>
                    {{Form::close()}}

                    </td>

                </tr>
                @endforeach

            </tbody>
        </table>
    @endif
    </div>
    <!--end tabel responsive-->

        <footer class="print_footer visible-print">
            <div class="row visible-print">
                <hr style="margin-bottom: 10px;">
            <!--    <p>محتوى زيل الفاتورة</p>-->
            </div>

            <div class="col-xs-4">
                <p>{{$data->company}}</p>
                <p>{{$data->address}}</p>
                <p>{{$data->postal_code}} {{$data->district}}</p>
                @if(!empty($governorate) || !empty($country))
                <p>{{$governorate->name_ar}} {{$country->name_ar}}</p>
                @endif
            </div>
            <div class="col-xs-4">

              <p>التليفون: {{$data->phone}}</p>
              <p>الفاكس: {{$data->fax}}</p>
              <p>{{$data->user->email}}</p>
              <p>{{$data->url}}</p>


            </div>

            <div class="col-xs-4" style="text-align: right;direction: rtl;">
                <?php
                       $iban  = '';
                       $bic   = '';
                       $bank  = '';
                    ?>
                    @if(!empty($bank_data))
                      <?php
                          $iban = decrypt($bank_data->iban);
                          $bic  = decrypt($bank_data->bic);
                          $bank = decrypt($bank_data->bank_name);
                      ?>
                    @endif
              <div>
                  <p style="display: inline-block;">IBAN : </p>
                  <p style="display: inline-block;">{{$iban}}</p>
              </div>
              <div>
                  <p style="display: inline-block;">BIC : </p>
                  <p style="display: inline-block;">{{$bic}}</p>
              </div>
              <div>
                  <p style="display: inline-block;">Bank : </p>
                  <p style="display: inline-block;">{{$bank}}</p>
              </div>
            </div>

       </footer>
   </div>
    <!--end letter section-->

</div> <!--end row -->


    </div>
    <!--end all invoices-->




    <!--start model to send email -->
    <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">إرسال فاتورة </h4>
          </div>
          <div class="modal-body">


            <!--start user form for sending Email-->
    <form id="EmailUserForm">

        <input type="hidden" name="contact_id" value="{{$sales_invoice->contact_id}}">

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
                <input class="form-control" type="email" id="ReciverEmail" value="{{$sales_invoice->contact->email}}" style="margin-bottom:15px;" >
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-4 col-xs-12">
                <strong>Subject :</strong>
            </div>
            <div class="col-sm-8">
                <?php
                    $temp =\DB::table('email_templates')->where('id','=',1)->first();
                    $old2 = ["[CLIENT_NAME]", "[REST]", "[INVOICE_NUMBER]"];
                    $new2   = [ $sales_invoice->contact_name , $sales_invoice->rest , $sales_invoice->invoice_number ];
                    $phrase2 = $temp->subject;
                    $newPhrase2 = str_replace($old2, $new2, $phrase2);
                ?>
                <input class="form-control" type="text" name="subject" value="{{$newPhrase2}}" style="margin-bottom:15px;">
            </div>
        </div>

        <div class="row" id="header-row">
            <div class="col-md-12 col-xs-12" style="margin-bottom: 15px">
                <textarea id="header_text" name="header_text">
                    <?php
                        $old = ["[CLIENT_NAME]", "[REST]", "[INVOICE_NUMBER]"];
                        $new   = [ $sales_invoice->contact_name , $sales_invoice->rest , $sales_invoice->invoice_number ];
                        $phrase = $temp->content;
                        $newPhrase = str_replace($old, $new, $phrase);

                    ?>
                    {!!html_entity_decode($newPhrase)!!}
                </textarea>
            </div>
        </div>

    </form>

    </div>
          <div class="modal-footer">
          @if($sales_invoice->invoice_status_id==1)
            <button  name="submit" id="submitSendEmail" data-style="expand-right"  value="{{$sales_invoice->id}} "  type="button" class="btn btn-primary waves-effect waves-light m-r-5 ladda-button ">
                <span class="ladda-label"><i class="fa fa-floppy-o"></i>إرسال</span>
                <span class="ladda-spinner"></span>
            </button>
            @else
            <button  name="submit"  data-style="expand-right"    data-dismiss="modal" type="button" class="btn btn-primary waves-effect waves-light m-r-5 ladda-button  send ">
                إرسال
                <span class=""><i class="fa fa-share-square"></i> </span>
            </button>
            @endif
            <button type="submit" form="EmailUserForm" class="btn btn-danger" data-dismiss="modal">

                اغلاق
                <span><i class="fa fa-times-circle"></i></span>
                </button>
          </div>
        </div>

      </div>
    </div>
      {!!Form::close()!!}



<!-- <div id="paid_modal" class="modal fade" role="dialog" aria-labelledby="" aria-hidden="true" style="display: none;" > -->
<div id="paid_modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    @include(Config::get('front_theme').'.dashboard.user.sales_invoice.inc.create_paid_modal')
</div><!-- /.modal -->

<div id="finance_modal" class="modal fade"  role="dialog" aria-labelledby="" aria-hidden="true" style="display: none;" >
    @include(Config::get('front_theme').'.dashboard.user.sales_invoice.inc.create_finance_modal')
</div><!-- /.modal -->

@endsection



@section('page-scripts')
<!--datepicker js for date -->
<script src="plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<!-- <script src="plugins/select2/js/select2.min.js"></script> -->
<!--<script src="plugins/select2/js/select2.full.js"></script>-->
<script src="plugins/tinymce/tinymce.min.js"></script>

<!-- Modal-Effect -->
<script src="plugins/custombox/js/custombox.min.js"></script>
<script src="plugins/custombox/js/legacy.min.js"></script>
<!-- ladda js -->
<script src="plugins/ladda-buttons/js/spin.min.js"></script>
<script src="plugins/ladda-buttons/js/ladda.min.js"></script>
<script src="plugins/ladda-buttons/js/ladda.jquery.min.js"></script>
<!-- Notification js -->
<script src="plugins/notifyjs/js/notify.js"></script>
<script src="plugins/notifications/notify-metro.js"></script>

<!-- Modal-Effect -->
<script src="plugins/custombox/js/custombox.min.js"></script>
<script src="plugins/custombox/js/legacy.min.js"></script>


<!-- PrintArea -->
<script src="plugins/PrintArea/jquery.PrintArea.js"></script>
<script>
$('#first').on('shown.bs.modal', function () {
// make check here if not $('#scond').modal('show');
})


  $(document).ready(function(){

    tinyMCE.init({
        'formats' : {
        //'alignleft' : {'selector' : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', attributes: {"align":  'left'}},
        //'aligncenter' : {'selector' : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', attributes: {"align":  'center'}},
        'alignright' : {'selector' : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', attributes: {"align":  'right'}},
        //'alignfull' : {'selector' : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', attributes: {"align":  'justify'}}
    }
})
	$('ul.tabs').each(function(){
  // For each set of tabs, we want to keep track of
  // which tab is active and its associated content
  var $active, $content, $links = $(this).find('a');

  // If the location.hash matches one of the links, use that as the active tab.
  // If no match is found, use the first link as the initial active tab.
  $active = $($links.filter('[href="'+location.hash+'"]')[0] || $links[0]);
  $active.addClass('active');

  $content = $($active[0].hash);

  // Hide the remaining content
  $links.not($active).each(function () {
    $(this.hash).hide();
  });

  // Bind the click event handler
  $(this).on('click', 'a', function(e){
    // Make the old tab inactive.
    $active.removeClass('active');
    $content.hide();

    // Update the variables with the new link and content
    $active = $(this);
    $content = $(this.hash);

    // Make the tab active.
    $active.addClass('active');
    $content.show();

    // Prevent the anchor's default click action
    e.preventDefault();
  });
});


$('.invoices-btn').on('click', function(e)  {
// var currentAttrValue = jQuery(this).attr('href');
// Show/Hide Tabs
$('.tabs ' + currentAttrValue).show().siblings().hide();
// Change/remove current tab to active
jQuery(this).parent('li').addClass('active').siblings().removeClass('active');
e.preventDefault();
});


  //  $('#finance_id').on('click',function(e){
  function load_finance()
  {
   $.get('/dashboard/salesInvoice/get_finance_json',function(data){
  //   console.log(data);
     $('#finance_id').empty();
     if(data.count == 0){
           document.getElementById('BtnFinance').style.display = 'block';
     }else{

      //   $.each(data.financArr,function(index,value){
      //       $('#finance_id').append('<option value="'+index+'">'+value+'</option>');
      // });
      if(data.count1!=0)
      {
        $('#finance_id').append('<option disabled>البنوك</option>');
        $.each(data.financArr1,function(index,value){
            $('#finance_id').append('<option value="'+index+'">'+value+'</option>');
      });
    }
    if(data.count2!=0)
    {
      $('#finance_id').append('<option disabled>الخزائن</option>');
        $.each(data.financArr2,function(index,value){
            $('#finance_id').append('<option value="'+index+'">'+value+'</option>');
      });
    }
    if(data.count3!=0)
    {
        $('#finance_id').append('<option disabled>بطاقات الائتمان</option>');
        $.each(data.financArr3,function(index,value){
            $('#finance_id').append('<option value="'+index+'">'+value+'</option>');
      });
    }

     }


// });

});
}
load_finance();

        var l = $('.ladda-button').ladda();
        var S_D = $('#treasury_details') , C_D = $('#card_details') , B_D = $('#back_details');

        $('#radio1').click( function() {
            $('#serial_number').val($('#bank_serial_number').val());
            S_D.fadeOut();
            C_D .fadeOut();
            B_D.fadeIn();
        });
        $('#radio2').click( function() {
            $('#serial_number').val($('#treasury_serial_number').val());
            B_D.fadeOut();
            C_D.fadeOut();
            S_D.fadeIn();
        });
        $('#radio3').click( function() {
            $('#serial_number').val($('#credit_serial_number').val());
            B_D.fadeOut();
            S_D.fadeOut();
            C_D.fadeIn();
        });

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
                type: "POST",
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
                        $.Notification.autoHideNotify('success', 'top right', 'Saved successfully','Data has been Saved successfully <br>');
                          load_finance();
                        $('#finance_modal').modal('hide');
                         document.getElementById('BtnFinance').style.display = 'none';

                    //window.location.href = "{{ route('sales_invoice.show' ,$sales_invoice->id) }}";
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
        //save store_installment
        $('#btnPaidSave').on('click',function () {
            $('.alerts').html('');
            $('.ladda-button[led="btnSave"]').ladda('start');
            var url = $("#Paid_form").attr('action');
            $.ajax({
                type: "POST",
                url: url,
                data: $("#Paid_form").serialize(),
                success: function(data)
                {
                console.log($("#Paid_form").serialize());
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
                        $.Notification.autoHideNotify('success', 'top right', 'Saved successfully','Data has been Saved successfully <br>');
                         window.location.href = "{{ route('sales_invoice.show' ,$sales_invoice->id) }}";
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

        //==delete installment//
        $('form.delete-form').submit(function(){
          var this_objct = this;
        //  alert('ok');
          $.post($(this).attr('action'),$(this).serialize(),function(result){
          $(this_objct).closest('tr').remove();
          window.location.href = "{{ route('sales_invoice.show' ,$sales_invoice->id) }}";
          },'json');
          return false;
        });

        /*********Send Email************/
        $('.send').on('click',function(e){
            e.preventDefault();
            e.stopPropagation();
            $('.alerts').html('');
            var led = $(this).attr('led')
            var lada = '.ladda-button[led="' + led + '"]'
            $(lada).ladda('start');
            var url = "{{route('sales_invoice.sendEmail')}}";
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id': $('#myModal input[name="contact_id"]').val(),
                    'email' : $('#myModal #ReciverEmail').val(),
                    'subject' : $('#myModal input[name="subject"]').val(),
                    'message' : $('#myModal textarea').text(),
                    'company' : "{{$data->company}}",
                    'sales_number' : "{{$sales_invoice->invoice_number}}",
                    'rest' : "{{$sales_invoice->rest}}",
                    'sales_invoice_id' : "{{$sales_invoice->id}}"
                },
                success: function(data)
                {
                    $.Notification.autoHideNotify('success', 'top right', 'Email Sent successfully');
                    location.reload();
                }
            });
        });
        //end delete installment//==
        //=========convert draft to invoice2

        $('#submitSendEmail').on('click' , function () {
            $('.alerts').html('');
            var led = $(this).attr('led')
            var lada = '.ladda-button[led="' + led + '"]'
            $(lada).ladda('start');
            var url = "{{ route('sales_invoice.draft_invoice') }}";
            $.ajax({
                type: "GET",
                url: url,
                data: { id: $(this).val() },
                success: function(data)
                {
                //  console.log(data);
                  console.log(data);
                    setTimeout(function () {
                        $(lada).ladda('stop');
                    },2000)
                    if (isNaN(data)){
                        $.each(data['errors'], function(i, item) {
                            $.Notification.autoHideNotify('error', 'top right', 'Whoops',item);
                        });
                    }else{
                        var mode = 'iframe'; //popup
                        var close = mode == "popup";
                        var options = { mode : mode, popClose : close};


                        setTimeout(function() {

                       window.location.href = "{{route('admin::invoices.index')}}";
                        }, 2500);
                      $.Notification.autoHideNotify('success', 'top right', 'Convert Draft To Invoice successfully','Invoice Saved successfully<br>');
                    }
                },
                error: function(data){
                    setTimeout(function () {
                        $(lada).ladda('stop');
                    },2000)
                    $.Notification.autoHideNotify('error', 'top right', 'Whoops','Error may be in connection to server<br>');
                }
            });
        });
        //====draft to ibvoice


    });
</script>





@endsection
