



<form role="form" id="Paid_form" method="POST" action="{{ route('sales_invoice.store_installement') }}">
    {{ csrf_field() }}
    {{Form::hidden('invoice_id',$sales_invoice->id)}}
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="full-width-modalLabel">إضافه دفعه جديده  </h4>
            </div>
            <div class="modal-body">



              <!-- Start bank details -->
              <div >
                  <div class="row">
                      <div class="col-sm-12 col-xs-12">
                          <div class="form-group has-feedback ">
                              <label class="control-label">المبلغ</label>
                              <input class="form-control" type="number" step="any"  placeholder="" value="{{ $sales_invoice->rest}}" name="paid" min="0" max="{{$sales_invoice->rest}}">
                            <span class="fa fa-money fa-fw form-control-feedback"></span>
                          </div>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-xs-12">
                            <div class="form-group has-feedback ">
                                <label class="control-label" for="paid_date" >تاريخ الدفع :</label>
                                  {{Form::date('paid_date',  \Carbon\Carbon::now(),['class'=>'form-control'])}}
                                <span class="fa fa-calendar fa-fw form-control-feedback"></span>
                            </div>
                        </div>
                    </div>


                        <div class="row">
                          <div class="col-sm-12 col-xs-12">

                              <div class="form-group has-feedback ">
                                  <label class="control-label">حساب الدفع :</label>


                                  <select name="finance_id" class="form-control select2" id="finance_id">

                                  </select>
                              
                                  <div data-toggle="modal"  data-target="#finance_modal" id="BtnFinance" class="btn btn-default waves-effect waves-light m-r-20" style="display:none;"><i class="fa fa-plus-square"  ></i> إضافة بنك أو خزينه أو بطاقة ائتمان </div>

                              </div>


                          </div>
                        </div>
                      </div>

                    <div class="row">
                      <div class="col-sm-12 col-xs-12">
                          <div class="form-group has-feedback ">
                              <label class="control-label">نص الدفع :</label>

                              {{Form::text('finance_notes','',['class'=>'form-control','maxlength'=>'50'])}}
                              <span class="fa fa-info fa-fw form-control-feedback"></span>
                          </div>
                      </div>
                    </div>




              <!-- End bank details -->

              <!-- End save details -->


            </div>
            <div class="modal-footer">
                    <button data-style="expand-right" type="button" class="btn btn-default waves-effect waves-light  ladda-button btnSave" id="btnPaidSave" led="btnSave">
                    <span class="ladda-label"><i class="fa fa-floppy-o"></i> {{ trans('button.save')}} </span>
                    <span class="ladda-spinner"></span>
                </button>
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">{{ trans('button.close')}}</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</form>
