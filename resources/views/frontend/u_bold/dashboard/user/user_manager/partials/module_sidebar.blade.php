<Style>


.sidebar{
    float: right !important;
    padding-right: 0 !important;
}

.tabs{
    padding: 0 ;
    /*float:right;*/
    /*background-color: #f5f5f5;*/
}

.tabs .tab-switch li{
background-color: #333;
color: #fff;
border-bottom: 1px solid #fff;
height: 60px;
line-height: 60px;
font-size: 15px;
cursor: pointer;
}
.tabs .tab-switch li.selected , .tabs .tab-switch li:hover{
    background: #5fbeaa !important;
}
.tabs-content{
    /*float:left;*/
    width:100%;
}
.tabs-content h3{
    margin-top: 0;
    font-weight: bold;
    letter-spacing: -1px;
    margin-bottom: 30px;
}
.tabs-content .lead{
color: #c8c8ca;
line-height: 1.8;
font-size: 16px;
}
.tabs-content button{
    background-color: #5fbeaa;
    color: #fff;
}



		.tab-content{
			display: none;
		
		}

		.tab-content.current{
			display: block;
            }

.tab-content{
    box-shadow:none !important;
    padding-top:30px;
}

body{
direction:rtl;
}
.myForm{
    padding-right:10px;
    padding-left:10px;
}
.mylabel{
    padding-right:0 !important;
    font-size: 15px ;
    font-weight: bold;
    text-align:center;
}

@media(max-width:768px){
   
   .mylabel{
    /*padding-left: 1% !important;*/
    font-size: 14px ;
    /*font-weight: normal;*/
} 
}

@media(max-width:650px){
   .mylabel{
    font-size: 12px ;

} 
}


.myInput{
    width:60% !important;
}

.myInput-pass{
    width: 35% !important;
}
@media (max-width:1249px){
    
}
.btns 
{
    width: 76% !important;


}
.btnspass{
    text-align:center;
        margin-right: 6%;

}
.submitt,.cancel{
    display: inline-block;
   
    margin-bottom: 0;
    font-size: 15px;
    font-weight: 400;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    border-radius:10px;
}
.submitt{
    padding: 6px 50px ;
}
.cancel{
    padding: 6px 40px ;
    
}
.shadow{box-shadow:0 2px 1px 0px #ccc !important;}
/*.container{
    width:100% !important;
}*/
.board{
height: 500px;
background: #fff;
/*box-shadow: 10px 10px #ccc,-10px 20px #ddd;*/
}
.board .nav-tabs {
    padding-right: 50px;
    position: relative;
    margin-bottom: 0;
    box-sizing: border-box;

}

.board > div.board-inner{
    background: #fafafa url(http://subtlepatterns.com/patterns/geometry2.png);
    background-size: 30%;
}

p.narrow{
    width: 60%;
    margin: 10px auto;
}

.liner{
    height: 2px;
    background: #ddd;
    position: absolute;
    width: 89%;
    margin: 0 auto;
    left: 0;
    right: 0;
    top: 50%;
    z-index: 1;
}

.nav-tabs>li.active>a, .nav-tabs>li.active>a:hover, .nav-tabs>li.active>a:focus{
    border:none !important;
}
/*.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
    color: #555555;
    cursor: default;
    border: 0;
    border-bottom-color: transparent;
}*/

span.round-tabs{
    width: 70px;
    height: 70px;
    line-height: 70px;
    display: inline-block;
    border-radius: 100px;
    background: white;
    z-index: 2;
    position: absolute;
    left: 0;
    text-align: center;
    font-size: 25px;
}

span.round-tabs.one{
    color: rgb(34, 194, 34);
    border: 2px solid rgb(34, 194, 34);
}


li.active span.round-tabs.one{
    background: #fff !important;
    border: 2px solid #ddd;
    color: rgb(34, 194, 34);
}

span.round-tabs.two{
    color: #febe29;border: 2px solid #febe29;
}

li.active span.round-tabs.two{
    background: #fff !important;
    border: 2px solid #ddd;
    color: #febe29;
}

span.round-tabs.three{
    color: #3e5e9a;border: 2px solid #3e5e9a;
}

li.active span.round-tabs.three{
    background: #fff !important;
    border: 2px solid #ddd;
    color: #3e5e9a;
}

span.round-tabs.four{
    color: #f1685e;border: 2px solid #f1685e;
}

li.active span.round-tabs.four{
    background: #fff !important;
    border: 2px solid #ddd;
    color: #f1685e;
}

span.round-tabs.five{
    color: #999;border: 2px solid #999;
}

li.active span.round-tabs.five{
    background: #fff !important;
    border: 2px solid #ddd;
    color: #999;
}



.nav.nav-tabs > li.active > a , .nav.nav-tabs > li > a {
    background-color: transparent !important;
}
.nav-tabs > li {
    width: 20%;
}

/*.nav-tabs > li:after {
    content: " ";
    position: absolute;
    left: 45%;
   opacity:0;
    margin: 0 auto;
    bottom: 0px;
    border: 5px solid transparent;
    border-bottom-color: #ddd;
    transition:0.1s ease-in-out;
    
}
.nav-tabs > li.active:after {
    content: " ";
    position: absolute;
    left: 45%;
   opacity:1;
    margin: 0 auto;
    bottom: 0px;
    border: 10px solid transparent;
    border-bottom-color: #ddd;
    
}*/
.nav-tabs > li a{
   width: 70px ;
   height: 70px ;
   line-height: 70px;
   margin: 20px auto;
   border-radius: 100%;
   padding: 0;
}

.nav-tabs > li a:hover{
    background: transparent;
}


.tab-pane{
position: relative;
padding-top: 50px;
}
.tab-content .head{
    font-family: 'Roboto Condensed', sans-serif;
    font-size: 25px;
    text-transform: uppercase;
    padding-bottom: 10px;
}
.btn-outline-rounded{
    padding: 10px 40px;
    margin: 20px 0;
    border: 2px solid transparent;
    border-radius: 25px;
}

.btn.green{
    background-color:#5cb85c;
    /*border: 2px solid #5cb85c;*/
    color: #ffffff;
}

#profile{
    text-align:center;
}



