@extends(Config::get('front_theme').'.layouts.default')


@section('title',$page_title)

@section('page-styles')
 <!--Form Wizard-->
        <link rel="stylesheet" type="text/css" href="plugins/jquery.steps/css/jquery.steps.css" />
        <link href="css/components.css" rel="stylesheet" type="text/css" />
 <style>
            .wizard > .steps > ul > li{width: 33.33%;}
            .check_groub{margin-right: 50px}
     .card-box{padding: 0px}
     .table>thead:first-child>tr:first-child>th{font-weight: normal; text-align: center}
     #steps-uid-0-p-1{width: 100%}
     .form-group{height: 25px}
     .top_right{font-size: 12px}
     .top_right p span{margin-left: 50px;}
     .top_right p:first-child {    margin-top: 30px;}
        </style> 

@endsection


 




@section('content')






<div class="wrapper">
            <div class="container">

               


                <!-- Basic Form Wizard -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-box">
                            <h4 class="m-t-0 header-title"><b>الضرائب</b></h4>
                            <p class="text-muted m-b-30 font-13">
                               متابعة الضرائب ..
                            </p>

                            <form id="basic-form" action="#">
                                <div>
                                    <h3>حدد فترة</h3>
                                    <section>
                                        <div class="row">
                                            <div class="col-xs-6 col-md-1" >
                                            <h4 class="text-center">شهر</h4><br>
                                            <div class="btn-group">
                                                <select class="btn btn-sm  btn-default dropdown-toggle waves-effect waves-light">
                                                    <option >1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                    <option>4</option>
                                                    <option>5</option>
                                                    <option>6</option>
                                                    <option>7</option>
                                                    <option>8</option>
                                                    <option>9</option>
                                                    <option>10</option>
                                                    <option>11</option>
                                                    <option>12</option>
                                            
                                                </select>
                                            </div>
                                            </div>
                                            <div class="col-xs-6 col-md-1">
                                            <h4 class="text-center">سنة</h4><br>
                                                <select class="btn  btn-sm  btn-default dropdown-toggle waves-effect waves-light">
                                                    <option>1990</option>
                                                    <option>1991</option>
                                                    <option>1992</option>
                                                    <option>1993</option>
                                                </select>
                                            </div>

                                        </div>

                                    </section>
                                    <h3>نظرة عامة</h3>
                                    <section>

                               
                                        
                      <div class="pbody table-responsive">
                         
                        
                                          
                <div class="BoxContent card-box">
                 
                         <div class="col-xs-6 ">
                           
                               <form class="form-horizontal" role="form">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">رقم المستند : </label>
                                            <div class="col-md-9">
                                                <input type="number" class="form-control" placeholder="123..">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" >رقم الجهة : </label>
                                            <div class="col-md-9">
                                                <input type="number"  class="form-control" placeholder="123..">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" >أسم الجهة :</label>
                                            <div class="col-md-9">
                                                <input type="text"  class="form-control" placeholder="اسم الجهه">
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" >عنوان الجهة :</label>
                                            <div class="col-md-9">
                                                <input type="text"  class="form-control" placeholder="عنوان الجهه">
                                            </div>
                                        </div>
                                         
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" >كود نوع الجهة : </label>
                                            <div class="col-md-9">
                                                <input type="number"  class="form-control" placeholder="123...">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" >تليفون الجهة :</label>
                                            <div class="col-md-9">
                                                <input type="tel"  class="form-control" placeholder="0123...">
                                            </div>
                                        </div>
                                        <p>( عام - خاص - أعمال - حكومة - نقابة - نادي - فرع أجنبي - هيئة عامة )</p>



                                    </form>

                         </div>
                          <div class="col-xs-6 top_right">
                              <p>السيد الأستاذ رئيس الإدارة العامة لمركز تجميع الخصم والإضافة والتحصيل تحت حساب الضريبة</p>
                              <p>____________________________________________________ بالقاهرة</p>
                              <p class="text-center">تحية طيبة وبعد</p>
                              <p>مرفق مع هذا شيك رقم (<span></span>)  بمبلغ  (<span></span>) </p>
                              <p>فقـط وقدره (<span></span>)  بتاريخ  / / - - 2</p>
                              <p>المسحوب على بنك : (<span></span>)  فرع : (<span></span>) </p>
                              <p>قيمة المبالغ المحصلة من الممولين طبقا للنموذج / والنماذج المرفقة وعددها (<span></span>)  نموذج</p>
                              
                          </div> 
                          
                         <table class="table table-hover table-bordered " id="demo-foo-filtering" data-page-size="6">
                        <thead>
                            <tr>
                               <th rowspan="2" style="line-height: 7;" >م</th>
                               <th rowspan="2"  ><p style="margin-bottom: 20px;">رقم التسجيل الضريبي</p></th>
                               <th rowspan="2"  ><p style="margin-bottom: 30px;">رقم الملف</p></th>
                               <th rowspan="2"  ><p style="margin-bottom: 30px;">اسم الممول</p></th>
                               <th rowspan="2"  style="line-height: 7;"  >العنــوان</th>
                                <th colspan="2">المأمورية المختصة</th>
                               <th rowspan="2"  ><p style="margin-bottom: 30px;" >تاريخ التعامل</p></th>
                                
                                <th colspan="2" >طبيعة التعامل وكودها</th>
                                <th rowspan="2"  ><p style="margin-bottom: 20px;" > القيمة الإجمالية للتعامل</p></th>
                                
                             <th colspan="2" >نوع الخصومات وكودها</th>
                                 <th rowspan="2"  ><p style="margin-bottom: 20px;"  >الهيئه الصافيه للتعامل</p></th>
                                 <th rowspan="2"  ><p style="margin-bottom: 30px;" >نسبة %</p></th>
                                 <th rowspan="2"  ><p style="margin-bottom: 20px;" >المحصل لحساب الضريبه</p></th>
                            </tr>
                            <tr>
                                <th>مأمورية</th>
                                <th>كود</th>
                                <th>ط. تعامل</th>
                                <th>كود</th>
                                <th> </th>
                                <th> </th>
                            </tr>
                        </thead>
                        <div class="tableBody">
                            <tbody>
                                <tr>
                                   <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                   <td>-</td>
                                   <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                   <td>-</td>
                                </tr>
                                
                                 <tr>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                   <td>-</td>
                                   <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                   <td>-</td>
                                </tr>
                                
                                 <tr>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                   <td>-</td>
                                   <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                   <td>-</td>
                                </tr>
                                
                                 <tr>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                   <td>-</td>
                                   <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                   <td>-</td>
                                </tr>
                                
                                 <tr>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                   <td>-</td>
                                   <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                   <td>-</td>
                                </tr>
                                
                                <tr>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                   <td>-</td>
                                   <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                   <td>-</td>
                                </tr>
                               <tr>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                   <td>-</td>
                                   <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                   <td>-</td>
                                </tr>
                                <tr>
                                  <td colspan="4" >تحريرا فى --/--/20--</td> 
                                  <td colspan="3" >الموظف المختص</td>
                                   <td colspan="4" >رئيس جهة العمل</td> 
                                  <td colspan="3">اجمالى القيمة</td>
                                  <td colspan="2"> </td>
                                </tr>
                           
                        </tbody>
                        
                          
                     
                    
                       
                   

                        </div>
                        
                        
             
                    </table>

                </div>
            </div>
                                       
                                       
                                    </section>

                                    <h3>نقل البيانات</h3>
                                    <section>
                                    
                                        <div class="radio radio-custom">
                                            <input type="radio" name="radio" id="radio1" checked>
                                            <label for="radio1">
                                                 حفظ ضريبة المبيعات
                                            </label>
                                        </div>
                                        
                                         <div class="radio radio-custom">
                                            <input type="radio" name="radio" id="radio2">
                                            <label for="radio2">
                                                ارسال ضريبه المبيعات 
                                            </label>
                                        </div>
                                      
                                     <div class="check_groub">
                                        <div class="checkbox checkbox-custom">
                                            <input id="checkbox" type="checkbox" >
                                            <label for="checkbox">
                                                سيتم تقديم الوثائق في وقت لاحق
                                            </label>
                                        </div>
                                        <div class="checkbox checkbox-custom">
                                            <input id="checkbox1" type="checkbox">
                                            <label for="checkbox1">
                                                سجل للتصحيح
                                            </label>
                                        </div>
                                        <div class="checkbox checkbox-custom">
                                            <input id="checkbox2" type="checkbox">
                                            <label for="checkbox2">
                                                طلب السداد
                                            </label>
                                        </div>
                                        <div class="checkbox checkbox-custom">
                                            <input id="checkbox3" type="checkbox">
                                            <label for="checkbox3">
                                                الخصم المباشر
                                            </label>
                                        </div>
                                        <div class="checkbox checkbox-custom">
                                            <input id="checkbox4" type="checkbox">
                                            <label for="checkbox4">
                                                اضافة او تغير معلومات
                                            </label>
                                        </div>
                                    </div>
                                        
                                        
                                    </section>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

                <!-- End row -->


           
                

                <!-- Footer -->
                <footer class="footer text-right">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-6">
                                .2016-UBold ©
                            </div>
                            <div class="col-xs-6">
                                <ul class="pull-right list-inline m-b-0">
                                    <li>
                                        <a href="#">About</a>
                                    </li>
                                    <li>
                                        <a href="#">Help</a>
                                    </li>
                                    <li>
                                        <a href="#">Contact</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- End Footer -->

            </div> <!-- end container -->
        </div>
    
    





@endsection

@section('page-scripts')
    
    <!--Form Wizard-->
        <script src="plugins/jquery.steps/js/jquery.steps.min.js" type="text/javascript"></script>
        
        
        
        
        <!--wizard initialization-->
        <script>


!function($) {
    "use strict";

    var FormWizard = function() {};

    FormWizard.prototype.createBasic = function($form_container) {
        $form_container.children("div").steps({
            headerTag: "h3",
            bodyTag: "section",
            transitionEffect: "slideLeft",
        });
        return $form_container;
    },
  
    FormWizard.prototype.init = function() {
        this.createBasic($("#basic-form"));
    },
    $.FormWizard = new FormWizard, $.FormWizard.Constructor = FormWizard
}(window.jQuery),

//initializing 
function($) {
    "use strict";
    $.FormWizard.init()
    
   // console.log('aa');
}(window.jQuery);
            

        
        </script>


@endsection
 
 

 