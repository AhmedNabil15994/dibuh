@extends(Config::get('front_theme').'.dashboard.'.$userType.'.partials.layout')

@section('title')
- {{$page_title}}
@endsection


@section('page-styles')
<link rel="stylesheet" type="text/css" href="css/user_dashboard.css">
@endsection

>

@section('content')


<!-- ### Breadcrumb -->
<div class="breadcrum_sec">
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li class="active">User Profile</li>
        </ol>	
    </div>
</div
<!-- Start Section Main Content -->
<div class="main_contant" style="height: 100%">



    <section class="page_container" style="height: 100%;display: block">
        <div class="container">
             
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
            <h1>Edit Profile</h1>
            <hr>
            <div class="row">
            <!-- left column/sidebar -->

            @include(Config::get('front_theme').'.dashboard.salesman.partials.profile_sidebar')
            

<!--                edit form column -->
                <div class="col-md-9 personal-info">
                    <div class="alert alert-info alert-dismissable">
                        <a class="panel-close close" data-dismiss="alert">×</a> 
                        <i class="fa fa-coffee"></i>
                        This is an <strong>.alert</strong>. Use this to show important messages to the user.

                    </div>                        
                    <hr>                        
                        {{$data[0]['profile']->first_name}}
                        <hr>
                    <h3>Personal info:<pre>{{$data[0]->id}}</pre></h3>

                    {!! Form::model($data[0]['profile'], ['method' => 'PATCH','route' => [ 'user.profile.update', $data[0]->id]]) !!}                    
                    <div class="form-group">
                        <label class="col-lg-3 control-label">First name:</label>
                        <div class="col-lg-8">
                            {!! Form::text('first_name', null, ['placeholder' => 'First Name','class' => 'form-control']) !!}     
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Last name:</label>
                        <div class="col-lg-8">
                            {!! Form::text('last_name', null, ['placeholder' => 'Last Name','class' => 'form-control']) !!}     
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Company:</label>
                        <div class="col-lg-8">
                            {!! Form::text('company', null, ['placeholder' => 'Company','class' => 'form-control']) !!}     
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Phone:</label>
                        <div class="col-lg-8">
                            {!! Form::text('phone', null, ['placeholder' => 'Phone','class' => 'form-control']) !!}     
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Mobile:</label>
                        <div class="col-lg-8">
                            {!! Form::text('mobile', null, ['placeholder' => 'Mobile','class' => 'form-control']) !!}     
                        </div>
                    </div>                    
      
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Fax:</label>
                        <div class="col-lg-8">
                            {!! Form::text('fax', null, ['placeholder' => 'Fax','class' => 'form-control']) !!}     
                        </div>
                    </div>   
                    
             
           
       
                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-8">
                            <input type="submit" class="btn btn-primary" value="Save Changes">
                            <span></span>
                            <input type="reset" class="btn btn-default" value="Cancel">
                        </div>
                    </div>
                    {!! Form::close() !!}
                        <hr>   
                        
                    <h3>Address info: </pre></h3>

                    {!! Form::model($data[0]['address'], ['method' => 'PATCH','route' => [ 'user.profile.update', $data[0]->id]]) !!}                    
 
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Country:</label>
                        <div class="col-lg-8">
                            {!! Form::text('country', null, ['placeholder' => 'country','class' => 'form-control']) !!}     
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">	City:</label>
                        <div class="col-lg-8">
                            {!! Form::text('city', null, ['placeholder' => 'City','class' => 'form-control']) !!}     
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">House no:</label>
                        <div class="col-lg-8">
                            {!! Form::text('house_no', null, ['placeholder' => 'House No','class' => 'form-control']) !!}     
                        </div>
                    </div>                    
      
                    <div class="form-group">
                        <label class="col-lg-3 control-label">	Street:</label>
                        <div class="col-lg-8">
                            {!! Form::text('street', null, ['placeholder' => 'Street','class' => 'form-control']) !!}     
                        </div>
                    </div>   

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Postal code:</label>
                        <div class="col-lg-8">
                            {!! Form::text('postal_code', null, ['placeholder' => 'Postal code','class' => 'form-control']) !!}     
                        </div>
                    </div>                                
           
       
                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-8">
                            <input type="submit" class="btn btn-primary" value="Save Changes">
                            <span></span>
                            <input type="reset" class="btn btn-default" value="Cancel">
                        </div>
                    </div>
                    {!! Form::close() !!}
                        <hr>                          
                </div>
            </div>



        </div>
    </section>
</div> 



<!-- End Section Main Content -->	
@endsection