<!DOCTYPE html>
<html >

  <head>
    <!--<link href="{{ asset('/css/bootstrap.css') }}" rel="stylesheet">
    -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <style>
            body{
              background: linear-gradient(#ccc, #fff);
              font: 14px ;
              padding: 20px;
            }
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
     
    </style>
  </head>
  <body>
    <div class="container" style="direction: rtl;">
      <section class="col-lg-8 col-md-7 col-12 letter">

    <div class="row">
    <!--start header info -->
      <div class="header_right text-center col-sm-6 col-xs-12">
    
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
    <span class="pull-left label detail_sban label-def" ><strong> دفعات الفاتوره </strong></span>
    

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

    </div>
      <!--<script src="{{ asset('/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>-->
      <!-- Bootstrap 3.3.2 JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

  </body>
</html>