@extends('layouts.admin')
@section('title', 'Transaction')
@section('content')
<!-- Add the Bootstrap JavaScript and jQuery dependencies -->
<style>
    .dropdown-item:not(.disabled).active, .dropdown-item:not(.disabled):active {
        background-color: #fff;
    }

    .show-total-amount {
   
    border-radius: 2px;
    text-align: center;
   
}
</style>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Transaction /</span> Home</h4>
    @if(Session::has('success'))
    <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
     @endif
    <!-- Users List Table -->
    <div class="card">
        <div class="row">
            <div class="col-md-8 d-flex" style="justify-content: space-between;">
                <h5 class="card-header">Transaction List</h5>
            </div>
        
            <div class="col-md-4 text-end"></div>
        </div>
        <div class="card-datatable table-responsive">
            <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="dataTables_length" id="DataTables_Table_3_length"></div>
                    </div>
                    <div class="col-sm-12"></div>
                </div>
                <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
                    <thead>
                        <tr>
                            <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                            <!-- <th scope="col">Client Name</th> -->
                            <th scope="col">Date</th>
                            <th scope="col">Payment Method</th>
                            <th scope="col">Description</th>
                            <th scope="col">Amount In</th>
                            <th scope="col">Fees</th>
                            <th scope="col">Amount Out</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($invoices) > 0)
                            @foreach($invoices as $key => $Inventor)
                            <tr class="odd">
                                <td>@if($Inventor && $Inventor->created_at) {{ date('Y-m-d',strtotime($Inventor->created_at)) }} @endif</td>
                                <td>
                                   Online
                                </td>
                                <td>
                                    Invoice Payment 
                                    @if($Inventor && $Inventor->invoice_number2) 
                                        (#{{ $Inventor->invoice_number2 }})
                                    @endif
                                    <br>
                                    Trans.Id {{isset($Inventor) ? $Inventor->razorpay_payment_id : ''}}
                                </td>
                                <td>{{ $Inventor->prefix}} {{number_format(floatVal($Inventor->final_total_amt ?? 0),2) }}</td>
                                <td>{{ $Inventor->prefix}} 0:00/- </td>
                                <td>{{ $Inventor->prefix}} 0:00/- </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="text-center" colspan="8">No Data Found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
        
                <div class="p-1" style="float: right;">
                    {{ $invoices->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function downloadPDF(invoiceId) {
        window.location.href = "{{ url('admin/Invoices/downloadPDF') }}/" + invoiceId;
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

    $(document).ready(function () {
        // Check/uncheck all checkboxes when clicking on the "selectAll" checkbox
        $("#selectAll").click(function () {
            $(".selectId").prop("checked", $(this).prop("checked"));
            var id = [];

            $('.selectId:checked').each(function(i) {
                id.push($(this).val()); 
            });
            $('.pdfValue').val(id);
        });

            // Uncheck "selectAll" checkbox if any "selectId" checkbox is unchecked
        $(".selectId").click(function () {
           var id = [];

           $('.selectId:checked').each(function(i) {
            id.push($(this).val()); 
        });
           $('.pdfValue').val(id);
           if (!$(this).prop("checked")) {
            $("#selectAll").prop("checked", false);
        }
    });
    });

    $('.pdfDownload').click(function() {
        var id = [];
        $('.selectId:checked').each(function(i) {
            id.push($(this).val()); 
        });

        if (id.length > 0) {

        } else {
            alert('Please select at least one checkbox to download the PDF.');
        }
    });


    function submitForm() {
       var id = [];

       $('.selectId:checked').each(function(i) {
        id.push($(this).val()); 
    });
       if (id.length > 0) {
        var form = document.getElementById('downloadPDF');
        form.submit();
    }else {
        alert('Please select at least one checkbox to download the PDF.');
    }
}
</script>

@endsection