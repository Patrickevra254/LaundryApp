@if ($customers->count())
    @foreach ($customers as $customer)
        <div class="search-item"
            onclick="selectCustomer(
                '{{ $customer->id }}',
                '{{ $customer->name }}',
                '{{ $customer->phone }}',
                '{{ $customer->email }}'
            )">

            <div><strong>{{ $customer->name }}</strong></div>
            <small class="text-muted">{{ $customer->phone }}</small>
        </div>
    @endforeach
@else
    <div class="search-item text-muted">No customers found</div>
@endif
