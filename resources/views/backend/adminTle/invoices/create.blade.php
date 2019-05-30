@extends(Config::get('back_theme').'.layouts.app')

@section('htmlheader_title')
{{ trans('backend/main.new') }}
@endsection

@section('contentheader_title')
{{ trans('backend/main.new') }}

@endsection

@section('contentheader_description')
@endsection

@section('previous_breadcrumb')
{{ trans('backend/main.invoices') }}
@endsection
<!--breadcrumb current page-->
@section('current_breadcrumb')
{{ trans('backend/main.new') }}
@endsection


@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
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

<div class="pag">
	<div class="row" id="customer-row">
    {!! Form::open(['route'=>'admin::invoices.store']) !!}
        <div class="col-md-6 col-xs-12">
            <div class="form-group has-feedback ">
                <label for="user_id" class="control-label">{{trans('backend/main.client')}} :</label>{{-- trans('backend/main.user_id')--}}
                <select class="form-control" name="user_id" id="user_id">
                    {!! old('user_id') ? '<option value=' . old('user_id') . ' selected ="selected">' . old('user_name') . '</option>':''!!}
                </select>
                <input type="hidden" name="user_name" id="user_name" value="{{old('user_name')? old('user_name') : ''}}">
                <input type="hidden" name="user_id_" id="user_id_" >

            </div>
            <div class="form-group has-feedback ">
                <label for="address" class="control-label">{{trans('backend/main.address')}} :</label>{{-- trans('backend/main.address')--}}
                <textarea rows="8" class="form-control" type="text" name="address" id="address" style="height: 103px;">{{old('address')? old('address') : ''}}</textarea>
              <input type="hidden" name="user_address_id" id="user_address_id">
            </div>
        </div>
        <div class="col-md-6 col-xs-12">
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <div class="form-group has-feedback ">
                        <label for="serial_number" class="control-label">{{trans('backend/main.inv_no')}} :</label>
                        <input class="form-control" type="text" name="serial_number" id="invoice_number" value="{{$invoice_serial_number}}"  readonly >
                        <input type="hidden" name="invoice_number_secure" value="{{$invoice_serial_number}}">
                        <span class="fa fa-hashtag fa-fw form-control-feedback"></span>
                    </div>
                </div>
                <div class="col-md-6 col-xs-12">
                    <div class="form-group has-feedback ">
                        <label for="price_plan" class="control-label">{{trans('backend/main.plan')}} :</label>
                        {{Form::select('price_plan',$price_plans,null,['class'=>"form-control",'id'=>'price_plan'])}}
                        <span class="fa fa-hashtag fa-fw form-control-feedback"></span>
                    </div>
                </div>
        	</div>
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <div class="form-group has-feedback ">
                        <label for="invoice_date" class="control-label">{{trans('backend/main.inv_date')}} :</label>{{-- trans('backend/main.inv_date')--}}
                        <input class="form-control" type="text" name="invoice_date" id="invoice_date" placeholder="mm/dd/yyyy" value="{{\Carbon::now()->format('Y-m-d')}}" >
                        <span class="fa fa-calendar fa-fw form-control-feedback"></span>
                    </div>
                </div>
                <div class="col-md-6 col-xs-12">
                    <div class="form-group has-feedback ">
                        <label for="due_date" class="control-label">  {{  trans('backend/main.due_date') }} :</label>
                        <input class="form-control" type="text" name="due_date" id="payment_day" placeholder="yyyy-dd-mm" value="{{\Carbon::now()->endOfMonth()->format('Y-m-d')}}" >
                        <span class="fa fa-calendar fa-fw form-control-feedback"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="row" style="padding-left: 15px;margin-right: 0;margin-left: 0;padding-right: 15px;">
                    <h4>{{ trans('backend/main.duration')}}</h4>
                    <hr style="margin-bottom: 10px;">
                </div>
                <div class="col-md-6 col-xs-12">
                    <div class="form-group has-feedback ">
                        <label for="from_date" class="control-label">{{ trans('backend/main.from')}} :</label>
                        <input class="form-control" type="text" name="from_date" id="from_date" placeholder="mm/dd/yyyy" value="{{\Carbon::now()->format('Y-m-d')}}" >
                        <span class="fa fa-calendar fa-fw form-control-feedback"></span>
                    </div>
                </div>
                <div class="col-md-6 col-xs-12">
                    <div class="form-group has-feedback ">
                        <label for="to_date" class="control-label"> {{ trans('backend/main.to')}} :</label>
                        <input class="form-control" type="text" name="to_date" id="to_date" placeholder="yyyy-dd-mm">
                        <span class="fa fa-calendar fa-fw form-control-feedback"></span>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <hr>
    <div class="row" style="margin-top: 15px;">
                <div class="col-md-12 col-xs-12">
                    <button class="btn btn-success btn-md pull-right" type="submit"><i class="fa fa-plus"></i> {{trans('backend/main.add')}}</button>
                </div>
    </div>
    {!! Form::close() !!}
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
    .content-wrapper, .right-side , .wrapper{
        background-color: #EBEFF2 !important;
    }
   	.pag{
        margin-top: 50px;
        border: 1px solid #DDD;
        padding: 20px 20px;
        background-color: #FFF;
        border-radius: 5px;
        box-shadow: 5px 5px 5px #999;
    }
    .select2-selection.select2-selection--single,
    .select2-dropdown.select2-dropdown--below,
    select,input,textarea{
    	border: 1px solid #768188 !important;
    }
    .select2-container .select2-selection--single .select2-selection__rendered {
            line-height: 32px !important;
            padding-right: 5px !important;
            font-size: 14px;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: 3px;
        }
        .select2-container--open .select2-dropdown--above {
            padding: 0;
        }
        textarea.form-control{
            max-height: 103px;
            min-height: 103px;
            min-width: 100%;
            max-width: 100%;
        }
        .select2-search__field{
        	font-size: 20px !important;
        }
        .select2-results__option,input,textarea,label{
        	font-size: 15px !important;
        }


