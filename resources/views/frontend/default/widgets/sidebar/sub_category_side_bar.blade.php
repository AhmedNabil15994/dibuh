                                    <div class="title_default">
                                        <h3><a href="{{ route('category', ['id' =>  $data['currentCategory']['slug']]) }}" class="active" > {{ $data['currentCategory']['name']  }}</a></h3>
                                        <a href="{{ route('category', ['id' =>  $data['currentCategory']['slug']]) }}" class="view_all"  > عرض  <i class="fa fa-list-ul" aria-hidden="true"></i></a>
                                    </div>  <!--Title Default--> 

                                    <div class="sub_category"> 
                                        <ul class="cats list-unstyled">
                                            @forelse ($data['rows'] as $row)
                                                 <li ><a href="{{ route('category', ['id' =>  $row->slug]) }}">{{ $row->name  }}</a></li>
                                            @empty                         
                                            
                                            @endforelse                                        

                                        </ul>                                                  
                                    </div>
 