@extends('layouts.admin')
@section('title', 'Product')
@section('content')
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
<style>

    .outer_container{

/* background-color:white; */
min-height:500px;
display: flex;
align-items:center;



}

.inner_container {
  border-radius: 6px;
  min-height: 430px;
  box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;
  transition: transform 0.7s ease, box-shadow 0.7s ease, background-color 0.7s ease, color 0.4s ease;
  background-color: white;
}

.inner_container:hover {
  transform: translateY(-15px); /* Move the container upwards */
  box-shadow: rgba(60, 64, 67, 0.3) 0px 4px 6px 0px, rgba(60, 64, 67, 0.15) 0px 2px 8px 2px; /* Adjust the shadow */
  background: linear-gradient(72.47deg, #7367f0 22.16%, rgba(115, 103, 240, 0.7) 76.47%);
  color: white;
}

.inner_container:hover .heading1{

    background:white;
    color:#5d596c;

}


.inner_container:hover .ul_prod li{

color:white;
background: url('{{url('/')}}/public/images/tick3.svg') no-repeat left center;

}


.inner_container:hover .cstm_btn{

    background:white;
    color:#5d596c;

}

.inner_container:hover .bold_txt,.htxt{


    color:white;

}

.inner_container:hover .htxt{


    color:white;

}


.inner_container:hover .ul_prod li span{

    color:white;
}


.htxt{


    color:#5d596c;
    font-size:22px;
}


.ul_prod{


    padding-left:2px;
}

.ul_prod li{

    list-style-type:none;
    display:flex;
    align-items:center;
    line-height:2;
    font-size:14px;
    display: inline-block;
    width: 100%;
    padding: 1px 0 1px 30px;
    background: url('{{url('/')}}/public/images/tick2.svg') no-repeat left center;
    margin-bottom: 12px;
    font-size: 14px;
    line-height: 22px;
    text-align: left;
    color: #101828;
}


.ul_prod li span{

    margin:0 5px;
    color: #5d596c;
}

.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
  margin: 0 8px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #7367f0;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}



.bold_txt{


    font-size:35px;
    color: #7367f0;

}


.bold_txt2{

    font-size:27px;
    margin-bottom:5px;


}


.list{

    margin-top:5px;
    
}

.cstm_btn{

    background-color:#7367f0;
    padding:7px 7px;
    color:grey;
    width:85%;
    color:white;
    border:none;
    border-radius:15px;

}


.contents{


    padding: 5px 10px;
}


.heading1{

/* position:relative; */
/* top:-10px; */
left:0;
background: linear-gradient(72.47deg, #7367f0 22.16%, rgba(115, 103, 240, 0.7) 76.47%);
border-bottom-left-radius: 100%;
border-bottom-right-radius: 100%;
color: white;
padding:20px 2px;

}

.toggle {
  position: relative;
  display: block;
  margin: 0 auto;
  width: 230px;
  height: 50px;
  color: white;
  outline: 0;
  text-decoration: none;
  border-radius: 100px;
  box-shadow: rgba(67, 71, 85, 0.27) 0px 0px 0.25em, rgba(90, 125, 188, 0.05) 0px 0.25em 1em;
  background-color: white;
  transition: all 500ms;
  &:active {
    background-color: darken(#263238, 5%);
}
&:hover:not(.toggle--moving) {
    &:after {
      background-color: #7367f0;
      Color:white;
  }
}
&:after {
    display: block;
    position: absolute;
    top: 4px;
    bottom: 4px;
    left: 4px;
    width: calc(50% - 4px);
    line-height: 39px;
    text-align: center;
    /* text-transform: uppercase; */
    font-size: 18px;
    color: #7367f0;
    background-color: white ;
    border: 2px solid #7367f0;
    transition: all 500ms; 
}
}
.toggle--on {
  &:after {
    content: 'Monthly';
    border-radius: 50px 5px 5px 50px;
    color: #7367f0;
}
}
.toggle--off {
  &:after {
    content: 'Yearly';
    border-radius: 5px 50px 50px 5px;
    transform: translate(100%, 0);
    color: #7367f0;
}
}
.toggle--moving {
  background-color: darken(#263238, 5%);
  &:after {
    color: transparent;
    border-color: darken(#546E7A, 8%);
    background-color: darken(#37474F, 10%);
    transition: color 0s,
    transform 500ms,
    border-radius 500ms,          
    background-color 500ms;
}
}



@media only screen and (max-width: 600px){


   .inner_container{


    margin-top:20px;
}       


}
</style>


<section class="section-py first-section-pt">
    <div class="container-fluid">
        <div class="row mx-0 gy-3 px-lg-12">


            <h2 class="text-center mb-0 mt-5">Products & pricing</h2>
            <h5 class="mt-1 text-center" style="font-weight:100;">We've got products to meet all your business needs,<br>helping you scale effortlessly.</h5>
            <!-- Basic -->
            <div class="outer_container" style="display:flex;flex-direction:column;justify-content:space-around;">
           
<div class="container-fluid" style="padding:0;">
    <div class="row">
       @if($products->isNotEmpty())
       @php
       $renderedProductIds = [];
       @endphp
       @foreach($products as $product)
       @if(!in_array($product->id, $renderedProductIds))
       @php
       $tax = DB::table('tax_settings')->where('id', $product->tax_id)->select('rate')->first();
       $renderedProductIds[] = $product->id;
       @endphp
       <div class="col-md-4 mb-4" style="height: 500px;">
        <div class="inner_container text-center" style="height: 100%;">
            <div class="contents mt-4">
                <div class="heading1 bold_txt2">{{$product->product_name}}</div>
                <div class="upper_txt">
                   @if($product->payment_type == 1)
                   <h3 class="htxt" style="margin-bottom:15px;margin-top:15px;"><span class="bold_txt">Free</span></h3>
                   @elseif($product->payment_type == 2)
                   <h3 class="htxt" style="margin-bottom:15px;margin-top:15px;"><span class="bold_txt">
                    {{$currency->prefix}} {{ $product->price}}</span> / @if($product->plan_type) {{ $product->plan_type}} @else onetime @endif</h3>
                   @elseif($product->payment_type == 3)
                    @php $amount = explode('_', $product->show_payment_type); @endphp
                    <h3 class="htxt" style="margin-bottom:15px;margin-top:15px;"><span class="bold_txt">
                    {{$currency->prefix}} {{ $product->price}}</span> / @if($product->plan_type) {{ $product->plan_type}} @else onetime @endif</h3>
                    @else
                          <h3 class="htxt" style="margin-bottom:15px;margin-top:15px;"><span class="bold_txt">Free</span></h3>
                    @endif
                </div>
                <div class="below_txt ">
                    <div class="list">
                        <ul class="ul_prod">
                            <div class="row">
                                {!! $product->description !!}
                            </div>
                        </ul>
                    </div>
                </div>
                <div class="btn1">
                     @if($product->payment_type == 3)
                    @php $amount = explode('_', $product->show_payment_type); @endphp
                    <a href="javascript::void(0);" onclick="addOrder(`{{url('user/get-related-datas/add-cart')}}?action=add&amp;pid={{$product->id}}&amp;currency={{$currency->id}}` ,`{{$product->id}}`,`{{$product->payment_type}}`,`{{ $amount[0]}}`,` {{$tax->rate ?? ''}}`,`{{$product->product_type_id}}`,`{{$product->category_id}}`)" ><button class="cstm_btn mb-2">Choose Plan</button></a>
                    @else
                    <a href="javascript::void(0);" onclick="addOrder(`{{url('user/get-related-datas/add-cart')}}?action=add&amp;pid={{$product->id}}&amp;currency={{$currency->id}}` ,`{{$product->id}}`,`{{$product->payment_type}}`,`{{ $product->price}}`,` {{$tax->rate ?? ''}}`,`{{$product->product_type_id}}`,`{{$product->category_id}}`)" ><button class="cstm_btn mb-2">Choose Plan</button></a>
                    @endif
                </div>
            </div>
        </div>
       </div>
       @endif
       @endforeach
       @else
       <h5>No Products Available</h5>
       @endif
    </div>
</div>
</div>

</section>
<script>
    function addOrder(url, productId, payment_type, price, tax, product_type_id, category_id) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ url('user/order/addOrder') }}",
            method: 'POST',
            data: {
                selected_prod_id: productId,
                payment_type: payment_type,
                total_amt: price,
                tax: tax,
                product_type_id: product_type_id,
                category_id: category_id,
            },
            success: function(resp) {
                if (resp.status == 'success') {
                    window.location.href = url;
                } else {
                    bootbox.alert(resp.user_status_message);
                }
            }
        })
    }


    $('.toggle').click(function(e) {
      var toggle = this;

      e.preventDefault();

      $(toggle).toggleClass('toggle--on')
      .toggleClass('toggle--off')
      .addClass('toggle--moving');

      setTimeout(function() {
        $(toggle).removeClass('toggle--moving');
    }, 200)
  });
</script>
@endsection