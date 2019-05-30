<!DOCTYPE html>
<html >
  
  <head>
    <style type="text/css">

.letter {
     background: #fff;
     box-shadow: 0 0 10px rgba(0,0,0,0.3);
     max-width: 550px;
     padding: 25px;
     padding-bottom:10px;
     position: relative;
     width: 80%;
     z-index: 51;
     margin-right:50px;
}

.header_right{
    width: 50%;
    float: right;
    position: relative;
  
  
}

 .firstLogo{
    
     word-spacing: -5px;
     font-weight:bold;
}
 .header_right  p{
     font-size: 13px;
     /* background:red; */
     margin:0px;
     margin-bottom: 3px !important;
}

 .header_right .myCompany{
    font-size: 10px;
    margin-bottom: 5px;
}
/*end letter right section*/

/* start section الدفع */
 .side_paper{
   float:left  !important;
  
}

 .side_paper .side_paper_head {
  font-size:16px;
  font-weight:bold;
     display: block;
     text-align: center;
     margin:0;
     margin-top:30px;  
     margin-bottom:12px;     
        
     font-weight: bold;
}
.text-center{
  text-align:center;
  /* margin-top:8px; */
     /* margin-bottom: 10px; */
}
 /* .side_paper .paper-li{
    list-style: none;
    margin:0;
    padding-right:0
} */

 .side_paper p{
     margin: 5px;
     margin-bottom:5px;
}

.footer{
  margin-right: 10%;
  width: 85%;
}

 .invoice_header , .invoice_footer{
        background:#f1f1f1 !important;
        text-align:center;
        border: 1px solid #ddd;
        
        display:block;
        font-weight:bold;
        padding-top: 5px;
        padding-bottom:5px;
        /* margin-right:-5px; */
        margin-top: 40px;
        margin-bottom: 0 !important;
}
.invoice_header {
  background-color:#f1f1f1;
  
}

/* .invoice_header_text{
  
  border-bottom-color:none;
}
.invoice_footer{
  border-top-color:none;
  
} */
.invoice_header_text , .invoice_footer_text{
  border: 1px solid #ddd;
  
  margin-top:0;
  margin-bottom:0;

    padding:8px;  
  
}
.invoice_header_text{
  margin-top: 15px;
}

    .invoice_footer{
      margin-top:0!important;
    }

 
/*end sidebar*/
.pay_details{
  position: relative;
  display: inline-flex;
    margin-bottom: 0px !important;
     border: 1px solid #ddd;
     margin-top:0px;
     position:relative;
     width:100% ;
     margin:0;

}
 .pay_details .right {
  border-left:1px solid #ccc;

   width: 50% ;
    float: right;padding: 15px 15px;

}
 .pay_details .right h6{
    text-decoration: underline;
    display: inline-block;
    /* padding-top: 15px; */
    
    margin-bottom: 15px;
    font-weight: bold;
    }

