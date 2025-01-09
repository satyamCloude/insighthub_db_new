@foreach($payrolls as $payroll)
    <tr>
        <td>{{$payroll->id}}</td>
        <td>{{$payroll->first_name}}</td>
        <td>{{number_format($payroll->net_salary,2)}}</td>
        <td>{{number_format($payroll->deduction,2)}}</td>
        <td>{{number_format($payroll->tds,2)}}</td>
        <td>{{number_format($payroll->net_paid,2)}}</td>
        <td>
            <a class="btn-link" href="{{url('admin/PayRoll/SallarySlip/'.$payroll->id)}}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
        </td>
    </tr>
@endforeach
          
 				  