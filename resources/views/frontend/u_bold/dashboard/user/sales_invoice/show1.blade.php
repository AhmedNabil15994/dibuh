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


    <link href='https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.7.5/css/froala_editor.min.css' rel='stylesheet' type='text/css' />
<link href='https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.7.5/css/froala_style.min.css' rel='stylesheet' type='text/css' />


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
     background: #f6f6f6;
     box-shadow: 0 0 3px rgba(0,0,0,0.2);
     right: -3px;
     top: 1px;
     transform: rotate(1.4deg);
}
 .letter .header_right{
     padding-right: 2rem;
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
 .header_right h2{
    margin-bottom: 30px;
}
 .header_right .myCompany{
    font-size: 10px;
    margin-bottom: 10px
}
/*end letter right section*/
 .side_paper{
     margin-top: 3rem;
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
     color: #f05050;
     font-size: 18px;
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
     font-size: 11px;
     margin-bottom: 0;
}
 .side_paper .small{
     text-align: center;
     margin-top: 5px;
     font-size: 18px;
     color: #5fbeaa 
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
     margin-top:10px;
     position:relative;
     width:100% 
    /*heigth: 50%;
    */
}
 .pay_details .right {
    padding: 0px 20px 5px;
}
 .pay_details .right h5{
    text-decoration: underline
}
 .pay_details .right p{
    line-height: 22px;
     margin: 0;
     font-size: 14px;
}
 .pay_details .left{
    background:rgba(204, 204, 204, 0.33);
     border-right: 1px solid;
     display:block;
     padding: 20px;
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
/*start media print */
 @media print {
     .letter {
         background: #fff;
         box-shadow: none;
         margin-top:0;
         min-height: auto;
         padding: 0px;
         min-width: 95%;
         margin-left: 0px;
         margin-right: 20px;
         position: relative;
         z-index: 51;
    }

    .header_right{
        margin:0 !important;
        width:50%;
        text-align:right;
    }
    .header_right h2{
        margin:0;
    }
    .side_paper{
        text-align:left;
        margin-top:20px !important;
        margin-bottom:0 !important;
        width:50%;
    }
    .side_paper_head{
        margin:0;

    }
    .paper_li{
        margin:0;
    }
     .pay_details{
         margin-top: 0;
    }
     .row{
         padding: 0;
         margin: 0;
    }
     .panel-heading,.pay_details{
         border:1px solid #f1f1f1 !important;
    }
     .pay_details .left{
         border-right: 1px solid #f1f1f1 !important;
    }
     .print_footer{
         position: fixed;
         bottom: 0;
         width: 100%;
    }
     p,td,th{
         font-size: 12px;
         font-weight: normal;
    }
     .header_right{
        display:block;
        padding-top:30px;
        padding-bottom:20px
    }
     .header_left{
        display:block;
         position:absolute;
        top:0;
        left:0
    }
     .letter:before, .letter:after {
         display:none 
    }
     body {
         background: none;
         font: 14px sans-serif;
         padding: 0px;
         margin: 0px;
    }
     .wrapper,.container {
        padding: 0px;
        margin: 0px;
    }
    .invoice_header , .invoice_footer{
        display:block;
        margin-right:15px;
        font-weight:bold;
        padding: 5px;
    border: 1px solid;
    text-align: center;
    margin-top: 10px;
    width: 90%;        
        
    }

    .invoice_footer{
        margin-top:15px;

    }
    .last-icon{
        display:none;
    }
    #thetable th:last-child{
        display:none;
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
 .f_table{
    margin-top:30px
}
 .f_table tbody i{
    color:#f05050
}
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
 a {
     color: white;
}
 a:hover{
    color:white
}
 a:visited{
    color:white
}
 a:active{
    color:white
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
    width:70%;
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
.text-area{
        margin-top: 10px;

}
</style>


<div class="section m-b-20">
        <div class="head hidden-print">
            <h4 class="page-title">الضرائب</h4>
            <p class=" page-title-alt m-b-0">من هنا يمكنك متابعه الضرائب</p>
</div>
<div class="row details">
        
            <!--start buttons div-->
    <div class="col-lg-4 col-md-5  col-12 hidden-print buttons">
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal" onclick="window.history.back();">رجوع</button>

                <button type="button" data-style="expand-right" id="btnSavePrint" onclick="window.print()" class="btn btn-inverse waves-effect waves-light ladda-button" led="btnSavePrint">
                    <span class="ladda-label"> طباعه <i class="fa fa-print"></i></span>
                    <span class="ladda-spinner"></span>
                </button>

                <button type="button" data-style="expand-right" id="btndownloadPrint"  class="btn btn-inverse waves-effect waves-light ladda-button" led="btndownloadPrint">
                    <span class="ladda-label"> <a href="{{route('sales_invoice.downloadPdf',['id'=>$sales_invoice->id])}}">تحميل</a> <i class="fa fa-download"></i></span>
                    <span class="ladda-spinner"></span>
                </button>

                @if($sales_invoice->rest>0 && $sales_invoice->invoice_status_id!=1)
                <button type="button"data-toggle="modal"  data-target="#paid_modal"data-style="expand-right" id="btnpaidPrint"  class="btn btn-inverse waves-effect waves-light ladda-button" led="btnpaidPrint">
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

    <section class="col-lg-8 col-md-7 col-12 letter">

    <div class="row">
    <!--start header info -->
      <div class="header_right col-sm-6 col-xs-12">
    
            <h2>  <span class="firstLogo"> {{$data->company}} </span></h2>
            <p class="myCompany">   {{$data->postal_code}}  | {{$data->country->name}}|{{$data->phone}}</p>
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
                <div class="contact_info col-xs-6 pull-right" style="position: absolute; top: 0; right: 0; height: 100%; padding: 10px;">
                    <p>{{@$sales_invoice->contact->full_name}}</p>
                    <p>{{$address->street}} {{$address->house_no}}</p>
                    <p>{{$address->postal_code }} {{$address->city}}</p>
                    <?php if(count($governorate) < 1  || count($country) < 1){

                    }else{?>
                    <p>{{$governorate->name_ar}} {{$country->name_ar}}</p>
                <?php } ?>
                </div>
            </div>

            @else
            <p>{{@$sales_invoice->contact->full_name}}</p>
            <p>{{$address->street}} {{$address->house_no}}</p>
            <p>{{$address->postal_code }} {{$address->city}}</p>
            <?php if(count($governorate) < 1  || count($country) < 1){

            }else{?>
            <p>{{$governorate->name_ar}} {{$country->name_ar}}</p>
        <?php } ?>
        @endif
        </div>
        <!--end header info-->


        
    <!--start side_paper-->
    <div class="side_paper col-sm-6 col-xs-12">
        <p class="side_paper_head">
        <i class="fa  fa-credit-card"></i> 
        
        الدفع</p>

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
            @if(count($sales_invoice->installments))
            {{$sales_invoice->installments->last()->paid_date}}
            @endif           
             </p>
             </li>
           

        </ul>
    </div>
    <!--end side_paper -->

    </div> <!--end row -->
    <p class="show-print invoice_header">{{$sales_invoice->header_text}}</p>
    
    <div class="row pay_details">
        <div class="col-xs-7 right">
            <h5>حررت هذه الفاتورة ل :</h5>
            <p>{{@$sales_invoice->contact->full_name}}</p>
            <p>التليفون: {{@$sales_invoice->contact->phones->first()->phone_number}}</p>
            <p>العنوان: {{$sales_invoice->address}}</p>
        </div>
        <div class="col-xs-5 left">
            <strong>رقم الفاتورة : </strong><p> {{$sales_invoice->invoice_number}}</p><br>
            <strong>تاريخ الفاتورة : </strong><p> {{$sales_invoice->invoice_date}}</p><br>
            <strong>رقم العميل : </strong><p> {{$sales_invoice->contact_id}}</p><br>
        </div>
    </div>

    <p class="show-print invoice_footer">{{$sales_invoice->footer_text}}</p>
    <div class="row">
        <hr>
    <!--    <p>محتوى راس الفاتورة</p>-->
    </div>

    <!--start table of detail-->
    <div class="table-responsive">
    
    <table class="table table-hover table-bordered table-striped">
        <thead class="tabel-head">
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
    @if(count($sales_invoice->installments))
    <span class="pull-left label detail_sban label-def"><strong> دفعات الفاتوره </strong></span>
    

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
        <div class="row">
            <hr>
        <!--    <p>محتوى زيل الفاتورة</p>-->
        </div>

        <div class="print_footer visible-print" style="position: fixed;bottom: 0; right:0px;width:100%">
            <div class="col-xs-4">
                    <p>{{$data->company}}</p>
                <p>{{$data->address}}</p>
                <p>{{$data->district}}</p>
                    <p>{{$data->postal_code}} </p>
            </div>
            <div class="col-xs-4">

              <p>التليفون: {{$data->phone}}</p>
              <p>الفاكس: {{$data->fax}}</p>
              <p>{{$data->user->email}}</p>
              <p>website.com</p>


            </div>

            <div class="col-xs-4">
              <p>IBAN:DE9610050000019</p>
              <p>BIC: BELADEBEXXX</p>
              <p>Bank: LBB - Berliner Sparkasse</p>
            </div>

       </div>
   </section>
    <!--end letter section-->

</div> <!--end row -->

        


    <!--start model to send email -->
    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">إرسال بالبريد الالكترونى </h4>
          </div>
          <div class="modal-body">


            <!--start user form for sending Email-->
    <form id="EmailUserForm">

        <div class="form-group">
            <label for="UserEmail1" id="ReciverEmailLabel">  البريد الالكتروني :</label>
            <input type="email" class="form-control" id="ReciverEmail" placeholder="عـــنوان البريد الالكتروني" value="{{$sales_invoice->contact->email}}">
        </div>
        <div class="clearfix"></div>
        <input type="hidden" name="contact_id" value="{{$sales_invoice->contact_id}}">
        @if(!empty($sales_invoice->contact->email))
        <div class="form-group Email-main-info">
            <label for="UserEmail1" id="UserEmailLabel">  الي :</label>
            <input type="text" class="form-control User_NameInput" id="UserEmail" aria-describedby="emailHelp" placeholder="اسم المرســـل " value="{{$sales_invoice->contact->full_name}} -- {{$sales_invoice->contact->company}}"> 
        </div>
        <div class="clearfix"></div>
        @endif

        <span class=" label"> المــحتوي : </span>
        <div class="form-group text-area">
            <textarea class="form-control" id="froala-editor" name="subject" rows="6" placeholder="">
                <h5>فاتورة رقم : {{$sales_invoice->id}}</h5>
                <h5>اسم الشركة : {{$data->company}}</h5>
                <h5>المبلغ المتبقي : {{$sales_invoice->rest}}</h5>
            </textarea>
        </div>

    </form>

    </div>
          <div class="modal-footer">
          @if($sales_invoice->invoice_status_id==1)
            <button  name="submit" id="submitSendEmail" data-style="expand-right"  value={{$sales_invoice->id}}   type="button" class="btn btn-primary waves-effect waves-light m-r-5 ladda-button ">
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

      function load_finance()
      {
       $.get('/dashboard/salesInvoice/get_finance_json',function(data){
         $('#finance_id').empty();
         if(data.count == 0){
               document.getElementById('BtnFinance').style.display = 'block';
         }else{

          
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
        $('form.Delete_form').submit(function(){
          var this_objct = this;
          $.post($(this).attr('action'),$(this).serialize(),function(result){
          $(this_objct).closest('tr').remove();
          window.location.href = "{{ route('sales_invoice.show' ,$sales_invoice->id) }}";
          },'json');
          return false;
        });

        //end delete installment//==
        //=========convert draft to invoice2
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
                        'message' : $('#myModal textarea').text(),
                        'company' : "{{$data->company}}",
                        'sales_id' : "{{$sales_invoice->invoice_number}}",
                        'rest' : "{{$sales_invoice->rest}}"
                },
                success: function(data)
                {
                    $.Notification.autoHideNotify('success', 'top right', 'Email Sent successfully');
                    location.reload();
                }
            });
        });
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

                       window.location.href = "{{route('sales_invoice.index')}}";
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

        $('textarea#froala-editor').froalaEditor({
                  height: 150
        });


    });
</script>

<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.7.5/js/froala_editor.min.js'></script>




@endsection
