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
        <div class="wrapper">
            <div class="container">

                <div class="wrapper-page">
                    <div class="ex-page-content text-center">
                        <div class="text-error">
                            <span class="text-primary">6</span><i class="ti-face-sad text-pink"></i><span class="text-info">1</span>
                        </div>
                        <h2>Who0ps! Upgrade Needed!</h2>
                        <br>
                        <p class="text-muted">
                               Oops! You Need to Upgrade you Plan.
                        </p>
                        <p class="text-muted">
                            Use the navigation above or the button below to get back and track.
                        </p>
                        <br>
                        <a class="btn btn-default waves-effect waves-light" href="{{route('dashboard.index')}}"> {{ trans('adminlte_lang::message.returndashboard') }}</a>

                    </div>
                </div>
                <!-- end wrapper page -->

                <!-- Footer -->
                <footer class="footer text-right">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6">
 
                            </div>
                            <div class="col-sm-6">
                                <ul class="pull-right list-inline m-b-0">
                                    <li>
                                        <a href="#">About</a>
                                    </li>
                                    <li>
                                        <a href="#">Help</a>
                                    </li>
                                    <li>
                                        <a href="#">Contact</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- End Footer -->

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->
 
@endsection