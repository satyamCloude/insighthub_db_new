@extends('layouts.admin')
@section('title', 'Leave Policies')
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
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">Leave Policies /</span> Home</h4>
    @if(Session::has('success'))
   <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
    @endif
  <div class="card">
    <div class="row">
      <div class="col-md-6">
          <h5 class="card-header">Leave Policies List</h5>
      </div>
      <div class="col-md-6 text-end">
          <a href="{{url('admin/LeavePolicies/add')}}" class="btn btn-primary mt-3 m-3">Add Policies</a>
      </div>
    </div>
  </div>
  @if(count($LeavePolicies) > 0)
    @foreach($LeavePolicies as $Leave)
      <div class="card mt-3">
        <div class="row">
          <div class="col-md-6">
              <h5 class="card-header">{{$Leave->title}}</h5>
          </div>
          <div class="col-md-6">
              <h5 class="card-header">{{$Leave->created_at}}</h5>
          </div>
        </div>
        <hr>
        <div class="card-body">
          <div class="row">
          <div class="col-md-6">
              <span class="badge rounded-pill bg-danger"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle me-50"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg> Effective Date: {{$Leave->effective_date}}</span>
          </div>
          <div class="col-md-6">
              <a id="{{$Leave->id}}" onclick="viewplecy(this)" class="btn btn-success waves-effect waves-float waves-light text-white"><i class="fa-regular fa-eye"></i></a>
              <a href="{{url('admin/LeavePolicies/edit/'.$Leave->id)}}" class="btn btn-primary waves-effect waves-float waves-light text-white"><i class="fa-regular fa-pen-to-square"></i></a>
              <a  url="{{url('admin/LeavePolicies/delete/'.$Leave->id)}}" id="{{$Leave->id}}" class="btn btn-danger waves-effect waves-float waves-light text-white delete_debtcase"><i class="fa-solid fa-trash"></i></a>
              <a href="#" class="btn btn-info waves-effect waves-float waves-light text-white"><i class="fa-regular fa-file-pdf"></i></a>
          </div>
        </div>
        </div>
      </div>
      @endforeach
    @endif
</div>
<div class="modal fade" id="showedit" data-bs-backdrop="static" tabindex="-1" aria-modal="true" role="dialog"></div>
<script>
function viewplecy(element) {
    var cate_id = $(element).attr('id');

    $.ajax({
        url: "{{ url('admin/LeavePolicies/view') }}",
        method: 'GET',
        data: { id: cate_id },
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
<script>
    $(document).ready(function () {

        $(".delete_debtcase").click(function (e) {
            var id = $(this).attr('id');
            var url = $(this).attr('url');
            e.preventDefault();
            bootbox.confirm({
                message: "Are you sure?",
                buttons: {
                    cancel: {
                        label: '<i class="fa fa-times"></i> Cancel'
                    },
                    confirm: {
                        label: '<i class="fa fa-check"></i> Delete'
                    },
                },
                callback: function (result) {
                    if (result) {
                        window.location.href = url;
                    }
                }
            });
        });
    });
</script>
@endsection