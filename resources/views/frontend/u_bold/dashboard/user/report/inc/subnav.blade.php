<li><a class="{{Active('report.main')}}" href="{{Active('report.main') ? 'javascript:void(0)' :  route('report.main')}}">الميزان العام</a></li>
<li><a class="{{Active('operating_analysis.main')}}" href="{{Active('operating_analysis.main') ? 'javascript:void(0)' :  route('operating_analysis.main')}}">تحليل مصروفات عامة</a></li>
<li><a class="{{Active('General_administrative.main')}}" href="{{Active('General_administrative.main') ? 'javascript:void(0)' :  route('General_administrative.main')}}"> تحليل مصوفات تشغيل</a></li>
<li><a class="{{Active('report.invoice')}} {{Active('report.invoice2')}}" href="{{Active('report.invoice') ? 'javascript:void(0)' :  route('report.invoice')}}">الفواتير المفتوحة للعملاء والموردين</a></li>
<li><a class="{{Active('log.index')}} {{Active('log.income')}} {{Active('log.contact')}} {{Active('log.tax')}}" href="{{Active('log.index') ? 'javascript:void(0)' :  route('log.index')}}">{{trans('frontend/sales_invoice.log')}}</a></li>
<li><a class="{{Active('report.acc_overview')}}" href="{{Active('report.acc_overview') ? 'javascript:void(0)' :  route('report.acc_overview')}}">{{trans('frontend/reports.title')}}</a></li>
<li><a class="{{Active('report.prof_loss')}}" href="{{Active('report.prof_loss') ? 'javascript:void(0)' :  route('report.prof_loss')}}">{{trans('frontend/reports.title2')}}</a></li>



<style>

ul.subnav li a.active{
    font-weight:bold;
}

@media only screen and (max-width: 768px){

   
ul.subnav li a {
    padding:14px 6px !important;
}

}


@media only screen and (max-width:720px){

     ul.subnav li{
        display:inline-block;
    }




}




@media only screen and (max-width: 653px){

ul.subnav li a {
    padding:14px 4px !important;
    font-size:13px;
}


}


@media only screen and (max-width: 598px){

ul.subnav li a {
    padding:14px 2px !important;
    font-size:11px;
}


}


@media only screen and (max-width: 498px) and (min-width:300px){
ul.subnav{
    width:100%;
}
ul.subnav li  {
  width:30% ;
}


ul.subnav li:nth-child(3)  {
  width:35% ;
}
ul.subnav li:nth-child(4)  {
  width:50% ;
}

ul.subnav li a {
    padding:8px 2px !important;
}

ul.subnav li a.active:before {
 display:none;
}


}



</style>