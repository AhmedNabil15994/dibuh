@extends(Config::get('back_theme').'.layouts.app')

@section('htmlheader_title')
{{ trans('backend/language.list') }}
@endsection

@section('contentheader_title')
{{ trans('backend/language.list') }}
@endsection

@section('contentheader_description')
{{ trans('backend/language.list') }}
@endsection

<!--breadcrumb current page-->
@section('current_breadcrumb')
{{ trans('backend/language.list') }}
@endsection


@section('content')
<style type='text/css'>
  form{display:inline;}
</style>

	@if ($message = Session::get('success'))
		<div class="alert alert-success">
			<p>{{ $message }}</p>
		</div>
	@endif
				<a class="btn btn-primary" href="{{ route('admin::languages.add') }}"> {{ trans('backend/language.add') }}</a>
             {!! Form::open(['route'=>'admin::language.change']) !!}
						 {!! Form::select('lang_id',$languages,$active_lang,['class'=>"",'placeholder'=>'Change Language','onchange'=>"this.form.submit()"]) !!}
             {!!Form::close() !!}
	<table class="table table-bordered">
		<tr>
			<th> {{ trans('backend/main.no#') }}</th>
			<th> {{ trans('backend/language.code') }}</th>
			<th> {{ trans('backend/language.name') }}</th>
			<th> {{ trans('backend/language.native_name') }}</th>
			<th> {{ trans('backend/language.regional') }}</th>
			<th> {{ trans('backend/language.dir') }}</th>
			<th> {{ trans('master.is_active') }}</th>
			<th> {{ trans('master.is_default') }}</th>
			<th width="280px" >Action</th>
		</tr>
	@foreach ($data as $key => $row)

	<tr class="show_btn" type="submit">
		<td>{{ ++$i }}</td>
		<td>{{ $row->code }}</td>
		<td>{{ $row->name }}</td>
		<td>{{ $row->native_name }}</td>
		<td>{{ $row->regional }}</td>
		<td>{{ $row->dir }}</td>
		<td>{{ $row->is_active }}</td>
		<td>{{ $row->is_default }}</td>


		<td >


      <a class="btn btn-primary" href="{{ route('admin::languages.edit',$row->id) }}"> {{ trans('button.edit') }}</a>
     @if($row->code !="ar")
		  	{{Form::open(['method'=>'delete','route'=>['admin::languages.delete',$row->id]])}}
		    	<button type="submit" class="btn btn-danger"> {{ trans('button.delete') }}</button>
       {{Form::close()}}
		  @endif

		   <a class="btn btn-info" href="{{ route('admin::language.files',$row->id) }}"> {{ trans('button.show') }}</a>
    </td>
	</tr>

	@endforeach
	</table>
	{!! $data->render() !!}
@endsection
@section('page-script')
<script>
// $('table tbody tr').on('click',function(){
//               var route  = $(this).find('.show_btn').attr('href');
//               window.location.href="{{ route('admin::languages.add') }}";
//  });
</script>
@endsection
