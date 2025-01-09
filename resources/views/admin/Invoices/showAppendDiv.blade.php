
   <div class="content-wrapper">
            
              <div id="sortable" >
                <div class="d-flex c-inv-desc ">

<div class="c-inv-desc-table item-row mt-4 w-100 d-lg-flex d-md-flex d-block">
  <table width="100%">
    <tbody>
      <tr class="text-dark-grey font-weight-bold f-14">
        <td width="50%" class="border-0 inv-desc-mbl btlr">Description</td>
        <td width="10%" class="border-0" align="right">
          Quantity </td>
        <td width="10%" class="border-0" align="right">
          Unit Price </td>
        <td width="13%" class="border-0" align="right">Tax </td>
        <td width="17%" class="border-0 bblr-mbl" align="right">
          Amount</td>
      </tr>
      <tr>
        <td class="border-bottom-0 btrr-mbl btlr">
          <input type="text" class="form-control f-14 border-0 w-100 item_name" id="item_name" name="item_name[]" placeholder="Item Name" autocomplete="off" value="{{isset($productDetails) ? $productDetails->product_name : ''}}">

          <input type="hidden" name="product_id[]" value="{{$productDetails->proId}}" autocomplete="off">
        </td>
        <td class="border-bottom-0 d-block d-lg-none d-md-none">
          <textarea class="form-control f-14 border-0 w-100 mobile-description form-control item_summary" id="item_summary" name="item_summary" placeholder="Enter Description (optional)">{{isset($productDetails) ? $productDetails->description : ''}}</textarea>
        </td>
        <td class="border-bottom-0">
          <input type="number" min="1" class="form-control f-14 border-0 w-100 text-right qty quantity mt-3" value="1" name="quantity[]" autocomplete="off" id="qty{{$numberCount}}" sectionCount="{{$numberCount}}">
          <select class="text-dark-grey float-right border-0 f-12" name="unit_id">
            <option selected="" value="1">Pcs</option>
          </select>

        </td>
        <td class="border-bottom-0">
          <input type="number" min="1" class="f-14 border-0 w-100 text-right cost_per_item form-control" value="{{$productDetails ? $productDetails->price : '0.00' }}" name="cost_per_items[]" autocomplete="off" id="cost_per_item{{$numberCount}}" sectionCount="{{$numberCount}}" readonly required>
        </td>

        <td class="border-bottom-0">
          <div class="select-others height-35 rounded border-0">
            <div class="dropdown bootstrap-select show-tick select-picker type customSequence border-0">
              <select id="multiselect1{{$numberCount}}" name="taxes{{$numberCount}}[]" multiple="multiple" onchange="CalculateTax()" class="select-picker type customSequence border-0 multiselect" data-size="3" >
                @foreach($Tax as $Taxs)
                <option data-rate="{{ $Taxs->tax_name }}" data-product-id{{$numberCount}}="{{$numberCount}}" data-tax-value="{{ $Taxs->rate }}" data-tax{{$numberCount}}="{{ $Taxs->tax_name . ':' . $Taxs->rate }}" value="{{$Taxs->id}}" @if($Taxs->id == $productDetails->taxId) selected @endif >{{ $Taxs->tax_name . ':' . $Taxs->rate }} </option>
                @endforeach
              </select>
              <input type="hidden" name="applied_tax[]" id="applied_tax{{$numberCount}}">
              <div class="dropdown-menu ">
                <div class="inner show" role="listbox" id="bs-select-9" tabindex="-1" aria-multiselectable="true">
                  <ul class="dropdown-menu inner show" role="presentation"></ul>
                </div>
              </div>
            </div>
          </div>
        </td>
        <td rowspan="2" align="right" valign="top" class="bg-amt-grey btrr-bbrr">
          <span class="amount-html" id="total-amt{{$numberCount}}">{{isset($productDetails) ? $productDetails->price : ''}}</span>
          <input type="hidden" id="total_tax{{$numberCount}}">

        </td>
      </tr>
      <tr class="d-none d-md-table-row d-lg-table-row">
        <td colspan="3" class="dash-border-top bblr border-right-0">
          <textarea class="f-14 border p-3 px-1 rounded w-100 desktop-description form-control item_summary" id="item_summary" name="item_summary" placeholder="Enter Description (optional)" style="margin:unset; border: unset!important;box-shadow: unset !important;height: 120px;">{{isset($productDetails) ? strip_tags($productDetails->description) : ''}}</textarea>
        </td>
        <td class="border-left-0">
          <div class="dropify-wrapper" style="height: 81.6px;" id="show_img1">
            <div class="dropify-message"><span class=""><img id="show_imgs1" src="{{ url('public/images/cloud.png') }}" style="width: 54px;
              margin-top: 25px;
              "></span>
              <p>Choose a file</p>
              <p class="dropify-error">Some error occurred.</p>
            </div>
            <div class="dropify-loader"></div>
            <div class="dropify-errors-container">
              <ul></ul>
            </div>
            <input type="file" class="dropify" id="upload_imag1" name="invoice_item_image[]" data-allowed-file-extensions="png jpg jpeg bmp" sectionCount="1" data-messages-default="test" data-height="70" autocomplete="off">
            <button type="button" class="dropify-clear" id="remove_button1">Remove</button>

            <div class="dropify-preview" id="show_imag1"><span class="dropify-render"></span>
              <div class="dropify-infos">
                <div class="dropify-infos-inner">
                  <p class="dropify-filename"><span class="dropify-filename-inner"></span></p>
                  <p class="dropify-infos-message">Drop a file or click to replace</p>
                </div>
              </div>
            </div>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
  <a href="javascript:;" class="d-flex align-items-center justify-content-center ml-3 remove-item"
  onclick="removeSection(this)"><i class="fa fa-times-circle f-20 text-lightest"></i></a> 
   &nbsp;&nbsp;&nbsp;
</div>
</div>
</div>
              <hr class="m-0 border-top-grey mt-4">
