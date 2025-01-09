<style>
    #disabl {
        display: none !important;
    }
</style>

  

      <div class="card-datatable table-responsive">
        <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
      
            <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
              <h5 class="card-title mb-sm-0 me-2 p-2">Add Detail's</h5>
            </div>
            <form action="{{url('admin/CompanySettings/store')}}" method="post" enctype="multipart/form-data"> 
                                @csrf
                                <div class="card-body">
                                  <div class="row mt-4"> 
                                    <div class="col-sm-6 mb-4">
                                            <label for="project_name" class="form-label">Company Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" @if($CompanyLogin && $CompanyLogin->company_name) value="{{$CompanyLogin->company_name}}" @endif name="company_name" required/>
                                        </div>

                                    <div class="col-sm-6 mb-4">
                                          <label for="project_name" class="form-label">Company Email<span class="text-danger">*</span></label>
                                          <input type="email" class="form-control" @if($CompanyLogin && $CompanyLogin->email_address) value="{{$CompanyLogin->email_address}}" @endif  name="email_address" required/>
                                    </div> 
                                    <div class="col-sm-6 mb-4">
                                          <label for="project_name" class="form-label">Company Phone<span class="text-danger">*</span></label>
                                         <input type="text" class="form-control" @if($CompanyLogin && $CompanyLogin->contact_no) value="{{$CompanyLogin->contact_no}}" @endif name="contact_no" required/>
                                    </div>
                                    <div class="col-sm-6 mb-4">
                                          <label for="project_name" class="form-label">Company Website<span class="text-danger">*</span></label>
                                           <input type="text" class="form-control" @if($CompanyLogin && $CompanyLogin->company_website) value="{{$CompanyLogin->company_website}}" @endif name="company_website" required/>

                                    </div>
                                    <div class="col-sm-6 mb-4">
                                          <label for="project_name" class="form-label">Country<span class="text-danger">*</span></label>
                                          <select class="form-control" name="country_id">
                                            @foreach($Country as $countrys)
                                            <option value="{{$countrys->id}}">{{$countrys->name}}</option>
                                            @endforeach
                                          </select>
                                    </div>
                                    <div class="col-sm-6 mb-4">
                                          <label for="project_name" class="form-label">Location<span class="text-danger">*</span></label>
                                         <input type="text" class="form-control" @if($CompanyLogin && $CompanyLogin->location) value="{{$CompanyLogin->location}}" @endif name="location" required/>
                                    </div>
                                    <div class="col-sm-6 mb-4">
                                          <label for="project_name" class="form-label">Tax Name<span class="text-danger">*</span></label>
                                         <input type="hidden" class="form-control"  name="user_id" value="{{ Auth::user()->id }}" />
                                         <input type="text" class="form-control" @if($CompanyLogin && $CompanyLogin->tax_name) value="{{$CompanyLogin->tax_name}}" @endif name="tax_name" required/>

                                    </div>
                                    <div class="col-sm-6 mb-4">
                                          <label for="project_name" class="form-label">Tax Number<span class="text-danger">*</span></label>
                                         <input type="text" class="form-control" @if($CompanyLogin && $CompanyLogin->tax_number) value="{{$CompanyLogin->tax_number}}" @endif name="tax_number" required/>

                                    </div>
                                   <!--   <div class="col-sm-6 mb-4">
                                          <label for="project_name" class="form-label">Latitude<span class="text-danger">*</span></label>
                                         <input type="text" class="form-control" @if($CompanyLogin && $CompanyLogin->latitude) value="{{$CompanyLogin->latitude}}" @endif name="latitude" required/>

                                    </div>
                                     <div class="col-sm-6 mb-4">
                                          <label for="project_name" class="form-label">Longitude<span class="text-danger">*</span></label>
                                         <input type="text" class="form-control" @if($CompanyLogin && $CompanyLogin->longitude) value="{{$CompanyLogin->longitude}}" @endif name="longitude" required/>
                                    </div> -->
                                    <div class="col-sm-12 mb-4">
                                          <label for="billing_address" class="form-label">Billing Address <span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="billing_address"> @if($CompanyLogin && $CompanyLogin->billing_address) {{$CompanyLogin->billing_address}} @endif</textarea>


                                    </div>
                                    <div class="col-sm-12 mb-4">
                                          <label for="project_name" class="form-label">Address <span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="address"> @if($CompanyLogin && $CompanyLogin->address) {{$CompanyLogin->address}} @endif</textarea>


                                    </div>
                                  </div>               
                                </div>               
                                <div class="card-footer">
                                  <div class="row mb-4"> 
                                    <div class="col-md-5 text-end" >
                                      <!-- <a href="{{url('admin/LeadSettings/home')}}" type="button" class="btn btn-outline-danger">Discard</a> -->
                                    </div>
                                    <div class="col-md-7">
                                      <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                  </div>
                                </div> 
            </form>
         </div>
      </div>
                   
            
 