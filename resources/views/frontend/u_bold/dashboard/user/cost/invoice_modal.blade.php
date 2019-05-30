
<style>
    #invoice_modal .modal-dialog{width:1000px}
.pay_details{
        font-size:10px;
    border: 1px solid rgba(51, 51, 51, 0.6);
    box-shadow: 0 0 7px 1px rgba(0, 0, 0, 0.42);
    margin: 30px 0;
    position:relative;
        width:100%
    }
    .pay_details .right {padding: 0px 20px 5px;}
    .pay_details .right h5{text-decoration: underline}
    .pay_details .right p{line-height:10px;
    margin: 0;
    font-size: 14px;}
    .pay_details .left{
        background:rgba(204, 204, 204, 0.33);
        height:100%;
        border: 1px solid #000;
            display: block;
           float: left !important;
 }
    .pay_details .left strong,.pay_details .left1 p {display:inline-block;
        line-height: 35px;
        
    }

   
    
    .letter_footer .left{font-size :10px;
    font-size: 10px;
    text-align: left;
        display:block;
        float:left
}
    
    .letter_footer .left ul {list-style: none; position:relative;}
    .letter_footer .left ul li:after{
           content: " ";
    right: 44%;
    position: absolute;
    width: 50%;
    border: 1px solid rgba(51, 51, 51, 0.44);
        
    }
    .header_left{position: absolute;
    left: 65px;
    top: 55px;}
    
    .print_footer{margin-top:100px}
    .header_left p,.print_footer p {line-height: 0.9;}
    .letter_footer .left p{    margin-left: 15px;
    display:inline-block}
    

   
    
    .header_right p{ font-size:16px;line-height: .5;}
    .header_right h1{margin-bottom: 30px;}
    .header_right .myCompany{font-size: 10px;margin-bottom: 25px}
    .firstLogo{color: #5fbeaa;}
    .buttons{margin-top: 90px;}
    
    .side_paper{position:absolute;top: 40px;
    left: -10px;
    opacity:0;
    
         transition:all 0.5s ease-in-out;
        -webkit-transition:all 0.5s ease-in-out;
        -moz-transition:all 0.5s ease-in-out;
        -o-transition:all 0.5s ease-in-out;
    }
    .side_paper p {
            display: block;
    margin: 10px auto;
    text-align: center;
        color:#f05050;
    }
    
    .side_paper ul{list-style: none}
    .side_paper ul li i {color:#5fbeaa}
    .side_paper ul li:last-child{ font-weight: bold;}
    .f_table{margin-top:30px}
    .f_table tbody i{color:#f05050}
    .tax{margin-bottom: 25px}
    
    .print_footer{position: relative;
        }
 @media print {

.header_right{display:block;padding-top:30px;padding-bottom:20px}
         

.header_left{display:block; position:absolute;top:0;left:0}
         
.pay_details{margin-top:50px}
     
     .left1 p {display:inline-block;
        line-height: 25px;
        
    }
}
    
    
</style>
<div class="modal-dialog modal-full">
    <div class="modal-content printInvoice">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="full-width-modalLabel">{{trans('frontend/sales_invoice.print_meading')}}</h4>
        </div>
        <div class="modal-body">

                <div class="panel panel-default">
                   <div class="panel-heading">
                        <h4>{{trans('frontend/sales_invoice.invoice')}}</h4>
                    </div> 
                    
                    <div class="panel-body printAreaInvoice">
                        <div class="clearfix">
                           
                            <div class="pull-left">
                                <div class="header_right">
                                    <?php
//        $address = ContactAddress::where('contact_id', $id)->first();
//        $contact = Contact::where('id', $id)->first();        
//        return  $contact->company ."\n"
//                .$address->house_no ."\n"
//                .$address->postal_code." - ".$address->city."\n"
//                .$address->governorate->name." - ".$address->country->name;    
                                    
                                    ?>
                                    <h1>  <span class="firstLogo">user-company </span></h1>
                                    <p class="myCompany">   user-postalcode | user-governorate-name | user-country-name</p>
                                <p>  user-company</p>
                            <p>       sales_invoice-contact-full_name</p>
                            <p>user-address</p>

   
                                </div>
                            </div>
                            
                            
                        </div>
                        <hr>
                      <div class="row pay_details">
                           <div class="col-xs-7 right ">
                            <h5>{{trans('frontend/sales_invoice.send_invoice_to')}} :</h5>
                            <p>user-company</p>
                            <p>{{trans('frontend/sales_invoice.tel')}}: user-phone</p>
                            <p>{{trans('frontend/sales_invoice.adrress')}}: user-address</p>
                          </div>
                          

                          <div class="col-xs-5 left1">
                              <strong>{{trans('frontend/sales_invoice.invoice_number')}} : </strong><p id="invoiceNumber"> 1234</p><br>
                            <strong>{{trans('frontend/sales_invoice.invoice_date')}} : </strong><p id="invoiceDate"> 11/1/2017</p><br>
                            <strong>{{trans('frontend/sales_invoice.contact_id')}} :</strong><p id="contact_id">1</p><br>
                          </div>
                      </div>
                        <div class="m-h-20"></div>
                        <div class="row">
                        

                            <div class="col-md-12">
                                <div class="table-responsive printTable">
                                    <table class="table m-t-30">
                                        <thead>
                                            <tr class="hamo" style="background:#eee"><th>#</th>
                                                <th>{{trans('frontend/sales_invoice.product')}}</th>
                                                <th>{{trans('frontend/sales_invoice.quantity')}}</th>
                                                <th>{{trans('frontend/sales_invoice.unit_cost')}}</th>
                                                <th>{{trans('frontend/sales_invoice.discount')}}</th>
                                                <th>{{trans('frontend/sales_invoice.total')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                  </div>
                        <div class="m-h-20"></div>
                        <div class="row" style="border-radius: 0px;">
                        <div class="col-md-5 pull-left">
                                <div id="totalsRow">
                                </div>
                            </div>
                        
                        
                      <div class="print_footer visible-print" style="position: fixed;bottom: 0;width:100%">
                           <div class="col-xs-4">


                <p>user-company</p>
               <p>user->address</p>
              <p>user-district</p>
                <p>user-postal_code user-governorate-name</p>
              <p>user-country-name</p>




            </div>
            <div class="col-xs-4">

              <p>{{trans('frontend/sales_invoice.tel')}}: user-phone</p>
              <p>{{trans('frontend/sales_invoice.fax')}}: user-fax</p>
              <p>user-user-email</p>
              <p>website.com</p>
             

            </div>
            <div class="col-xs-4">
              <p>IBAN:DE9610050000019</p>
              <p>BIC: BELADEBEXXX</p>
              <p>Bank: LBB - Berliner Sparkasse</p>
            </div>

       </div> 
                    </div>
                </div>
                   
                    
  
                    
                   
        </div>
        
       
             
        <div class="modal-footer">
             
              
           
           
            <div class="hidden-print">
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">{{trans('button.close')}}</button>
                {{--<button type="button" id="btnSavePrint"     class="btn btn-inverse waves-effect waves-light" onclick="window.print()"></button>--}}
                <button type="button" data-style="expand-right" id="btnSavePrint"  class="btn btn-inverse waves-effect waves-light ladda-button" led="btnSavePrint">
                    <span class="ladda-label"> {{trans('button.close')}} <i class="fa fa-print"></i></span>
                    <span class="ladda-spinner"></span>
                </button>
                <button type="button" data-style="expand-right" id="btndownloadPrint"  class="btn btn-inverse waves-effect waves-light ladda-button" led="btndownloadPrint">
                    <span class="ladda-label"> {{trans('button.download')}} <i class="fa fa-download"></i></span>
                    <span class="ladda-spinner"></span>
                </button>
                <button type="button" data-style="expand-right" id="btnSendmailPrint"  class="btn btn-inverse waves-effect waves-light ladda-button" led="btnSendmailPrint">
                    <span class="ladda-label">  {{trans('button.send_by_email')}} <i class="fa fa-send"></i></span>
                    <span class="ladda-spinner"></span>
                </button>
                {{--<button type="button" id="btndownloadPrint" class="btn btn-inverse waves-effect waves-light"> {{trans('button.download')}} <i class="fa fa-download"></i></button>--}}
                {{--<button type="button" id="btnSendmailPrint" class="btn btn-inverse waves-effect waves-light"> {{trans('button.send_by_email')}} <i class="fa fa-send"></i></button>--}}
            </div>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
