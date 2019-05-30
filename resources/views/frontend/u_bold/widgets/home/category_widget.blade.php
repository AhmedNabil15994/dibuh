

<div class="title_default">
    <h3><a href="#" class="active" >
            {{ $data['block_title'] }} </a></h3>
    <a href="#" class="view_all"  > View all  <i class="fa fa-list-ul" aria-hidden="true"></i></a>
</div>	<!--Title Default--> 

<div class="category"> 

    @forelse ($data['posts'] as $post)

    <div class="cat_box">
        <a href="{{URL::to(Request::route()->getName())}}"> 
            <i class="fa fa-folder-open fa-1x" aria-hidden="true"></i> {{ $post->name }} 
        </a>
    </div>

    @empty
    
    <p>No Data</p>
    
    @endforelse								



</div>	

