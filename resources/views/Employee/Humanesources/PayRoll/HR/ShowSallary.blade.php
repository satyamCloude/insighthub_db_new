             @php
               $totalNetSalary = 0;
               $totalNetPaid = 0;
              @endphp
              @if(count($PayRoll) > 0)
            @foreach($PayRoll as $key => $user)
                 @php 
                if ($user && $user->net_salary) {
                    $totalNetSalary += $user->net_salary;
                }
                if ($user && $user->net_paid) {
                    $totalNetPaid += $user->net_paid;
                }
                @endphp

                <tr class="odd">
                    <td>{{ $key+1 }} </td>
                    <td>@if($user && $user->first_name) {{ $user->first_name }} @endif</td>
                    <td>@if($user && $user->net_salary) {{ $user->net_salary }} @endif</td>
                    <td>@if($user && $user->net_paid) {{ $user->net_paid }} @endif</td>
                    <td>
                        <a onclick="editrol(this)" id="{{ $user->id }}"><i class="fas fa-edit pointer-cursor"></i></a>&nbsp;&nbsp;
                        <a class="btn-link"  href="{{url('admin/PayRoll/view/'.$user->id)}}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                    </td>
                </tr>
            @endforeach
              <tr style="background: aliceblue;">
                  <td></td>
                  <td><strong>Total</strong></td>
                  <td><strong>{{ $totalNetSalary }}</strong></td>
                  <td><strong>{{ $totalNetPaid }}</strong></td>
                  <td></td>
              </tr>
              @else
              <tr>
                <td class="text-center" colspan="5">No Data Found</td>
              </tr>
              @endif             
