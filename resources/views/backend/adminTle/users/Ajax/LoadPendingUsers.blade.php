<table class="table table-hover daTatable dataTable deleteFormModal text-center demo-foo-filtering6" data-form="deleteForm" id="users-table">
            <thead>
                <tr style="background-color: #EEE;">
                <th>{{ trans('master.no#') }}</th>
                <th style="padding: 0;"><input type="text" style="margin-bottom: 5px;" name="search" class="form-control" placeholder="{{ trans('master.email') }}" id="search6"></th>
                <th class="col-sm-4">{{ trans('backend/user.created') }}</th>
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
                        <td>{{ \Carbon::parse($users->created_at)->format('Y-m-d')}}</td>
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
    .select2-container--default .select2-selection--multiple .select2-selection__choice{
        color: #666;
    }
    table td{
        text-align: left !important;
    }
    .table tbody tr > td:first-of-type,
    .table tbody tr > td:nth-of-type(3),
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
    .row{
        padding-right: 50px;
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
    #search6{
        float: left;
    }
    .tab-content{
        border: 1px solid #DDD;
        box-shadow: 5px 5px 5px #999;
    }
    .pag{
        min-height: 300px;
    }
    .bg-aqua, .callout.callout-info, .alert-info, .label-info, .modal-info .modal-body{
        background-color: transparent !important;
        color: #505458 !important;
        border: 0 !important;
    }
</style>

<script type="text/javascript">
    $(function(){
         var oTable = $('.demo-foo-filtering6').DataTable({
                      "ordering": false
                    } );
        $('#search6').on('keyup',function(){
            oTable.search( this.value ).draw();
        });
    });
</script>        