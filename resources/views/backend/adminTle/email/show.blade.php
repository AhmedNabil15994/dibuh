@extends(Config::get('back_theme').'.layouts.app')

@section('htmlheader_title')
{{ trans('backend/main.email') }}
@endsection

@section('contentheader_title')
{{ trans('backend/main.email') }}

@endsection

@section('contentheader_description')
{{ trans('backend/main.email') }}
@endsection

@section('previous_breadcrumb')
{{ trans('backend/main.temp') }}
@endsection
<!--breadcrumb current page-->
@section('current_breadcrumb')
{{ trans('backend/main.email') }}
@endsection

@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<div class="main">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ trans('backend/main.edit_email') }}</h4>
            </div>
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


                <div class="modal-body">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <div class="col-sm-3">
                                <strong>{{ trans('backend/main.name')}} :</strong>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" class="form-control name" name="name" placeholder="{{trans('backend/main.name')}}" value="{{$data->name}}">
                            </div>

                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <div class="col-sm-3">
                                <strong>{{ trans('backend/main.subject')}} :</strong>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" class="form-control subject" name="subject" placeholder="{{trans('backend/main.subject')}}" value="{{$data->subject}}">
                            </div>

                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <div class="col-sm-3">
                                <strong>{{ trans('backend/main.content')}} :</strong>
                            </div>
                            <div class="col-sm-9 contents">
                                <textarea placeholder="{{trans('backend/main.content')}}" id="header_text" name="header_text">
                                    {{$data->content}}
                                </textarea>
                            </div>

                        </div>
                    </div>
                </div>

            <div class="modal-footer" style="border-top: 0">
                <button type="submit" class="btn btn-success" style="background-color: #449d44" value="{{$data->id}}"><i class="fa fa-save"></i> {{ trans('button.save') }}</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-home "></i> {{ trans('button.cancel') }}</button>
            </div>


        </div>

    </div>
</div>


@endsection

@section('page-styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
<link rel="stylesheet" href="plugins/select2/select2.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.0/css/buttons.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.4/css/select.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="{{URL::to('').Config::get('assets_frontend')}}/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
<style type="text/css">
    .notifyjs-bootstrap-base.notifyjs-bootstrap-error{
        background-color: #d9534f !important;
        color: #FFF !important;
        border-color: #d43f3a !important;
    }
    .notifyjs-bootstrap-base.notifyjs-bootstrap-success{
        background-color: #449d44 !important;
        color: #FFF !important;
        border-color:#398439 !important;
    }
    .content-wrapper, .right-side , .wrapper{
        background-color: #FFF !important;
    }
    .main{
        border: 1px solid #DDD;
        padding: 15px;
        margin-top: 50px;
    }
    .modal-content,.modal-dialog{
        border-radius: 6px !important;
        border: 1px solid rgba(0,0,0,.2) !important;
        width: 100% !important;
    }
    .modal-dialog{
        box-shadow: 0 5px 15px rgba(0,0,0,.5);
        border: 0 !important;
        width: 80% !important;
    }
    .modal-footer{
        margin-top: 60px;
        border-top: 1px solid #DDD !important;
    }
    .modal-body{
        min-height: 430px;
    }
    .label{
        background-color: #358eda;
        padding: 5px;
        margin-bottom: 10px;
        display: inline-block;
    }
    #header_text{
        max-height: 250px;
        min-height: 250px;
    }
    button i{
        font-size: 13px;
        margin-right: 5px;
    }
    #mceu_41{
        min-height: 200px;
        max-height: 200px;
        min-width: 100%;
        max-width: 100%;
    }
    .col-sm-9{
        padding: 0;
        margin-bottom: 15px;
    }
    .contents{
        border: 1px solid #DDD !important;
    }
</style>
@endsection

@section('page-scripts')


<script src="plugins/select2/select2.full.min.js"></script>
<script src="plugins/iCheck/icheck.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/select/1.2.4/js/dataTables.select.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.0/js/buttons.bootstrap.min.js"></script>
<script src="{{URL::to('').Config::get('assets_frontend')}}plugins/tinymce/tinymce.min.js"></script>
<script src="{{URL::to('').Config::get('assets_frontend')}}plugins/notifications/notify.min.js"></script>
<script type="text/javascript">
    $(function(){

/*********************************************** Pagination Code***********************************************/
        /*$(document).on('click','.pagination a',function(e){
            e.preventDefault();
            var page = $(this).attr('href');
            getItems(page);
            window.history.pushState("", "", page);
        });

        function getItems(page){
            $.ajax({
                url:page
            }).done(function(data){
                $('#home').html($(data).find(".pag"));
            });
        }*/

        tinyMCE.init({
            'formats' : {
                //'alignleft' : {'selector' : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', attributes: {"align":  'left'}},
                //'aligncenter' : {'selector' : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', attributes: {"align":  'center'}},
                'alignright' : {'selector' : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', attributes: {"align":  'right'}},
                //'alignfull' : {'selector' : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', attributes: {"align":  'justify'}}
            }
        });
        if($("#header_text").length > 0){
            tinymce.init({
                selector: "textarea#header_text,textarea#footer_text",
                theme: "modern",
                height:100,
                menubar: true,
                statusbar: true,
                plugins: [
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                    "save table contextmenu directionality emoticons  paste textcolor"
                ],
                toolbar: "rtl | insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
                style_formats: [
                    {title: 'Bold text', inline: 'b'},
                    {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                    {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                    {title: 'Example 1', inline: 'span', classes: 'example1'},
                    {title: 'Example 2', inline: 'span', classes: 'example2'},
                    {title: 'Table styles'},
                    {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
                ]
            });
        }

        $('.breadcrumb .prev').toggle();
        $('.breadcrumb .prev a').click(function (e) {
            e.preventDefault();
            e.stopPropagation();
            window.location.href = "{{route('admin::email.index')}}";
        });


        $('.btn-success').on('click',function(){
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            $.ajax({
                type: 'post',
                url: "{{route('admin::email.edit')}}",
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id'  : $(this).attr('value'),
                    'name': $('.name').val(),
                    'subject': $('.subject').val(),
                    'content': tinymce.get('header_text').getContent(),
                },
                success: function(data) {
                    if(isNaN (data)){
                    $.each(data['errors'], function(i, item) {
                        $.notify("Whoops \n"+item,{ position:"top right" ,className:"error"});
                    });


                    }else if(data==1){
                        $.notify("Updated successfully \n Email Updated successfully In Emails",{ position:"top right" ,className:"success"});
                        location.reload();
                    }
                },
                error: function(data){
                    $.notify("Whoops \n Error may be in connection to server",{ position:"top right" ,className:"error"});
                }
            });
        });




    });
</script>

@endsection
