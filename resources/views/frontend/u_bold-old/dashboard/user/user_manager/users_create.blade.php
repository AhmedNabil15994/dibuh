@extends(Config::get('front_theme').'.dashboard.'.$userType.'.partials.layout')


@section('module_breadcrumb')
<li><a href="{{ route('account.index') }}">Account Manager</a></li>            
<li class="active">Created Users</li>

@endsection

@section('content_dashboard')
<!-- right column -->



@if (count($errors) > 0)
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
    <h3>Created Users</h3>
<hr>    

    {!! Form::open( ['method' => 'POST','route' => [ 'users.store']]) !!}     



<!--    <div class="form-group">
        <label class="col-lg-3 control-label">Name:</label>
        <div class="col-lg-8">
            {!! Form::text('country', null, ['placeholder' => 'Name','class' => 'form-control']) !!}     
        </div>

    </div>-->
    <div class="form-group">
        <label class="col-lg-3 control-label">email:</label>
        <div class="col-lg-8">
            {!! Form::text('email', null, ['placeholder' => 'Email','class' => 'form-control']) !!}     
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-3 control-label">password:</label>
        <div class="col-lg-8">
            {!! Form::password('password', null, ['placeholder' => 'Password','class' => 'form-control']) !!}     
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-3 control-label">Password Confirmation:</label>
        <div class="col-lg-8">
            {!! Form::password('password_confirmation', null, ['placeholder' => 'Password Confirmation','class' => 'form-control']) !!}     
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-3 control-label">User Type:</label>
        <div class="col-lg-8">
            <select name="user_role" class="form-control ">
                        <option value="2">User</option>
                        <option value="4">Advertiser</option>
                    </select>                        
              
        </div>
    </div>       
    
 



    <div class="form-group">
        <label class="col-md-3 control-label"></label>
        <div class="col-md-8">
            <input type="submit" class="btn btn-primary" value="Save Changes">
            
            <a class="btn btn-danger pull-left" href="{{ route('profile.address.index') }}"> Cancel</a>                            
        </div>
    </div>
    {!! Form::close() !!}
 



<!-- End Section Main Content -->	
@endsection