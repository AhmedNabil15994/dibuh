<!DOCTYPE html>
<html >

  <head></head>

  <body>

    <h2>  <span >{{$data->company}} </span></h2>
    <p >   {{$data->postal_code}}  | {{$data->district}}  | {{$data->phone}}</p>


    <div>

        <div  style="position: absolute; top: 0; right: 0; height: 100%; padding: 10px; width: 100%;">
            <p>{{$data->getFullNameAttribute()}}</p>
            <p>{{$address->street}} {{$address->house_no}}</p>
            <p>{{$address->postal_code}} {{$address->city}}</p>
           <p> {{$address->country->name}}</p>
        </div>
    </div>
</div>


  </body>

</html>
