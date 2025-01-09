@extends('layouts.admin')
@section('title', 'Edit')
@section('content')

<style>

.dropbtn {
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
  background-color: #fff;
  border: 1px solid #dbdade;
  border-radius: 0.375rem;
  border-color: #C9C8CE !important;
  height:40px;
  width:100%;
  text-align:left;
  color:#6f6b7d;
  font-weight:500;
  font-size:16px;
  display:flex;
  justify-content:space-between;
  align-items:center;
}

}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 100%;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #f1f1f1}

.dropdown:hover .dropdown-content {
  display: block;
}

.dropdown:hover .dropbtn {
  background-color: white;
}


.outer:hover{

  background-color:#685dd8 !important;
  color:white !important;

}


.outer{


  background-color: rgba(115, 103, 240, 0.08);
  color: #7367f0;

  border-radius:10px;



}

</style>

<!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">IPAddress /</span> Edit</h4>
    <!-- Sticky Actions -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
            <h5 class="card-title mb-sm-0 me-2">Edit Detail's</h5>
            <div class="action-btns">
              <a href="{{url('admin/IPAddress/home')}}" class="btn btn-label-primary me-3">
                <span class="align-middle"> Back</span>
              </a>
            </div>
          </div>
          <form action="{{url('admin/IPAddress/update/'.$IPAddress->id)}}" method="post" enctype="multipart/form-data"> 
            @csrf
            <div class="card-body">
              <h5 class="mb-4">1. General Details</h5>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="network_subnet" class="form-label">IP Address <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="ip_address" @if($IPAddress && $IPAddress->ip_address) value="{{$IPAddress->ip_address}}" @endif placeholder="Enter Network Subnet"/>
                </div>
                <div class="col-md-6">
                      <label for="private_ip" class="form-label">Private IP <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="private_ip" @if($IPAddress && $IPAddress->private_ip) value="{{$IPAddress->private_ip}}" @endif placeholder="Enter private ip"/>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="vlan" class="form-label">VLAN <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="vlan" @if($IPAddress && $IPAddress->vlan) value="{{$IPAddress->vlan}}" @endif placeholder="Enter VLAN"/>
                </div>
                <div class="col-md-6">
                      <label for="gateway" class="form-label">Gateway <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="gateway" @if($IPAddress && $IPAddress->gateway) value="{{$IPAddress->gateway}}" @endif placeholder="Enter Gateway"/>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="primary_name_server" class="form-label">Primary Name Server <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="primary_name_server" @if($IPAddress && $IPAddress->primary_name_server) value="{{$IPAddress->primary_name_server}}" @endif placeholder="Enter Primary Name Server"/>
                </div>
                <div class="col-md-6">
                      <label for="secondary_name_server" class="form-label">Secondary Name Server<span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="secondary_name_server" @if($IPAddress && $IPAddress->secondary_name_server) value="{{$IPAddress->secondary_name_server}}" @endif placeholder="Enter Secondary Name Server"/>
                </div>
              </div>
              <div class="row mb-4"> 
                <div class="col-md-6">
                      <label for="dc_location_id" class="form-label">DC Location <span class="text-danger">*</span></label>
                      <select class="form-control" name="dc_location_id">                                      
                        @foreach($Countrys as $Count)
                        <option @if($IPAddress && $IPAddress->dc_location_id == $Count->country_id) selected @endif value="{{$Count->country_id}}">{{$Count->country_name}}</option>                                         
                        @endforeach
                      </select>
                </div>
                <div class="col-md-6">
                      <label for="ip_type" class="form-label">IP Type <span class="text-danger">*</span></label>
                      <select class="form-control" name="ip_type" >          
                        <option @if($IPAddress && $IPAddress->ip_type == '1') selected @endif value="1">Public</option>                         
                        <option @if($IPAddress && $IPAddress->ip_type == '2') selected @endif value="2">Private</option>                         
                      </select>
                </div>
              </div>
                 <div class="row mb-4"> 
                  <div class="col-md-6">
                       <label for="customer_id" class="form-label">Customer Name <span class="text-danger">*</span></label>
                      <!--<select class="form-control" name="customer_id">                -->
                      <!-- @foreach($customer as $Count)-->
                      <!--  <option @if($IPAddress && $IPAddress->customer_id == $Count->id) selected @endif -->
                      <!--  value="{{$Count->id}}">{{$Count->first_name}}</option>                                              -->
                      <!--  @endforeach-->
                      <!--</select>-->
                       @php
                            // Use the `firstWhere` collection method to find the first client matching the Ticket's ccid
                            $client = collect($customer)->firstWhere('id', $IPAddress->customer_id);
                    
                            // Use null coalescence operator to handle the case when $client is null
                           
                            $first_name = $client->first_name ?? 'Select Customer';
                            $last_name = $client->last_name ?? '';
                            $id = $client->id ?? '';
                            
                        @endphp
                      <div class="dropdown">
                                      <button class="dropbtn" id="selected_customer_btn">{{$first_name}} {{$last_name}}<i class="fa fa-angle-down" style="font-size:24px"></i></button>
                                      <div class="dropdown-content" style="max-height: 45vh;overflow: auto;">
                                          
                                         @foreach($customer as $vendors)
                                          <div class="outer" id="customer_{{ $vendors->id }}" style="display:flex;margin:6px;padding:4px;color:black;" onclick="selectClient('{{ $vendors->id }}')">
                                              <div style="border-radius:50%;">
                                                  @if($vendors->profile_img)
                                                    <img src="{{ $vendors->profile_img }}" style="width:45px;border-radius:50%;height:auto;">
                                                  @else
                                                    <img src="https://i.pinimg.com/564x/8b/16/7a/8b167af653c2399dd93b952a48740620.jpg" style="width:45px;border-radius:50%;height:auto;">
                                                  @endif
                                              </div>
                                              <div class="sie_cont" style="display:flex;flex-direction:column;margin:5px;">
                                                <span>{{ $vendors->first_name }} {{$vendors->last_name}} |  #{{$vendors->id }} <br>
                                                {{$vendors->company_name }}</span>
                                              </div>
                                          </div>
                                          @endforeach
                                      </div>
                                  </div>
                                  <input type="hidden" name="customer_id" id="customer_name" value="{{$id}}">
                  </div>
                  <div class="col-md-6">
                      <label for="subnet_mask" class="form-label">Subnet Mask <span class="text-danger">*</span></label>
                       <input type="text" class="form-control" name="subnet_mask" @if($IPAddress && $IPAddress->subnet_mask) value="{{$IPAddress->subnet_mask}}" @endif/>
                  </div>
                </div>
               <div class="row mb-4"> 
                <div class="col-md-12">
                      <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                       <div class="editor-container">
                            <div class="full-editor geteditor">@if($IPAddress && $IPAddress->description) {!!$IPAddress->description!!} @endif</div>
                            <input type="hidden" name="description" @if($IPAddress && $IPAddress->description) value="{{$IPAddress->description}}" @endif class="hidden-field">
                        </div>
                </div>
            </div>     
            </div>
            <div class="card-footer">
              <div class="row mb-4"> 
                <div class="col-md-6 text-end" >
                  <a href="{{url('admin/IPAddress/home')}}" type="button" class="btn btn-outline-danger">Discard</a>
                </div>
                <div class="col-md-6">
                  <button type="submit" class="btn btn-success">Submit</button>
                </div>
              </div>
            </div> 
          </form>
        </div>
      </div>
    </div>
    <!-- /Sticky Actions -->
  </div>
<!-- / Content -->
<script>
  $(document).ready(function () {
    // Function to update the hidden field based on the editor content
    function updateHiddenField(index) {
      var editorContentText = $(".full-editor.geteditor").eq(index).html();
      console.log("Editor " + (index + 1) + " Text content: " + editorContentText);

      // Update the value of the hidden field based on the index
      $('.hidden-field').eq(index).val(editorContentText);
    }

    // Use event delegation to handle keyup and blur on any .full-editor.geteditor
    $(document).on('keyup blur', '.full-editor.geteditor', function () {
      // Get the index of the editor
      var index = $(".full-editor.geteditor").index(this);

      // Update the corresponding hidden field
      updateHiddenField(index);
    });
  });
  
  
  
  function selectClient(id) {
        var clientName = $('#customer_' + id + ' .sie_cont span:first-child').text(); // Extract client name from selected item
        // alert(clientName);
        $('#selected_customer_btn').text(clientName); // Set the button text to the selected client name
        $('#customer_name').val(id); // Set the button text to the selected client name
    
        $('.dropdown-content .outer').removeClass('selected');
    
        // Add the 'selected' class to the clicked option
        $('#customer_' + id).addClass('selected');
  }
</script>
@endsection