<form role="form" id="Contact_form" method="POST" action="{{ route('cost_other.store_customer') }}">
    {{ csrf_field() }}
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="full-width-modalLabel">إضافة عميل جديد</h4>
            </div>
            <div class="modal-body">

                <div class="row">

                    <div class="col-sm-3 col-xs-12">
                        <div class="form-group has-feedback ">
                            <label class="control-label">الاسم الاول :</label>
                            <input class="form-control" name="first_name" id="first_name" type="text"  placeholder="" value="{{old('first_name') ? old('first_name') : ''}}">
                            <span class="fa fa-user fa-fw form-control-feedback"></span>
                        </div>
                    </div>

                    <div class="col-sm-3 col-xs-12">
                        <div class="form-group has-feedback ">
                            <label class="control-label">الاسم الاخير :</label>
                            <input class="form-control" name="last_name" type="text"  placeholder="" value="{{old('last_name') ? old('last_name') : ''}}">
                            <span class="fa fa-user fa-fw form-control-feedback"></span>
                        </div>
                    </div>

                    <div class="col-sm-3 col-xs-12">
                        <div class="form-group has-feedback ">
                            <label class="control-label">الوظيفة :</label>
                            <input class="form-control" name="job" type="text"  placeholder="" value="{{old('job') ? old('job') : ''}}">
                            <span class="fa fa-briefcase fa-fw form-control-feedback"></span>
                        </div>
                    </div>

                    <div class="col-sm-3 col-xs-12">
                        <div class="form-group has-feedback ">
                            <label class="control-label">المنظمة :</label>
                            <input class="form-control" name="company" type="text"  placeholder="" value="{{old('company') ? old('company') : ''}}">
                            <span class="fa fa-building fa-fw form-control-feedback"></span>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-sm-3 col-xs-12" id="customer_label" style="">
                            <div class="form-group  ">
                                <label  class="control-label">رقم العميل :</label>
                                <input class="form-control" name="customer_code" type="number" placeholder="" value="{{isset($customer_number)?$customer_number : ''}}">
                            </div>
                        </div>

                        <div class="col-sm-3 col-xs-12" id="customer_r_label" style="">
                            <div class="form-group ">
                                <label  class="control-label">الرقم المرجعي للعميل :</label>
                                <input class="form-control" name="customer_reference_code" type="number" placeholder=""  value="">
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-lg-12 below_form">
                        <ul class="nav nav-tabs navtab-bg nav-justified">
                            <li class="active" >
                                <a href="#adresse_tab" data-toggle="tab" aria-expanded="false">
                                    <span class="visible-xs"><i class="fa fa-home"></i></span>
                                    <span class="hidden-xs">العنوان</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="#profile1" data-toggle="tab" aria-expanded="true">
                                    <span class="visible-xs"><i class="fa fa-user"></i></span>
                                    <span class="hidden-xs">تفاصيل الاتصال</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="#messages1" data-toggle="tab" aria-expanded="false">
                                    <span class="visible-xs"><i class="fa fa-envelope-o"></i></span>
                                    <span class="hidden-xs">معلومات البنك</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="#settings1" data-toggle="tab" aria-expanded="false">
                                    <span class="visible-xs"><i class="fa fa-cog"></i></span>
                                    <span class="hidden-xs">ملاحظات</span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content" style="padding: 20px 0">
                            <div class="tab-pane active" id="adresse_tab" >
                                <div id="adresse">
                                    <div class=" row adresse_block">
                                            <div class="form-group col-xs-11 ">
                                                <label>اسم الشارع ورقم البيت :</label>
                                                <input type="text" name="adresse[1][address_number]" placeholder="" class="form-control">
                                            </div>

                                            <div class="col-xs-1 trash">
                                                <a href="javascript:void(0);" class="remCF" ><i class="fa fa-trash fa-2x " style="color:#5FBEAA;margin-top: 27px;"></i></a>
                                            </div>

                                            <div class="form-group col-xs-3 ">
                                                <label>الرقم البريدى :</label>
                                                <input type="number" name="adresse[1][code_tax]" placeholder="" class="form-control" >
                                            </div>

                                            <div class="form-group col-xs-3">
                                                <label>اسم المركز :</label>
                                                <input type="text" name="adresse[1][region]" placeholder="" class="form-control" >
                                            </div>


                                            <div class="form-group col-xs-3">
                                                <label>اسم المحافظة :</label>
                                                <select name="adresse[1][governorate]" class="form-control">
                                                    @foreach($governorates as $key => $governorate)
                                                        <option value="{{$key}}">{{$governorate}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group col-xs-3">
                                                <label>اسم الدولة :</label>
                                                <select name="adresse[1][country]" class="form-control">
                                                    @foreach($countries as $key => $country)
                                                        <option value="{{$key}}">{{$country}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                </div>
                                <button type="button" class="btn btn-default btn-custom btn-rounded waves-effect waves-light" id="add_adress">+إضافه عنوان</button>

                            </div>

                            <div class="tab-pane " id="profile1">
                                <div class="row">
                                    <div class="contact_details_header col-xs-12">
                                        <label>التليفون :</label>
                                    </div>
                                    <div class="tel_block">
                                        <div class="Tel_add ">
                                                <div class="form-group col-xs-5 ">
                                                    <input type="number" name="phones[1][phone_number]" placeholder="" class="form-control ">
                                                </div>
                                                <div class="col-xs-1 trash">
                                                    <a href="javascript:void(0);" class="remCF"><i class="fa fa-trash fa-2x" style="color:#5FBEAA;"></i></a>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-default btn-custom btn-rounded waves-effect waves-light" id="add_tel">+إضافه تليفون </button>
                            </div>
                            <div class="tab-pane" id="messages1">
                                <div class="bank_information row">
                                    <div class="form-group col-xs-3 ">
                                        <label>IBAN :</label>
                                        <input type="number" name="IBAN"  placeholder="" class="form-control" value="">
                                    </div>

                                    <div class="form-group col-xs-3">
                                        <label>BIC :</label>
                                        <input type="text" name="BIC" placeholder="" class="form-control" value="">
                                    </div>


                                    <div class="form-group col-xs-3">
                                        <label>رقم الضرائب :</label>
                                        <input type="number" name="tax_number" placeholder="" class="form-control" value="">
                                    </div>

                                    <div class="form-group col-xs-3">
                                        <label>Debitoren :</label>
                                        <input type="text" name="Debitoren" placeholder="" class="form-control" value="">
                                    </div>

                                    <div class="form-group col-xs-3">
                                        <label>اسم البنك :</label>
                                        <input type="text" name="bank_name" placeholder="" class="form-control" value="">
                                    </div>

                                    <div class="form-group col-xs-3">
                                        <label>رقم الحساب :</label>
                                        <input type="text" name="bank_number" placeholder="" class="form-control" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="settings1" >
                                <!-- Start SummerNote -->
                                <div class="row" id="header-row">
                                    <div class="col-md-12 col-xs-12" style="margin-bottom: 15px">
                                        <textarea id="header_text" name="header_text"></textarea>
                                    </div>
                                </div>
                                <!-- End SummerNote -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button  name="submit" data-style="expand-left"  type="submit" class="btn btn-success waves-effect waves-light m-r-5 ladda-button ">
                    <span class="ladda-label"><i class="fa fa-floppy-o"></i> حفظ العميل </span>
                    <span class="ladda-spinner"></span>
                </button>
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">الغاء</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</form>
