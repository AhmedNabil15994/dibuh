

<div class="title_default">
    <h3><a href="#" class="active" >الأقســـام</a></h3>
<!--    <a href="#" class="view_all"  > View all  <i class="fa fa-list-ul" aria-hidden="true"></i></a>-->
</div>	<!--Title Default--> 

<div class="category"> 

    @forelse ($data['rows'] as $row)

    <div class="cat_box">
        <a href="{{ route('category', ['id' =>  $row->slug]) }}"> 
            <i class="fa fa-folder-open fa-1x" aria-hidden="true"></i> {{ $row->name }} 
        </a>
    </div>

    @empty
    
    <p>No Data</p>
    
    @endforelse								



</div>	

