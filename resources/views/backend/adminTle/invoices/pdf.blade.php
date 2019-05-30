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

    <!--start header info -->

    <div class="header_right col-sm-6 col-xs-12">

    <h2>  <span class="firstLogo">{{@$data->company}} </span></h2>
    <p class="myCompany">   {{@$data->postal_code}}  | {{$data->district}}  | {{@$data->phone}}</p>


    <div >

        <div class=" col-xs-6 pull-right" style="position: absolute; top: 0; right: 0;  padding: 10px; width: 100%;">
            <p>{{$data->getFullNameAttribute()}}</p>
            <p>{{$address->street}} {{$address->house_no}}</p>
            <p>{{$address->postal_code}} {{$address->city}}</p>
           <p> {{$address->country->name}}</p>
        </div>
    </div>
</div>


        <!--end header info-->








      <div class=" row pay_details">
          <div class="col-xs-7 right">


  <div>
    <strong>{{trans('backend/main.write')}}:</strong>
    <span>{{$data->getFullNameAttribute()}}</span><br>
  </div>

    <br>

    <div class="phone">
    <strong>{{trans('backend/main.phone')}} : </strong>
    <span>{{$data->phone}}</span><br>
    </div>

  <div>
    <strong>{{trans('backend/main.address')}}  :
      </strong>
    <span>
    {{$address->street}}  {{$address->house_no}}<br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$address->postal_code}} {{$address->city}}<br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$address->country->name}}<br>
     </span>
  </div>





          <div class="clearfix" style="clear: both;"></div>


          </div>
        <!-- end right -->


        <div class="col-xs-5  left">

        <div>
  <strong >{{trans('backend/main.inv_no')}}  : </strong><span> {{$invoice->serial_number}}</span><br>
  </div>

  <div>
  <strong>{{trans('backend/main.inv_date')}} : </strong><span> {{$invoice->invoice_date}}</span><br>
  </div>

  <div>
    <h5 style="width: 100%;display: inline-block;float: left;">{{trans('backend/main.duration')}} : </h5>
    <div style="width: 100% ;display: inline-block;float: left;">
        <h6 style="margin-top: 0;margin-bottom: 0;"> {{trans('backend/main.from')}} : {{$invoice->from_date}}</h6>
        <h6 style="margin-top: 3px;"> {{trans('backend/main.to')}} : {{$invoice->to_date}}</h6>
    </div>
  </div>













          <div class="clearfix" style="clear: both;"></div>
          </div>



    </div>
  <!-- end row -->





      <div style="margin-top:25px;"></div>


      <table class="table table-bordered table-striped" style="
        width: 100%;
        max-width: 100%;
        margin-bottom: 1rem;
        background-color: transparent;
        border: 1px solid #DDD;">

          <thead class="table-head">
            <tr style="text-align: right;border-bottom: 1px solid #DDD;">
              <th class="table-head" style="text-align: right;vertical-align: bottom;padding: .75rem;">{{trans('backend/main.plan')}} </th>
              <th class="table-head" style="text-align: right; vertical-align:bottom;padding: .75rem;">{{trans('backend/main.bf_tax')}}</th>
              <th class="table-head" style="text-align: right;  vertical-align: bottom;padding: .75rem;">{{trans('backend/main.af_tax')}}</th>

              <th class="table-head" style="vertical-align: bottom;padding: .75rem;">{{trans('backend/main.all')}}</th>
            </tr>
          </thead>

          <tbody>

            <tr>
              <td style="padding:1rem;vertical-align:top;border-top: 1px solid #dee2e6">{{$price_plan->name}}</td>
              <td style="padding:1rem;vertical-align:top;border-top: 1px solid #dee2e6">1000</td>
              <td style="padding:1rem;vertical-align:top;border-top: 1px solid #dee2e6">1000</td>
              <td style="text-align:center;padding:1rem;vertical-align:top;border-top: 1px solid #dee2e6"> 1000</td>
            </tr>



          </tbody>
      </table>

  <htmlpagefooter name="page-footer" class="footer">
                <hr style="margin-top:20px;">
                 <div class="col-xs-4 pull-left" style="float:right; width:33.3333%;text-align: right;">
                    <p style="margin-top:10px">{{$data->company}}</p>
                    <p>{{$data->address}}</p>
                    <p>{{$data->district}}</p>
                    <p>{{$data->country->name}} {{$data->postal_code}} </p>

                  </div>

                  <div class="col-xs-4 pull-left" style="float:right;width:33.3333%;text-align: right;">
                    <p style="margin-top:10px">{{trans('backend/main.phone')}} : {{$data->phone}}</p>
                    <p >{{trans('backend/main.fax')}}: {{$data->fax}}</p>
                    <p >{{$data->user->email}}</p>
                    <p>{{$data->url}}</p>
                  </div>
                  <div class="col-xs-4 pull-left" style="float:right;width:33.3333%;text-align: right;">




                    <p style="margin-top:10px"> {{trans('backend/main.iban')}}: IBAN </p>
                    <!-- <p></p> -->
                    <p>{{trans('backend/main.bic')}}: BIC</p>
                    <!-- <p></p> -->
                    <p>{{trans('backend/main.bank')}}  : Bank</p>
                    <!-- <p></p> -->
                  </div>
  </htmlpagefooter>
</div>
    </section>
</div>

  </body>

</html>