</style>
@endsection

@section('page-scripts')

<script src="{{URL::to('').Config::get('assets_frontend')}}/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="plugins/select2/select2.full.min.js"></script>
<script src="plugins/iCheck/icheck.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/select/1.2.4/js/dataTables.select.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.0/js/buttons.bootstrap.min.js"></script>

<script type="text/javascript">
	$(function(){

		$('select').select2();

		$('.breadcrumb .prev').toggle();
        $('.breadcrumb .prev a').click(function (e) {
            e.preventDefault();
            e.stopPropagation();
            window.location.href = "{{route('admin::invoices.index')}}";
        });

        $('#delivery_date,#payment_day,#invoice_date').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'yyyy-mm-dd'
        });

        var opts = {
        language: {
            inputTooShort: function(args) {
                // args.minimum is the minimum required length
                // args.input is the user-typed text
                return "Enter at least " + args.minimum + " chars";
            },
            inputTooLong: function(args) {
                // args.maximum is the maximum allowed length
                // args.input is the user-typed text
                return "You typed too much";
            },
            errorLoading: function() {
                return "Error while loading more results";
            },
            loadingMore: function() {
                return "load more results";
            },
            noResults: function() {
                var element = document.getElementById("select2-user_id-results");
                if (element != null){

                    return "No Results";

                }
           },
            searching: function() {
                return "Searching ...";
            },
            maximumSelected: function(args) {
                // args.maximum is the maximum number of items the user may select
                return "Error while loading";
            }
        }
    };

        $("#user_id").on("select2:open", function() {
            $(".select2-search__field").attr("placeholder", "Search");
        });
        $("#user_id").select2({
            language: opts.language ,
            tags: false,
            dir: "ltr",
            multiple: false,
            tokenSeparators: [',', ''],
            minimumInputLength: 1,
            minimumResultsForSearch: 10,
            ajax: {
                url: "{{route('admin::get_user_json') }}" ,
                dataType: "json",
                type: "GET",
                data: function (params) {

                    var queryParameters = {
                        text: params.term
                    }
                    return queryParameters;
                },
                processResults: function (data) {
                  //console.log(data);

                    return {
                        results: $.map(data, function (item) {

                            return {
                                text: item.name ,
                                id: item.id
                            }
                        })
                    };
                }

            }

        });

        $("#user_id").on('change',function () {
        //  console.log($(this).val());
            getAddressById($(this).val());
            $('#user_id_').val($(this).val());

        });

        function getAddressById(id) {
	        var e = document.getElementById("user_id");
	        var userID = id || e.options[e.selectedIndex].value;
	        var userName = e.options[e.selectedIndex].text;
	        $('#user_name').val(userName);
	        $('#test').val(userID);
	        var url = '{{ route("admin::get_one_user_address", ":user_id") }}';
	        url = url.replace(":user_id", userID);
	        $('span#get_address').addClass('hidden');
	        $('#address').val('');
	        $('.printInvoice #user_address').val('');
	        $('.printInvoice .user_address').val('');
	        $.ajax({
	            url : url
	        }).done(function (data) {
            var item = data.split('|');
          //  console.log(item);
        //    console.log(partsOfStr[1]);
	            $('#address').val(item[0]);
              $('#user_address_id').val(item[1]);
	           $('.printInvoice #user_address').val(data);
	            $('.printInvoice .user_address').val(data);
	            $('span#get_address').removeClass('hidden');

	        }).fail(function () {
	            $('span#get_address').addClass('hidden');
	        });
    	}

      $('#price_plan').on('change',function(){
      // console.log("in select");
          console.log($('#price_plan').val());
          if($(this).val()!='')
          {
          $.get('/backend/invoices/todate/'+$('#invoice_date').val()+'/'+$(this).val(),function(data){
  //  console.log(date);
       $('#to_date').val(data.result);

          });
        }

      });


	});
</script>

@endsection
