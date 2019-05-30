<div class="breadcrum_sec">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    @forelse ($data['rows'] as $row)
                         <li ><a href="{{ route('category', ['id' =>  $row->slug]) }}">{{ $row->name  }}</a></li>
                    @empty                         
                    
                    @endforelse
                    <li class="active">{{ $data['currentCategory']  }}</li>
                </ol>	
            </div>
        </div>