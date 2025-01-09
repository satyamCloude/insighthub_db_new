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
            <h5 class="card-title mb-sm-0 me-2">Client Module Setting's</h5>
            <a href="{{url('admin/ETempleteSettings/home')}}"><button class="btn btn-outline-primary">BACK</button></a>
          </div>
           @if(Session::has('success'))
         <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
          @endif
          <div class="row mb-4"> 
                <div class="col-md-12">

          <form action="{{url('admin/ClientModule/store/'.$id)}}" method="post" enctype="multipart/form-data"> 
           @csrf
            <div class="card-body">
              <div class="row mb-4"> 
                
                <div class="col-md-12">
                      <label for="subject" class="form-label"><h5>Subject <span class="text-danger">*</span></h5></label>
                      <input type="text" class="form-control" name="subject" />
                </div>
               
            </div> 
            <div class="row mb-4"> 
                <div class="col-12">
                      <label for="header" class="form-label"><h5>Header<span class="text-danger">*</span></h5></label>
                       <textarea type="text" name="header" class="form-control"></textarea>                     
                </div>
            </div>
             <div class="row mb-4"> 
                <div class="col-12">
                      <label for="discription" class="form-label"><h5>Template<span class="text-danger">*</span></h5></label>
                       <textarea type="text" name="template" class="form-control"></textarea>                     
                </div>
            </div>
           
             <div class="row mb-4"> 
                <div class="col-12">
                      <label for="footer" class="form-label"><h5>Footer<span class="text-danger">*</span></h5></label>
                       <textarea type="text" name="footer" class="form-control"></textarea>                     
                </div>
            </div>
            </div>
            <div class="row">
               <div class="col-md-12">
                          <h4>Client Module Related</h4>
                          <table>
                            <tr>
                              <td>ID</td>
                              <td> </td><td> </td>
                              <td>{$client_id}</td>
                            </tr>
                            <tr>
                              <td>Client Name</td>
                              <td> </td><td></td>
                              <td>{$client_name}</td>
                            </tr>
                             <tr>
                              <td>First Name</td>
                              <td> </td><td> </td>
                              <td>{$client_last_name}</td>
                            </tr>
                            <tr>
                              <td>Company Name</td>
                              <td> </td><td> </td>
                              <td>{$client_company_name}</td>
                            </tr>
                            <tr>
                              <td>Email Address</td>
                              <td> </td><td> </td>
                              <td>{$client_email}</td>
                            </tr>
                            <tr>
                              <td>Address 1</td>
                              <td> </td><td> </td>
                              <td>{$client_address1}</td>
                            </tr>
                            <tr>
                              <td>Address 2</td>
                              <td> </td><td> </td>
                              <td>{$client_address2}</td>
                            </tr>
                             <tr>
                              <td>City </td>
                              <td> </td><td> </td>
                              <td>{$client_city}</td>
                            </tr>
                            <tr>
                              <td>State/Region</td>
                              <td> </td><td> </td>
                              <td>{$client_state}</td>
                            </tr>
                            <tr>
                              <td>Postcode</td>
                              <td> </td><td> </td>
                              <td>{$client_postcode}</td>
                            </tr>
                            <tr>
                              <td>Country </td>
                              <td> </td><td> </td>
                              <td>{$client_country}</td>
                            </tr>
                            <tr>
                              <td>Phone Number</td>
                              <td> </td><td> </td>
                              <td>{$client_phonenumber}</td>
                            </tr>

                            <tr>
                              <td>Tax ID</td>
                              <td> </td><td> </td>
                              <td>{$client_tax_id}</td>
                            </tr>

                            <tr>
                              <td>Signup Date</td>
                              <td> </td><td> </td>
                              <td>{$client_signup_date}</td>
                            </tr>


                             <tr>
                              <td>Total Due Invoices Balance</td>
                              <td> </td><td> </td>
                              <td>{$client_due_invoices_balance}</td>
                            </tr> 

                            <tr>
                              <td>Status</td>
                              <td> </td><td> </td>
                              <td>{$client_status}</td>
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
<script src="https://cdn.ckeditor.com/4.24.0-lts/standard/ckeditor.js"></script>
<script>
 CKEDITOR.replace( 'header' );
 CKEDITOR.replace( 'footer' );
 CKEDITOR.replace( 'template' );
</script>
@endsection