@extends('layouts.admin')
@section('title', 'TimeShift')
@section('content')
<!-- Add the Bootstrap JavaScript and jQuery dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>

<style type="text/css">
  .actives{
    border: 0px solid #1ff11f;
    padding: 0px 1px 0px 17px;
    border-radius: 146px;
    background: #1ff11f;
    }

  .inactives{
    border: 0px solid red;
    padding: 0px 1px 0px 17px;
    border-radius: 146px;
    background: red;
    }
    .orangecose{
    border: 0px solid orange;
    padding: 0px 1px 0px 17px;
    border-radius: 146px;
    background: orange;
    }
</style>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">TimeShift /</span> Home</h4>
    @if(Session::has('success'))
   <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
    @endif
    
    
    
  <!-- Users List Table -->
  <div class="card">
    <div class="row">
      <div class="col-md-6">
          <h5 class="card-header">Time Shift's List</h5>
      </div>
      <!--<div class="col-md-6 text-end pe-4">-->
      <!--  <form method="GET" action="">    -->
      <!--      <label>Search: <input type="search" value="" class="form-control" name="search" placeholder="" aria-controls="DataTables_Table_3">-->
      <!--      </label>-->
      <!--  </form>-->
      <!--</div>-->
    </div>
      <div class="card-datatable table-responsive">
        <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
          <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
    <thead>
        <tr>
            <th>Employee</th>
            <th>Monday</th>
            <th>Tuesday</th>
            <th>Wednesday</th>
            <th>Thursday</th>
            <th>Friday</th>
            <th>Saturday1</th>
            <th>Saturday2</th>
            <th>Saturday3</th>
            <th>Saturday4</th>
            <th>Sunday</th>
        </tr>
    </thead>
   <tbody>
@forelse($TimeShift as $user)
    <tr>
        <td class="text-center">
            <img class="avatar rounded-circle" src="{{ $user->profile_img }}"><br/>
            {{ $user->first_name }}
        </td>
        
        <!-- Display schedule for Monday to Friday -->
        @for($day = 1; $day <= 5; $day++)
             <td >
                @if($user->weekly_off_id == $day )
                  <span class="text-success"> Week Off</span>
                @elseif($user->additional_week_off_first == $day || $user->additional_week_off_second ==  $day || $user->additional_week_off_third == $day || $user->additional_week_off_fourth == $day  )
                 <span class="text-warning"> Week Off</span>
                @else
                {{ \Carbon\Carbon::parse($user->StartTime)->format('H:i') . ' - ' . \Carbon\Carbon::parse($user->EndTime)->format('H:i') }}
                @endif
            </td>
        @endfor
        
        <!-- Display schedule for Saturday1, Saturday2, Saturday3, Saturday4 -->
        <td>
            @if($user->weekly_off_id == 6)
               <span class="text-success"> Week Off</span>
            @elseif( $user->additional_week_off_first == 6)
               <span class="text-warning"> Week Off</span>
            @else
                {{ \Carbon\Carbon::parse($user->StartTime)->format('H:i') . ' - ' . \Carbon\Carbon::parse($user->EndTime)->format('H:i') }}
            @endif
        </td>
        <td>
            @if($user->weekly_off_id == 6)
                <span class="text-success"> Week Off</span>
            @elseif($user->additional_week_off_second == 6)
                <span class="text-warning"> Week Off</span>
            @else
                {{ \Carbon\Carbon::parse($user->StartTime)->format('H:i') . ' - ' . \Carbon\Carbon::parse($user->EndTime)->format('H:i') }}
            @endif
        </td>
        <td>
            @if($user->weekly_off_id == 6 )
               <span class="text-success"> Week Off</span>
            @elseif($user->additional_week_off_third == 6)
            <span class="text-warning"> Week Off</span>
            @else
                {{ \Carbon\Carbon::parse($user->StartTime)->format('H:i') .  ' - ' .  \Carbon\Carbon::parse($user->EndTime)->format('H:i') }}
            @endif
        </td>
        <td>
            @if($user->weekly_off_id == 6)
                 <span class="text-success"> Week Off</span>
            @elseif($user->additional_week_off_fourth == 6)
             <span class="text-warning"> Week Off</span>
            @else
                {{ \Carbon\Carbon::parse($user->StartTime)->format('H:i') .  ' - ' .  \Carbon\Carbon::parse($user->EndTime)->format('H:i') }}
            @endif
        </td>
        
        <!-- Display schedule for Sunday -->
        <td>
            
            
            
            @if($user->weekly_off_id == 7)
                <span class="text-success"> Week Off</span>
            @else
                {{ \Carbon\Carbon::parse($user->StartTime)->format('H:i')  . ' - ' .  \Carbon\Carbon::parse($user->EndTime)->format('H:i') }}
            @endif
        </td>
        
    </tr>
@empty
    <tr>
        <td class="text-center" colspan="11">No Data Found</td>
    </tr>
@endforelse 


</tbody>

</table>

          <div class="p-1" style="float: right;">
              {{ $TimeShift->links() }}
          </div>
      </div>
      </div>
    </div>
</div>
@endsection