@media(max-width : 500px){
    .myInput-pass{
        width:80% !important;
            margin-right: 20px;

    }
    .submitt{
    padding: 6px 15px !important;
    font-size:13px;
    font-weight:normal;
}

.cancel{
    padding: 6px 7px !important;
    font-size:13px;
    font-weight:normal;
    
    
    
}

span.round-tabs {
font-size:16px !important ;
width: 30px  !important;
height: 30px  !important;
line-height: 30px !important;
}
    .nav-tabs > li a {
width: 30px  !important;
height: 30px  !important;
line-height:30px  !important;
}
}


@media(max-width : 768px){
  
    .btns{
            margin-left: 4%;

    }
    .myInput{
    width:80% !important;
}
  .myInput-pass{
        width:50% !important;
}

.submitt{
    padding: 6px 30px ;
}
.cancel{
    padding: 6px 20px ;
    
}
.submitpass , cancelpass{
    padding-left: 6px !important;
    padding-right: 6px !important;
}

    span.round-tabs {
font-size:16px ;
width: 50px ;
height: 50px ;
line-height: 50px;
    }


    .board .nav-tabs{
        padding-right:0;
    }    


.tab-content .head{
        font-size:18px ;
        }
    .nav-tabs > li a {
width: 50px ;
height: 50px ;
line-height:50px ;
}

/*.nav-tabs > li.active:after {
content: " ";
position: absolute;
left: 5% !important;
    top: 86%;
;
}*/

.btn-outline-rounded {
    padding:12px 20px;
    }
}
.tab-content .head{
        font-size:20px;
}
    .nav-tabs > li a {
width: 50px;
height: 50px;
line-height:50px;
}

.nav-tabs > li.active > a span.round-tabs{
    margin-top: 20px !important;
    background:#5fbeaa !important;
}

.btn-outline-rounded {
    padding:12px 20px;
    }
}


 
</style>
<div class="col-md-12">
           <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<!--start tabs-->
