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





    .inner_cont{



        background-color:white;

        color:grey;

        border-radius: 6px;

        box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;padding:0px 5px;



    }

</style>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>

<div class="container-xxl flex-grow-1 container-p-y">

  <h4 class="py-3 mb-4"><span class="text-muted fw-light">Invoices /</span> TDS</h4>

  @if(Session::has('success'))

  <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>

  @endif

<br>

            <div class="card">

                <div class="row">
                    <div class="col-md-12 d-flex justify-content-between" >
                   
                        <h5 class="card-header">TDS List</h5>
                         <small class="text-muted mt-4"><a href="{{url('admin/Invoices/home')}}" class="btn btn-sm btn-primary">Back</a></small>
                    </div>
                    

                    <div class="col-md-12">
                        <form class="d-flex justify-content-center mb-3">
                            <div >
                                <label for="warranty_expiry" class="form-label">Client Name<span class="text-danger">*</span></label>
                                <input type="text" name="cName" class="form-control" value="{{$cName}}">
                            </div>&nbsp;&nbsp;
                            <div >
                                <label for="warranty_expiry" class="form-label">Client Id<span class="text-danger">*</span></label>
                                <input type="text" name="ClientId" class="form-control" value="{{$ClientId}}">
                            </div>&nbsp;&nbsp;
                            <div >
                                <br>
                                <button type="submit" class="btn btn-success btn-sm" style="margin-top: 8px;">Submit</button>
                            </div>
                        </form>
                    </div>
                    <table id="invoiceListTable" class="invoice-list-table table border-top">
                        <thead>
                          <tr>

                            <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>

                            <th><input type="checkbox" id="selectAll"> &nbsp;&nbsp;&nbsp;#ID</th>

                            <th>Customer Name</th>

                            <th>Service Name</th>

                            <th>TDS (%)</th>

                            <th>TDS Amount</th>

                            <!-- <th class="cell-fit">Actions</th> -->

                          </tr>
                        </thead>

      

                        <tbody>



                            @if(count($Invoice) > 0)

                            @foreach($Invoice as $key => $Inventor)



                            <tr class="odd">

                                <td><input type="checkbox" name="ids[]" class="selectId" value="{{$Inventor->id}}"> &nbsp;&nbsp;{{ $key + 1 }} </td>
                     <td>
                                        <a href="{{url('admin/Client/view/'.$Inventor->id)}}">   
                                                
                                                <div class="parent d-flex">
                                                      <div class="child1"> @if($Inventor->profile_img)
                                                     <img 
                                                        class="rounded-circle"
                                                        style="margin-right: 15px;margin-top: 10px;" 
                                                        src="{{$Inventor->profile_img}}"
                                                        height="30"
                                                        width="30"
                                                        alt="User avatar" /> 
                                                  @else
                                                  <img 
                                                        class="rounded-circle"
                                                        style="margin-right: 15px;margin-top: 10px;" 
                                                        src="{{url('public/images/21104.png')}}"
                                                        height="30"
                                                        width="30"
                                                        alt="User avatar" />
                            
                                                  @endif   </div>
                                              <div class="child2">{{ $Inventor->first_name }} {{ $Inventor->last_name }}   ({{$Inventor->users_id}}) <br>{{ $Inventor->companys_name }}</div>
                                              </div>
                                          
                                               </a>
                                                </td>

                                    <td>

                                        @if($Inventor && $Inventor->product_name) 

                                        {{ $Inventor->product_name }} 

                                        @endif

                                    </td>

                                    <td>

                                        @if($Inventor && $Inventor->tds_percent) 

                                        {{ $Inventor->tds_percent ?? 0.00 }}%

                                        @endif

                                    </td>  

                                    <td>
                                    @php         
                                    $final_amt = ($Inventor->tds_percent/100)*$Inventor->final_total_amt;
                                    @endphp
                                    {{number_format($final_amt,2)}}
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
                </div>
            </div>

</div>






<script>

    $(document).ready(function () {

        $('#invoiceListTable').DataTable();

    });

</script>



<script>

    $('.auto_pay').click(function() {

        var invoiceId = this.getAttribute('data-id');

        var paymentAmount = parseFloat(this.getAttribute('data-amount')); // Convert amount to dollars

        $('#invoiceId').val(invoiceId);

        $('#paymentAmounthidden').val(paymentAmount.toFixed(2)); // Format to 2 decimal places

        $('#paymentAmount').val(''); // Clear the payment amount input initially

        $('#paymentModal').modal('show');

    });



    $('#showPaymentAmount').change(function() {

        var paymentAmounthidden = $('#paymentAmounthidden').val();

        var isChecked = $(this).is(':checked');

        if (isChecked) {

            $('#paymentAmount').val(paymentAmounthidden); // Format to 2 decimal places

        } else {

            $('#paymentAmount').val(''); // Clear the payment amount input

        }

    });



    $('#paymentFormSubmit').click(function() {

        var invoiceId = $('#invoiceId').val();

        var paymentMethod = $('#selectBox').val();

        var transactionDate = $('#transaction_date').val();

        var transactionId = $('#transaction_id').val();

        var tdsPercent = $('#tdsPercent').val();

        var showPaymentAmount = $('#showPaymentAmount').val();

        var confrm_mail = $('#confrm_mail').val();

        var paymentAmount = $('#paymentAmount').val();

         $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

        });

        $.ajax({

            url: "{{ url('admin/Invoices/autopayinvoice') }}", // Controller route

            type: 'POST',

            data: {

                invoiceId: invoiceId,

                paymentMethod: paymentMethod,

                transactionDate: transactionDate,

                transactionId: transactionId,

                tdsPercent: tdsPercent,

                paymentAmount: paymentAmount,

                confrm_mail: confrm_mail,

                fullPaymentStatus: showPaymentAmount

            },

            success: function(response) {

                // Handle success response

                console.log(response);

                $('#paymentModal').modal('hide'); // Hide the modal on success

                 setTimeout(function() {

                    location.reload();

                }, 2000);

            },

            error: function(xhr, status, error) {

                // Handle error

                console.error(xhr.responseText);

                // Show error message

                $('#errorMsg').text("An error occurred. Please try again."); // Assuming you have an element with id 'errorMsg' to display the error message

            }

        });

    });

</script>



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

        $("#selectAll").click(function () {

            $(".selectId").prop("checked", $(this).prop("checked"));

            var id = [];



            $('.selectId:checked').each(function(i) {

                id.push($(this).val()); 

            });

            $('.pdfValue').val(id);

        });

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

   
</script>



@endsection