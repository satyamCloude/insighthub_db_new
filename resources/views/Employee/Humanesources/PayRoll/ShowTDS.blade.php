              @php
               $totaltds = 0;
              @endphp
              @if(count($PayRoll) > 0)
                @foreach($PayRoll as $key => $user)
                 @php 
                if ($user && $user->tds) {
                    $totaltds += $user->tds;
                }
                if ($user && $user->net_paid) {
                    $totaltds += $user->net_paid;
                }
                @endphp

                <tr class="odd">
                    <td>{{ $key+1 }} </td>
                    <td>@if($user && $user->first_name) {{ $user->first_name }} @endif</td>
                    <td>@if($user && $user->tds) {{ $user->tds }} @endif</td>
                </tr>
                @endforeach
              <!--<tr style="background: aliceblue;">-->
              <!--    <td></td>-->
              <!--    <td><strong>Total</strong></td>-->
              <!--    <td><strong>{{ $totaltds }}</strong></td>-->
              <!--</tr>-->
              @else
              <tr>
                <td class="text-center" colspan="3">No Data Found</td>
              </tr>
              @endif  
           