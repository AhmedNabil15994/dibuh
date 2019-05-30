

        {!! Form::model($user->profile, ['method' => 'PATCH','route' => ['admin::users.profile.basic.update', $user->id]]) !!}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="box box-solid">

                    <div class="box-header with-border">
                        <h3 class="box-title">{{ trans('backend/user.user_profile_edit') }}</h3>
                    </div>
                    <div class="box-body">

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{ trans('backend/user.first_name') }}:</strong>
                                {!! Form::text('first_name', null, array('placeholder' => trans('backend/user.first_name'),'class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{ trans('backend/user.last_name') }}:</strong>
                                {!! Form::text('last_name', null, array('placeholder' => trans('backend/user.last_name'),'class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{ trans('backend/user.company') }}:</strong>
                                {!! Form::text('company', null, array('placeholder' =>trans('backend/user.company'),'class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{ trans('backend/user.mobile') }}:</strong>
                                {!! Form::text('mobile', null, array('placeholder' =>trans('backend/user.mobile'),'class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{ trans('backend/user.fax') }}:</strong>
                                {!! Form::text('fax', null, array('placeholder' => trans('backend/user.fax'),'class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{ trans('backend/user.tax_no') }}:</strong>
                                {!! Form::text('tax_no', null, array('placeholder' =>trans('backend/user.tax_no'),'class' => 'form-control')) !!}
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Url:</strong>
                                {!! Form::text('url', null, array('placeholder' =>'url','class' => 'form-control')) !!}
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{ trans('backend/user.expire_date') }}:</strong>
                                {!! Form::text('expire_date', null, array('placeholder' =>trans('backend/user.expire_date'),'class' => 'form-control')) !!}
                            </div>
                        </div>
                        <!-- i delete + $user_status it  -->
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{ trans('backend/user.expire_date') }}:</strong>
                                 {!! Form::select('user_status_id',
                                    (['' =>  trans('master.select_item_from_list') ] ),
                                    $user->profile->user_status_id,
                                    ['class' => 'form-control']) !!}
                            </div>
                        </div>

                    </div>


                    <div class="box-footer">
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                @permission('user-edit')
                                <button type="submit" class="btn btn-primary pull-left"><i class="fa fa-save"></i> {{ trans('button.save') }}</button>
                                @endpermission
                        </div>

                    </div>

                </div>

            </div>
        </div>
        {!! Form::close() !!}
