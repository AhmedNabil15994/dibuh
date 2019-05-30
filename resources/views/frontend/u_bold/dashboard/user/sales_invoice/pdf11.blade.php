<!DOCTYPE html>
<html >

  <head>

  </head>
  <body>
<div class="container" style="direction: rtl; font-family: unset; font-size: 11px;">
    <section class="letter">

        
      <div class="header_right ">
          <h2>  <span class="firstLogo" style="font-size: 26px;padding: 0 15px;"> {{$data->company}} </span></h2>
          <span class="myCompany" style="padding:0 15px; display: block;">   {{$data->postal_code}}  | {{$data->country->name}} | {{$data->phone}}</span><br>
          <?php 
            $address = \DB::table('contact_addresses')->where('contact_id', $sales_invoice->contact->id)->first();
            $contact = \DB::table('contacts')->where('id',$sales_invoice->contact->id)->first();
            $country = \DB::table('countries')->where('id',$address->country_id)->first();
            $governorate = \DB::table('governorates')->where('id',$address->governorate_id)->first();
          ?>
          @if($sales_invoice->invoice_status_id==1)
            <div id="draft-image">
                <img src="{{asset('img/draft.png')}}">
                <div class="contact_info col-xs-6 pull-right" style="position: absolute; top: 0; right: 0; height: 100%; padding: 10px; width: 100%;">
                    <span style="padding:0 15px;display: block;">{{@$sales_invoice->contact->full_name}}</span><br>
                    <span style="padding:0 15px;display: block;">{{$address->street}} {{$address->house_no}}</span><br>
                    <span style="padding:0 15px;display: block;">{{$address->postal_code }} {{$address->city}}</span><br>
                    <?php if(count($governorate) < 1  || count($country) < 1){

                    }else{?>
                    <span style="padding:0 15px;display: block;">{{$governorate->name_ar}} {{$country->name_ar}}</span><br>
                <?php } ?>
                </div>
            </div>

            @else
            <span style="padding:0 15px;display: block;">{{@$sales_invoice->contact->full_name}}</span><br>
            <span style="padding:0 15px;display: block;">{{$address->street}} {{$address->house_no}}</span><br>
            <span style="padding:0 15px;display: block;">{{$address->postal_code }} {{$address->city}}</span><br>
            <?php if(count($governorate) < 1  || count($country) < 1){

            }else{?>
            <span style="padding:0 15px;display: block;">{{$governorate->name_ar}} {{$country->name_ar}}</span><br>
        <?php } ?>
        @endif
      </div>

      <div class="panel-heading text-center" style="background-color: #f1f1f1; margin-top: 20px;padding:0 20px;text-align: center;">{{trans('frontend/sales_invoice.bill_head')}}</div>
      <p style="padding:5px 15px;border: 1px solid #f1f1f1; border-top:0; margin-bottom: -1px;margin-top: 0;">{{$sales_invoice->header_text}}</p>

      <div class="row pay_details" style="margin: 0; border: 1px solid #DDD;">
        <div class="row">
          <div class="col-xs-7 right" style="width: 50% ; float: right;border-left: 1px solid #999;padding: 5px 15px;">
             <div style="margin-bottom:10px;">
              <span style="padding:5px 15px;">حررت هذه الفاتورة ل :</span>
              <span style="padding:5px 5px;">{{@$sales_invoice->contact->full_name}}</span><br>
              </div>
              <?php 
                $phone = '';
                if(count($sales_invoice->contact->phones->first()) < 1){

                }else{
                  $phone = $sales_invoice->contact->phones->first()->phone_number;
                } 
              ?>
              <div style="margin-bottom:10px;">
              <span style="padding:5px 15px;">التليفون: <?php echo $phone; ?></span><br>
              </div>
              
              <span style="padding:5px 15px;float: right;">العنوان:</span>
             
              <span style="float: right; display: inline-block;width: 300px;">
              {{$address->street}} {{$address->house_no}}<br>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$address->postal_code }} {{$address->city}}<br>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$governorate->name_ar}} {{$country->name_ar}}<br>
             </span>
             <div class="clearfix" style="clear: both;"></div>
          </div>
          <div class="col-xs-5 left" style="width: 36%;float: right; padding: 5px 15px;">
             <div> 
              <span style="padding:0 15px;">رقم الفاتورة : </span><span style="padding:0 15px;"> {{$sales_invoice->invoice_number}}</span><br><br>
              </div>
              <div>
              <span style="padding:0 15px;float:right;">تاريخ الفاتورة : </span><span style="padding:0 15px;"> {{$sales_invoice->invoice_date}}</span><br><br>
              </div>
              <div>
              <span style="padding:0 15px;float:right;">رقم العميل : </span><span style="padding:0 15px;"> {{$sales_invoice->contact_id}}</span><br><br>
              </div>
          </div>
          <div class="clearfix" style="clear: both;"></div>
        </div>  
      </div>
        

    <div class="panel-heading text-center" style="background-color: #f1f1f1; margin-top: 0px;padding:0 20px;text-align: center;">{{trans('frontend/sales_invoice.bill_footer')}}</div>
      <p style="padding:5px 15px;border: 1px solid #f1f1f1; border-top:0; margin-bottom: -1px;margin-top: 0;">{{$sales_invoice->footer_text}}</p>
      <hr>

      <table class="table table-bordered table-striped" style="margin-right: 10%;margin-left: 10%;border: 1px solid #DDD;">
          <thead style="border: 1px solid #DDD;">
            <tr style="text-align: right;border-bottom: 1px solid #DDD;">
              <th style="width: 20%;text-align: right;padding: 2px">المنتج  </th>
              <th style="width: 20%;text-align: right;padding: 2px">السعر</th>
              <th style="width: 20%;text-align: right;padding: 2px">الكمية</th>
              <th style="width: 20%;text-align: right;padding: 2px">المبلغ شامل الضرائب</th>
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
               <span style="margin-bottom: 5px;">الاجمالى</span>
              <span class="tax">الضرائب</span>
               <span>اجمالى الفاتورة</span>
               </td>
              <td>
              <span>{{$sales_invoice->invoiceItems->sum('amount')}}</span>
              <span class="tax">145</span>
              <span>{{$sales_invoice->invoiceItems->sum('amount')}}</span>
              </td>
            </tr>


          </tbody>
      </table>

  @if(count($sales_invoice->installments))
    <span class="pull-left label detail_sban label-def" ><span> دفعات الفاتوره </span></span>
    

        <!--start >فغات الفاتوره-->
    <hr> 
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

       <div class="print_footer">
        <hr>
                 <div class="col-xs-4 pull-left">
                    <span>{{$data->company}}</span>
                    <span>{{$data->address}}</span>
                    <span>{{$data->district}}</span>
                    <span>{{$data->postal_code}} </span>
                    <span>{{$data->country->name}}</span>
                  </div>
                  <div class="col-xs-4 pull-left">
                    <span>التليفون: {{$data->phone}}</span>
                    <span>الفاكس: {{$data->fax}}</span>
                    <span>{{$data->user->email}}</span>
                    <span>website.com</span>
                  </div>
                  <div class="col-xs-4 pull-left">
                    <span>IBAN:DE9610050000019</span>
                    <span>BIC: BELADEBEXXX</span>
                    <span>Bank: LBB - Berliner Sparkasse</span>
                  </div>
       </div>

    </section>
</div>
      <!-- Bootstrap 3.3.2 JS -->
  </body>
</html>