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
            <h5 class="card-title mb-sm-0 me-2">Invoice Module Setting's</h5>
            <!-- <a href="{{url('admin/ETempleteSettings/home')}}"><button class="btn btn-outline-primary">BACK</button></a> -->
          </div>
           @if(Session::has('success'))
         <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
          @endif
          <div class="row mb-4"> 
                <div class="col-md-12">

          <form action="{{url('admin/InvoiceModule/store/'.$id)}}" method="post" enctype="multipart/form-data"> 
           @csrf
            <div class="card-body">
              <div class="row mb-4"> 
                
                <div class="col-md-12 ">
                      <label for="subject" class="form-label"><h5>Subject <span class="text-danger">*</span></h5></label>
                      <input type="text" class="form-control" value="@if($template_data && $template_data->subject)  {{$template_data->subject}} @endif" name="subject" />
                </div>
               
            </div> 
            <div class="row mb-4"> 
                <div class="col-md-12">
                      <label for="header" class="form-label"><h5>Header<span class="text-danger">*</span></h5></label>
                       <textarea type="text" name="header" id="header" class="form-control">@if($template_data && $template_data->header)  {{$template_data->header}} @endif</textarea>                     
                </div>
            </div>
             <div class="row mb-4"> 
                <div class="col-md-12">
                      <label for="discription" class="form-label"><h5>Template<span class="text-danger">*</span></h5></label>
                       <textarea type="text" name="template" id="template" class="form-control">@if($template_data && $template_data->template)  {{$template_data->template}} @endif</textarea>                     
                </div>
            </div>
           
             <div class="row mb-4"> 
                <div class="col-md-12">
                      <label for="footer" class="form-label"><h5>Footer<span class="text-danger">*</span></h5></label>
                       <textarea type="text" name="footer"  id="footer" class="form-control">@if($template_data && $template_data->footer)  {{$template_data->footer}} @endif</textarea>                     
                </div>
            </div>
            </div>
             <div class="col-md-12">
                          <h4>Invoice Module Related</h4>
                            <table>
                            <tr>
                              <td>Invoice ID</td>
                              <td> </td><td> </td>
                              <td>{$invoice_id}</td>
                            </tr>
                            <tr>
                              <td>Invoice</td>
                              <td> </td><td></td>
                              <td>{$invoice_num}</td>
                            </tr>
                             <tr>
                              <td>Date Created</td>
                              <td> </td><td> </td>
                              <td>{$invoice_date_created}</td>
                            </tr>
                            <tr>
                              <td>Due Date</td>
                              <td> </td><td> </td>
                              <td>{$invoice_date_due}</td>
                            </tr>
                            <tr>
                              <td>Date Paid</td>
                              <td> </td><td> </td>
                              <td>{$invoice_date_paid}</td>
                            </tr>
                            <tr>
                              <td >Invoice Items (Array)</td>
                              <td> </td><td> </td>
                              <td>$invoice_items}</td>
                            </tr>
                             <tr>
                              <td>Tax</td>
                              <td> </td><td> </td>
                              <td>{$invoice_tax}</td>
                            </tr>
                            <tr>
                              <td>Total</td>
                              <td> </td><td> </td>
                              <td>{$invoice_total}</td>
                            </tr>
                            <tr>
                              <td>Amount Paid</td>
                              <td> </td><td> </td>
                              <td>{$invoice_amount_paid}</td>
                            </tr>
                            <tr>
                              <td>Current Date</td>
                              <td> </td><td> </td>
                              <td>{$invoice_current_date}</td>
                            </tr>
                            <tr>
                              <td class="text-danger">Balance</td>
                              <td> </td><td> </td>
                              <td class="text-danger">{$invoice_balance}</td>
                            </tr>
                            <tr>
                              <td class="text-danger">Expiry Date</td>
                              <td> </td><td> </td>
                              <td class="text-danger">{$invoice_pay_method_expiry}</td>
                            </tr>
                            <tr>
                              <td class="text-danger">Payment Link</td>
                              <td> </td><td> </td>
                              <td class="text-danger">{$invoice_payment_link}</td>
                            </tr>
                             <tr>
                              <td class="text-danger">Subscription ID</td>
                              <td> </td><td> </td>
                              <td class="text-danger">{$invoice_subscription_id}</td>
                            </tr>
                             <tr>
                              <td class="text-danger">Status</td>
                              <td> </td><td> </td>
                              <td class="text-danger">{$invoice_status}</td>
                            </tr>
                             <tr>
                              <td class="text-danger">Total Due Invoices Balance</td>
                              <td> </td><td> </td>
                              <td class="text-danger"> {$invoice_total_balance_due}</td>
                            </tr>
                          </table>

                         
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


<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.js"></script>
<script>
$('#header').summernote();
$('#footer').summernote();
$('#template').summernote();
</script>
@endsection