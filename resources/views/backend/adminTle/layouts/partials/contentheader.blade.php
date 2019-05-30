<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        @yield('contentheader_title', 'Page Header here')
        <small>@yield('contentheader_description')</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin::login')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="prev" style="display: none;"><a href="#">@yield('previous_breadcrumb')</a></li>
        <li class="active">@yield('current_breadcrumb')</li>

    </ol>
</section>