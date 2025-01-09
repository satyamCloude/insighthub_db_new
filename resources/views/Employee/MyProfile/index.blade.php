@extends('layouts.admin')
@section('title', 'My Profile')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
  <div class="d-flex justify-content-between">
    
    <ul class="nav nav-pills flex-column flex-md-row mb-4 mt-2">
    @php
        $tabs = ['Profile', 'Projects', 'Tasks', 'Leaves', 'Timesheet', 'Ticket', 'ShiftRoster', 'Permissions', 'Activity'];
    @endphp

    @foreach($tabs as $tab)
        <li class="nav-item">
            <button class="nav-link RemoveActive @if(session('TabViews') == $tab) active @endif"
                    onclick="Tab('{{$tab}}', {{$id}}, '{{$tab}}')"
                    value="{{$tab}}" id="{{$tab}}">
                {{$tab}}
            </button>
        </li>
    @endforeach
  </ul>
  <button class="btn btn-label-primary" style="margin:11px 1px 28px;" onclick="EditEmployee({{Auth::user()->id}})"><i class="fas fa-edit"></i></button>
  </div>

      <div id="TBView">
          
      </div>
</div>
<div class="modal fade" id="showedit" data-bs-backdrop="statics" tabindex="-1" aria-modal="true" role="dialog"></div>

   @if(session('TabViews'))
    <script>
      window.onload = function() {
    var tabs = "{{ session('TabViews') }}";
    if (tabs) {
        Tab(tabs, {{$id}}, tabs);
    }
}
    </script>
@endif
<script type="text/javascript">
  
  function Tab(value, id, Activeid) {
    // Remove 'active' class from all buttons
    $('.nav-link').removeClass('active');

    // Add 'active' class to the clicked button
    $('#' + Activeid).addClass('active');

    // AJAX request to load tab content
    $.ajax({
        url: "{{ url('Employee/MyProfile/TabView') }}",
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

function EditEmployee(id)
{
    $.ajax({
        url: "{{url('Employee/MyProfile/edit')}}",
        method: 'GET',
        data: { id: id },
        success: function (data) {
            if (data && typeof data == 'string') {
                $('#showedit').html(data);
                $('#showedit').modal('show');
            } else {
                $('#showedit').html('<div>No Data Found</div>');
                $('#showedit').modal('show');
            }
        },
        error: function () {
            $('#showedit .modal-content').html('<div>Error fetching data.</div>');
            $('#showedit').modal('show');
        }
    });
}

</script>
@endsection

