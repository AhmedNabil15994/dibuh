 
@extends(Config::get('front_theme').'.layouts.default')

@section('title')
- {{$page_title}}
@endsection

@section('page-styles')
<link rel="stylesheet" type="text/css" href="css/user_dashboard.css">
@endsection

@section('content')

<!-- ### Breadcrumb -->
<div class="breadcrum_sec">
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="{{route('home.index')}}">{{trans('master.home')}}</a></li>
            <li class="active">{{trans('master.dashboard')}}</li>
        </ol>	
    </div>
</div>

<!-- End Breadcrumb --> 
<!-- Start Section Main Content -->
<div class="main_contant">
    <div class="container">
        <section class="sec dashboard">         
            <div class="row " >
                <div class="col-md-2">
                    <ul class="nav nav-pills nav-stacked well">
                        <li  class="dashboard_title"><a  href="{{ route('dashboard.index') }}" class="dashboard_title"><i class="fa fa-dashboard"></i> Dashboard</a></li>

                        <li><a href="{{ route('accountmanagment.index') }}"><i class="fa fa-user"></i> Account Managment</a></li>


                        <li><a href="#"><i class="fa fa-sign-out"></i> Logout</a></li>
                    </ul>
                </div>
                <div class="col-md-10">
<!--                    <div class="panel">
                        <img class="pic img-circle " src="http://placehold.it/120x120" alt="...">
                        <div class="name "><small>Dibuh Salesman</small></div>
                        <a href="#" class="btn btn-xs btn-primary pull-left" style="margin:10px;"><span class="glyphicon glyphicon-picture"></span> Change cover</a>
                    </div>

                    <br><br><br>-->
                    <ul class="nav nav-tabs" id="myTab">
                        <li class="active"><a href="#tab1" data-toggle="tab"><i class="fa fa-dashboard"></i> tab1</a></li>
                        <li><a href="#tab2" data-toggle="tab"><i class="fa fa-reply-all"></i> tab2</a></li>
                        <li><a href="#tab3" data-toggle="tab"><i class="fa fa-file-text-o"></i> tab3</a></li>
                        <li><a href="#tab4" data-toggle="tab"><i class="fa fa-clock-o"></i> tab4</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="tab1">
                            statics


                        </div>


                        <div class="tab-pane" id="tab2">
                            tab2
                        </div>


                        <div class="tab-pane" id="tab3">
                            tab 3
                        </div>

                        <div class="tab-pane" id="tab4">
                            tab 4
                        </div>



                    </div>

                </div>
            </div>


    </div>

</section

</div>



<!-- End Section Main Content -->	
@endsection