@extends('layouts.admin')

@section('title', 'Notification')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
    @endif
    <div class="alert alert-success" role="alert" id="ResMsg" style="display:none;"></div>
    <!-- Users List Table -->
    <div class="card">
        <div class="row">
            <div class="col-md-6">
                <h5 class="card-header">Notification's List</h5>
            </div>
            @if(Auth::user()->status == 4)
                <script>
                    $(document).ready(function(){
                        var id = {{ Auth::user()->id }};
                        $.ajax({
                            url: "{{ url('user/MyProfile/edit') }}",
                            method: 'GET',
                            data: { id: id },
                            success: function(data) {
                                if (data && typeof data === 'string') {
                                    $('#showedit').html(data);
                                    $('#showedit').modal('show');
                                } else {
                                    $('#showedit').html('<div>No Data Found</div>');
                                    $('#showedit').modal('show');
                                }
                            },
                            error: function() {
                                $('#showedit .modal-content').html('<div>Error fetching data.</div>');
                                $('#showedit').modal('show');
                            }
                        });
                    });
                </script>
            @endif
        </div>
        <div class="card-datatable table-responsive">
            <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Subject</th>
                        <th>Message</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($Quotes) > 0)
                        @foreach($Quotes as $key => $user)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>@if($user && $user->first_name) {{ $user->first_name }} @else -- @endif @if($user && $user->user_id) {{ $user->last_name }} | (#{{ $user->user_id }}) @endif</td>
                                <td>@if($user && $user->user_id) {{ $user->subject }} @endif</td>
                                <td>@if($user && $user->user_id) {!! $user->message !!} @endif</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td class="text-center" colspan="4">No Data Found</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            {{ $Quotes->links() }}
        </div>
    </div>
</div>

@if(Auth::user()->status == 4)
    <div class="modal fade show" id="showedit" data-bs-backdrop="static" tabindex="-1" aria-modal="true" role="dialog" style="display: block;">
    </div>
@endif

<script type="text/javascript">
    function QuoteStatus(value, Qid) {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: "{{ url('user/Quotes/StatusUpdate') }}",
            method: 'post',
            data: {
                value: value,
                Qid: Qid,
                _token: csrfToken
            },
            success: function(response) {
                if (response.success === true) {
                    $('#ResMsg').show().html(response.message);

                    setTimeout(function() {
                        $('#ResMsg').hide(500);

                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    }, 1000);
                }
            },
            error: function() {
                alert("Oops! Some technical error occurred.");
            }
        });
    }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.10.5/sweetalert2.min.js" integrity="sha512-WHVh4oxWZQOEVkGECWGFO41WavMMW5vNCi55lyuzDBID+dHg2PIxVufsguM7nfTYN3CEeQ/6NB46FWemzpoI6Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(window).on('load', function() {
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this imaginary file!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(isConfirm) {
            if (isConfirm) {
                swal("Deleted!", "Your imaginary file has been deleted.", "success");
            } else {
                swal("Cancelled", "Your imaginary file is safe :)", "error");
            }
        });
    });
</script>

@endsection
