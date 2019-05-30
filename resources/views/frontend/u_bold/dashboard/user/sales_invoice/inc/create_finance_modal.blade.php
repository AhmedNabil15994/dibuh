
<form role="form" id="idform" method="POST" action="{{ route('finance.store') }}">
    {{ csrf_field() }}
    <input type="hidden" id="field_id">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="full-width-modalLabel">إضافة خزينه /بنك </h4>
            </div>
            <div class="modal-body">

              <div class="row">
                  <div class="col-xs-4 col-sm-1">
                      <div class="radio radio-custom">
                          <input type="radio"  name="type" id="radio1" value="bank"  checked>
                          <label for="radio1">بنك</label>
                      </div>
                  </div>
                  <div class="col-xs-4 col-sm-1 ">
                      <div class="radio radio-custom ">
                          <input type="radio" name="type" id="radio2" value="treasury">
                          <label for="radio2">خزينة</label>
                      </div>
                  </div>
                  <div class="col-xs-4 col-sm-3">
                      <div class="radio radio-custom">
                          <input type="radio" name="type" id="radio3" value="credit_card">
                          <label for="radio3">كارت أئتمان</label>
                      </div>
                  </div>

              </div>
              <div class="row">
                  <div class="col-sm-3 col-xs-12">
                      <input type="hidden" name="bank_serial_number" id="bank_serial_number" value="{{$bank_serial_number}}">
                      <input type="hidden" name="treasury_serial_number" id="treasury_serial_number" value="{{$treasury_serial_number}}">
                      <input type="hidden" name="credit_serial_number" id="credit_serial_number" value="{{$credit_serial_number}}">
                      <div class="form-group has-feedback ">
                          <label  class="control-label">رقم تسلسلى :</label>
                          <input class="form-control" type="text" placeholder=""  value="{{$bank_serial_number}}" name="serial_number" id="serial_number" readonly>
                          <span class="fa fa-hashtag fa-fw form-control-feedback"></span>
                      </div>
                  </div>
              </div>
              <!-- Start bank details -->
              <div id="back_details">
                  <div class="row">
                      <div class="col-sm-6 col-xs-12">
                          <div class="form-group has-feedback ">
                              <label class="control-label">صاحب الحساب :</label>
                              <input class="form-control" type="text"  placeholder="" value="" name="account_owner" id="account_owner">
                              <span class="fa fa-user fa-fw form-control-feedback"></span>
                          </div>
                      </div>
                      <div class="col-sm-3 col-xs-12">
                          <div class="form-group has-feedback ">
                              <label class="control-label">رصيد البنك :</label>
                              <input class="form-control" type="text"  placeholder="" value="" name="bank_balance">
                              <span class="fa fa-money fa-fw form-control-feedback"></span>
                          </div>
                      </div>
                      <div class="col-sm-3 col-xs-12">
                          <div class="form-group has-feedback ">
                              <label class="control-label" for="start_date" >تاريخ الرصيد :</label>
                              <input class="form-control" type="text"  placeholder="" value="" name="start_date" id="start_date">
                              <span class="fa fa-calendar fa-fw form-control-feedback"></span>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-sm-3 col-xs-12">
                          <div class="form-group has-feedback ">
                              <label class="control-label">IBAN :</label>
                              <input class="form-control" type="text"  placeholder="" value="" name="IBAN">
                              <span class="fa fa-building fa-fw form-control-feedback"></span>
                          </div>
                      </div>
                      <div class="col-sm-3 col-xs-12">
                          <div class="form-group has-feedback">
                              <label  class="control-label">Swift International<small class="text-muted">(11 char).</small></label>
                              <input class="form-control" type="number" placeholder="" value="" name="swift_international">
                              <span class="fa fa-hashtag fa-fw form-control-feedback"></span>
                          </div>
                      </div>
                      <div class="col-sm-3 col-xs-12">
                          <div class="form-group has-feedback">
                              <label  class="control-label">رقم الحساب :</label>
                              <input class="form-control" type="number" placeholder=""  value="" name="account_number">
                              <span class="fa fa-hashtag fa-fw form-control-feedback"></span>
                          </div>
                      </div>

                      <div class="col-sm-3 col-xs-12">
                          <div class="form-group has-feedback ">
                              <label  class="control-label">Swift national<small class="text-muted">(9 char)</small></label>
                              <input class="form-control" type="number" placeholder="" value="" name="swift_national">
                              <span class="fa fa-hashtag fa-fw form-control-feedback"></span>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-sm-6 col-xs-12">
                          <div class="form-group has-feedback ">
                              <label  class="control-label">أسم البنك :</label>
                              <input class="form-control" type="text" placeholder=""  value="" name="bank_name">
                              <span class="fa fa-university fa-fw form-control-feedback"></span>
                          </div>
                      </div>
                      <div class="col-sm-3 col-xs-12">
                          <div class="form-group has-feedback ">
                              <label  class="control-label">اسم الفرع :</label>
                              <input class="form-control" type="text" placeholder=""  value="" name="branch_name">
                              <span class="fa fa-building fa-fw form-control-feedback"></span>
                          </div>
                      </div>
                      <div class="col-sm-3 col-xs-12">
                          <div class="form-group has-feedback ">
                              <label  class="control-label">كود الفرع :</label>
                              <input class="form-control" type="number" placeholder=""  value="" name="branch_code">
                              <span class="fa fa-hashtag fa-fw form-control-feedback"></span>
                          </div>
                      </div>
                      <div class="col-sm-6 col-xs-12">
                          <div class="form-group has-feedback ">
                              <label  class="control-label">عنوان الفرع :</label>
                              <input class="form-control" type="text" placeholder=""  value="" name="branch_address">
                              <span class="fa fa-map-marker fa-fw form-control-feedback"></span>
                          </div>
                      </div>
                      <div class="col-sm-3 col-xs-12">
                          <div class="form-group has-feedback ">
                              <label  class="control-label">أسم المدينة :</label>
                              <input class="form-control" type="text" placeholder=""  value="" name="city">
                              <span class="fa fa-map-marker fa-fw form-control-feedback"></span>
                          </div>
                      </div>
                      <div class="col-sm-3 col-xs-12 " >
                          <div class="form-group ">
                              <label  class="control-label">أسم المحافظة :</label>
                              <select class="form-control" name="governorate">
                                  @foreach($governorates as $key => $governorate)
                                      <option value="{{$key}}">{{$governorate}}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>
                      <div class="col-sm-6 col-xs-12 " >
                          <div class="form-group ">
                              <label for="bank_currency" class="control-label">نوع العمله :</label>
                              <select class="form-control" name="bank_currency" id="bank_currency">
                                  @foreach($currency as $key => $curr)
                                      <option value="{{$key}}">{{$curr}}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>
                  </div>
              </div>
              <!-- End bank details -->
              <!-- ٍStart save details -->
              <div id="treasury_details">
                  <div class="row">
                      <div class="col-sm-6 col-xs-12">
                          <div class="form-group has-feedback ">
                              <label class="control-label">أسم الخزنة :</label>
                              <input class="form-control" type="text"  placeholder="" value="" name="treasury_name" id="treasury_name">
                              <span class="fa fa-unlock-alt fa-fw form-control-feedback"></span>
                          </div>
                      </div>
                      <div class="col-sm-3 col-xs-12">
                          <div class="form-group has-feedback ">
                              <label class="control-label" for="treasury_start_date">تاريخ افتتاح الخزنة :</label>
                              <input class="form-control" type="text"  placeholder="" value="" name="treasury_start_date" id="treasury_start_date">
                              <span class="fa fa-calendar fa-fw form-control-feedback"></span>
                          </div>
                      </div>
                      <div class="col-sm-3 col-xs-12">
                          <div class="form-group has-feedback ">
                              <label class="control-label">المبلغ عند الافتتاح :</label>
                              <input class="form-control" type="text"  placeholder="" value="" name="start_balance">
                              <span class="fa fa-money fa-fw form-control-feedback"></span>
                          </div>
                      </div>
                      <div class="col-sm-6 col-xs-12 " >
                          <div class="form-group ">
                              <label for="treasury_currency" class="control-label">نوع العمله :</label>
                              <select class="form-control" name="treasury_currency" id="treasury_currency">
                                  @foreach($currency as $key => $curr)
                                      <option value="{{$key}}">{{$curr}}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>
                  </div>
                    <br><br><br><br><br><br>
              </div>
              <!-- End save details -->
              <!-- Start card details -->
              <div id="card_details">
                  <div class="row">
                      <div class="col-sm-6 col-xs-12">
                          <div class="form-group has-feedback ">
                              <label class="control-label">صاحب الحساب :</label>
                              <input class="form-control" type="text"  placeholder="" value="" name="credit_owner" id="credit_owner" >
                              <span class="fa fa-user fa-fw form-control-feedback"></span>
                          </div>
                      </div>
                      <div class="col-sm-3 col-xs-12">
                          <div class="form-group has-feedback ">
                              <label class="control-label">رصيد البنك :</label>
                              <input class="form-control" type="text"  placeholder="" value="" name="credit_balance">
                              <span class="fa fa-money fa-fw form-control-feedback"></span>
                          </div>
                      </div>
                      <div class="col-sm-3 col-xs-12">
                          <div class="form-group has-feedback ">
                              <label class="control-label">تاريخ الرصيد :</label>
                              <input class="form-control" type="text"  placeholder="" value="" id="credit_start_date" name="credit_start_date">
                              <span class="fa fa-calendar fa-fw form-control-feedback"></span>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-sm-3 col-xs-12">
                          <div class="form-group has-feedback ">
                              <label  class="control-label">أسم البنك :</label>
                              <input class="form-control" type="text" placeholder=""  value="" name="credit_bank_name">
                              <span class="fa fa-university fa-fw form-control-feedback"></span>
                          </div>
                      </div>
                      <div class="col-sm-3 col-xs-12">
                          <div class="form-group has-feedback ">
                              <label class="control-label">رقم كارت بطاقه الائتمان :</label>
                              <input class="form-control" type="text"  placeholder="" value="" name="credit_number">
                              <span class="fa fa-hashtag fa-fw form-control-feedback"></span>
                          </div>
                      </div>
                      <div class="col-sm-3 col-xs-12">
                          <div class="form-group has-feedback ">
                              <label class="control-label">نوع الكارت :</label>
                              <select class="form-control" name="credit_type">
                                  <option value="1">فيرا</option>
                                  <option value="2">مستر</option>
                              </select>
                          </div>
                      </div>
                      <div class="col-sm-3 col-xs-12">
                          <div class="form-group has-feedback ">
                             <label for="credit_end_date" class="control-label">تاريخ الانتهاء :</label>
                             <input class="form-control" type="text" name="credit_end_date" id="credit_end_date" placeholder="mm/yyyy" value="" data-date="">
                             <span class="fa fa-calendar fa-fw form-control-feedback"></span>
                          </div>
                      </div>
                  </div>
                    <br><br><br><br><br><br>
              </div>

              <!-- End card details -->

            </div>
            <div class="modal-footer">
                    <button data-style="expand-right" type="button" class="btn btn-default waves-effect waves-light  ladda-button btnSave" id="btnSave" led="btnSave">
                    <span class="ladda-label"><i class="fa fa-floppy-o"></i> {{ trans('button.save')}} </span>
                    <span class="ladda-spinner"></span>
                </button>
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">{{ trans('button.close')}}</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</form>
