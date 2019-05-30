
            @extends(Config::get('front_theme').'.dashboard.'.$userType.'.'.$module.'.partials.layout')

            
            @section('page-styles')
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <link href="plugins/jsgrid/css/jsgrid.min.css" rel="stylesheet" type="text/css" />
            <link href="plugins/jsgrid/css/jsgrid-theme.min.css" rel="stylesheet" type="text/css" />
            <link href="plugins/bootstrap-table/css/bootstrap-table.min.css" rel="stylesheet" type="text/css" />
    		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
    		<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.0/css/buttons.bootstrap.min.css">
    		<link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.4/css/select.bootstrap.min.css">
            <style>
        		.check{
        			margin: 0 0 15px;
        			padding: 0 0 20px;
        		}
        		.main_contant {
        			margin-top: 25px;
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
		        .checkbox.checkbox-inline{
		        	padding: 0;
		        	margin: 5px 0;
		        }
		        .page-panel .panel-body .pbody .table > tbody > tr{
		        	height: 40px !important;
		        	cursor: pointer;
		        }

		        .opened,tr.datarow.opened:hover{
		        	background-color: #f2f5c4 !important;
		        }
		        .writable{
		        	border: 1px solid #DDD !important;
		        	background-color: #FFF !important;
		        }
		        .more{
		        	display: none;
		        }
        	</style>
            <meta name="token" content="{!! csrf_token() !!}" />
            @endsection
            
            @section('subnav')
                @include(Config::get('front_theme').'.dashboard.'.$userType.'.more.inc.subnav')
            @endsection

            @section('content')
            <!-- right column -->
 
            <div class="row m-b-20" style="margin-top: 75px;">
                <div class="col-xs-12 ">
                    <h4 class="page-title">{{trans('frontend/dashboard.account_manager')}}</h4>
                    <p class="text-muted page-title-alt m-b-0">من هنا يمكنك اضافة معلومات عن الاكواد المحاسبية للنظام</p>
                </div>
            </div>

            <div class="panel panel-default page-panel">
			    <div class="panel-heading">
			        <div class="row" style="margin: 0;padding: 0;">
			         	<div class="check">
                            	<?php 
                            		$types = \DB::table('company_types')->get();
                            	?>
                            	@foreach($types as $type)
									<div class="checkbox checkbox-custom checkbox-inline col-md-2 col-xs-6">
	                                    <input type="checkbox" id="company_type_{{$type->id}}" class="config-panel" checked="checked" value="{{$type->id}}">
	                                    <label for="company_type_{{$type->id}}">{{$type->name_ar}}</label>
	                                    <input type="hidden" name="type_id" value="{{$type->id}}">
	                                </div>
                            	@endforeach                               
                        </div>  
			        </div>
			    </div>
			    <div class="panel-body">
			        
			        <div class="pbody table-responsive">
			            <div class="BoxContent">
			                <table class="table table-hover table-bordered daTatable dataTable demo-foo-filtering" id="demo-foo-filtering" >
		                        <thead>
		                            <tr style="background-color: #F9F9F9;">
		                                <th class="text-center">{{trans('frontend/account.account_code')}}</th>
		                                <th class="text-center col-md-4">{{trans('frontend/account.title')}}</th>
		                                <th class="text-center">{{trans('frontend/account.display_name')}}</th>
		                                <th class="text-center">{{trans('frontend/account.use')}}</th>
		                                <th class="text-center col-md-2"></th>
		                            </tr>
		                        </thead>
		                        <div class="tableBody">
		                            <tbody>
		                                @if(count($data))
		                                   @foreach($data as $row)
		                                   	<tr class="datarow" data-value1="{{$row->id}}" data-value2="{{$row->company_type_id}}">
		                                   		<td class="text-center">{{$row->account_code}}</td>
		                                   		<?php $color=''; ?>
		                                   		@if($row->is_major == 1)
		                                   		<?php 
		                                   			$color = "#EEE";
		                                   		?>
		                                   		@else
		                                   		<?php 
		                                   			$color = "transparent";
		                                   		?>
		                                   		@endif
		                                   		<td style="background-color: {{$color}}">{{$row->name}}</td>		

		                                   		<?php 
		                                   			$display = \DB::table('users_accounts')->where('user_id','=',Auth::user()->id)->where('account_id','=',$row->id)->first();
		                                   			$name='';
		                                   		?>           
		                                   		@if(count($display) > 0)
		                                   			<?php $name = $display->display_name; ?>	
		                                   		@else
		                                   			<?php $name = ''; ?>
		                                   		@endif       
		                                   		<td>
		                                   			<input style="background-color: transparent;border: 0;" class="form-control display" type="text" name="" value="{{$name}}" disabled>
		                                   		</td>
		                                   		<td class="text-center">
		                                   			<div class="checkbox checkbox-custom checkbox-inline text-center col-md-2 col-xs-6" style="width: 100%;display: block;margin-bottom: 0;padding-left: 10px;">
					                                    <input type="checkbox" id="use" checked="checked" disabled>
					                                    <label for="use"></label>
					                                </div>
		                                   		</td>
		                                   		<td class="text-center actions">
		                                   			<button type="button" class="btn edit btn-xs" style="background-color: #5fbeaa;color: #FFF;"><i class="fa fa-pencil fa-fw"></i></button>
		                                   			<div class="row more">
		                                   					<button type="button" class="btn save btn-xs btn-success" value1="{{$row->id}}" value2="{{$row->company_type_id}}"><i class="fa fa-check fa-fw"></i></button>
		                                   				<button type="button" class="btn cancel btn-xs btn-danger" value="{{$name}}"><i class="fa fa-close fa-fw"></i></button>
		                                   			</div>
		                                   		</td>
		                                   	</tr>
		                                   @endforeach
		                                @endif()
		                            </tbody>
		                        </div>
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
			                            <img style="width: 120px;" src="images/filter.svg">
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
			            </div>
			        </div>
			    </div>
			    <div class="panel-footer">
			        <div class="row">
			            <div class="col-md-4 pull-left">
			                <button class="btn btn-success waves-effect waves-light m-r-5 ladda-button btn-save" id="save_list">{{trans('button.save')}}</button>    
			            </div>
			        </div>
			    </div>
			</div>
 
                


            @endsection

            @section('page-scripts')
            <!-- jsgris table js -->
            <script src="plugins/jsgrid/js/jsgrid.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
		    <script src="https://cdn.datatables.net/buttons/1.5.0/js/dataTables.buttons.min.js"></script>
		    <script src="https://cdn.datatables.net/select/1.2.4/js/dataTables.select.min.js"></script>
		    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
		    <script src="https://cdn.datatables.net/buttons/1.5.0/js/buttons.bootstrap.min.js"></script>
		    <script src="plugins/notifyjs/js/notify.js"></script>
			<script src="plugins/notifications/notify-metro.js"></script>


		    <script type="text/javascript">
           		$(function(){
           			$('.demo-foo-filtering').DataTable({
						"bSort" : false
					});
           			var length = <?php echo count($types) ; ?>;
           			var IDs = [];

           			@foreach($types as $type)
           				IDs.push("{{$type->id}}");
           			@endforeach
           			$('.config-panel').each(function(){
           				$(this).on('change',function(){

           					if($(this).prop('checked')){
           						for (var i = length - 1; i >= 0; i--) {
           							if(IDs[i] == $(this).val()){

           							}else{
           								IDs.push($(this).val());
           								break;
           							}
           						}
           					}else{
           						var index = IDs.indexOf($(this).val());
           						if (index > -1) {
								    IDs.splice(index, 1);
								}
           					}

           				   var url = "{{Route('account.filter')}}";
			               var outerBox = '.page-panel';
			               var Box = '.page-panel .BoxContent';
			               var loaging = '<div id="overlayPagination" class="overlay overlay-x1"><i class="fa fa-spinner fa-pulse fa-fw" ></i></div>';
			               $(outerBox + ' .btn').attr('disabled','disabled');
			               $(Box + ' #overlayPagination').remove();
			               $(Box).append(loaging);
			               $.ajax({
			                   url : url,
			                   data: {
		                            '_token': $('input[name=_token]').val(),
		                            'ids': IDs
		                        },
			               }).done(function (data) {
			                   $(Box).html(data);
			                   $('.CopyedPagination').html($('.NewPagination').html());
			                   $('.BoxContent #overlayPagination').remove();
			                   $(outerBox + ' .btn').removeAttr('disabled','disabled');
			               }).fail(function () {
			                   $('.BoxContent #overlayPagination').remove();
			                   $('.BoxContent #overlayError').remove();
			                   $(outerBox + ' .btn').removeAttr('disabled','disabled');
			                   var error = '<div id="overlayError" class="alert alert-danger" style="margin: 0"><h4>خطأ في الاتصال<i class="fa fa-exclamation fa-fw"></i></h4><p>حدث خطأ اثناء الاتصال قد يكون انقطاع في الاتصال . حاول مرة اخري</p></div>';
			                   $(Box).html(error);
			               });

           				});
           			});


           				$(document).on('dblclick','table tr.datarow',function(e){
           					e.preventDefault();
           					e.stopPropagation();
           					$(this).addClass('opened');
           					$(this).siblings().removeClass('opened');
           					$(this).siblings().children('td').children('.display').removeClass('writable');
           					$(this).siblings().children('td').children('.display').attr('disabled','disabled');
           					$(this).siblings().children('td.actions').children('.edit').show();
           					$(this).siblings().children('td.actions').children('.more').hide();

           					if($(this).hasClass('opened')){
           						$(this).children('td').children('.display').addClass('writable');
           						$(this).children('td').children('.display').focus();
           						$(this).children('td').children('.display').removeAttr('disabled');
           						$(this).children('td.actions').children('.edit').hide();
           						$(this).children('td.actions').children('.more').show();
           					}else{
           						$(this).removeClass('opened');
           						$(this).children('td').children('.display').removeClass('writable');
           						$(this).children('td').children('.display').attr('disabled','disabled');
           					}
           					


           				});

           				$(document).on('click','.edit',function(){
           					$(this).parent('td').parent('.datarow').dblclick();
           				});

           				$(document).on('click','.cancel',function(){
           					var value = $(this).val();
           					$(this).parent('.more').parent('td').parent('.datarow').removeClass('opened');
           					$(this).parent('.more').parent('td').siblings('td').children('.display').removeClass('writable');
           					$(this).parent('.more').parent('td').siblings('td').children('.display').attr('disabled','disabled');
           					$(this).parent('.more').hide();
           					$(this).parent('.more').siblings('.edit').show();
           				})

           				$(document).on('click','.save',function(e){
           					e.preventDefault();
                    		e.stopPropagation();
                    		var element    = $(this);
           					var account_id = element.attr('value1');
           					var company_type_id = element.attr('value2');
           					var display_name  = element.parent('.more').parent('td').siblings('td').children('.display').val();
           					$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
		                    $.ajax({
		                        type: 'post',
								url: '{{route("account.storeDisplay")}}',
		                        data: {
		                            '_token': $('input[name=_token]').val(),
		                            'account_id': account_id,
		                            'display_name'	 : display_name,
		                        },
		                        success: function(data) {
		                            element.siblings('.cancel').attr('value',display_name);
		                            element.siblings('.cancel').click();
		                        	$.Notification.autoHideNotify('success', 'top right', 'Saved successfully','Your Display Name Saved Successfully<br>');
		                        },
		                        error: function(data){
		                        	$.Notification.autoHideNotify('error', 'top right', 'Whoops','Error may be in connection to server<br>');
		                        }
		                    });
           				});

           		});
           	</script>

            

            @endsection

