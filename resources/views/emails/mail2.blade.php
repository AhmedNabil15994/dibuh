<!DOCTYPE html>
<html>
<head>

	<title></title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<style type="text/css">
		
		*{
			margin: 0;
			padding: 0;
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			-o-box-sizing: border-box;
			box-sizing: border-box;
		}	
		@font-face {
		    font-family: 'Droid';
		    font-style: normal;
		    font-weight: 400;
		    src: url('{{URL::to('').Config::get('assets_frontend')}}/fonts/Droid_Arabic_Kufi/DroidKufi-Regular.eot');
		    src: url('{{URL::to('').Config::get('assets_frontend')}}/fonts/Droid_Arabic_Kufi/DroidKufi-Regular.eot?#iefix') format('embedded-opentype'),
		    url('{{URL::to('').Config::get('assets_frontend')}}/fonts/Droid_Arabic_Kufi/DroidKufi-Regular.woff2') format('woff2'),
		    url('{{URL::to('').Config::get('assets_frontend')}}/fonts/Droid_Arabic_Kufi/DroidKufi-Regular.woff') format('woff'),
		    url('{{URL::to('').Config::get('assets_frontend')}}/fonts/Droid_Arabic_Kufi/DroidKufi-Regular.ttf') format('truetype');
		}
		@font-face {
		    font-family: 'Droid';
		    font-style: normal;
		    font-weight: 700;
		    src: url('{{URL::to('').Config::get('assets_frontend')}}/fonts/Droid_Arabic_Kufi/DroidKufi-Bold.eot');
		    src: url('{{URL::to('').Config::get('assets_frontend')}}/fonts/Droid_Arabic_Kufi/DroidKufi-Bold.eot?#iefix') format('embedded-opentype'),
		    url('{{URL::to('').Config::get('assets_frontend')}}/fonts/Droid_Arabic_Kufi/DroidKufi-Bold.woff2') format('woff2'),
		    url('{{URL::to('').Config::get('assets_frontend')}}/fonts/Droid_Arabic_Kufi/DroidKufi-Bold.woff') format('woff'),
		    url('{{URL::to('').Config::get('assets_frontend')}}/fonts/Droid_Arabic_Kufi/DroidKufi-Bold.ttf') format('truetype');
		}
		html,body{
			font-family: unset !important; 
		}
		
		.main{
			background-color: rgb(249,249,249);
			padding: 20px;
		}
		.message{
			width: 700px; 
			display: block;
			margin: auto;
			box-shadow: 8px 5px 10px #999;
			border-radius: 5px;
			border: 1px solid #222D32;
		}
		.header,.footer{
			background-color: #222D32;
			padding: 20px;
			text-align: center;
		}
		.header a{
			text-decoration: none;
			letter-spacing: 2px;
		    font-weight: bold;
		    font-size: 34px;
		}
		.header a span:first-of-type,
		.footer .row h3 span:first-of-type{
			color: #5fbeaa;
		}
		.header a span:last-of-type,
		.footer .row h3 span:last-of-type{
			color: #FFF;
		}
		.content{
			background-color: #FFF;
			padding: 20px;
		}
		.content .title,
		.content .details{
			padding: 20px;
			padding-top: 10px;
			padding-bottom: 10px;
			text-align: center;
		}
		.content .title h2{
			font-weight: bold;
			color: #000;
			margin-bottom: 20px;
		}
		.content .title p{
			color: #777;
			font-size: 15px;
    		letter-spacing: .5px;
    		line-height: 1.5;
		}
		.footer{
			text-align: left;
			color: #FFF;
		}
		.footer .row{
			margin-right: 0;
			margin-left: 0;
		}
		.footer .row p{
			color: #939393;
			font-size: 15px;
    		letter-spacing: .5px;
    		line-height: 1.5;
		}
		.footer .contact-info p{
			margin-bottom: 0;
			line-height: 1.5;
		}
		.footer .contact-info .more{
			margin-top: 10px;
			color: #DDD;
			margin-bottom: 30px;
		}
		.footer .right{
			margin-top: 15px;
			text-align: center;
		}
		.footer .left{
			width: 48%;
			margin-right: 2%;
			float: left;
		}
		.footer .left h3,
		.footer .left h4{
			margin-bottom: 10px;
			font-size: 18px;
		}
		.clearfix{
			clear: both;
		}
	</style>