<div class="tabs">
  <div class="container">
    <div class="row">
      <div class="col-md-2 sidebar">
        <ul class="list-unstyled tab-switch text-center upperCase">
          <li class="selected" data-tab="tab-one">Profile</li>
          <li data-tab="tab-two">Address</li>
          <li data-tab="tab-three">Bank Account</li>
          <li data-tab="tab-four">Change Password</li>
          
        </ul>
      </div>
      <div class="col-md-9">
        <div class="tabs-content">
            <div id="tab-one" class="tab-content current">
            <form class="myForm">

            <div class="form-group row">
                        
                    <div class="col-xs-10">
                     <input name="fname" type="text" class="shadow myInput form-control" id="fname" >
                    </div>
                    
                    <label for="fname" class="col-xs-2 mylabel col-form-label">First Name</label>
                    </div>


                     <div class="form-group row">
                        <div class="col-xs-10">
                        <input name="lname" type="text" class=" shadow form-control myInput" id="lname">
                               
                        </div>
                    <label for="lname" class="col-xs-2 mylabel col-form-label">Last Name</label>

                    </div>
                    
                    <div class="form-group row">
                        <div class="col-xs-10">
                        <input name="myCompany" type="text" class="shadow form-control myInput" id="company" >
                        </div>
                    <label for="company" class="col-xs-2 mylabel col-form-label">Company</label>

                    </div>

                    <div class="form-group row">
                        <div class="col-xs-10">
              <input name="phone" type="number" class="shadow form-control myInput" id="phone" >
                        </div>
                        <label for="phone" class="col-xs-2 mylabel col-form-label">Phone</label>
                    
                    </div>

                                   

                    <div class="form-group row">
                        <div class="col-xs-10">
                    <input name="fax" type="text" class="shadow form-control myInput" id="fax">
                    </div>
                        <label for="fax" class="col-xs-2 mylabel col-form-label">Fax</label>

                    </div>   




                    <div class="form-group row">
                        <div class="col-xs-12 btns ">
                            <button type="submit" class="submitt btn-primary waves-effect waves-light">
                           Save </button>
                           <a class="btn-danger cancel waves-effect waves-light" href="">Cancel</a>   
                        </div>
                        
                    </div>

            </form>
            

          </div>
          <!--end tab one -->
           <div id="tab-two" class="tab-content"><div>
               
               </div>aasdasd</div>
            
           <div id="tab-three" class="tab-content">Tab Three</div>
           <div id="tab-four"  class="tab-content">


                                   <form class="myForm" method="post">
                        <i class="img-intro icon-checkmark-circle"></i>

                        <div class="form-group row">
                        <div class="col-xs-10">
              <input name="currentPass" type="password" class="shadow form-control myInput-pass" id="currentPass" >
                        </div>
                        <label for="currentPass" class="col-xs-2 mylabel col-form-label">Current Password</label>
                    
                    </div>


                         <div class="form-group row">
                        <div class="col-xs-10">
              <input name="newPass" type="password" class="shadow form-control myInput-pass" id="newPass" >
                        </div>
                        <label for="newPass" class="col-xs-2 mylabel col-form-label">New Password</label>
                    
                    </div>

                                   

                    <div class="form-group row">
                        <div class="col-xs-10">
                    <input name="confirmPass" type="password" class="shadow form-control myInput-pass" id="confirmPass">
                    </div>
                        <label for="confirmPass" class="col-xs-2 mylabel col-form-label">Confirm Password</label>

                    </div>   




                    <div class="form-group row myInput">
                        <div class="btnspass">
                            <button type="submit" class="btn  submitpass btn-primary waves-effect waves-light">
                           Confirm </button>


                            <button type="submit" class="btn cancelpass btn-danger waves-effect waves-light">
                           Cancel </button>
                      
                   
                    </div>
            </form>

           </div>
          </div>
         </div> 
     </div>
      </div>
     
</div>

<script>
    // $(function(){
    // $('a[title]').tooltip();
    // });

      $(function() {

        $('.tab-switch li').click(function(){
            // get id of tab selected
		var tab_id = $(this).attr('data-tab');

		$('.tab-switch li').removeClass('current');
		$('.tab-switch li').removeClass('selected');
        
		$('.tab-content').removeClass('current');

		$(this).addClass('current');
		$(this).addClass('selected');
        
		$("#"+tab_id).addClass('current');
	})

    // $('.tab-switch li').click(function() {
    //   //add active class
    //   $(this).addClass('selected').siblings().removeClass('selected');
    //   //hide all dives

    //   $(' .tabs .tabs-content').hide();
      
      
    //   //show conected links
    //   $('.'+ $(this).data('class')).show();
    // //   console.log($('.'+ $(this).data('class')));
    // });
    });

  
</script>   