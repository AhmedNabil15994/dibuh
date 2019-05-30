@extends(app('FrontEndTheme').'.layouts.default')


@section('title')
- {{$page_title}}
@endsection


@section('content')
 
<!-- Start Section Main Content -->
<div class="main_contant">
            <!-- Start Section Main Section -->
            <section class="category_page sec">
                <div class="container">
                    {{$i=0}}
                    @foreach ($rows as $row)
                    <div class="title">image:: {{ $row->image }}</div>
                        <?php 
                        
$d=date ("d");
$m=date ("m");
$y=date ("Y");
$t=time();
$dmt=$d+$m+$y+$t;    
$ran= rand(0,10000000);
$dmtran= $dmt+$ran;
$un=  uniqid();
$dmtun = $dmt.$un;
$mdun = md5($dmtran.$un);
$sort=substr($mdun, 16); // if you want sort length code.

$mdun;        

                        $path='uploads/news/thumb/';
                        $img = Image::make($row->image);
                        $img->resize(300, 200)->save($path.$row->id.'_'.$mdun.'.jpg');  
                        
                
                        ?>
                    {{$i++}}                    
                    @endforeach

             
                </div><!--End Container-->

            </section>

</div>
<!-- End Section Main Content -->	
@endsection