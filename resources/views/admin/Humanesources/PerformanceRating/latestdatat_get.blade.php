@if(count($PerformanceRating) > 0)
@foreach($PerformanceRating as $key=> $Perfo)
<tr>
    <td>{{$key+1}} </td>
    <td>{{$Perfo->rating_name}} </td>
    <td>{{$Perfo->rating}} </td>
    <td><a onclick="editrating({{$Perfo->id}})"><i class="cursor-pointer text-dark fas fa-edit"></i></a>&nbsp;&nbsp; <a onclick="deleterating({{$Perfo->id}})" ><i class="cursor-pointer text-dark fa-solid fa-trash"></i></a></td>
</tr>
@endforeach
 @else
<tr>
  <td class="text-center" colspan="4">No Data Found</td>
</tr>
@endif