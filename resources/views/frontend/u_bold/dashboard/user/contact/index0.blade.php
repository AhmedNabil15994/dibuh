@extends(Config::get('front_theme').'.dashboard.'.$userType.'.'.$module.'.partials.layout')

@section('module_breadcrumb')
    <li><a href="{{ route($module.'.index') }}"> {{trans('frontend/dashboard.contact_manager')}} </a></li>
    <li class="active"> {{trans('frontend/'.$module.'.edit')}} </li>
@endsection




@section('content_dashboard')
    <!-- right column -->

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
    <h3>{{trans('frontend/'.$module.'.edit')}}</h3>
    <hr>
    {!! Form::model($data, ['method' => 'PATCH','route' => ['contact.update', $data->id]]) !!}




    <div class="form-group">
        <label class="col-lg-3 control-label">     {{ trans('frontend/'.$module.'.title')}} :</label>
        <div class="col-lg-8">

            {!! Form::select('title_id',
            (['' =>  trans('master.select_item_from_list') ] + $titles),
            null,
            ['class' => 'form-control select2']) !!}
        </div>
    </div>

    <div class="form-group">
        <label class="col-lg-3 control-label">{{ trans('frontend/'.$module.'.first_name')}} :</label>
        <div class="col-lg-8">

            {!! Form::text('first_name', null, array('placeholder' => trans('frontend/'.$module.'.first_name'),'class' => 'form-control' )) !!}

        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-3 control-label">{{ trans('frontend/'.$module.'.last_name')}} :</label>
        <div class="col-lg-8">

            {!! Form::text('last_name', null, array('placeholder' => trans('frontend/'.$module.'.last_name'),'class' => 'form-control' )) !!}

        </div>
    </div>

    <div class="form-group">
        <label class="col-lg-3 control-label">{{ trans('frontend/'.$module.'.company')}} :</label>
        <div class="col-lg-8">

            {!! Form::text('company', null, array('placeholder' => trans('frontend/'.$module.'.company'),'class' => 'form-control' )) !!}

        </div>
    </div>

    <div class="form-group">
        <label class="col-lg-3 control-label">     {{ trans('frontend/'.$module.'.contact_type')}} :</label>
        <div class="col-lg-8">

            {!! Form::select('contact_type_id',
            (['' =>  trans('master.select_item_from_list') ] + $contact_type),
            null,
            ['class' => 'form-control select2']) !!}
        </div>
    </div>

    <div class="form-group">
        <label class="col-lg-3 control-label">{{ trans('frontend/'.$module.'.contact_number')}} :</label>
        <div class="col-lg-8">

            {!! Form::text('contact_number', null, array('placeholder' => trans('frontend/'.$module.'.contact_number'),'class' => 'form-control' )) !!}

        </div>
    </div>

    <div class="form-group">
        <label class="col-lg-3 control-label">{{ trans('frontend/'.$module.'.phone')}} :</label>
        <div class="col-lg-8">

            {!! Form::text('phone', null, array('placeholder' => trans('frontend/'.$module.'.phone'),'class' => 'form-control' )) !!}

        </div>
    </div>

    <div class="form-group">
        <label class="col-lg-3 control-label">{{ trans('frontend/'.$module.'.email')}} :</label>
        <div class="col-lg-8">

            {!! Form::text('email', null, array('placeholder' => trans('frontend/'.$module.'.email'),'class' => 'form-control' )) !!}

        </div>
    </div>

    <div class="form-group">
        <label class="col-lg-3 control-label">{{ trans('frontend/'.$module.'.website')}} :</label>
        <div class="col-lg-8">

            {!! Form::text('website', null, array('placeholder' => trans('frontend/'.$module.'.website'),'class' => 'form-control' )) !!}

        </div>
    </div>

    <div class="form-group">
        <label class="col-lg-3 control-label">           {{ trans('frontend/'.$module.'.comment')}} :</label>
        <div class="col-lg-8">


            {!! Form::textarea('comment', null, array('placeholder' => trans('frontend/'.$module.'.comment'),'class' => 'form-control' )) !!}

        </div>
    </div>







    <div class="form-group">
        <label class="col-md-3 control-label"></label>
        <div class="col-md-8">
            <input type="submit" class="btn btn-primary" value="{{trans('button.save')}}">
            <a class="btn btn-danger pull-left" href="{{ route('contact.index') }}"> {{trans('button.cancel')}}</a>


        </div>
    </div>
    {!! Form::close() !!}

    <!-- End Section Main Content -->
@endsection

 