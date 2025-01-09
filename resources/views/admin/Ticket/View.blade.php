@extends('layouts.admin')
@section('title', 'Ticket')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">Ticket /</span> View</h4>
  <div class="col-xl">
    @php $client = \App\Models\User::select('first_name','profile_img','email')->where('id',$View->client_id)->where('type',2)->first(); @endphp
    @php $Department = \App\Models\Department::where('id',$View->department_id)->first() @endphp
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
          @if($Department && $Department->name)
          {{$Department->name}}
          @else
          {{$View->department_id}}
          @endif

          </br>
          <div class="dropdown">
            <div class="dropdown">
              <button class="btn p-0" type="button" id="dropdownMoreActions" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> To <i class="ti ti-caret-down"></i></button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMoreActions">
                <li class="dropdown-item"><b>From</b> : @if($Department && $Department->name){{$Department->name}} @else {{$View->department_id}} @endif</li>
                <li class="dropdown-item"><b>To</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : @if($View && $View->ccid){{$View->ccid}} @endif</li>
                <li class="dropdown-item"><b>Date</b>&nbsp; : @if($View && $View->created_at){{$View->created_at}} @endif</li>
                <li class="dropdown-item"><b>sub.</b>&nbsp;&nbsp;&nbsp;: @if($View && $View->subject){{$View->subject}} @endif</li>
              </ul>
            </div>
        </h5>
        <small class="text-muted float-end"><a href="{{url('admin/Ticket/home')}}" class="btn btn-sm btn-primary">Back</a></small>
      </div>
      <div class="card-body" style="height: 500px;">
        @if($View && $View->task){!!$View->task!!} @endif
      </div>
    </div>
  </div>
</div>
@endsection