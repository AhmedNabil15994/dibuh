@extends(Config::get('back_theme').'.layouts.app')

@section('htmlheader_title')
    {{ trans('backend/main.dashboard') }}
@endsection

@section('contentheader_title')
{{ trans('backend/main.dashboard') }}
@endsection

@section('contentheader_description')
 {{ trans('backend/main.dashboard') }}
@endsection

<!--breadcrumb current page-->
@section('current_breadcrumb')

{{ trans('backend/main.dashboard') }}
@endsection

@section('content')

@endsection
