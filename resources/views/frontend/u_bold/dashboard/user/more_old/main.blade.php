 
@extends(Config::get('front_theme').'.layouts.default')


@section('title',$page_title)

@section('page-styles')
    <style>
        .page-panel{
            margin-top: 80px;
        }
    </style>
    <link href="plugins/bootstrap-table/css/bootstrap-table.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
@endsection()

@section('subnav')
    @include(Config::get('front_theme').'.dashboard.user.more.inc.subnav')
@endsection

@section('content_dashboard')
            <!-- right column -->
            
 
                <h4>{{trans('frontend/dashboard.more')}}</h4>
<hr>
 
            
@endsection


 
 

 