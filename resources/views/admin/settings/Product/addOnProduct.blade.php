
  <div class="card">
    <div class="row">
      <div class="col-md-6">
          <h5 class="card-header">Product</h5>
      </div>
     <!--  <div class="col-md-6 text-end">
         <button type="button" onclick="Tab(value)" value="ServiceAutomation" class="btn btn-warning"><i class="fas fa-sync-alt"></i></button>
          <button type="button" onclick="Tab(value)" value="AddServiceAutomation" class="btn btn-primary mt-3 m-3">Add Product</button>
         
      </div> -->
    </div>
      <div class="card-datatable table-responsive">
        <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5">
          <div class="row">
            <div class="col-sm-12 col-md-6">
              <div class="dataTables_length" id="DataTables_Table_3_length"><label>
              </div>
            </div>
          <!--   <div class="col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end">
              <div id="DataTables_Table_3_filter" class="dataTables_filter">
                 <form method="GET" action="">    
                  <label>Search: <input type="search" class="form-control" name="search" placeholder="" aria-controls="DataTables_Table_3"></label>
                </form>
            </div>
          </div> -->
          <table class="dt-responsive table dataTable dtr-column" id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info">
            <thead>
              <tr>
                <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                <th>ID</th>
                <th>Product Name</th>
                <th>Product Type</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="result">
            @if(count($Category) > 0)

              @foreach($Category as $key=> $Cat)
              <tr class="bg-secondary5">
                  <td>{{$key+1}}</td>
                  <td>@if($Cat && $Cat->Pname) {{ $Cat->Pname }} @endif</td>
                  <td>@if($Cat && $Cat->addOnProduct) {{ $Cat->addOnProduct }} @endif</td>
                  <td>
                    <svg xmlns="http://www.w3.org/2000/svg" style="width: 19px;" class="delete_debtcase1" url="{{url('admin/ProductAddOn/delete/'.$Cat->id)}}" id="{{$Cat->id}}" viewBox="0 0 448 512"><path d="M32 464a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V128H32zm272-256a16 16 0 0 1 32 0v224a16 16 0 0 1 -32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1 -32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1 -32 0zM432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.7 23.7 0 0 0 -21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0 -16-16z"/></svg>
                  </td>
              </tr>
               
              @endforeach
              @else
              <tr>
                <td class="text-center" colspan="5">No Data Found</td>
              </tr>
              @endif
            </tbody>
        </table>
          <div class="p-1" style="float: right;">
         
          </div>
      </div>
      </div>
    </div>
  </div>
 <div class="modal fade" id="AddOnProduct" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-simple modal-edit-user">
        <div class="modal-content p-3 p-md-5">
          <div class="modal-body">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="text-center mb-4">
              <h3 class="mb-2">Add On Product Info</h3>
            </div>
            <form action="{{url('admin/Product/storeAddOnProduct')}}" method="post" class="row g-3">
               @csrf
              <div class="col-12">
               <input type="hidden" name="product_id" id="product_id">
              </div>
              <div class="col-12">
                <label class="form-label">Product Name</label>
                <input type="text" id="product_name" class="form-control" name="product_name[]" placeholder="ABC" required/>
              </div>
              
              <div class="col-12">
                <label class="form-label">Product Description</label>
                <textarea name="description[]" id="descriptions" class="form-control"></textarea>
              </div>
              <div class="col-12">
                <label class="form-label" for="modalEditUserName">Pricing</label>
              <div class="row mb-3"> 
                <div class="col-md-2">
                  <label for="payment_type"  class="form-label">Payment Type</label>
                </div>
                <div class="col-md-3">
                  <label for="free"class="form-label"><input type="radio" onclick="free()" checked name="payment_type[0]" value="1" />&nbsp;&nbsp;Free</label>
                </div>
                <div class="col-md-3">
                  <label for="one_time"class="form-label"><input type="radio" onclick="onetimeAddOnOne()" name="payment_type[0]" value="2" />&nbsp;&nbsp;One Time</label>
                </div>
                <div class="col-md-3">
                  <label for="recurring"class="form-label"><input type="radio" onclick="recurringAddOnOne()" name="payment_type[0]" value="3" />&nbsp;&nbsp;Recurring</label>
                </div>
              </div>
          <div class="recurringAddOnOne"></div>
              </div>
            <div id="AppendProduct">
              
      
            </div>
            <div class="AppendProduct" style="text-align: end;">
          <button type="button"  class="btn btn-success me-sm-3 me-1 add">Add</button>
          <button type="button" class="btn btn-danger remove">Remove</button>
      </div>
        <div class="col-12">
          <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
          <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
      </div>
    </form>
  </div>
