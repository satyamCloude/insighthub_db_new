@extends('layouts.admin')
@section('title', 'Inventory')
@section('content')
<!-- Add the Bootstrap JavaScript and jQuery dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
<div class="container-xxl flex-grow-1 container-p-y">
   <!-- <h4 class="py-3 mb-4"><span class="text-muted fw-light">Inventory /</span> Home</h4> -->
   @if(Session::has('success'))
   <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
   @endif
   <!-- Users List Table -->
   <div class="card">
      <div class="card-datatable table-responsive">
         <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row p-2">
            <h5 class="card-title mb-sm-0 me-2">Ticket Module Setting's</h5>
            <a href="{{url('admin/ETempleteSettings/home')}}"><button class="btn btn-outline-primary">BACK</button></a>
         </div>
         @if(Session::has('success'))
         <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
         @endif
         <div class="row mb-4">
            <div class="col-md-12">
               <form action="{{url('admin/ETemplatesettings/TicketEmailSetting/store')}}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="card-body">
                     <div class="row mb-4">
                        <div class="col-md-12">
                           <label for="subject" class="form-label">
                              <h5>Name <span class="text-danger">*</span></h5>
                           </label>
                           <input type="text" class="form-control" name="name" />
                        </div>

                        <div class="col-md-12">
                           <label for="subject" class="form-label">
                              <h5>Subject <span class="text-danger">*</span></h5>
                           </label>
                           <input type="text" class="form-control" name="subject" />
                        </div>
                     </div>
                     <div class="row mb-4">
                        <div class="col-12">
                           <label for="header" class="form-label">
                              <h5>Header<span class="text-danger">*</span></h5>
                           </label>
                           <textarea type="text" name="header" class="form-control"></textarea>
                        </div>
                     </div>
                     <div class="row mb-4">
                        <div class="col-12">
                           <label for="discription" class="form-label">
                              <h5>Template<span class="text-danger">*</span></h5>
                           </label>
                           <textarea type="text" name="template" class="form-control"></textarea>
                        </div>
                     </div>
                     <div class="row mb-4">
                        <div class="col-12">
                           <label for="footer" class="form-label">
                              <h5>Footer<span class="text-danger">*</span></h5>
                           </label>
                           <textarea type="text" name="footer" class="form-control"></textarea>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <h4>Ticket Module Related</h4>
                        <table>
                           <tr>
                              <td>Invoice ID</td>
                              <td> </td>
                              <td> </td>
                              <td>{$invoice_id}</td>
                           </tr>
                           <tr>
                              <td>Invoice</td>
                              <td> </td>
                              <td></td>
                              <td>{$invoice_num}</td>
                           </tr>
                           <tr>
                              <td>Date Created</td>
                              <td> </td>
                              <td> </td>
                              <td>{$invoice_date_created}</td>
                           </tr>
                           <tr>
                              <td>Due Date</td>
                              <td> </td>
                              <td> </td>
                              <td>{$invoice_date_due}</td>
                           </tr>
                           <tr>
                              <td>Date Paid</td>
                              <td> </td>
                              <td> </td>
                              <td>{$invoice_date_paid}</td>
                           </tr>
                           <tr>
                              <td>Date Paid</td>
                              <td> </td>
                              <td> </td>
                              <td>{$invoice_date_paid}</td>
                           </tr>
                           <tr>
                              <td>Invoice Items (Array)</td>
                              <td> </td>
                              <td> </td>
                              <td>$invoice_items}</td>
                           </tr>
                           <tr>
                              <td>Tax</td>
                              <td> </td>
                              <td> </td>
                              <td>{$invoice_tax}</td>
                           </tr>
                           <tr>
                              <td>Total</td>
                              <td> </td>
                              <td> </td>
                              <td>{$invoice_total}</td>
                           </tr>
                           <tr>
                              <td>Amount Paid</td>
                              <td> </td>
                              <td> </td>
                              <td>{$invoice_amount_paid}</td>
                           </tr>
                           <tr>
                              <td>Balance</td>
                              <td> </td>
                              <td> </td>
                              <td>{$invoice_balance}</td>
                           </tr>
                           <tr>
                              <td>Expiry Date</td>
                              <td> </td>
                              <td> </td>
                              <td>{$invoice_pay_method_expiry}</td>
                           </tr>
                           <tr>
                              <td>Payment Link</td>
                              <td> </td>
                              <td> </td>
                              <td>{$invoice_payment_link}</td>
                           </tr>
                           <tr>
                              <td>Subscription ID</td>
                              <td> </td>
                              <td> </td>
                              <td>{$invoice_subscription_id}</td>
                           </tr>
                           <tr>
                              <td>Status</td>
                              <td> </td>
                              <td> </td>
                              <td>{$invoice_status}</td>
                           </tr>
                           <tr>
                              <td>Total Due Invoices Balance</td>
                              <td> </td>
                              <td> </td>
                              <td>{$invoice_total_balance_due}</td>
                           </tr>
                        </table>
                     </div>
                  </div>
                  <div class="card-footer">
                     <div class="row mb-4">
                        <!-- <div class="col-md-6 text-end" >
                           <button type="button" onclick="Tab(value)" value="SmSEmail" class="btn btn-label-danger me-3">
                           <span class="align-middle"> Back</span>
                           </button>
                           </div> -->
                        <div class="col-md-6">
                           <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<script src="https://cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>
<script>
   CKEDITOR.replace( 'header' );
   CKEDITOR.replace( 'footer' );
   CKEDITOR.replace( 'template' );
</script>
@endsection