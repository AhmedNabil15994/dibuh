@extends(Config::get('front_theme').'.layouts.default')


@section('title',$page_title)

@section('page-styles')

    
    <link href="plugins/bootstrap-table/css/bootstrap-table.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.0/css/buttons.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.4/css/select.bootstrap.min.css">
    <style>
    thead tr th , tbody tr td{text-align: center}
    tbody tr td a {display:block !important;vertical-align: middle;margin-bottom:5px;color:#797979;    font-weight: 500;
    -webkit-transition: color .2s ease-in-out ;
    -moz-transition: color .2s ease-in-out ;
    transition: color .2s ease-in-out ;}
    tbody tr td a:hover{
        color:#111;
    }
     .header-print{margin-top: 75px;}

    @media print {@page {size: landscape}
       .wrapper{padding-top: 0px !important}
        .header-print,.panel{margin-top: 0px; !important}
        .container{width: 100% !important}
        .page-panel .panel-body .pbody,.card-box{padding: 0px}
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
    #navigation{
        position:relative !important;
    }

  

    @media (max-width:690px){
        .subnav li a{
            padding-left:6px !important;
            padding-right:6px !important;
         /*content:none !important;*/
     }
    }
    @media (max-width:611px){
        .subnav{
            
        /*display:inline-flex;*/
    }
    .subnav li {
        float:right !important;
        width:25%;
     }
      .subnav li a:before{
         content:none !important;
     }
        .subnav li a{
           font-size:13px !important;
         /*content:none !important;*/
     }
    }
    .col-sm-5{
        display:inline-block;
        text-align:right;
        width:40%;
    }
    

    .col-sm-7 {
    padding:0;
    width: 60%;
    vertical-align: top;

    display: inline-block;
    }
    @media(max-width: 767px){
        form .btn-danger{
            display: inline-block;
        }
        table td , table th{
            width: 150px !important;
        }
        .page-panel .panel-body .pbody .table > thead > tr > th{
            width: 150px !important;
        }
        .page-panel .panel-body .pbody .table>tbody>tr>td{
            width: 150px !important;
        }
    }

    .show-filter{
    padding-top: 5px;
    padding-bottom: 8px;

    }

    .detail-btn{
        width:auto;
        margin-bottom:5px;
    }
        
        .btns{
            padding-top:6px;
        }
        tbody td:last-child{
            padding: 0;
    text-align: center;
    margin-top:5px;
        }

      .table{
          width:100%;
      }     
      .tabel thead
      {
    font-size: 11px;

      }
      .entries{
        padding-top: 15px;

      }

      .table >thead > tr > th , .table >tbody> tr > td{
          text-align:center !important;
      }
    /*mobile responsive */
    @media (max-width:768px){

        .table > thead >tr>th{
        font-size:11px;
        padding-left: 0;
        
      }
      .table > tbody > tr > td{
          font-size: 13px;
      }
      
      
      
    }


    
     @media (max-width:552px){
      .page-panel .panel-heading  ul.panel-nav li .al {
            font-size:13px;
        padding-right:6px !important;
      padding-left:6px !important;
   
          }
          .btns a , .btns form button {
              font-size:11px !important;
          }
          .table > thead >tr>th{
        font-size:10px;
        padding-right:0!important;
        padding-left:0 !important;

      }
      .table > tbody > tr > td{
padding-right:0!important;
        padding-left:0 !important;
                  font-size: 12px;
      }

      #btnFilter ,.pull-right .export button{
            padding: 4px 6px !important;

      }

    #demo-foo-filtering_info , #demo-foo-filtering_paginate{
        font-size:12px;
    }  
    .pagination li a {
        padding:6px;
    }
    }
    
    @media (max-width:465px){
        .page-panel .panel-heading  ul.panel-nav li .al {
            font-size:12px;

            padding-right:4px !important;
      padding-left:4px !important;
        
            
        }
        .btns a , .btns form button {
              font-size:10px !important;
          }

        
          .table > thead >tr>th{
        font-size:9px;

      }
      .table > tbody > tr > td{
          text-align:center;
          font-size: 11px;
      }

            #btnFilter ,.pull-right .export button{
            padding: 2px 4px !important;

      }
    }

    
    @media (max-width:410px){
        .col-sm-5{
        font-size:12px !important;
    }
    

    .col-sm-7 {
        font-size:12px !important;
    }
        .page-panel .panel-heading  ul.panel-nav li  .al {
            font-size:10px;
            
        }
       
    }

    
    @media (max-width:359px){
         .col-sm-5{
        font-size:11px !important;
    }
    

    .col-sm-7 {
        font-size:11px !important;
    }
        .page-panel .panel-heading  ul.panel-nav li  .al {
            font-size:9px;
            
        }
        #demo-foo-filtering_info , #demo-foo-filtering_paginate{
        font-size:10px;
    } 
        

    }

    @media (max-width:335px){
        .page-panel .panel-heading  ul.panel-nav li  .al {
            /*font-size:9px;*/
                
            padding-right:3px !important;
      padding-left:3px !important;
        }



    
    </style>
@endsection()



@section('subnav')
    @include(Config::get('front_theme').'.dashboard.'.$userType.'.report.inc.subnav')
@endsection




@section('content')



 

    <div class="row m-b-20 header-print" >
        <div class="col-xs-12 ">
            <h4 class="page-title">{{trans('frontend/sales_invoice.reports')}}</h4>
        </div>
    </div>

    <div class="panel panel-default page-panel">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-5 pull-right " style="padding: 0">

                    <button id="btnFilter" type="button" class="btn btn-default waves-effect waves-light pull-right" style="margin: 0 5px;"><i class="md md-filter-list"></i>{{trans('button.filter')}}  </button>

                    <div class="btn-group pull-right export">
                        <button type="button" class="btn btn-default dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-upload"></i> {{trans('button.export')}}  <span class="caret"></span> </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">PDF File</a></li>
                            <li><a href="#">Excel File</a></li>
                            <li><a href="#">Csv File</a></li>
                            <li><a href="#">Html File</a></li>
                        </ul>
                    </div>
                </div>
                <ul class="panel-nav pull-left">
                    <li><a class="" id="state-draft"  href="{{route('report.invoice')}}">{{trans('frontend/sales_invoice.clients' )}}</a></li>
                    <li><a class="active"       id="state-unpaid" href="{{route('report.invoice2')}}">{{trans('frontend/sales_invoice.suppliers')}}</a></li>
                </ul>
            </div>
        </div>
        <div class="panel-body">
            <div class="filter" style="display: none">
               <div class="row ">
                
                   <div class="col-md-2 col-xs-12">
                       <div class="form-group has-feedback ">
                           <label for="filterCustomer" class="control-label">{{trans('frontend/dashboard.customer'  )}}  :</label>{{-- trans('frontend/sales_invoice.contact_id')--}}
                           <select class="form-control" name="filterCustomer" id="filterCustomer">
                            
                           </select>
                       </div>
                   </div>
                   <div class="col-md-2 col-xs-12">
                       <div class="form-group has-feedback ">
                           <label for="filterInvoice_date" class="control-label">{{trans('frontend/dashboard.invoice_date'  )}} :</label>
                           <input  class="form-control" type="text" name="filterInvoice_date" id="filterInvoice_date" placeholder="mm/dd/yyyy" value="">
                           <span class="fa fa-calendar fa-fw form-control-feedback"></span>
                       </div>
                   </div>
                   <div class="col-md-2 col-xs-12">
                       <div class="form-group has-feedback ">
                           <label for="filterPayment_day" class="control-label">{{trans('frontend/dashboard.received_date'  )}}:</label>
                           <input class="form-control" type="text" name="filterPayment_day" id="filterPayment_day" placeholder="mm/dd/yyyy" value="" data-date="">
                           <span class="fa fa-calendar fa-fw form-control-feedback"></span>
                       </div>
                   </div>
                   <div class="col-md-2 col-xs-12">
                       <div class="form-group has-feedback ">
                           <label for="filterInvoiceNumber" class="control-label">{{trans('frontend/dashboard.invoice_number')}}:</label>
                           <input class="form-control" type="text" name="filterInvoiceNumber" id="filterInvoiceNumber" value="" >
                           <span class="fa fa-tags fa-fw form-control-feedback"></span>
                       </div>
                   </div>
                   <div class="col-md-2 col-xs-12">
                       <div class="form-group-without-label">
                           <button type="button" id="btnClearFilters" class="btn btn-white waves-effect ">
                               {{trans('button.cancel_input'  )}}
                           </button>
                           <button type="button" id="btnOkFilters" class="btn btn-white waves-effect "><i class
                               
                           ="fa fa-search"></i></button>
                       </div>

                   </div>
                   
               </div>
            </div>
            <div class="pbody table-responsive">
                <div class="BoxContent">
                  <table class="table table-hover daTatable dataTable" id="reports-table">
                    <thead>
                      <tr>
                          <th>{{trans('frontend/contact.company')}}</th>
                          <th>{{trans('frontend/sales_invoice.date')}}</th>   
                          <th>{{trans('frontend/sales_invoice.due_date')}}</th>   
                          <th>{{trans('frontend/sales_invoice.final_cost')}}</th>
                          <th>{{trans('frontend/sales_invoice.rest')}}</th>    
                      </tr> 
                    </thead>

                    <tbody>
                      @if(count($test))
                        
                          @foreach ($test as $row)
                        <?php 
                            $final_cost = \DB::table('costs')->where('user_id','=',Auth::user()->id)->whereIn('invoice_status_id',array(2,3,5))->where('contact_id','=',$row->contact_id)->sum('total_invoice');

                            $rest = \DB::table('costs')->where('user_id','=',Auth::user()->id)->whereIn('invoice_status_id',array(2,3,5))->where('contact_id','=',$row->contact_id)->sum('rest');

                        ?>
                          <tr class="main" data-toggle="collapse" data-target=".order{{$row->id}}"> 
                            <td style="margin-bottom: 15px; color: #5fbeaa !important;font-weight: bold;font-size: 15px;position: relative;">
                            <i class="fa fa-arrow-left" style="position: absolute;right: 35px;color: #999;"></i>{{$row->contact_name}} -- {{$row->company}}</td>
                            <td></td>
                            <td></td>
                            <td>{{$final_cost}}</td>
                            <td>{{$rest}}</td>
                          </tr>
                          <?php 
                              $id = \DB::table('contacts')->where('company','LIKE',$row->company)->where('user_id','=',Auth::user()->id)->pluck('id');
                              $sales;
                              for ($i=0; $i < count($id) ; $i++) { 
                                $sales = \DB::table('costs')->where('contact_id' , '=' , $id[$i])->whereIn('invoice_status_id',array(2,3,5))->where('user_id','=',Auth::user()->id)->get();?>
                                @foreach($sales as $one)
                                <tr class="collapse order{{$row->id}}">
                                  <td><a href="{{route('cost.show',$one->id)}}" style="color: #000;">{{trans('frontend/reports.invoice_number')}} {{$one->invoice_number}}</a></td>
                                  <td>{{$one->invoice_date}}</td>
                                  <td>{{$one->due_date}}</td>
                                  <td class="sub-all">{{$one->total_invoice}}</td>
                                  <td class="sub-rest">{{$one->rest}}</td>
                                </tr>
                                @endforeach  
                                
                          <?php } ?>   
                          
    
                        @endforeach                 
                        
                      @endif()
                    </tbody>
                  
                      
                      @if(!count($test))
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
                </table>
                </div>
            </div>
        </div>
        
    </div>

    
    





@endsection

@section('page-scripts')
    

    <script src="plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

		<script src="plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>


    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.2.4/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.0/js/buttons.bootstrap.min.js"></script>

   
	 <script>
	       jQuery(document).ready(function($) {
              $('#reports-table tr.main').each(function(){
                  $(this).on('click',function(){
                    icon = $(this).find('i.fa');
                    icon.toggleClass('fa-arrow-down');
                  });
              });
              //$('#reports-table').DataTable(); 
              $(document).on('click','.btn-danger',function(){
                location.reload();
              });

	            $( "#btnFilter" ).click(function() {
	                $( ".filter" ).slideToggle( 200, function() {

	                });
	            });

               @if(!count($test))
                $('#datatable_wrapper').hide();
               @endif 

	           $('#start-date , #end-date').datepicker({
	               autoclose: true,
	               todayHighlight: true
	           });

	           $('#btnClearFilters').click(function () {
	                $('#filterSearch,#filterCustomer,#start-date,#end-date,#filterTags').val('');
	                $('#filterSearch').focus();
	           });

	           $('#state_all,#state_Save,#state_Bank').click(function () {
	               if ($(this).hasClass('active')){
	                   return void (0);
	               }else{
	                   $('.page-panel .panel-heading .panel-nav a.active').removeClass('active');
	                   $(this).addClass('active');
	                   getData(null , $(this).attr('link'));
	               }

	           });


	           


	        });
	    </script>

@endsection
 
 

 