.phone{
  margin-bottom:15px;
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
   
width: 36%;float: right; padding: 15px 15px;
}
 .pay_details .left strong,.pay_details .left p {
    display:inline-block;
}
.left div {
  margin-bottom:15px;
}
.left div:last-child {
  margin-bottom:0px;
}
 .letter_footer .left{
    font-size :10px;
     font-size: 10px;
     text-align: left;
     display:block;
     float:left 
}
 .letter_footer .left{
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
@page {
  footer: page-footer;
}


.footer p {
  margin:0px;
  margin-bottom:4px;
}


  .table .table-head{
    background-color: #eeeeee;
    font-weight: 400;
  
    text-align:right;
    
    /* font-family: sans-serif; */
    font-size: 13px;
  }
  .table tbody tr td {
    text-align:right;
  }

    </style>
  </head>
  <body>
<div class="container" style="direction: rtl; font-family: unset;">
    <section class="letter">
    <div >
    <!--start header info -->
     
    <div class="header_right col-sm-6 col-xs-12">
    
    <h2>  <span class="firstLogo">{{@$data->company}} </span></h2>
    <p class="myCompany">   {{@$data->postal_code}}  | {{@$data->country->name}} | {{@$data->phone}}</p>
    <?php
//  dd($sales_invoice->contact->id);
    $address = \DB::table('contact_addresses')->where('user_id','=',$user_id)->where('contact_id', $sales_invoice->contact->id)->first();
    $contact = \DB::table('contacts')->where('user_id','=',$user_id)->where('id',$sales_invoice->contact->id)->first();
    $country = \DB::table('countries')->where('id',$address->country_id)->first();
    $governorate = \DB::table('governorates')->where('id',$address->governorate_id)->first();
    ?>
    @if($sales_invoice->invoice_status_id==1)
    <div id="draft-image">
        <img src="{{asset('img/draft.png')}}">
        <div class="contact_info col-xs-6 pull-right" style="position: absolute; top: 0; right: 0; height: 100%; padding: 10px; width: 100%;">
            <p>{{@$sales_invoice->contact->full_name}}</p>
            <p>{{@$address->street}} {{@$address->house_no}}</p>
            <p>{{@$address->postal_code }} {{@$address->city}}</p>
            @if(!empty($governorate)   || !empty($country) ){
            <p>{{@$governorate->name_ar}} {{@$country->name_ar}}</p>

            @endif
        </div>
    </div>

    @else
    <p>{{@$sales_invoice->contact->full_name}}</p>
    <p>{{@$address->street}} {{$address->house_no}}</p>
    <p>{{@$address->postal_code }} {{$address->city}}</p>
    <?php if(empty($governorate)  || empty($country)){

    }else{?>
    <p>{{@$governorate->name_ar}} {{@$country->name_ar}}</p>
<?php } ?>
@endif
</div>


        <!--end header info-->


        
    <!--start side_paper-->
    <div class="side_paper">
        <h4 class="side_paper_head">
         <span class="firstLogo">الدفع</span>
         </h4>
      
     
           <p class="text-center"> 
           المبلغ المتبقى
            </p> 

              <p class="text-center">
             {{$sales_invoice->rest}}
             </p>
              
            <p class="text-center">
             تاريخ أخر دفعه
            </p> 
            <p class="text-center">
            @if(!empty($sales_invoice->installments))
            {{@$sales_invoice->installments->last()->paid_date}}
            @endif           
             </p>
          
          
    </div>
    <!--end side_paper -->

    </div> <!--end row -->
      

      @if(!empty($sales_invoice->header_text))
        <p class="invoice_header_text">{{$sales_invoice->header_text}}</p>
      @endif
     


      <div class=" row pay_details">
          <div class="col-xs-7 right">
        
         
  <div>
    <strong>حررت هذه الفاتورة ل :</strong>
    <span>{{@$sales_invoice->contact->full_name}}</span><br>
    </div>
   
    <br>
   
    <div class="phone">
    <strong>التليفون : </strong>
    <span>{{@$sales_invoice->contact->phones->first()->phone_number}}</span><br>
    </div>
 
  <div>
    <strong>العنوان : 
      </strong>
    <span>
      {{$address->street}} {{$address->house_no}}<br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$address->postal_code }} {{$address->city}}<br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$governorate->name_ar}} {{$country->name_ar}}<br>
     </span>
  </div>
    
  

  

          <div class="clearfix" style="clear: both;"></div>
          

          </div>
        <!-- end right -->


        <div class="col-xs-5  left">
                
        <div> 
  <strong >رقم الفاتورة : </strong><span> {{$sales_invoice->invoice_number}}</span><br>
  </div>

  <div>
  <strong>تاريخ الفاتورة : </strong><span> {{$sales_invoice->invoice_date}}</span><br>
  </div>

  <div>
  <strong >رقم العميل : </strong><span> {{$sales_invoice->contact_id}}</span><br>
  </div>













          <div class="clearfix" style="clear: both;"></div>
          </div>

          
       
    </div>
  <!-- end row -->



      

      @if(!empty($sales_invoice->footer_text))
      <p class="invoice_footer_text" >{{$sales_invoice->footer_text}}</p>
      @endif
      <div style="margin-top:25px;"></div>
			     

      <table class="table table-bordered table-striped" style="
        width: 100%;
        max-width: 100%;
        margin-bottom: 1rem;
        background-color: transparent;
        border: 1px solid #DDD;">

          <thead class="table-head">
            <tr style="text-align: right;border-bottom: 1px solid #DDD;">
              <th class="table-head" style="text-align: right;vertical-align: bottom;padding: .75rem;">المنتج  </th>
              <th class="table-head" style="text-align: right; vertical-align:bottom;padding: .75rem;">السعر</th>
              <th class="table-head" style="text-align: right;  vertical-align: bottom;padding: .75rem;">الكمية</th>

              <th class="table-head" style="vertical-align: bottom;padding: .75rem;">المبلغ شامل الضرائب</th>
            </tr>
          </thead>

          <tbody>
              @foreach($sales_invoice->invoiceItems as $row)
            <tr>
              <td style="padding:1rem;vertical-align:top;border-top: 1px solid #dee2e6">{{$row->product->name}}</td>
              <td style="padding:1rem;vertical-align:top;border-top: 1px solid #dee2e6">{{$row->price}}</td>
              <td style="padding:1rem;vertical-align:top;border-top: 1px solid #dee2e6"> {{$row->quantity}}</td>
              <td style="text-align:center;padding:1rem;vertical-align:top;border-top: 1px solid #dee2e6"> {{$row->amount}}</td>
            </tr>
             @endforeach
            <tr>
               <td style="padding:1rem;vertical-align:top;border-top: 1px solid #dee2e6" colspan="3">
               <span style="margin-bottom: 5px;">الاجمالى بدون ضرائب</span><br>
               <span class="tax">الضرائب</span><br>
               <span>اجمالى الفاتورة</span><br>
               </td>
              <td style="text-align:center;padding:1rem;vertical-align:top;border-top: 1px solid #dee2e6">
              <span>{{$sales_invoice->total_amount}}</span><br>
              <span class="tax">{{$sales_invoice->total_invoice - $sales_invoice->total_amount}}</span><br>
              <span>{{$sales_invoice->invoiceItems->sum('amount')}}</span><br>
              </td>
            </tr>


          </tbody>
      </table>


  @if(!empty($sales_invoice->installments))
 <p class="" style="display:block; width:100%; text-align:center;margin-top: 2rem;background-color: #f1f1f1 !important;padding:7px ; border:1px solid #ddd ;margin-bottom: 0;"><strong> دفعات الفاتوره </strong>
 </p>    
  <table class="table table-bordered table-striped" id="thetable" style="width: 100%;
    max-width: 100%;
    margin-bottom: 1rem;
    background-color: transparent;
    border: 1px solid #DDD;">
        <thead class="tabel-head" style="border: 1px solid #DDD;">
            <tr style="text-align: right;border-bottom: 1px solid #DDD;">
            <th style="vertical-align: bottom;text-align:right;padding: .75rem;">المبلغ</th>
            <th style="vertical-align: bottom;text-align:right;padding: .75rem;">تاريخ الدفع </th>
            <th style="vertical-align: bottom;text-align:right;padding: .75rem;">حساب الدفع </th>
            <th style="vertical-align: bottom;text-align:right;padding: .75rem;"> نص الدفع </th>
            </tr>
        </thead>
        <tbody class="tabel-body-font">
            @foreach($sales_invoice->installments as $row)
            <tr>
            <td style="padding:1rem;vertical-align:top;border-top: 1px solid #dee2e6">{{$row->paid}}</td>

            <td style="padding:1rem;vertical-align:top;border-top: 1px solid #dee2e6" >{{$row->paid_date}}</td>
            @if($row->finance_type==1)
            <td style="padding:1rem;vertical-align:top;border-top: 1px solid #dee2e6">{{$row->finance_bank_name($row->finance_id)}}</td>
            @elseif($row->finance_type==2)
                <td style="padding:1rem;vertical-align:top;border-top: 1px solid #dee2e6">{{$row->finance_treasury_name($row->finance_id)}}</td>
            @else
                <td style="padding:1rem;padding-right:4rem;vertical-align:top;border-top: 1px solid #dee2e6">{{$row->finance_credit_name($row->finance_id)}}</td>
            @endif
            <td style="padding:1rem;vertical-align:top;border-top: 1px solid #dee2e6">{{$row->finance_notes}}</td>

            </tr>
            @endforeach

        </tbody>
  </table>
  @endif



        
  
  <htmlpagefooter name="page-footer" class="footer">
                <hr style="margin-top:20px;">
                 <div class="col-xs-4 pull-left" style="float:right; width:33.3333%;text-align: right;">
                    <p style="margin-top:10px">{{$data->company}}</p>
                    <p>{{$data->address}}</p>
                    <p>{{$data->district}}</p>
                    <p>{{$data->country->name}} {{$data->postal_code}} </p>
                    @if(!empty($governorate) || !empty($country)){
                    <p>{{$governorate->name_ar}} {{$country->name_ar}}</p>
                    @endif
                  </div>

                  <div class="col-xs-4 pull-left" style="float:right;width:33.3333%;text-align: right;">
                    <p style="margin-top:10px">التليفون: {{$data->phone}}</p>
                    <p >الفاكس: {{$data->fax}}</p>
                    <p >{{$data->user->email}}</p>
                    <p>{{$data->url}}</p>
                  </div>
                  <div class="col-xs-4 pull-left" style="float:right;width:33.3333%;text-align: right;">
                    <?php 
                       $iban  = '';
                       $bic   = '';
                       $bank  = '';
                    ?>
                    @if(!empty($bank_data))
                      <?php 
                          $iban = $bank_data->iban;
                          $bic  = $bank_data->bic;
                          $bank = $bank_data->bank_name;
                      ?>
                    @endif
                    <p style="margin-top:10px"> {{$iban}} : IBAN </p>
                    <!-- <p></p> -->
                    <p>{{$bic}} : BIC</p>
                    <!-- <p></p> -->
                    <p>{{$bank}}  : Bank</p>
                    <!-- <p></p> -->
                  </div>
  </htmlpagefooter>

    </section>
</div>
  </body>
</html>