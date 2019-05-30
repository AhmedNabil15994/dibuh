<div class="row" style="margin-bottom: -35px;margin-right: 2px;">
                <?php 
                    $id   = '';
                    if(count($data)<1){
                        $id = 0;
                    }else{
                        foreach ($data as $key => $value) {
                           $id   = $value->id;
                        }
                    }
                ?>
                
                <button type="button" class="btn btn-success btn-circle pull-right user-add" value="<?php echo $id; ?>"><i class="fa fa-plus"></i> <span>{{ trans('button.create') }}</span></button>
        </div>
         <table class="table table-hover daTatable dataTable deleteFormModal text-center demo-foo-filtering" data-form="deleteForm" id="users-table">
            <thead>
                <tr style="background-color: #EEE;">
                <th>{{ trans('master.no#') }}</th>
                <th style="padding: 0;"><input type="text" style="margin-bottom: 5px;" name="search" class="form-control" placeholder="{{ trans('master.email') }}" id="search"></th>
                <th class="col-sm-4">{{ trans('backend/user.roles') }} <a class="btn btn-primary btn-xs" href="{{ route('admin::users.users_roles') }}"><i class="fa fa-pencil"></i></a></th>
                <th>{{ trans('master.action') }}</th>
            </tr>
            </thead>

            <tbody>
                <?php $i = 0; ?>
                @foreach ($data as $key => $users)
                <form class="form{{$users->id}}" action="{{route('admin::users.editUser',$users->id)}}" method="get">
                    <tr class="tab-row{{$users->id}} selected_record">
                        <input type="hidden" class="user_id" name="user_id" value="{{$users->id}}">
                        <td>{{ ++$i }}</td>
                        <td>{{ $users->email }}</td>
                        <td>
                            @if(!empty($users->roles))
                            @foreach($users->roles as $v)
                            <label class="label">{{ $v->display_name }}</label>
                            @endforeach
                            @endif
                        </td>
                        <td>
                            <button type="button" name="delete" class="btn btn-danger btn-xs  delete" alt=" {{trans('button.delete')}}" value="{{$users->id}}"><i class="fa fa-trash"></i> {{ trans('button.delete') }}</button>                
                            {!! Form::close() !!}
                        </td>
                    </tr>
                </form>
                @endforeach
            </tbody>    
            
        </table>
        @if(!count($data))
                <style type="text/css">
                    tbody,
                    .dataTables_wrapper .row:last-of-type,
                    .dataTables_wrapper .row:first-of-type{
                        display: none;
                    }
                </style>
                <div id="overlayError">
                    <div class="row" style="margin-top: 20px;">
                        <div class="col-xs-6 text-right">
                            <img style="width: 120px;" src="img/filter.svg">
                        </div>
                        <div class="col-xs-6">
                            <div class="callout callout-info" style="margin-top: 50px;">
                                <h4>لا يوجد نتائج <i class="fa fa-exclamation fa-fw"></i></h4>
                                <p>لا يوجد نتائج مطابقه الان</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

<style type="text/css">
    .ul-row{
        border-bottom: 1px solid #DDD;
        margin-left: 0px;
        margin-right: 5px;
    }
    ul.panel-nav {
        display: inline-block;
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        background-color: transparent;
    }
    ul.panel-nav li {
        float: left;
    }
    ul.panel-nav li a.active {
        border-bottom: 2px solid #5fbeaa;
        color: #111;
    }
    ul.panel-nav li a:hover {
        color: #111;
    }
    ul.panel-nav li a {
        display: block;
        color: silver;
        text-align: center;
        padding: 10px!important;
        margin-bottom: 0;
        text-decoration: none;
        font-weight: bold;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice{
        color: #666;
    }
    table td{
        text-align: left !important;
    }
    .table tbody tr > td:first-of-type,
    .table tbody tr > td:last-of-type{
        text-align: center !important; 
    }
    .content-wrapper, .right-side , .wrapper{
        background-color: #FFF !important;
    }
    .label{
        background-color: #358eda;
        padding: 5px;
        margin-bottom: 10px; 
        display: inline-block;
    }
    #form_search input.form-control{
        display: block;
        width: 100% !important;
        position: relative;
    }
    #form_search .input-group-btn{
        position: absolute;
        right: 0;
    }
    .row{
        margin-bottom: 20px;    
    }
    button i{
        font-size: 13px;
        margin-right: 5px;
    }
    .table{
        color: #495060;
        border: 1px solid #DDD;
    }
    .table thead tr > th{
        text-align: center;
        padding: 12px 5px;
    }
    .table tbody tr > td{
        text-align: center;
        padding: 10px 7px;
        font-size: 14px;
    }
    .table tbody .selected_record:hover{
        cursor: pointer;
        -webkit-transition: all ease-in-out .3s;
        -moz-transition: all ease-in-out .3s;
        -o-transition: all ease-in-out .3s;
        transition: all ease-in-out .3s;
        background-color: #EBF7FF;
    }
    .table tbody .tab-row.active,.table tbody .selected_record:active{
        background-color: #DDD;
    }
    .btn-warning{
        background-color: #FFAD33;
        padding: 6px 5px;
        padding-left: 10px;
        display: inline-block;
        font-size: 12px;
    }
    .btn-warning:hover{
        opacity: .8;
    }
    .tax-delete{
        padding: 0;
        font-size: 12px;
        padding: 2px 7px;
        background-color: #ed3f14;
    }
    .taxs .text{
        border: 1px solid #e9eaec;
        background-color: #f7f7f7;
        padding: 5px;
        display: block;
        width: fit-content;
        margin: auto;
        margin-bottom: 10px;
    }
    .taxs .rate{
        min-width: 40px;
    }
    th.edit{
        position: relative;
    }
    th.edit div{
        position: absolute;
        top: 0;
        left: 0;
        padding: 5px 15px;
        display: block;
        width: 100%;
        text-align: center;
    }
    td .btn{
        margin-bottom: 5px;
    }
    .tab-pane{
        padding: 15px;
        border: 1px solid #DDD;
        border-top: 0;
    }
    .select2,.form-control{
        width: 50% !important;
        display: inline-block;
    }
    #datatable_paginate{
        text-align: left;
    }
    .dataTables_wrapper .row:first-of-type .col-sm-6:first-of-type{
        float: left;
    } 
    #datatable_wrapper .row:last-of-type{
        margin-top: 30px;
    }
    .dataTables_filter{
        display: none;
    }
    .dataTables_length,
    .pagination{
        float: left;
    }
    .dataTables_wrapper .row .col-sm-5{
        float: right;
    }
    .dataTables_wrapper .row .col-sm-5 .dataTables_info{
        float: right;
    }
    #search{
        float: left;
    }
    .pag{
        min-height: 300px;
    }
    .tab-content{
        border: 1px solid #DDD;
        box-shadow: 5px 5px 5px #999;
    }
    #overlayPagination{
        width: 50%;
        display: block;
        margin:auto;
    }
    .bg-aqua, .callout.callout-info, .alert-info, .label-info, .modal-info .modal-body{
        background-color: transparent !important;
        color: #505458 !important;
        border: 0 !important;
    }
</style>

<script type="text/javascript">
    $(function(){
        var oTable = $('.demo-foo-filtering').DataTable({
            "ordering": false
        } );
        $('#search').on('keyup',function(){
            oTable.search( this.value ).draw();
        });
        
    });
</script>                