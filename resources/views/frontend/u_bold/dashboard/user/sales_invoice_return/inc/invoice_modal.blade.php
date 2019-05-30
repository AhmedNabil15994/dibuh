
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
                                <h4 class="text-right"><img src="images/logo_dark.png" alt="velonic"></h4>

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
                                    <p><strong>تاريخ الفاتوره: </strong> <span id="invoiceDate">Jun 15, 2015</span></p>
                                    <p class="m-t-10"><strong>حالة الفاتوره: </strong> <span class="label label-pink">Pending</span></p>
                                    <p class="m-t-10"><strong>رقم الفاتوره: </strong> <span id="invoiceNumber">#123456</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="m-h-50"></div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive printTable">
                                    <table class="table m-t-30">
                                        <thead>
                                            <tr><th>#</th>
                                                <th>المنتج</th>
                                                <th>الكميه</th>
                                                <th>تكلفة الوحده</th>
                                                <th>الخصم</th>
                                                <th>الاجمالي</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>LCD</td>
                                                <td>Lorem ipsum dolor sit amet.</td>
                                                <td>1</td>
                                                <td>$380</td>
                                                <td>$380</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Mobile</td>
                                                <td>Lorem ipsum dolor sit amet.</td>
                                                <td>5</td>
                                                <td>$50</td>
                                                <td>$250</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>LED</td>
                                                <td>Lorem ipsum dolor sit amet.</td>
                                                <td>2</td>
                                                <td>$500</td>
                                                <td>$1000</td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>LCD</td>
                                                <td>Lorem ipsum dolor sit amet.</td>
                                                <td>3</td>
                                                <td>$300</td>
                                                <td>$900</td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>Mobile</td>
                                                <td>Lorem ipsum dolor sit amet.</td>
                                                <td>5</td>
                                                <td>$80</td>
                                                <td>$400</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="m-h-50"></div>
                        <div class="row" style="border-radius: 0px;">
                            <div class="col-md-5 pull-left">
                                <div id="totalsRow">

                                    <div class="row with-border-dotted">
                                        <h5 class="totals">
                                            <div class="col-xs-6 text-left">صافي السعر</div>
                                            <div class="col-xs-6 text-right"><span id="netPrice"></span> جنيه مصري </div>
                                        </h5>
                                    </div>
                                    <hr>
                                    <div class="row with-border-dotted">
                                        <h5 class="totals">
                                            <div class="col-xs-6 text-left">اجمالي الخصم</div>
                                            <div class="col-xs-6 text-right"><span id="discount"></span> جنيه مصري </div>
                                        </h5>
                                    </div>
                                    <hr>

                                    <div class="row with-border-dotted">
                                        <h5 class="totals">
                                            <div class="col-xs-6 text-left">بعد  الخصم</div>
                                            <div class="col-xs-6 text-right"><span id="totalAmount">0</span> جنيه مصري </div>
                                        </h5>
                                    </div>
                                    <hr>
                                    <div id="tax_total_row_1" style="padding:5px;">
                                        <div class="row with-border-dotted">
                                            <h5 class="totals">
                                                <div class="col-xs-6 text-left">القيمة المضافة</div>
                                                <div class="col-xs-6 text-right">
                                                    <span id="tax_type_1" date-totaltaxtypeid="1" data-taxtypeval="0">0</span> جنيه مصري
                                                    <input type="hidden" name="tax_totals[id_1]" id="tax_totals_id_1" value="0">
                                                </div>
                                            </h5>
                                        </div>
                                        <hr>
                                    </div>
                                    <div id="tax_total_row_2" style="padding:5px;">
                                        <div class="row with-border-dotted">
                                            <h5 class="totals">
                                                <div class="col-xs-6 text-left">ضربيه الخصم والاضافة</div>
                                                <div class="col-xs-6 text-right">
                                                    <span id="tax_type_2" date-totaltaxtypeid="2" data-taxtypeval="0">0</span> جنيه مصري
                                                    <input type="hidden" name="tax_totals[id_2]" id="tax_totals_id_2" value="0">
                                                </div>
                                            </h5>
                                        </div>
                                        <hr>
                                    </div>
                                    <div id="tax_total_row_3" style="padding:5px;">
                                        <div class="row with-border-dotted">
                                            <h5 class="totals">
                                                <div class="col-xs-6 text-left">ضربيه الملاهي</div>
                                                <div class="col-xs-6 text-right">
                                                    <span id="tax_type_3" date-totaltaxtypeid="3" data-taxtypeval="0">0</span> جنيه مصري
                                                    <input type="hidden" name="tax_totals[id_3]" id="tax_totals_id_3" value="0">
                                                </div>
                                            </h5>
                                        </div>
                                        <hr>
                                    </div>
                                    <div id="tax_total_row_4" style="padding:5px;">
                                        <div class="row with-border-dotted">
                                            <h5 class="totals">
                                                <div class="col-xs-6 text-left">ضربيه الجدول</div>
                                                <div class="col-xs-6 text-right">
                                                    <span id="tax_type_4" date-totaltaxtypeid="4" data-taxtypeval="0">0</span> جنيه مصري
                                                    <input type="hidden" name="tax_totals[id_4]" id="tax_totals_id_4" value="0">
                                                </div>
                                            </h5>
                                        </div>
                                        <hr>
                                    </div>

                                    <div class="row">
                                        <h5 class="totals bold">
                                            <div class="col-xs-6 text-left">الاجمالي</div>
                                            <div class="col-xs-6 text-right"><span id="totalInvoice">0</span> جنيه مصري </div>
                                        </h5>
                                    </div>
                                </div>
                                {{--<p class="text-left"><b>Sub-total:</b> 2930.00</p>--}}
                                {{--<p class="text-left">Discout: 12.9%</p>--}}
                                {{--<p class="text-left">VAT: 12.9%</p>--}}
                                {{--<hr>--}}
                                {{--<h3 class="text-left">USD 2930.00</h3>--}}
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
