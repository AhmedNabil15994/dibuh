<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

@section('htmlheader')
    @include(Config::get('back_theme').'.layouts.partials.htmlheader')
@show

<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="skin-blue sidebar-mini">
<div class="wrapper">

    @include(Config::get('back_theme').'.layouts.partials.mainheader')

    @include(Config::get('back_theme').'.layouts.partials.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        @include(Config::get('back_theme').'.layouts.partials.contentheader')

        <!-- Main content -->
        <section class="content">
            <!-- Your Page Content Here -->
            @yield('content')
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    @include(Config::get('back_theme').'.layouts.partials.controlsidebar')

    @include(Config::get('back_theme').'.layouts.partials.footer')

</div><!-- ./wrapper -->

@section('scripts')
    @include(Config::get('back_theme').'.layouts.partials.scripts')
    <script type="text/javascript">
        $(function(){
             $('#toggle-event').change(function() {
              var lang ;
              if($(this).prop('checked') == true){
                lang="English";
              }else{
                lang="Arabic";
              }
              $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                $.ajax({
                    type: 'GET',
                    url:"{{route('admin::dashboard.change')}}",
                    data:{
                        '_token': $('input[name=_token]').val(),
                        "lang":lang
                    },
                    success:function(data){
                        console.log(lang);

                    }
                });     
            })
        });
    </script>
@show

</body>
</html>
