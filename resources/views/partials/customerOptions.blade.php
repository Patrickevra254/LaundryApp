<option value="">-- Select Customer --</option>

@forelse ($customers as $customer)
    <option value="{{ $customer->id }}" data-phone="{{ $customer->phone }}">
        {{ $customer->name }}
    </option>
@empty
    <option value="">No customer found</option>
@endforelse
