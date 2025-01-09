@if(count($PerformanceCategory) > 0)
@foreach($PerformanceCategory as $key=> $Perfo)
<tr>
    <td>{{$key+1}} </td>
    <td>{{$Perfo->category_name}} </td>
    <td>{{$Perfo->description}} </td>
    <td><a onclick="editdatat({{$Perfo->id}})"><i class="text-dark fas fa-edit"></i></a>&nbsp;&nbsp; <a onclick="deletedatat({{$Perfo->id}})"><i class="text-dark fa-solid fa-trash"></i></a></td>
</tr>
@endforeach
 @else
<tr>
  <td class="text-center" colspan="4">No Data Found</td>
</tr>
@endif