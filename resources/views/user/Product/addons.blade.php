@foreach ($addOnProducts as $addOnProduct)
<div class="mt-3" onClick="addToCart(`{{ $addOnProduct->price }}`,`{{ $addOnProduct->rate }}`,`{{ $addOnProduct->prefix }}`,`{{ $addOnProduct->code }}`,`{{ isset($addOnProduct->product_name) ? ucfirst($addOnProduct->product_name) : '' }}`,`{{ $addOnProduct->id }}`,`{{ $addOnProduct->rate }}`,`{{ $addOnProduct->id }}`)">
    <div class="panel card panel-default panel-addon">
        <div class="panel-body card-body">
            <label>
                <div class="icheckbox_square-blue" style="position: relative;">
                    <input type="checkbox" name="addons[5]" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;">
                    <ins class="iCheck-helper" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                </div>
                <strong>{{ $addOnProduct->product_name ?? '' }}</strong>
            </label>
            <br>
            {!! $addOnProduct->descriptions ?? '' !!}
        </div>
        <div class="panel-price" id="addons_price">
            {{ $addOnProduct->prefix }}
            {{ $addOnProduct->price }}
            {{ $addOnProduct->code }} Monthly
        </div>
        <div class="panel-add text-white">
            <i class="fas fa-plus"></i>
            <span id="addon-button{{ $addOnProduct->id }}">ADD</span>
            <input type="hidden" name="addon_product[]">
        </div>
    </div>
</div>
@endforeach