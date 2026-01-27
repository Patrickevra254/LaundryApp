<div class="container-fluid book-order-page mt-2">

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

{{-- <script>
    const ITEMS = @json($items);

    document.addEventListener("DOMContentLoaded", function() {
        const tableBody = document.getElementById('itemsTableBody');
        const addBtn = document.getElementById('addItemBtn');
        let itemIndex = tableBody.querySelectorAll('tr').length;

        function updateRowPrice(row) {
            const itemSelect = row.querySelector('.item-name');
            const serviceSelect = row.querySelector('.item-service');
            const priceInput = row.querySelector('.item-price');
            const priceDisplay = row.querySelector('.price-display');
            const qtyInput = row.querySelector('.item-qty');
            const subtotalCell = row.querySelector('.item-subtotal');

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
            document.getElementById('paystackAmount').value = total * 100;
        }

        tableBody.addEventListener('change', e => {
            if (e.target.classList.contains('item-name') || e.target.classList.contains(
                    'item-service')) {
                updateRowPrice(e.target.closest('tr'));
            }
        });

        tableBody.addEventListener('input', e => {
            if (e.target.classList.contains('item-qty')) {
                updateRowPrice(e.target.closest('tr'));
            }
        });

        tableBody.addEventListener('click', e => {
            if (e.target.closest('.remove-item')) {
                e.target.closest('tr').remove();
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
            </option>`).join('');

            const row = document.createElement('tr');
            row.innerHTML = `
            <td data-label="Item">
                <select name="items[${itemIndex}][item_id]" class="form-select item-name">${options}</select>
            </td>
            <td data-label="Service">
                <select name="items[${itemIndex}][service_type]" class="form-select item-service">
                    <option value="washing" selected>Washing</option>
                    <option value="ironing">Ironing</option>
                    <option value="wash_and_iron">Washing & Ironing</option>
                </select>
            </td>
            <td data-label="Price">
                <input type="hidden" name="items[${itemIndex}][price]" class="item-price">
                <input type="text" class="form-control price-display" disabled>
            </td>
            <td data-label="Qty">
                <input type="number" name="items[${itemIndex}][quantity]" class="form-control item-qty" value="1" min="1">
            </td>
            <td data-label="Subtotal" class="fw-semibold item-subtotal">₦0</td>
            <td class="text-center">
                <button type="button" class="btn btn-sm btn-outline-danger remove-item"><i class="fa fa-trash"></i></button>
            </td>`;
            tableBody.appendChild(row);
            itemIndex++;
            updateRowPrice(row);
        });

        tableBody.querySelectorAll('tr').forEach(row => updateRowPrice(row));
    });

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
            document.getElementById('customerPhone').value = opt.dataset.phone || '';
            document.getElementById('paystackEmail').value = opt.dataset.email || '';
        }
    });
</script> --}}

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

            if (phone) phone.value = opt.dataset.phone || '';
            if (email) email.value = opt.dataset.email || '';
        }
    });
</script>
