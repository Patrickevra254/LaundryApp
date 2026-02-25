{{-- <div class="container-fluid book-order-page">

    <!-- Header -->
    <div class="page-header mb-4">
        <div>
            <h3 class="fw-bold mb-1">Book Laundry</h3>
            <small class="text-muted">Create a new premium laundry order</small>
        </div>
    </div>

    <form method="POST" action="{{ route('payment.redirect') }}">
        @csrf

        <input type="hidden" name="email" id="paystackEmail" value="{{ auth()->user()->email }}">
        <input type="hidden" name="amount" id="paystackAmount">

        <div class="row g-4">

            <!-- LEFT -->
            <div class="col-12 col-lg-8">

                <!-- Customer Info -->
                <div class="glass-card mb-4">
                    <div class="card-title">
                        <i class="fa fa-user"></i> Customer Information
                    </div>

                    <div class="row g-3 mt-1">
                        @if (auth()->user()->role == 'customer')
                            <div class="col-12 col-md-6">
                                <label class="form-label">Customer</label>
                                <input type="text" class="form-control" value="{{ auth()->user()->name }}" disabled>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label">Phone Number</label>
                                <input type="text" class="form-control" value="{{ auth()->user()->phone }}" disabled>
                            </div>
                            <input type="hidden" name="customer_id" value="{{ auth()->user()->id }}">
                        @else
                            <input type="text" name="q" class="form-control mb-2"
                                placeholder="Search by name or phone" hx-get="{{ route('customers.search') }}"
                                hx-trigger="keyup changed delay:300ms" hx-target="#customerSelect" hx-swap="innerHTML"
                                hx-on="htmx:afterSwap: openCustomerSelect()">

                            <div class="col-12 col-md-6">
                                <label class="form-label">Select Customer</label>
                                <select name="customer_id" id="customerSelect" class="form-select" required>
                                    <option value="">-- Select Customer --</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}" data-phone="{{ $customer->phone }}"
                                            data-email="{{ $customer->email }}">
                                            {{ $customer->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12 col-md-6">
                                <label class="form-label">Phone Number</label>
                                <input type="tel" id="customerPhone" class="form-control" readonly>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Pickup & Delivery -->
                <div class="glass-card mb-4">
                    <div class="card-title">
                        <i class="fa fa-map-marker-alt"></i> Pickup & Delivery
                    </div>

                    <div class="row g-3 mt-1">
                        <div class="col-md-6">
                            <label class="form-label">Pickup Address</label>
                            <textarea name="pickup_address" class="form-control" rows="2" required></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Delivery Address</label>
                            <textarea name="delivery_address" class="form-control" rows="2" required></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Pickup Date</label>
                            <input type="date" name="pickup_date" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Delivery Date</label>
                            <input type="date" name="delivery_date" class="form-control" required>
                        </div>
                    </div>
                </div>

                <!-- Laundry Items -->
                <div class="glass-card mb-4">
                    <div class="card-title d-flex justify-content-between">
                        <span><i class="fa fa-tshirt"></i> Laundry Items</span>
                        <button type="button" id="addItemBtn" class="btn btn-outline-primary btn-sm">
                            <i class="fa fa-plus"></i> Add Item
                        </button>
                    </div>

                    <div class="table-responsive mt-3">
                        <table class="table table-hover align-middle mobile-friendly">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Service</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="itemsTableBody">
                                @php $firstItem = $items->first(); @endphp
                                <tr>
                                    <td data-label="Item">
                                        <select name="items[0][item_id]" class="form-select item-name">
                                            @foreach ($items as $item)
                                                <option value="{{ $item->id }}"
                                                    data-washing="{{ $item->washing_price }}"
                                                    data-ironing="{{ $item->ironing_price }}"
                                                    data-wash_and_iron="{{ $item->wash_and_iron_price }}">
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td data-label="Service">
                                        <select name="items[0][service_type]" class="form-select item-service">
                                            <option value="washing">Washing</option>
                                            <option value="ironing">Ironing</option>
                                            <option value="wash_and_iron">Wash & Iron</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="hidden" class="item-price"
                                            value="{{ $firstItem->washing_price }}">
                                        <input class="form-control price-display" disabled>
                                    </td>
                                    <td>
                                        <input type="number" class="form-control item-qty" value="1"
                                            min="1">
                                    </td>
                                    <td class="fw-bold item-subtotal">₦0</td>
                                    <td>
                                        <button type="button" class="btn btn-outline-danger btn-sm remove-item">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- RIGHT -->
            <div class="col-12 col-lg-4">
                <div class="glass-card summary-card sticky-top">
                    <div class="card-title">
                        <i class="fa fa-receipt"></i> Order Summary
                    </div>

                    <div class="summary-row"><span>Items</span><span id="totalItems">1</span></div>
                    <div class="summary-row"><span>Subtotal</span><span id="subtotal">₦0</span></div>
                    <div class="summary-row"><span>Service Fee</span><span>₦200</span></div>
                    <hr>
                    <div class="summary-total">
                        <span>Total</span>
                        <span id="total">₦0</span>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mt-4">
                        <i class="fa fa-check-circle me-1"></i> Create Order
                    </button>
                </div>
            </div>

        </div>
    </form>
</div>


<style>
    .book-order-page {
        background: radial-gradient(circle at top, #eef3ff, #f6f8fb);
        font-family: 'Segoe UI', sans-serif;
    }

    /* Glass Card */
    .glass-card {
        background: rgba(255, 255, 255, 0.25);
        backdrop-filter: blur(14px);
        border-radius: 18px;
        padding: 1.5rem;
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.12);
    }

    /* Titles */
    .card-title {
        font-weight: 600;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 1rem;
    }

    /* Inputs */
    .form-control,
    .form-select {
        border-radius: 12px;
    }

    /* Summary */
    .summary-card {
        top: 90px;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
    }

    .summary-total {
        display: flex;
        justify-content: space-between;
        font-size: 1.2rem;
        font-weight: 700;
    }

    /* Buttons */
    .btn-primary {
        background: linear-gradient(135deg, #0d6efd, #4f46e5);
        border: none;
        border-radius: 14px;
    }

    /* Table */
    .table thead th {
        font-size: 0.75rem;
        text-transform: uppercase;
        color: #6c757d;
    }

    /* Mobile */
    @media (max-width: 768px) {
        .mobile-friendly thead {
            display: none;
        }

        .mobile-friendly tr {
            display: block;
            margin-bottom: 1rem;
        }

        .mobile-friendly td {
            display: flex;
            justify-content: space-between;
        }
    }
</style>



<script>
    const ITEMS = @json($items);

    function initBookLaundryPage() {
        const tableBody = document.getElementById('itemsTableBody');
        const addBtn = document.getElementById('addItemBtn');

        // Guard: only run on Book Laundry page
        if (!tableBody || !addBtn) return;

        let itemIndex = tableBody.querySelectorAll('tr').length;

        function updateRowPrice(row) {
            const itemSelect = row.querySelector('.item-name');
            const serviceSelect = row.querySelector('.item-service');
            const priceInput = row.querySelector('.item-price');
            const priceDisplay = row.querySelector('.price-display');
            const qtyInput = row.querySelector('.item-qty');
            const subtotalCell = row.querySelector('.item-subtotal');

            if (!itemSelect || !serviceSelect || !qtyInput) return;

            const selectedItem = itemSelect.selectedOptions[0];
            const service = serviceSelect.value;
            const qty = parseInt(qtyInput.value) || 0;
            const price = parseInt(selectedItem.dataset[service]) || 0;

            priceInput.value = price;
            priceDisplay.value = '₦' + price.toLocaleString();
            subtotalCell.textContent = '₦' + (price * qty).toLocaleString();

            updateTotals();
        }

        function updateTotals() {
            let totalItems = 0;
            let subtotal = 0;
            const serviceFee = 200;

            tableBody.querySelectorAll('tr').forEach(row => {
                const qty = parseInt(row.querySelector('.item-qty')?.value) || 0;
                const price = parseInt(row.querySelector('.item-price')?.value) || 0;

                totalItems += qty;
                subtotal += qty * price;
            });

            const total = subtotal + serviceFee;

            document.getElementById('totalItems').textContent = totalItems;
            document.getElementById('subtotal').textContent = '₦' + subtotal.toLocaleString();
            document.getElementById('total').textContent = '₦' + total.toLocaleString();

            const paystackAmount = document.getElementById('paystackAmount');
            if (paystackAmount) {
                paystackAmount.value = total * 100;
            }
        }

        /* ===========================
           EVENT DELEGATION
        ============================ */

        tableBody.addEventListener('change', e => {
            if (
                e.target.classList.contains('item-name') ||
                e.target.classList.contains('item-service')
            ) {
                updateRowPrice(e.target.closest('tr'));
            }
        });

        tableBody.addEventListener('input', e => {
            if (e.target.classList.contains('item-qty')) {
                updateRowPrice(e.target.closest('tr'));
            }
        });

        tableBody.addEventListener('click', e => {
            const removeBtn = e.target.closest('.remove-item');
            if (removeBtn) {
                removeBtn.closest('tr').remove();
                updateTotals();
            }
        });

        addBtn.addEventListener('click', () => {
            const options = ITEMS.map(item => `
                <option value="${item.id}"
                    data-washing="${item.washing_price}"
                    data-ironing="${item.ironing_price}"
                    data-wash_and_iron="${item.wash_and_iron_price}">
                    ${item.name}
                </option>
            `).join('');

            const row = document.createElement('tr');
            row.innerHTML = `
                <td data-label="Item">
                    <select name="items[${itemIndex}][item_id]" class="form-select item-name">
                        ${options}
                    </select>
                </td>
                <td data-label="Service">
                    <select name="items[${itemIndex}][service_type]" class="form-select item-service">
                        <option value="washing" selected>Washing</option>
                        <option value="ironing">Ironing</option>
                        <option value="wash_and_iron">Wash & Iron</option>
                    </select>
                </td>
                <td data-label="Price">
                    <input type="hidden" name="items[${itemIndex}][price]" class="item-price">
                    <input type="text" class="form-control price-display" disabled>
                </td>
                <td data-label="Qty">
                    <input type="number" name="items[${itemIndex}][quantity]"
                        class="form-control item-qty" value="1" min="1">
                </td>
                <td data-label="Subtotal" class="fw-semibold item-subtotal">₦0</td>
                <td class="text-center">
                    <button type="button" class="btn btn-sm btn-outline-danger remove-item">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            `;

            tableBody.appendChild(row);
            itemIndex++;
            updateRowPrice(row);
        });

        // Initialize existing rows
        tableBody.querySelectorAll('tr').forEach(row => updateRowPrice(row));
    }

    /* ===========================
       INIT — IMPORTANT PART
    ============================ */

    document.addEventListener('DOMContentLoaded', initBookLaundryPage);
    document.body.addEventListener('htmx:afterSwap', initBookLaundryPage);

    /* ===========================
       CUSTOMER SELECT (HTMX SAFE)
    ============================ */

    function openCustomerSelect() {
        const select = document.getElementById('customerSelect');
        if (!select) return;

        setTimeout(() => {
            const optionCount = select.options.length;
            select.size = Math.min(optionCount, 5);
            select.focus();

            if (optionCount === 2) {
                select.selectedIndex = 1;
                select.dispatchEvent(new Event('change'));
                select.size = 1;
            }
        }, 0);
    }

    document.addEventListener('change', e => {
        if (e.target.id === 'customerSelect') {
            const opt = e.target.options[e.target.selectedIndex];
            const phone = document.getElementById('customerPhone');
            const email = document.getElementById('paystackEmail');

             // Only update phone if it actually exists
            if (phone && opt.dataset.phone) {
                phone.value = opt.dataset.phone;
            }

            // Only update email if it actually exists
            if (email && opt.dataset.email) {
                email.value = opt.dataset.email;
            }
        }
    });

    // document.addEventListener('change', e => {
    //     if (e.target.id === 'customerSelect') {
    //         const opt = e.target.options[e.target.selectedIndex];
    //         const phone = document.getElementById('customerPhone');
    //         const email = document.getElementById('paystackEmail');

    //         if (phone) phone.value = opt.dataset.phone || '';
    //         if (email) email.value = opt.dataset.email || '';
    //     }
    // });
</script> --}}

<div class="container-fluid">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-3">
        <div>
            <div class="notifs-label">Booking</div>
            <h4 class="notifs-title mb-0">Book Laundry</h4>
            <p class="notifs-sub mb-0">Create a new laundry order</p>
        </div>
    </div>

    <form method="POST" action="{{ route('payment.redirect') }}" id="bookLaundryForm">
        @csrf

        <input type="hidden" name="email" id="paystackEmail" value="{{ auth()->user()->email }}">
        <input type="hidden" name="amount" id="paystackAmount">

        <div class="row g-4">

            <!-- LEFT -->
            <div class="col-12 col-lg-8">

                <!-- Customer Info -->
                <div class="p-card mb-4">
                    <div class="p-card-header">
                        <div class="p-card-icon"><i class="fa fa-user"></i></div>
                        <div>
                            <div class="p-card-title">Customer Information</div>
                            <div class="p-card-sub">Who is this order for?</div>
                        </div>
                    </div>
                    <div class="row g-3">
                        @if (auth()->user()->role == 'customer')
                            <div class="col-12 col-md-6">
                                <label class="p-label">Customer</label>
                                <input type="text" class="p-input" value="{{ auth()->user()->name }}" disabled>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="p-label">Phone Number</label>
                                <input type="text" class="p-input" value="{{ auth()->user()->phone }}" disabled>
                            </div>
                            <input type="hidden" name="customer_id" value="{{ auth()->user()->id }}">
                        @else
                            <div class="col-12">
                                <div class="h-search-wrap">
                                    <i class="fa fa-search"></i>
                                    <input type="text" name="q" class="h-search"
                                        placeholder="Search customer by name or phone..."
                                        hx-get="{{ route('customers.search') }}" hx-trigger="keyup changed delay:300ms"
                                        hx-target="#customerSelect" hx-swap="innerHTML"
                                        hx-on="htmx:afterSwap: openCustomerSelect()">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="p-label">Select Customer</label>
                                <select name="customer_id" id="customerSelect" class="p-input" required>
                                    <option value="">-- Select Customer --</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}" data-phone="{{ $customer->phone }}"
                                            data-email="{{ $customer->email }}">
                                            {{ $customer->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="p-label">Phone Number</label>
                                <input type="tel" id="customerPhone" class="p-input" readonly
                                    placeholder="Auto-filled">
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Pickup & Delivery -->
                <div class="p-card mb-4">
                    <div class="p-card-header">
                        <div class="p-card-icon"><i class="fa fa-location-dot"></i></div>
                        <div>
                            <div class="p-card-title">Pickup & Delivery</div>
                            <div class="p-card-sub">Where should we collect and drop off?</div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="p-label">Pickup Address</label>
                            <textarea name="pickup_address" class="p-input" rows="2" required placeholder="Enter pickup address"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="p-label">Delivery Address</label>
                            <textarea name="delivery_address" class="p-input" rows="2" required placeholder="Enter delivery address"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="p-label">Pickup Date</label>
                            <input type="date" name="pickup_date" class="p-input" required>
                        </div>
                        <div class="col-md-6">
                            <label class="p-label">Delivery Date</label>
                            <input type="date" name="delivery_date" class="p-input" required>
                        </div>
                    </div>
                </div>

                <!-- Laundry Items -->
                <div class="p-card mb-4">
                    <div class="p-card-header">
                        <div class="p-card-icon"><i class="fa fa-shirt"></i></div>
                        <div class="flex-grow-1">
                            <div class="p-card-title">Laundry Items</div>
                            <div class="p-card-sub">Add items to this order</div>
                        </div>
                        <button type="button" id="addItemBtn" class="n-btn n-btn-secondary ms-auto">
                            <i class="fa fa-plus"></i> Add Item
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle mb-0 book-table">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Service</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="itemsTableBody">
                                @php $firstItem = $items->first(); @endphp
                                <tr>
                                    <td>
                                        <select name="items[0][item_id]" class="p-input item-name">
                                            @foreach ($items as $item)
                                                <option value="{{ $item->id }}"
                                                    data-washing="{{ $item->washing_price }}"
                                                    data-ironing="{{ $item->ironing_price }}"
                                                    data-wash_and_iron="{{ $item->wash_and_iron_price }}">
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="items[0][service_type]" class="p-input item-service">
                                            <option value="washing">Washing</option>
                                            <option value="ironing">Ironing</option>
                                            <option value="wash_and_iron">Wash & Iron</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="hidden" name="items[0][price]" class="item-price"
                                            value="{{ $firstItem->washing_price }}">
                                        <input class="p-input price-display" disabled style="width:90px;">
                                    </td>
                                    <td>
                                        <input type="number" name="items[0][quantity]" class="p-input item-qty"
                                            value="1" min="1" style="width:70px;">
                                    </td>
                                    <td class="fw-600 item-subtotal">₦0</td>
                                    <td>
                                        <button type="button" class="n-icon-btn remove-item" title="Remove">
                                            <i class="fa fa-trash text-danger"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <!-- RIGHT: Summary -->
            <div class="col-12 col-lg-4">
                <div class="p-card summary-sticky">
                    <div class="p-card-header">
                        <div class="p-card-icon"><i class="fa fa-receipt"></i></div>
                        <div>
                            <div class="p-card-title">Order Summary</div>
                            <div class="p-card-sub">Your order breakdown</div>
                        </div>
                    </div>

                    <div class="summary-rows">
                        <div class="summary-row"><span>Items</span><span id="totalItems">1</span></div>
                        <div class="summary-row"><span>Subtotal</span><span id="subtotal">₦0</span></div>
                        <div class="summary-row"><span>Service Fee</span><span>₦200</span></div>
                    </div>

                    <div class="summary-divider"></div>

                    <div class="summary-total">
                        <span>Total</span>
                        <span id="total">₦0</span>
                    </div>

                    <button type="submit" class="n-btn n-btn-primary w-100 mt-4"
                        style="justify-content:center;padding:.65rem;">
                        <i class="fa fa-check-circle me-1"></i> Create Order
                    </button>
                </div>
            </div>

        </div>
    </form>
</div>

<style>
    /* Shared */
    .notifs-label {
        font-size: .7rem;
        font-weight: 700;
        letter-spacing: .1em;
        text-transform: uppercase;
        color: #a5b4fc;
    }

    .notifs-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: #0f0f1a;
        letter-spacing: -.02em;
    }

    .notifs-sub {
        font-size: .82rem;
        color: #9ca3af;
        margin-top: 2px;
    }

    .p-card {
        background: #fff;
        border: 1px solid #f0f0f8;
        border-radius: 14px;
        padding: 1.4rem;
    }

    .p-card-header {
        display: flex;
        align-items: center;
        gap: .85rem;
        margin-bottom: 1.2rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #f5f5fb;
    }

    .p-card-icon {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        background: #eef2ff;
        color: #4f46e5;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: .9rem;
        flex-shrink: 0;
    }

    .p-card-title {
        font-size: .9rem;
        font-weight: 700;
        color: #111827;
    }

    .p-card-sub {
        font-size: .75rem;
        color: #9ca3af;
        margin-top: 1px;
    }

    .p-label {
        font-size: .78rem;
        font-weight: 600;
        color: #6b7280;
        margin-bottom: 5px;
        display: block;
    }

    .p-input {
        width: 100%;
        border-radius: 9px;
        border: 1px solid #e5e7eb;
        padding: .52rem .75rem;
        font-size: .85rem;
        color: #111827;
        background: #fafafa;
        transition: all .15s;
        outline: none;
        appearance: auto;
    }

    .p-input:focus {
        border-color: #a5b4fc;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, .08);
    }

    .p-input:disabled {
        background: #f3f4f6;
        color: #9ca3af;
    }

    .p-input::placeholder {
        color: #c4c9d4;
    }

    textarea.p-input {
        resize: vertical;
    }

    .h-search-wrap {
        position: relative;
    }

    .h-search-wrap i {
        position: absolute;
        left: 11px;
        top: 50%;
        transform: translateY(-50%);
        color: #c4c9d4;
        font-size: .8rem;
        pointer-events: none;
    }

    .h-search {
        width: 100%;
        border-radius: 9px;
        border: 1px solid #e5e7eb;
        padding: .52rem .75rem .52rem 2.1rem;
        font-size: .85rem;
        background: #fafafa;
        outline: none;
        transition: all .15s;
        color: #111827;
    }

    .h-search:focus {
        border-color: #a5b4fc;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, .08);
    }

    .h-search::placeholder {
        color: #c4c9d4;
    }

    .n-btn {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: .45rem .85rem;
        border-radius: 8px;
        font-size: .8rem;
        font-weight: 600;
        border: 1px solid transparent;
        cursor: pointer;
        transition: all .15s;
        white-space: nowrap;
    }

    .n-btn-secondary {
        background: #f3f4f6;
        border-color: #e5e7eb;
        color: #374151;
    }

    .n-btn-secondary:hover {
        background: #e9eaec;
    }

    .n-btn-primary {
        background: #4f46e5;
        color: #fff;
    }

    .n-btn-primary:hover {
        background: #4338ca;
    }

    .n-icon-btn {
        width: 28px;
        height: 28px;
        border-radius: 7px;
        border: none;
        background: #f3f4f6;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: .75rem;
        cursor: pointer;
        transition: background .15s;
    }

    .n-icon-btn:hover {
        background: #fee2e2;
    }

    /* Table */
    .book-table {
        font-size: .83rem;
    }

    .book-table thead th {
        font-size: .7rem;
        text-transform: uppercase;
        letter-spacing: .05em;
        color: #9ca3af;
        font-weight: 600;
        border-bottom: 1px solid #f0f0f8;
        padding: .6rem .5rem;
    }

    .book-table tbody td {
        border-color: #f5f5fb;
        padding: .5rem;
        vertical-align: middle;
    }

    .fw-600 {
        font-weight: 600;
    }

    /* Summary */
    .summary-sticky {
        position: sticky;
        top: 80px;
    }

    .summary-rows {
        display: flex;
        flex-direction: column;
        gap: .5rem;
        margin-bottom: .75rem;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        font-size: .85rem;
        color: #6b7280;
    }

    .summary-divider {
        height: 1px;
        background: #f0f0f8;
        margin: .75rem 0;
    }

    .summary-total {
        display: flex;
        justify-content: space-between;
        font-size: 1.05rem;
        font-weight: 700;
        color: #111827;
    }
</style>

<script>
    const ITEMS = @json($items);
    let bookLaundryItemIndex = 0;

    // ─── Core helpers ────────────────────────────────────────────────────────────

    function updateRowPrice(row) {
        const itemSelect = row.querySelector('.item-name');
        const svcSelect = row.querySelector('.item-service');
        const priceHidden = row.querySelector('.item-price');
        const priceDisplay = row.querySelector('.price-display');
        const qtyInput = row.querySelector('.item-qty');
        const subtotal = row.querySelector('.item-subtotal');
        if (!itemSelect || !svcSelect || !qtyInput) return;

        const opt = itemSelect.selectedOptions[0];
        const svc = svcSelect.value;
        const qty = parseInt(qtyInput.value) || 0;
        const price = parseInt(opt.dataset[svc]) || 0;

        if (priceHidden) priceHidden.value = price;
        if (priceDisplay) priceDisplay.value = '₦' + price.toLocaleString();
        if (subtotal) subtotal.textContent = '₦' + (price * qty).toLocaleString();

        updateTotals();
    }

    function updateTotals() {
        const tbody = document.getElementById('itemsTableBody');
        if (!tbody) return;
        let totalItems = 0,
            subtotal = 0;
        tbody.querySelectorAll('tr').forEach(row => {
            const qty = parseInt(row.querySelector('.item-qty')?.value) || 0;
            const price = parseInt(row.querySelector('.item-price')?.value) || 0;
            totalItems += qty;
            subtotal += qty * price;
        });
        const total = subtotal + 200;
        const el = id => document.getElementById(id);
        if (el('totalItems')) el('totalItems').textContent = totalItems;
        if (el('subtotal')) el('subtotal').textContent = '₦' + subtotal.toLocaleString();
        if (el('total')) el('total').textContent = '₦' + total.toLocaleString();
        if (el('paystackAmount')) el('paystackAmount').value = total * 100;
    }

    function addItemRow() {
        const tbody = document.getElementById('itemsTableBody');
        if (!tbody) return;
        const i = ++bookLaundryItemIndex;
        const options = ITEMS.map(item =>
            `<option value="${item.id}" data-washing="${item.washing_price}" data-ironing="${item.ironing_price}" data-wash_and_iron="${item.wash_and_iron_price}">${item.name}</option>`
        ).join('');
        const row = document.createElement('tr');
        row.innerHTML =
            `
            <td><select name="items[${i}][item_id]" class="p-input item-name">${options}</select></td>
            <td><select name="items[${i}][service_type]" class="p-input item-service">
                    <option value="washing">Washing</option>
                    <option value="ironing">Ironing</option>
                    <option value="wash_and_iron">Wash & Iron</option>
                </select></td>
            <td><input type="hidden" name="items[${i}][price]" class="item-price">
                <input class="p-input price-display" disabled style="width:90px;"></td>
            <td><input type="number" name="items[${i}][quantity]" class="p-input item-qty" value="1" min="1" style="width:70px;"></td>
            <td class="fw-600 item-subtotal">₦0</td>
            <td><button type="button" class="n-icon-btn remove-item"><i class="fa fa-trash text-danger"></i></button></td>`;
        tbody.appendChild(row);
        updateRowPrice(row);
    }

    // ─── Init: attach listeners & seed prices ────────────────────────────────────

    function initBookLaundry() {
        const tbody = document.getElementById('itemsTableBody');
        const addBtn = document.getElementById('addItemBtn');
        if (!tbody || !addBtn) return;

        // Reset index to actual row count so indexes stay correct
        bookLaundryItemIndex = tbody.querySelectorAll('tr').length - 1;

        // Seed prices for existing rows
        tbody.querySelectorAll('tr').forEach(row => updateRowPrice(row));

        // Only attach once — guard with a flag on the element
        if (tbody.dataset.bound === '1') return;
        tbody.dataset.bound = '1';

        tbody.addEventListener('change', e => {
            if (e.target.matches('.item-name, .item-service')) updateRowPrice(e.target.closest('tr'));
        });
        tbody.addEventListener('input', e => {
            if (e.target.matches('.item-qty')) updateRowPrice(e.target.closest('tr'));
        });
        tbody.addEventListener('click', e => {
            if (e.target.closest('.remove-item')) {
                e.target.closest('tr').remove();
                updateTotals();
            }
        });
        addBtn.addEventListener('click', addItemRow);
    }

    // ─── Customer select ─────────────────────────────────────────────────────────

    function openCustomerSelect() {
        const select = document.getElementById('customerSelect');
        if (!select) return;
        setTimeout(() => {
            select.size = Math.min(select.options.length, 5);
            select.focus();
            if (select.options.length === 2) {
                select.selectedIndex = 1;
                select.dispatchEvent(new Event('change'));
                select.size = 1;
            }
        }, 0);
    }

    document.addEventListener('change', e => {
        if (e.target.id === 'customerSelect') {
            const opt = e.target.selectedOptions[0];
            const phone = document.getElementById('customerPhone');
            const email = document.getElementById('paystackEmail');
            if (phone) phone.value = opt?.dataset.phone || '';
            if (email) email.value = opt?.dataset.email || '';
        }
    });

    // ─── Run on DOMContentLoaded AND every HTMX swap ─────────────────────────────
    // Using htmx:afterSettle (fires after animations) is more reliable than afterSwap

    document.addEventListener('DOMContentLoaded', initBookLaundry);
    document.addEventListener('htmx:afterSettle', initBookLaundry);
</script>
