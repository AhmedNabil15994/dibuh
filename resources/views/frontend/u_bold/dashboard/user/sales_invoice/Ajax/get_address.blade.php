<div class="chooseDivs">
    <div class="row">
        @foreach ($addresses as $address)
            <div id="adr_{{$address->id}}" onclick="setAddress({{$address->id}});"  class="col-lg-6 no-padding">
                <div class="chooseDiv" style="">
                    {{$address->name}}<br/>
                    {{$address->street}}/{{$address->house_no}}<br/>
                    {{$address->country->name}} {{$address->city}}<br/>
                    {{$address->postal_code}}<br/>
                </div>
            </div>
        @endforeach
    </div>
</div>