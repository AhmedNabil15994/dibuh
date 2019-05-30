 
 
 
        {!! Form::model($user, ['method' => 'PATCH','route' => ['admin::users.update', $user->id]]) !!}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">        
                <div class="box box-solid">

                    <div class="box-header with-border">
                        <h3 class="box-title">{{ trans('backend/user.edit_form') }}</h3>
                    </div>
                    <div class="box-body">

<!--                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Name:</strong>
                                {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                            </div>
                        </div>                          -->
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{ trans('backend/user.email') }}:</strong>
                                {!! Form::text('email', null, array('placeholder' => trans('backend/user.email'),'class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Password:</strong>
                                {!! Form::password('password', array('placeholder' => trans('backend/user.password'),'class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Confirm Password:</strong>
                                {!! Form::password('confirm-password', array('placeholder' => trans('backend/user.password_confirmation'),'class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{ trans('backend/user.admin_access') }}   :</strong>
                                {!! Form::hidden('is_admin', false) !!}
                                {!! Form::checkbox('is_admin', true) !!}   
                            </div>
                        </div>     
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{ trans('backend/user.roles') }}:</strong>
                                {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!}
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
 
 