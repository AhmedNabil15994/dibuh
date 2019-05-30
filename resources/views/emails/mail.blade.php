<style type="text/css">
   
    .body > hr{
        border-style: dashed;
        border-width: .7px !important;
        border-color: #999;
        margin-bottom: 15px;
    }
    .main{
        width: 33.333333%;
        float: right;
    }
    .test{
		width: 100%;
		float: right;
	}
	.test2{
		background-color: #DDD;
		width: 75px;
		padding: 7px;
    	border-radius: 4px;
    	text-align: center;
	}
	.test2 a{
		text-decoration: none;
		color: #777;
		font-size: 15px;
	}

</style>
	<div class="body" style="direction: rtl; text-align: right;font-size: 14px;">
        <p>سيداتي وسادتي</p>
         <p style="display: inline-block;">سوف تتلقى الفاتورة {{$data['sales_invoice_number']}} ل {{$data['sales_invoice_rest']}} جنيه </p> <span>(انظر المرفق).</span> 
        <hr>
        <div class="main">
            <div>
                
                <strong>اسم الشركة : </strong>
                <span>{{$data['sent_company']}}</span>
            </div>
            <div>
                <strong>اسم العميل : </strong>
                <span>{{$data['Fname']}}</span>
            </div>
        </div>
        <div class="main">
            <strong style="float: right; width: 50px;">العنوان : </strong>
            <div style="display: inline-block; float: right;">
                {{$data['address1']}} <br>
                {{$data['address2']}} <br>
                {{$data['address3']}} 
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="main">
            <div>
                <strong>رقم التليفون : </strong>
                <span>{{$data['phone']}}</span>
            </div>
            <div>
                <strong>الراسل : </strong>
                <span>{{$data['sender']}}</span>
            </div>
        </div>

        <div class="clearfix"></div>
		<div class="test">
		<div class="test2">
			<a href="{{route('sales_invoice.downloadPdf',['id'=>$data['sales_invoice_id']])}}" target="_blank">تحميل المرفق

</a>
		</div>
		</div>
      </div>  
