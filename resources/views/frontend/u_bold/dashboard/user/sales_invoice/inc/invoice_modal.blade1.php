
<style>
    .modal-dialog{width:1000px }
</style>
<div class="modal-dialog modal-full">
    <div class="modal-content printInvoice">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="full-width-modalLabel">Modal Heading</h4>
        </div>
        <div class="modal-body">

                <div class="panel panel-default">
                    <!-- <div class="panel-heading">
                        <h4>Invoice</h4>
                    </div> -->
                    <div class="panel-body printAreaInvoice">
                        <div class="clearfix">
                            <div class="pull-right">
                                <h4 class="text-right"></h4>

                            </div>
                            <div class="pull-left">
                                <h4>Invoice # <br>
                                    <strong>2015-04-23654789</strong>
                                </h4>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">

                                <div class="pull-right m-t-30">
                                    <address id="customerAddress">
                                       
                                        <strong>Twitter, Inc.</strong><br>
                                        795 Folsom Ave, Suite 600<br>
                                        San Francisco, CA 94107<br>
                                        <abbr title="Phone">P:</abbr> (123) 456-7890
                                    </address>
                                </div>
                                <div class="pull-left m-t-30">
                                   <p>{{$data->company}}</p>
                                    <p><strong>تاريخ الفاتوره: </strong> <span id="invoiceDate">Jun 15, 2015</span></p>
                                    <p class="m-t-10"><strong>حالة الفاتوره: </strong> <span class="label label-pink">Pending</span></p>
                                    <p class="m-t-10"><strong>رقم الفاتوره: </strong> <span id="invoiceNumber">#123456</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="m-h-20"></div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive printTable">
                                    <table class="table m-t-30">
                                        <thead>
                                            <tr class="hamo" style="background:#eee"><th>#</th>
                                                <th>المنتج</th>
                                                <th>الكميه</th>
                                                <th>تكلفة الوحده</th>
                                                <th>الخصم</th>
                                                <th>الاجمالي</th>
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


<!--
                                {{--<p class="text-left"><b>Sub-total:</b> 2930.00</p>--}}
                                {{--<p class="text-left">Discout: 12.9%</p>--}}
                                {{--<p class="text-left">VAT: 12.9%</p>--}}
                                {{--<hr>--}}
                                {{--<h3 class="text-left">USD 2930.00</h3>--}}
-->
                            </div>
                        </div>
                        
                        
                    <div class="print_footer visible-print" style="position: fixed;bottom: 0;">
                       <div class="col-xs-4">

                         
                          
                           <p>{{$data->address}}</p>
                          <p>{{$data->district}}</p>
                            <p>{{--$data->governorate->name--}}</p>
                          <p>{{--$data->country->name--}}</p>
                          
           


                        </div>
                        <div class="col-xs-4">

                          <p>التليفون: {{$data->phone}}</p>
                          <p>الفاكس: {{$data->fax}}</p>
                          <p>الايميل : {{$data->user->email}}</p>
                         <p>{{$data->postal_code}}</p>

                        </div>
                        <div class="col-xs-4">
                          <p>IBAN:DE96100500000190431830 </p>
                          <p>BIC: BELADEBEXXX</p>
                          <p>Bank: LBB - Berliner Sparkasse</p>
                        </div>
  
                   </div>
                        
                        
                        
                        
                    </div>
                </div>
                   
                   
  
                    
                   
        </div>
        
       
             
        <div class="modal-footer">
             
              
           
           
            <div class="hidden-print">
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                {{--<button type="button" id="btnSavePrint"     class="btn btn-inverse waves-effect waves-light" onclick="window.print()"></button>--}}
                <button type="button" data-style="expand-right" id="btnSavePrint"  class="btn btn-inverse waves-effect waves-light ladda-button" led="btnSavePrint">
                    <span class="ladda-label"> طباعه <i class="fa fa-print"></i></span>
                    <span class="ladda-spinner"></span>
                </button>
                <button type="button" data-style="expand-right" id="btndownloadPrint"  class="btn btn-inverse waves-effect waves-light ladda-button" led="btndownloadPrint">
                    <span class="ladda-label"> تحميل <i class="fa fa-download"></i></span>
                    <span class="ladda-spinner"></span>
                </button>
                <button type="button" data-style="expand-right" id="btnSendmailPrint"  class="btn btn-inverse waves-effect waves-light ladda-button" led="btnSendmailPrint">
                    <span class="ladda-label"> إرسال بالبريد الالكتروني <i class="fa fa-send"></i></span>
                    <span class="ladda-spinner"></span>
                </button>
                {{--<button type="button" id="btndownloadPrint" class="btn btn-inverse waves-effect waves-light"> تحميل <i class="fa fa-download"></i></button>--}}
                {{--<button type="button" id="btnSendmailPrint" class="btn btn-inverse waves-effect waves-light"> إرسال بالبريد الالكتروني <i class="fa fa-send"></i></button>--}}
            </div>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
