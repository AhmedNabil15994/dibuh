<div class="chooseDivs">
    <div class="row">
        @foreach ($addresses as $address)
            <div id="adr_{{$address->id}}" onclick="setAddress({{$address->id}});"  class="col-lg-6 no-padding">
                <div class="chooseDiv" style="">
                    {{$contact->company}}<br>
                </div>
            </div>
        @endforeach
    </div>
</div>