</head>
<body>
	<div class="main">
		<div class="message">

			<div class="header">
				<a href="http://dibuh.com">
					<span>DI</span><span>BUH</span>
				</a>
			</div>

			<div class="content">
				@if($type == 1)
				<div class="imgResponsive" align="center" valign="middle" style="padding:0;">
					<div style="text-decoration:none;border:0">
						<img data-crop="false" editable="true" src="{{URL::to('').Config::get('assets_frontend')}}images/welcome.png" alt="#" border="0" width="500" style="display:block;border:0;width:100%;max-width:500px">
					</div>
				</div>
				<div class="title text-center">
					<?php 
						$email = \DB::table('email_templates')->where('id','=',$type)->first();
						$old = ["[CLIENT_NAME]", "[REST]", "[INVOICE_NUMBER]"];
						$new   = [ $data['Fname'] , $data['sales_invoice_rest'] , $data['sales_invoice_number'] ];
						$phrase = $email->content;
						$newPhrase = str_replace($old, $new, $phrase);

					?>
					<h2>{{$email->name}}</h2>
					{!!html_entity_decode($newPhrase)!!}
				</div>
				<div class="details text-center">
					<div data-size="Notification Button" data-bgcolor="Notification Button" mc:hideable="" mc:edit="" class="contBtn" align="center" style="font-family:'Open Sans',Arial,Helvetica,sans-serif;color:#FFFFFF;font-size:12px;line-height:20px;font-weight:700;letter-spacing:0.5px;text-align:center;background-color:#1DD2F0;border-radius:45px;padding: 10px 30px 10px 30px;display:inline-block;">
						<a data-color="Notification Button" href="{{route('sales_invoice.downloadPdf' , $data['sales_invoice_id'])}}" target="_blank" style="color:#FFFFFF;text-decoration:none;"><singleline>Download Attachment</singleline></a>
					</div>
				</div>
				@elseif($type ==2)
				<div class="imgResponsive" align="center" valign="middle" style="padding:0;">
					<div style="text-decoration:none;border:0">
						<img data-crop="false" editable="true" src="{{URL::to('').Config::get('assets_frontend')}}images/subcribe.png" alt="#" border="0" width="500" style="display:block;border:0;width:100%;max-width:500px">
					</div>
				</div>
				<div class="title text-center">
					
					<?php 
						$email = \DB::table('email_templates')->where('id','=',$type)->first();
						$old = ["[CLIENT_NAME]"];
						$new   = [$data['Email']];
						$phrase = $email->content;
						$newPhrase = str_replace($old, $new, $phrase);

					?>
					<h2>{{$email->name}}</h2>
					{!!html_entity_decode($newPhrase)!!}
				</div>
				<div class="details text-center">
					<div data-size="Notification Button" data-bgcolor="Notification Button" mc:hideable="" mc:edit="" class="contBtn" align="center" style="font-family:'Open Sans',Arial,Helvetica,sans-serif;color:#FFFFFF;font-size:12px;line-height:20px;font-weight:700;letter-spacing:0.5px;text-align:center;background-color:#1DD2F0;border-radius:45px;padding: 10px 30px 10px 30px;display:inline-block;">
						<a data-color="Notification Button" href="{{$data['link']}}" target="_blank" style="color:#FFFFFF;text-decoration:none;"><singleline>Verify Email<singleline></a>
					</div>
				</div>
				@elseif($type ==3)
				<div class="imgResponsive" align="center" valign="middle" style="padding:0;">
					<div style="text-decoration:none;border:0">
						<img data-crop="false" editable="true" src="{{URL::to('').Config::get('assets_frontend')}}images/password.png" alt="#" border="0" width="500" style="display:block;border:0;width:100%;max-width:500px">
					</div>
				</div>
				<div class="title text-center">
					
					<?php 
						$email = \DB::table('email_templates')->where('id','=',$type)->first();
						$old = ["[CLIENT_NAME]"];
						$new   = [];
						$phrase = $email->content;
						$newPhrase = str_replace($old, $new, $phrase);

					?>
					<h2>{{$email->name}}</h2>
					{!!html_entity_decode($newPhrase)!!}
				</div>
				<div class="details text-center">
					<div data-size="Notification Button" data-bgcolor="Notification Button" mc:hideable="" mc:edit="" class="contBtn" align="center" style="font-family:'Open Sans',Arial,Helvetica,sans-serif;color:#FFFFFF;font-size:12px;line-height:20px;font-weight:700;letter-spacing:0.5px;text-align:center;background-color:#1DD2F0;border-radius:45px;padding: 10px 30px 10px 30px;display:inline-block;">
						<a data-color="Notification Button" href="#" target="_blank" style="color:#FFFFFF;text-decoration:none;"><singleline>Reset Password<singleline></a>
					</div>
				</div>
				@elseif($type ==4)
				<div class="imgResponsive" align="center" valign="middle" style="padding:0;">
					<div style="text-decoration:none;border:0">
						<img data-crop="false" editable="true" src="{{URL::to('').Config::get('assets_frontend')}}images/unsubcribe.png" alt="#" border="0" width="500" style="display:block;border:0;width:100%;max-width:500px">
					</div>
				</div>
				<div class="title text-center">
					
					<?php 
						$email = \DB::table('email_templates')->where('id','=',$type)->first();
						$old = ["[CLIENT_NAME]"];
						$new   = [];
						$phrase = $email->content;
						$newPhrase = str_replace($old, $new, $phrase);

					?>
					<h2>{{$email->name}}</h2>
					{!!html_entity_decode($newPhrase)!!}
				</div>
				<div class="details text-center">
					<div data-size="Notification Button" data-bgcolor="Notification Button" mc:hideable="" mc:edit="" class="contBtn" align="center" style="font-family:'Open Sans',Arial,Helvetica,sans-serif;color:#FFFFFF;font-size:12px;line-height:20px;font-weight:700;letter-spacing:0.5px;text-align:center;background-color:#1DD2F0;border-radius:45px;padding: 10px 30px 10px 30px;display:inline-block;">
						<a data-color="Notification Button" href="#" target="_blank" style="color:#FFFFFF;text-decoration:none;"><singleline>Renew Your Plan<singleline></a>
					</div>
				</div>
				@else
				<div class="imgResponsive" align="center" valign="middle" style="padding:0;">
					<div style="text-decoration:none;border:0">
						<img data-crop="false" editable="true" src="{{URL::to('').Config::get('assets_frontend')}}images/account.png" alt="#" border="0" width="500" style="display:block;border:0;width:100%;max-width:500px">
					</div>
				</div>
				<div class="title text-center">
					
					<?php 
						$email = \DB::table('email_templates')->where('id','=',$type)->first();
						$old = ["[CLIENT_NAME]"];
						$new   = [];
						$phrase = $email->content;
						$newPhrase = str_replace($old, $new, $phrase);

					?>
					<h2>{{$email->name}}</h2>
					{!!html_entity_decode($newPhrase)!!}
				</div>
				<div class="details text-center">
					<div data-size="Notification Button" data-bgcolor="Notification Button" mc:hideable="" mc:edit="" class="contBtn" align="center" style="font-family:'Open Sans',Arial,Helvetica,sans-serif;color:#FFFFFF;font-size:12px;line-height:20px;font-weight:700;letter-spacing:0.5px;text-align:center;background-color:#1DD2F0;border-radius:45px;padding: 10px 30px 10px 30px;display:inline-block;">
						<a data-color="Notification Button" href="#" target="_blank" style="color:#FFFFFF;text-decoration:none;"><singleline>{{$email->name}}<singleline></a>
					</div>
				</div>
				@endif


			</div>

			<div class="footer">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-6 left">
						<h3><span>DI</span><span>BUH</span></h3>
						<p>Service Dibuh gives you control over your business and allows you to track your money easily and so you can focus on your business</p>
					</div>
					@if($type ==1)
					<div class="col-xs-12 col-sm-12 col-md-6 left">
						<div class="contact-info">
							<h4>Contact Info</h4>
							<p>{{$data['sent_company']}}</p>
							<p>{{$data['address1']}} <br>{{$data['address2']}} <br>{{$data['address3']}}</p>

							<div class="more">
								<span>Email:</span><span>{{$data['sender']}}</span><br>
								<span>Phone:</span><span>{{$data['phone']}}</span>
							</div>
						</div>
					</div>
					@else
					<div class="col-xs-12 col-sm-12 col-md-6 left">
						
					</div>			
					@endif
				</div>
				<div class="clearfix"></div>
				<div class="row text-center right">
					<p>Copyright &copy; {{\Carbon::now()->year}} Dibuh</p>
				</div>
			</div>

		</div>
	</div>
</body>
</html>