</div>
</div>
</div>
<div class="modal fade" id="showedit" data-bs-backdrop="statics" tabindex="-1" aria-modal="true" role="dialog"></div>
<script>
  $(document).ready(function () {
      $('#category_name').on('input', function () {
          // Get the value of the category_name input
          var categoryNameValue = $(this).val();

          // Update the value of the url input with the base URL and the category name
          $('#url').val("{{ url('/') }}" + '/' + categoryNameValue);
      });
  });


function editCategory(element) {
    var cate_id = $(element).attr('id');

    $.ajax({
        url: "{{ url('admin/Category/edit') }}",
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

    $(document).ready(function () {

        $(".delete_debtcase1").click(function (e) {
            var id = $(this).attr('id');
            var url = $(this).attr('url');
            e.preventDefault();
            bootbox.confirm({
                message: "Are you want to delete this product ?",
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
   

        $(".delete_1").click(function (e) {
            var id = $(this).attr('id');
            var url = $(this).attr('url');
            e.preventDefault();
            bootbox.confirm({
                message: "Are you sure ?",
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

      window.onload = function() {
          var tabs = "category";
          if (tabs) {
              productCategory(tabs);
          }
    }
    </script>
<script>
   function productCategory(value) {
    $.ajax({
        url: "{{ url('admin/product/categoryWise') }}",
        method: 'GET',
        data: { type: value },
        success: function (response) {
            $('#TBView').html(response);
        },
        error: function () {
        }
    });
}

////////////for add on product


 function openPopUp (id)
    { 
       $('#AddOnProduct').modal('show');
       $('#product_id').val(id);
    }


  $(document).ready(function() {
CKEDITOR.replace('descriptions', {
      extraPlugins: 'scayt',
      scayt_autoStartup: true,
    });


    $('.add').click(function() {
   var counter = $('.appendChield').length;
   var counterP = $('.appendChield').length+1;
   

$('#AppendProduct').append('<div class="appendChield">'+
    '<div class="col-12">'+
    '<label class="form-label">Product Name</label>'+
    '<input type="text" id="product_name" class="form-control" name="product_name[]" placeholder="ABC" required/>'+
    '</div>'+
    '<div class="col-12">'+
    '<label class="form-label">Product Description</label>'+
    '<textarea name="description[]" id="descriptions_' + counter + '" class="form-control"></textarea>'+
    '</div>'+
    '<div class="col-12">'+
    '<label class="form-label" for="modalEditUserName">Pricing</label>'+
    '<div class="row mb-3"> '+
    '<div class="col-md-2">'+
    '<label for="payment_type"  class="form-label">Payment Type</label>'+
    '</div>'+
    '<div class="col-md-3">'+
    '<label for="free"class="form-label">'+
    '<input type="radio" onclick="free()" checked name="payment_type['+counterP+']"  value="1" />&nbsp;&nbsp;Free</label>'+
    '</div>'+
    '<div class="col-md-3">'+
    '<label for="one_time"class="form-label">'+
    '<input type="radio" onclick="onetimeAddOn('+counter+')" name="payment_type['+counterP+']" value="2" />&nbsp;&nbsp;One Time</label>'+
    '</div>'+
    '<div class="col-md-3">'+
    '<label for="recurring"class="form-label">'+
    '<input type="radio" onclick="recurringAddOn('+counter+')" name="payment_type['+counterP+']" value="3" />&nbsp;&nbsp;Recurring</label>'+
    '</div>'+
    '</div>'+
    '<div class="mb-4 paymenttypeAddOn_'+ counter +'"></div>'+ 
    '</div>'+
    '</div>');
 CKEDITOR.replace('descriptions_'+counter, {
      extraPlugins: 'scayt',
      scayt_autoStartup: true,
    });
counter++;
counterP++;

});


$('.remove').click(function() {
    // $("#AppendProduct table:last-child").remove()
    $('#AppendProduct').children().last().remove();
});
});
/////price add on  
function onetimeAddOn(counterVar) {
  $(".paymenttypeAddOn_"+counterVar).html('<div class="row">' +
    '<div class="col-md-2 bg-success">' +
    '<label for="Currency" class="form-label">Currency</label>' +
    '</div>' +
    '<div class="col-md-2 bg-success">' +
    '<label for="One Time" class="form-label">One Time</label>' +
    '</div>' +
    '</div>' +
    '<div class="row mt-3">' +
    '<div class="col-md-2">' +
    ' <label for="INR "class="form-label mt-3">INR</label>' +
    '</div>' +
    '<div class="col-md-2">' +
    '<input type="number" class="form-control" name="onetime_inr[]"  placeholder="₹" required/>' +
    '</div>' +
    '</div>' +
    ' <div class="row mt-3">' +
    '<div class="col-md-2">' +
    '<label for="USD" class="form-label mt-3">USD</label>' +
    '</div>' +
    '<div class="col-md-2">' +
    '<input type="number" class="form-control" name="onetime_usd[]"  placeholder="$" required/>' +
    '</div>' +
    '</div>');
}
///// recurring Add On Payment
function recurringAddOn(counterVar1) {
  $(".paymenttypeAddOn_"+counterVar1).html('<div class="row">' +
    '<div class="col-md-1 bg-success">' +
    ' <label for="Currency"class="form-label">Currency</label>' +
    '</div>' +
    ' <div class="col-md-1 bg-success">' +
    ' <label for="Hourly"class="form-label">Hourly</label>' +
    '</div>' +
    '<div class="col-md-1 bg-success">' +
    ' <label for="Monthly"class="form-label">Monthly</label>' +
    '</div>' +
    '<div class="col-md-1 bg-success">' +
    '<label for="Quartely"class="form-label">Quartely</label>' +
    '</div>' +
    '<div class="col-md-2 bg-success">' +
    '<label for="Semi-Annually"class="form-label">Semi-Annually</label>' +
    '</div>' +
    '<div class="col-md-2 bg-success">' +
    '<label for="Annually"class="form-label">Annually</label>' +
    '</div>' +
    '<div class="col-md-2 bg-success">' +
    '<label for="Biennially"class="form-label">Biennially</label>' +
    '</div>' +
    '<div class="col-md-2 bg-success">' +
    '<label for="Triennially"class="form-label">Triennially</label>' +
    '</div>' +
    '</div>' +
    '<div class="row mt-3">' +
    '<div class="col-md-1">' +
    '<label for="INR "class="form-label mt-3">INR</label>' +
    '</div>' +
    '<div class="col-md-1">' +
    '<input type="number" class="form-control" name="recurr_inr_hourly[]"  placeholder="₹" required/>' +
    '</div>' +
    '<div class="col-md-1">' +
    '<input type="number" class="form-control" name="recurr_inr_monthly[]"  placeholder="₹" required/>' +
    '</div>' +
    '<div class="col-md-1">' +
    '<input type="number" class="form-control" name="recurr_inr_quartely[]"  placeholder="₹" required/>' +
    '</div>' +
    '<div class="col-md-2">' +
    '<input type="number" class="form-control" name="recurr_inr_semiannually[]"  placeholder="₹" required/>' +
    '</div>' +
    '<div class="col-md-2">' +
    '<input type="number" class="form-control" name="recurr_inr_annually[]"  placeholder="₹" required/>' +
    '</div>' +
    '<div class="col-md-2">' +
    '<input type="number" class="form-control" name="recurr_inr_biennially[]"  placeholder="₹" required/>' +
    '</div>' +
    '<div class="col-md-2">' +
    '<input type="number" class="form-control" name="recurr_inr_triennially[]"  placeholder="₹" required/>' +
    '</div>' +
    '</div>' +
    '<div class="row mt-3">' +
    ' <div class="col-md-1">' +
    '  <label for="USD "class="form-label mt-3">USD</label>' +
    ' </div>' +
    ' <div class="col-md-1">' +
    '  <input type="number" class="form-control" name="recurr_usd_hourly[]"  placeholder="$" required/>' +
    ' </div>' +
    ' <div class="col-md-1">' +
    ' <input type="number" class="form-control" name="recurr_usd_monthly[]"  placeholder="$" required/>' +
    '</div>' +
    '<div class="col-md-1">' +
    '  <input type="number" class="form-control" name="recurr_usd_quartely[]"  placeholder="$" required/>' +
    '</div>' +
    '<div class="col-md-2">' +
    ' <input type="number" class="form-control" name="recurr_usd_semiannually[]"  placeholder="$" required/>' +
    '</div>' +
    '<div class="col-md-2">' +
    '<input type="number" class="form-control" name="recurr_usd_annually[]"  placeholder="$" required/>' +
    '</div>' +
    ' <div class="col-md-2">' +
    '  <input type="number" class="form-control" name="recurr_usd_biennially[]"  placeholder="$" required/>' +
    '</div>' +
    '<div class="col-md-2">' +
    ' <input type="number" class="form-control" name="recurr_usd_triennially[]"  placeholder="$" required/>' +
    '</div>' +
    '</div>');
}
/////price add on  
function onetimeAddOnOne() {
  $('.recurringAddOnOne').html('<div class="row">' +
    '<div class="col-md-2 bg-success">' +
    '<label for="Currency" class="form-label">Currency</label>' +
    '</div>' +
    '<div class="col-md-2 bg-success">' +
    '<label for="One Time" class="form-label">One Time</label>' +
    '</div>' +
    '</div>' +
    '<div class="row mt-3">' +
    '<div class="col-md-2">' +
    ' <label for="INR "class="form-label mt-3">INR</label>' +
    '</div>' +
    '<div class="col-md-2">' +
    '<input type="number" class="form-control" name="onetime_inr[]"  placeholder="₹" required/>' +
    '</div>' +
    '</div>' +
    ' <div class="row mt-3">' +
    '<div class="col-md-2">' +
    '<label for="USD" class="form-label mt-3">USD</label>' +
    '</div>' +
    '<div class="col-md-2">' +
    '<input type="number" class="form-control" name="onetime_usd[]"  placeholder="$" required/>' +
    '</div>' +
    '</div>');
}
///// recurring Add On Payment
function recurringAddOnOne() {
  $('.recurringAddOnOne').html(' <div class="row">' +
    '<div class="col-md-1 bg-success">' +
    ' <label for="Currency"class="form-label">Currency</label>' +
    '</div>' +
    ' <div class="col-md-1 bg-success">' +
    ' <label for="Hourly"class="form-label">Hourly</label>' +
    '</div>' +
    '<div class="col-md-1 bg-success">' +
    ' <label for="Monthly"class="form-label">Monthly</label>' +
    '</div>' +
    '<div class="col-md-1 bg-success">' +
    '<label for="Quartely"class="form-label">Quartely</label>' +
    '</div>' +
    '<div class="col-md-2 bg-success">' +
    '<label for="Semi-Annually"class="form-label">Semi-Annually</label>' +
    '</div>' +
    '<div class="col-md-2 bg-success">' +
    '<label for="Annually"class="form-label">Annually</label>' +
    '</div>' +
    '<div class="col-md-2 bg-success">' +
    '<label for="Biennially"class="form-label">Biennially</label>' +
    '</div>' +
    '<div class="col-md-2 bg-success">' +
    '<label for="Triennially"class="form-label">Triennially</label>' +
    '</div>' +
    '</div>' +
    '<div class="row mt-3">' +
    '<div class="col-md-1">' +
    '<label for="INR "class="form-label mt-3">INR</label>' +
    '</div>' +
    '<div class="col-md-1">' +
    '<input type="number" class="form-control" name="recurr_inr_hourly[]"  placeholder="₹" required/>' +
    '</div>' +
    '<div class="col-md-1">' +
    '<input type="number" class="form-control" name="recurr_inr_monthly[]"  placeholder="₹" required/>' +
    '</div>' +
    '<div class="col-md-1">' +
    '<input type="number" class="form-control" name="recurr_inr_quartely[]"  placeholder="₹" required/>' +
    '</div>' +
    '<div class="col-md-2">' +
    '<input type="number" class="form-control" name="recurr_inr_semiannually[]"  placeholder="₹" required/>' +
    '</div>' +
    '<div class="col-md-2">' +
    '<input type="number" class="form-control" name="recurr_inr_annually[]"  placeholder="₹" required/>' +
    '</div>' +
    '<div class="col-md-2">' +
    '<input type="number" class="form-control" name="recurr_inr_biennially[]"  placeholder="₹" required/>' +
    '</div>' +
    '<div class="col-md-2">' +
    '<input type="number" class="form-control" name="recurr_inr_triennially[]"  placeholder="₹" required/>' +
    '</div>' +
    '</div>' +
    '<div class="row mt-3">' +
    ' <div class="col-md-1">' +
    '  <label for="USD "class="form-label mt-3">USD</label>' +
    ' </div>' +
    ' <div class="col-md-1">' +
    '  <input type="number" class="form-control" name="recurr_usd_hourly[]"  placeholder="$" required/>' +
    ' </div>' +
    ' <div class="col-md-1">' +
    ' <input type="number" class="form-control" name="recurr_usd_monthly[]"  placeholder="$" required/>' +
    '</div>' +
    '<div class="col-md-1">' +
    '  <input type="number" class="form-control" name="recurr_usd_quartely[]"  placeholder="$" required/>' +
    '</div>' +
    '<div class="col-md-2">' +
    ' <input type="number" class="form-control" name="recurr_usd_semiannually[]"  placeholder="$" required/>' +
    '</div>' +
    '<div class="col-md-2">' +
    '<input type="number" class="form-control" name="recurr_usd_annually[]"  placeholder="$" required/>' +
    '</div>' +
    ' <div class="col-md-2">' +
    '  <input type="number" class="form-control" name="recurr_usd_biennially[]"  placeholder="$" required/>' +
    '</div>' +
    '<div class="col-md-2">' +
    ' <input type="number" class="form-control" name="recurr_usd_triennially[]"  placeholder="$" required/>' +
    '</div>' +
    '</div>');
}
</script>