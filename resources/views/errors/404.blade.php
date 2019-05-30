@extends(Config::get('front_theme').'.layouts.default')

@section('htmlheader_title')
    {{ trans('adminlte_lang::message.pagenotfound') }}
@endsection

@section('contentheader_title')
    {{ trans('adminlte_lang::message.404error') }}
@endsection

@section('$contentheader_description')
@endsection

@section('content')

<div class="container"> 
	<div class="error-page" style="min-height:200px;margin-top:90px">
	    <h2 class="headline text-yellow"> 404</h2>
	    <div class="error-content">
	        <h3><i class="fa fa-warning text-yellow"></i> Oops! {{ trans('adminlte_lang::message.pagenotfound') }}.</h3>
	        <p>
	            {{ trans('adminlte_lang::message.notfindpage') }}
	            {{ trans('adminlte_lang::message.mainwhile') }} <a href='{{ url('/home') }}'>{{ trans('adminlte_lang::message.returndashboard') }}</a> {{ trans('adminlte_lang::message.usingsearch') }}
	        </p>

	    </div><!-- /.error-content -->
	</div><!-- /.error-page -->

</div>
@endsection