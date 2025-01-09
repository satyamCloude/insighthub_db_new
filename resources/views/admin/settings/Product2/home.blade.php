<div class="card-header sticky-element bg-label-secondary mb-4 p-2">
    <div class="row">
        <div class="col-md-6 d-flex justify-content-center align-self-baseline">
            <input type="radio" name="leadsetting" onclick="productCategory(value)" id="radio1" checked value="category">&nbsp;&nbsp;
            <label for="radio1">Category</label>
        </div>
        <!--<div class="col-md-4 d-flex justify-content-center align-self-baseline">-->
        <!--    <input type="radio" name="leadsetting" id="radio2" onclick="productCategory(value)"  value="operatingsystem">&nbsp;&nbsp;-->
        <!--    <label for="radio2">Operating System</label>-->
        <!--</div>-->
        <div class="col-md-6 d-flex justify-content-center align-self-baseline">
            <input type="radio" name="leadsetting" id="radio2" onclick="productCategory(value)"  value="product">&nbsp;&nbsp;
            <label for="radio2">Product</label>
        </div>
    </div>
</div>
<div id="TBView"></div>

<script>
    productCategory('category')

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


</script>