@extends('layouts.admin')
@section('title', 'Invoices')
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
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">Invoices /</span> Home</h4>
  @if(Session::has('success'))
  <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
  @endif
  <!-- Users List Table -->
  <div class="show-total-amount">
     <div class="row">

             <div class="col-sm-4">
               <h6 style="color:green;">Rupees: Paid : {{ number_format($result->inr_total_paid,2) }}/-</h6>
           </div>
           <div class="col-sm-4">
               <h6 style="color:red;">Rupees: Unpaid : {{ number_format($result->inr_total_unpaid,2) }}/-</h6>
           </div>
               <div class="col-sm-4">
               <h6 style="color:black;">Rupees: Over Due : {{ number_format($result->inr_total_due,2) }}/-</h6>
            </div>
        </div>
        <div class="row">

             <div class="col-sm-4">
               <h6 style="color:green;">Dollars: Paid : {{ number_format($result->usd_total_paid,2) }}/-</h6>
           </div>
           <div class="col-sm-4">
               <h6 style="color:red;">Dollars: Unpaid : {{ number_format($result->usd_total_unpaid,2) }}/-</h6>
           </div>
               <div class="col-sm-4">
               <h6 style="color:black;">Dollars: Over Due : {{ number_format($result->usd_total_due,2) }}/-</h6>
            </div>
        </div>
         <div class="row">

             <div class="col-sm-4">
               <h6 style="color:green;">Euro: Paid : {{ number_format($result->euro_total_paid,2) }}/-</h6>
           </div>
           <div class="col-sm-4">
               <h6 style="color:red;">Euro: Unpaid : {{ number_format($result->euro_total_unpaid,2) }}/-</h6>
           </div>
               <div class="col-sm-4">
               <h6 style="color:black;">Euro: Over Due : {{ number_format($result->euro_total_due,2) }}/-</h6>
            </div>
        </div>
        </div>
        <br>
  <div class="card">
    <div class="row">

        <div class="col-md-8 d-flex" style="justify-content: space-between;">
            <h5 class="card-header">Invoices List</h5>
         
    </div>
    
    <div class="col-md-4 text-end">
        <form id="downloadPDF" action="{{url('admin/Invoices/downloadPDF')}}">
            <input type="hidden" name="id" class="pdfValue">
            <a href="javascript::void(0);" class="btn btn-danger mt-3 m-3"  onclick="submitForm()"><i class="fa-solid fa-file-pdf"></i></a>
            <a href="{{url('admin/Invoices/EXPORTCSV')}}" class="btn btn-info mt-3 m-3"><i class="fa-solid fa-file-csv"></i></a>
            <a href="{{url('admin/Invoices/home')}}" class="btn btn-warning mt-3 m-3"><i class="fas fa-sync-alt"></i></a>
            <a href="{{url('admin/Invoices/add')}}" class="btn btn-primary mt-3 m-3">Add</a>
        </form>

    </div>
</div>
<div class="card-datatable table-responsive">
    <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
      <div class="row">
        <div class="col-sm-12 col-md-6">
          <div class="dataTables_length" id="DataTables_Table_3_length"><label>
          </div>
      </div>
      <div class="col-sm-12">
        <form>
          <div class="row mb-4"> 

          <div class="col-md-2">
            <label for="client_id" class="form-label">From Date <span class="text-danger">*</span></label>
            <input type="date" name="fDate" class="form-control" value="{{$fDate}}">
          </div>
          <div class="col-md-2">
            <label for="client_id" class="form-label">To Date<span class="text-danger">*</span></label>
          <input type="date" name="tDate" class="form-control"  value="{{$tDate}}">
          </div>
          <div class="col-md-2">
            <label for="warranty_expiry" class="form-label">Client Name<span class="text-danger">*</span></label>
          <input type="text" name="cName" class="form-control" value="{{$cName}}">
          </div>
           <div class="col-md-2">
            <label for="warranty_expiry" class="form-label">Status<span class="text-danger">*</span></label>
           <select name="status" class="form-control select2">
            <option value="">Select Status</option>
            <option value="1" {{$status == 1 ? 'selected':''}}>Paid</option>
            <option value="2" {{$status == 2 ? 'selected':''}}>UnPaid</option>
           </select>
          </div>
           <div class="col-md-2">
            <br>
          <button type="submit" class="btn btn-success btn-sm" style="margin-top: 8px;">Submit</button>
          </div>
        </div>
        </form>
      </div>
  </div>
  <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
   <thead>
    <tr>
        <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
        <th><input type="checkbox"  id="selectAll"> &nbsp;&nbsp;&nbsp;#</th>         
        <th>Customer Name</th>
        <th>Invoice ID</th>
        <th>Invoice Date</th>
        <th>Due Date</th>
        <th>Total Amount</th>
        <th>Status</th>

        <th>Action</th>
    </tr>
