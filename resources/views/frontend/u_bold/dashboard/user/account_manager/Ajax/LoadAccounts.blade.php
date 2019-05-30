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
		                                   	<tr class="datarow" data-value1="{{$row['id']}}" data-value2="{{$row['company_type_id']}}">
		                                   		<td class="text-center">{{$row['account_code']}}</td>
		                                   		<?php $color=''; ?>
		                                   		@if($row['is_major'] == 1)
		                                   		<?php 
		                                   			$color = "#EEE";
		                                   		?>
		                                   		@else
		                                   		<?php 
		                                   			$color = "transparent";
		                                   		?>
		                                   		@endif
		                                   		<td style="background-color: {{$color}}">{{$row['name']}}</td>		

		                                   		<?php 
		                                   			$display = \DB::table('users_accounts')->where('user_id','=',Auth::user()->id)->where('account_id','=',$row['id'])->first();
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
		                                   					<button type="button" class="btn save btn-xs btn-success" value1="{{$row['id']}}" value2="{{$row['company_type_id']}}"><i class="fa fa-check fa-fw"></i></button>
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
		                                        <h4>{{trans('message.no_results')}}<i class="fa fa-exclamation fa-fw"></i></h4>
		                                        <p>{{trans('message.no_result_now')}}</p>
		                                    </div>
		                                </div>
		                            </div>
		                        </div>
		                    @endif
<script type="text/javascript">
    $(function(){
        var oTable = $('.demo-foo-filtering').DataTable();
    });
</script>                            