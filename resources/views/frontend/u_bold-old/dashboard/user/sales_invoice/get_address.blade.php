contact id:  {{ $contactId }}<br/>
<div class="row">
    @foreach ($address as $row)  
    <div id="adr_{{$row->id}}" onclick="setAddress({{$row->id}});"  class="col-lg-5 " style="border:1px solid #006dcc;margin: 15px" >{{$row->zipt}}<br/>
    {{$row->street}}/{{$row->house_no}}<br/>
    {{$row->country->name}}/{{$row->city}}<br/>
    </div> 
 
@endforeach
</div>
