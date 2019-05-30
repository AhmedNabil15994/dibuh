@extends('frontend.default.layouts.default')

@section('htmlheader_title')
    {{ trans('adminlte_lang::message.serviceunavailable') }}
@endsection

@section('contentheader_title')
    Access Denied!
@endsection

@section('contentheader_description')
@endsection

@section('content')

    <div class="error-page">
        <h1 class="headline text-red">102</h1>
           
        <div class="error-content">
            <h1><i class="fa fa-warning text-red"></i> 
            Oops! User  Role not Allowed to login to this section.
             
             </h1>
            <p>
               
              <a href='{{ url('/') }}'>{{ trans('adminlte_lang::message.returndashboard') }}</a>  
 
        </div>
    </div><!-- /.error-page -->
@endsection