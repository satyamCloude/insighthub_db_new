@foreach ($operating_systems as $operating_system)
<option value="{{ $operating_system->id }}" data-price="{{ $operating_system->price }}" data-prefix="{{ $operating_system->prefix }}" data-code="{{ $operating_system->code }}" operating-system="{{ $operating_system->ostype }}" >
    {{ $operating_system->ostype }}
</option>
@endforeach