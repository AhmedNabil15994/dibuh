
<style>
.pay_details{
       
    border: 1px solid rgba(51, 51, 51, 0.6);
    box-shadow: 0 0 7px 1px rgba(0, 0, 0, 0.42);
    border: 1px solid rgba(51, 51, 51, 0.6);
    margin: 0;
   margin-top:30px;
    position:relative;
        width:100%;
            font-size: 13px;

    }
    .pay_details .right {    padding: 15px 20px 5px;}
    .pay_details .right p{line-height:19px;
        word-break: break-all;
    margin: 0;
    margin-top: 5px;
    font-size: 12px;
    white-space:normal;
    display:inline-block;}
    .pay_details .right h6{
        display: inline-block;
    margin-bottom: 5px;
    font-weight: bold;
    }
    .pay_details .left1{

    border-right: 1px solid #DDD;
    display: block;
    padding: 15px 20px 5px;
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




    .header_right p{line-height: .5;margin-bottom: 25px;}
    .header_right h1{margin-bottom: 28px;}
    .header_right .myCompany{font-size: 10px;margin-bottom: 25px}
    .firstLogo{color: #5fbeaa;font-weight:bold;    font-size: 32px;}
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

.pay_details{margin-top:0}

     .left1 p {display:inline-block;
        line-height: 25px;

    }
}
.modal .modal-dialog .modal-content .modal-body {
    padding: 0 25px 25px 25px !important;
}
#header_text {
    font-weight: bold !important;
    text-align: center !important;
    margin-bottom: 5px !important;
      padding: 10px 5px !important;
   
}

#footer_text{
    text-align: center !important;
     font-weight: bold !important;
    width: 91%;
    margin-top: 15px;
    
    padding: 4px 0px;
}


textarea#contact_address,
textarea.contact_address{
    max-height: 100px;
    min-height: 100px;
    border: 0px;
    background-color: rgb(255, 255, 255);
    resize: none;
}
.panel .panel-body{
    padding-bottom: 0;
}
#header_text,#footer_text{
    background-color: #F7F8FA;
    padding: 7px !important;
    margin-bottom: 0 !important;
}
.pay_details{
    margin-top: 0;
}
#footer_text{
    margin-top: 0;
    width: 100%;
}
.pay_details .left1,
.pay_details .right{
    height: 150px;
    background-color: #FFF;
}
textarea.contact_address{
    margin-right: 50px;
    margin-top: -20px;
    background-color: transparent;
}
</style>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<div class="modal-dialog" id="ParentModel">
    <div class="modal-content printInvoice">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="full-width-modalLabel">{{trans('frontend/sales_invoice.print_meading')}} </h4>
        </div>

        <div class="modal-body">
            <div class="panel panel-default">
                <div class="panel-body printAreaInvoice">
                    <div class="pull-left">
                        <div class="header_right">
                            <h1>  <span class="firstLogo"> {{@$user->company}}  </span></h1>
                            <p>   {{@$user->postal_code}} | {{@$user->country->name}} | {{@$user->phone}}</p>
                            <p id="contact_name" style="margin-bottom:5px;"></p>
                            <textarea disabled id="contact_address"></textarea disabled>       
                            
                        </div>
                    </div>
                </div>    

                

                <div class="row pay_details">
                    <p id="header_text" style="margin-bottom:5px;"></p>    
                    <div class="col-xs-7 right ">
                        <div>
                            <h6>{{trans('frontend/sales_invoice.send_invoice_to')}} :</h6>
                            <p class="contact_name"></p>
                        </div>
                           
                        <div>
                            <p class="contact_phones">{{trans('frontend/sales_invoice.tel')}}: </p>
                        </div>
        
                        <div class="row" style="margin: 0;margin-top: 2px;">
                            <span>{{trans('frontend/sales_invoice.adrress')}}: <span>
                            <textarea class="contact_address"></textarea>    
                        </div>
                    </div>


                    <div class="col-xs-5 left1">
                        <strong>{{trans('frontend/sales_invoice.invoice_number')}} : </strong><p id="invoiceNumber"> 1234</p><br>
                        <strong>{{trans('frontend/sales_invoice.invoice_date')}} : </strong><p id="invoiceDate"> 11/1/2017</p><br>
                        <strong>{{trans('frontend/sales_invoice.contact_id')}} : </strong><p id="contact_id">1</p><br>
                    </div>
                     <p id="footer_text"></p>
                </div>
               
                <div class="row"> 
                    <div class="col-md-12">
                        <div class="table-responsive printTable">
                            <table class="table m-t-30">
                                <thead>
                                    <tr class="hamo" style="background:#eee">
                                        <th>#</th>
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
                <div class="row" style="border-radius: 0px;">
                    <div class="col-md-5 pull-left">
                        <div id="totalsRow">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <div class="hidden-print">
                <button type="button" data-style="expand-right" id="btnSavePrint"  class="btn btn-danger waves-effect waves-light ladda-button" led="btnSavePrint">
                    <span class="ladda-label">{{trans('button.close')}} <i class="fa fa-print"></i></span>
                    <span class="ladda-spinner"></span>
                </button>
                
                <button type="button" data-style="expand-right" id="btndownloadPrint"  class="btn btn-inverse waves-effect waves-light ladda-button" led="btndownloadPrint" value="">
                    <span class="ladda-label"> {{trans('button.download')}} <i class="fa fa-download"></i></span>
                    <span class="ladda-spinner"></span>
                </button>
                <button id="done" data-toggle="modal" type="button" data-style="expand-right" id="btnSendmailPrint"  class="btn btn-inverse waves-effect waves-light ladda-button" led="btnSendmailPrint">
                    <span class="ladda-label" >  {{trans('button.send_by_email')}}<i class="fa fa-send"></i></span>
                    <span class="ladda-spinner"></span>
                </button>
            </div>
        </div>
    </div><!-- /.modal-content -->
</div>