</thead>
<tbody>

    @if(count($Invoice) > 0)
    @foreach($Invoice as $key => $Inventor)

    <tr class="odd">
        <td><input type="checkbox" name="ids[]" class="selectId" value="{{$Inventor->id}}"> &nbsp;&nbsp;{{ $key + 1 }} </td>
        <td>
            @if($Inventor->profile_img)
            <img class="rounded-circle"
            style="margin-right: 15px;margin-top: 10px;" 
            src="{{$Inventor->profile_img}}"
            height="30"
            width="30"
            alt="User avatar" />
            @else
            <img class="rounded-circle"
            style="margin-right: 15px;margin-top: 10px;" 
            src="{{url('public/images/21104.png')}}"
            height="30"
            width="30"
            alt="User avatar" />
            @endif

            {{$Inventor->first_name }}<div style="font-size:12px;margin-left: 46px;margin-top: -11px;">{{$Inventor->post_name}}</div></td>
            <td>
                <a href="{{ url('admin/Invoices/view/'.$Inventor->id) }}">
                    @if($Inventor && $Inventor->invoice_number2) 
                    {{ $Inventor->invoice_number2 }} 
                    @endif
                </a>
            </td>
            <td>@if($Inventor && $Inventor->issue_date) {{ $Inventor->issue_date }} @endif</td>
            <td>@if($Inventor && $Inventor->due_date) {{ $Inventor->due_date }} @endif</td>
            <td>{{ $Inventor->prefix}} {{number_format($Inventor->final_total_amt ?? 0,2) }} </td>
           
                        <td>
                            @if($Inventor && $Inventor->is_payment_recieved == 1)
                            <span class="btn btn-success btn-sm">Paid</span>
                            @else
                            <span class="btn btn-danger btn-sm">Unpaid</span>
                            @endif
                        </td> 
                        <td>
                            <div class="btn-group">
                          <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti ti-dots-vertical"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end" style="">
                             <li><a class="dropdown-item" href="{{ url('admin/Invoices/edit/'.$Inventor->id) }}">Edit</a></li>
                           
                            <li><button class="dropdown-item delete_debtcase" url="{{ url('admin/Invoices/delete/'.$Inventor->id) }}">Delete</button></li>
                             @if($Inventor && $Inventor->is_payment_recieved == 0)
                            <button class="dropdown-item btn-next rzp-payment-btn" data-id="{{ $Inventor->id }}" data-amount="{{ $Inventor->final_total_amt }}">Pay</button>
                             @endif
                          </ul>
                      </div>
                  
                        </td>
                      
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
              {{ $Invoice->links() }}
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

</script><script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    document.querySelectorAll('.rzp-payment-btn').forEach(button => {
        button.addEventListener('click', function() {
            var invoiceId = this.getAttribute('data-id');
            var paymentAmount = parseFloat(this.getAttribute('data-amount'))*100; // Convert amount to paise
            
            var finalAmount = paymentAmount.toFixed(2);
            var options = {
                "key": "rzp_test_905d9rOq4TKriv",
                "amount": finalAmount,
                "currency": "{{ $default_currency->code }}",
                "name": "Tech CRM",
                "image": "{{url('/')}}/public/logo/company.png",
                "handler": function(response) {
                    window.location.href = "{{ url('admin/Invoices/paymentStatusUpdate') }}?orderId=" + invoiceId + "&payment_id=" + response.razorpay_payment_id;
                },
                "theme": {
                    "color": "#3399cc"
                }
            };

            var rzp1 = new Razorpay(options);
            rzp1.open();
        });
    });
</script>

@endsection