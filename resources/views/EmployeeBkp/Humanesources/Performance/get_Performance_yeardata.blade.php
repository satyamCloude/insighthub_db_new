@if($Performance && count($Performance) > 0)
        @foreach($Performance as $key => $Perfo)
<tr>  
    <td>{{ $key + 1 }}</td> 
    <td>{{ $Perfo->evaluation_period }}</td> 
    <td>{{ $Perfo->totalrating }}</td> 
    <td>{{ $Perfo->date }}</td> 
    <td><a class="cursor-pointer" onclick="openper({{$Perfo->id}})"><i class="fa-solid fa-eye"></i></a></td>
        </tr>
    @endforeach
@else
    <tr>
        <td class="text-center" colspan="5">No Data Found</td>
    </tr>
@endif