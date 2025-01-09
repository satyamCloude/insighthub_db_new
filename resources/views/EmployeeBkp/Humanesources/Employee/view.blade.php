@extends('layouts.admin')
@section('title', 'Employee')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <ul class="nav nav-pills flex-column flex-md-row mb-4 mt-2">
    @php
        $tabs = ['Profile','KRA','Permissions', 'Activity'];
    @endphp

    @foreach($tabs as $key => $tab)
        <li class="nav-item">
            <button class="nav-link @if($key == 0) active @endif"
                    onclick="Tab('{{$tab}}', {{$id}}, '{{$tab}}')"
                    value="{{$tab}}" id="{{$tab}}">
                {{$tab}}
            </button>
        </li>
    @endforeach
</ul>

      <div id="TBView">
          
      </div>
</div>

<script type="text/javascript">
  
   Tab('Profile', '{{$id}}', 'Profile');

  function Tab(value, id, Activeid) {
    // Remove 'active' class from all buttons
    $('.nav-link').removeClass('active');

    // Add 'active' class to the clicked button
    $('#' + Activeid).addClass('active');

    // AJAX request to load tab content
    $.ajax({
        url: "{{ url('Employee/Employee/TabView') }}",
        method: 'GET',
        data: { type: value, id: id },
        success: function (response) {
            $('#TBView').html(response);
        },
        error: function () {
            // Handle error if needed
        }
    });
}

</script>
@endsection