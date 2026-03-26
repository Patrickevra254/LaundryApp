{{-- <div class="container-fluid">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-3">
        <div>
            <div class="notifs-label">Booking</div>
            <h4 class="notifs-title mb-0">Book Laundry</h4>
            <p class="notifs-sub mb-0">Create a new laundry order</p>
        </div>
    </div>

    <!-- Paystack form (online payments) -->
    <form method="POST" action="{{ route('payment.redirect') }}" id="paystackForm">
        @csrf
        <input type="hidden" name="email"           id="paystackEmail"     value="{{ auth()->user()->email }}">
        <input type="hidden" name="amount"           id="paystackAmount">
        <input type="hidden" name="customer_id"      id="ps_customer_id">
        <input type="hidden" name="pickup_address"   id="ps_pickup_address">
        <input type="hidden" name="delivery_address" id="ps_delivery_address">
        <input type="hidden" name="pickup_date"      id="ps_pickup_date">
        <input type="hidden" name="delivery_date"    id="ps_delivery_date">
        <input type="hidden" name="items_json"       id="ps_items_json">
        <input type="hidden" name="payment_method"   value="paystack">
        <input type="hidden" name="payment_timing"   value="now">
        <input type="hidden" name="amount_paid_now"  id="ps_amount_paid_now">
        <input type="hidden" name="extra_charges"    id="ps_extra_charges">
        <input type="hidden" name="extra_charges_note" id="ps_extra_charges_note">
        <input type="hidden" name="wash_assigned_to" id="ps_wash_assigned_to">
        <input type="hidden" name="iron_assigned_to" id="ps_iron_assigned_to">
    </form>

    <!-- Cash/Bank form (direct order creation) -->
    <form method="POST" action="{{ route('order.store') }}" id="directForm">
        @csrf
        <input type="hidden" name="customer_id"       id="df_customer_id">
        <input type="hidden" name="pickup_address"    id="df_pickup_address">
        <input type="hidden" name="delivery_address"  id="df_delivery_address">
        <input type="hidden" name="pickup_date"       id="df_pickup_date">
        <input type="hidden" name="delivery_date"     id="df_delivery_date">
        <input type="hidden" name="items_json"        id="df_items_json">
        <input type="hidden" name="payment_method"    id="df_payment_method">
        <input type="hidden" name="payment_timing"    id="df_payment_timing">
        <input type="hidden" name="amount_paid_now"   id="df_amount_paid_now">
        <input type="hidden" name="extra_charges"     id="df_extra_charges">
        <input type="hidden" name="extra_charges_note" id="df_extra_charges_note">
        <input type="hidden" name="wash_assigned_to"  id="df_wash_assigned_to">
        <input type="hidden" name="iron_assigned_to"  id="df_iron_assigned_to">
    </form>

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
                        <input type="hidden" id="field_customer_id"    value="{{ auth()->user()->id }}">
                        <input type="hidden" id="field_customer_email" value="{{ auth()->user()->email }}">
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
                            <select id="customerSelect" class="p-input">
                                <option value="">-- Select Customer --</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}"
                                        data-phone="{{ $customer->phone }}"
                                        data-email="{{ $customer->email }}">
                                        {{ $customer->name }}
                                    </option>
                                @endforeach
                            </select>
                            <input type="hidden" id="field_customer_id">
                            <input type="hidden" id="field_customer_email">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="p-label">Phone Number</label>
                            <input type="tel" id="customerPhone" class="p-input" readonly placeholder="Auto-filled">
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
                        <textarea id="field_pickup_address" class="p-input" rows="2" placeholder="Enter pickup address"></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="p-label">Delivery Address</label>
                        <textarea id="field_delivery_address" class="p-input" rows="2" placeholder="Enter delivery address"></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="p-label">Pickup Date</label>
                        <input type="date" id="field_pickup_date" class="p-input">
                    </div>
                    <div class="col-md-6">
                        <label class="p-label">Delivery Date</label>
                        <input type="date" id="field_delivery_date" class="p-input">
                    </div>
                </div>
            </div>

            <!-- Laundry Items -->
            <div class="p-card mb-4">
                <div class="p-card-header">
                    <div class="p-card-icon"><i class="fa fa-shirt"></i></div>
                    <div class="flex-grow-1">
                        <div class="p-card-title">Laundry Items</div>
                        <div class="p-card-sub">Add items and configure care details per item</div>
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
                                <th>Details</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="itemsTableBody">
                            @if ($items->isNotEmpty())
                                @php $firstItem = $items->first(); @endphp
                                <tr data-row-id="0">
                                    <td>
                                        <select class="p-input item-name">
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
                                        <select class="p-input item-service">
                                            <option value="washing">Washing</option>
                                            <option value="ironing">Ironing</option>
                                            <option value="wash_and_iron">Wash & Iron</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="hidden" class="item-price" value="{{ $firstItem->washing_price }}">
                                        <input class="p-input price-display" disabled style="width:90px;">
                                    </td>
                                    <td><input type="number" class="p-input item-qty" value="1" min="1" style="width:70px;"></td>
                                    <td class="fw-600 item-subtotal">₦0</td>
                                    <td>
                                        <button type="button" class="n-btn n-btn-secondary details-btn"
                                            data-row="0" style="font-size:.72rem; padding:.3rem .6rem;">
                                            <i class="fa fa-sliders me-1"></i>Details
                                        </button>
                                        <!-- hidden badge shown when details filled -->
                                        <span class="details-badge" id="badge-0" style="display:none;">✓</span>
                                    </td>
                                    <td>
                                        <button type="button" class="n-icon-btn remove-item">
                                            <i class="fa fa-trash text-danger"></i>
                                        </button>
                                    </td>
                                </tr>
                            @else
                                <tr id="noItemsRow">
                                    <td colspan="7" class="text-center py-4">
                                        <div class="no-items-state">
                                            <i class="fa fa-shirt mb-2" style="font-size:1.8rem; color:#d1d5db;"></i>
                                            <p class="mb-1 fw-600" style="color:#6b7280; font-size:.85rem;">No items available yet</p>
                                            <p class="mb-0" style="color:#9ca3af; font-size:.75rem;">
                                                Add items in the
                                                <a href="{{ route('items') }}" hx-get="{{ route('items') }}"
                                                   hx-target="#content-area" hx-push-url="true"
                                                   style="color:#4f46e5; font-weight:600;">Items page</a>
                                                before booking.
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Assignment — hidden from customers -->
            @if (auth()->user()->role !== 'customer')
            <div class="p-card mb-4">
                <div class="p-card-header">
                    <div class="p-card-icon"><i class="fa fa-users"></i></div>
                    <div>
                        <div class="p-card-title">Staff Assignment</div>
                        <div class="p-card-sub">Who will handle this order?</div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="p-label"><i class="fa fa-droplet me-1" style="color:#3b82f6;"></i> Assigned for Washing</label>
                        <input type="text" id="field_wash_assigned_to" class="p-input"
                            placeholder="Enter name of washer">
                    </div>
                    <div class="col-md-6">
                        <label class="p-label"><i class="fa fa-fire me-1" style="color:#f59e0b;"></i> Assigned for Ironing</label>
                        <input type="text" id="field_iron_assigned_to" class="p-input"
                            placeholder="Enter name of ironer">
                    </div>
                </div>
            </div>
            @else
                <!-- Keep hidden inputs so JS submit doesn't break -->
                <input type="hidden" id="field_wash_assigned_to">
                <input type="hidden" id="field_iron_assigned_to">
            @endif

            <!-- Payment -->
            <div class="p-card mb-4">
                <div class="p-card-header">
                    <div class="p-card-icon"><i class="fa fa-credit-card"></i></div>
                    <div>
                        <div class="p-card-title">Payment</div>
                        <div class="p-card-sub">How will this order be paid?</div>
                    </div>
                </div>
                <div class="row g-3">

                    <!-- Method -->
                    <div class="col-12">
                        <label class="p-label">Payment Method</label>
                        <div class="pay-options">
                            <label class="pay-option active" data-method="cash">
                                <i class="fa fa-money-bill-wave"></i><span>Cash</span>
                            </label>
                            <label class="pay-option" data-method="bank">
                                <i class="fa fa-building-columns"></i><span>Bank Transfer</span>
                            </label>
                            <label class="pay-option" data-method="paystack">
                                <i class="fa fa-globe"></i><span>Paystack</span>
                            </label>
                        </div>
                    </div>

                    <!-- Timing -->
                    <div class="col-12" id="timingRow">
                        <label class="p-label">When will payment be made?</label>
                        <div class="pay-options">
                            <label class="pay-option active" data-timing="now">
                                <i class="fa fa-bolt"></i><span>Pay Now</span>
                            </label>
                            <label class="pay-option" data-timing="on_delivery">
                                <i class="fa fa-truck"></i><span>On Delivery</span>
                            </label>
                            <label class="pay-option" data-timing="on_collection">
                                <i class="fa fa-store"></i><span>At Store</span>
                            </label>
                        </div>
                    </div>

                    <!-- Partial amount -->
                    <div class="col-12" id="partialRow">
                        <label class="p-label">Amount Paying Now</label>
                        <div class="partial-input-wrap">
                            <span class="partial-prefix">₦</span>
                            <input type="number" id="amountPaidNow" class="p-input" min="0" value="0" placeholder="0">
                        </div>
                        <div class="partial-hint">
                            Leave 0 to pay the <strong>full amount</strong>. Enter a partial amount to pay less now.
                            Leave 0 for <strong>On Delivery / At Store</strong> timings.
                        </div>
                        <div class="partial-hint paystack-note" id="paystackNote" style="display:none;">
                            <i class="fa fa-circle-info me-1"></i>
                            For Paystack, leave 0 to charge the full amount online, or enter a partial amount.
                        </div>
                    </div>

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
                    <div class="summary-row"><span>Items</span><span id="totalItems">0</span></div>
                    <div class="summary-row"><span>Subtotal</span><span id="subtotal">₦0</span></div>
                    <div class="summary-row"><span>Service Fee</span><span>₦200</span></div>
                    <div class="summary-row" id="extraChargesRow" style="display:none;">
                        <span>Extra Charges</span>
                        <span id="summaryExtra" style="color:#f59e0b; font-weight:600;">₦0</span>
                    </div>
                </div>

                <div class="summary-divider"></div>

                <div class="summary-total">
                    <span>Total</span><span id="total">₦0</span>
                </div>

                <!-- Payment preview -->
                <div class="pay-preview mt-3">
                    <div class="pay-preview-row"><span>Method</span><span id="previewMethod">Cash</span></div>
                    <div class="pay-preview-row"><span>Timing</span><span id="previewTiming">Pay Now</span></div>
                    <div class="pay-preview-row" id="previewPaidRow">
                        <span>Paying Now</span><span id="previewPaid">₦0 (full)</span>
                    </div>
                    <div class="pay-preview-row" id="previewBalanceRow" style="display:none;">
                        <span>Balance Due</span><span id="previewBalance" class="text-warning fw-bold">₦0</span>
                    </div>
                </div>

                <button type="button" id="submitOrderBtn" class="n-btn n-btn-primary w-100 mt-4"
                    style="justify-content:center;padding:.65rem;">
                    <i class="fa fa-check-circle me-1"></i>
                    <span id="submitLabel">Create Order</span>
                </button>
            </div>
        </div>

    </div>
</div> --}}

{{-- ═══ Item Details Modal ═══ --}}
{{-- <div class="modal fade" id="itemDetailsModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" style="max-width:580px;">
        <div class="modal-content od-modal">

            <div class="od-modal-header">
                <div>
                    <div class="od-order-num"><i class="fa fa-sliders me-2"></i>Item Care Details</div>
                    <div class="od-order-sub" id="detailsModalSubtitle">Configure care preferences for this item</div>
                </div>
                <button class="od-close" data-bs-dismiss="modal"><i class="fa fa-xmark"></i></button>
            </div>

            <div class="od-modal-body">

                <input type="hidden" id="detailsRowId">

                <div class="row g-3">

                    <!-- Cloth Description -->
                    <div class="col-12">
                        <label class="p-label"><i class="fa fa-tag me-1"></i> Cloth Description</label>
                        <input type="text" id="det_description" class="p-input"
                            placeholder="e.g. Blue cotton shirt, faded at collar">
                    </div>

                    <!-- Staff Observations — hidden from customers -->
                    @if (auth()->user()->role !== 'customer')
                        <div class="col-12">
                            <label class="p-label"><i class="fa fa-eye me-1"></i> Staff Observations</label>
                            <textarea id="det_observations" class="p-input" rows="2"
                                placeholder="e.g. Stain on left sleeve, missing button, torn hem..."></textarea>
                        </div>
                    @else
                        <!-- Keep hidden input so JS doesn't break when reading/saving -->
                        <textarea id="det_observations" style="display:none;"></textarea>
                    @endif

                    <!-- Customer Requirements -->
                    <div class="col-12">
                        <label class="p-label"><i class="fa fa-comment-dots me-1"></i> Customer Requirements</label>
                        <textarea id="det_requirements" class="p-input" rows="2"
                            placeholder="e.g. No bleach, handle with care, separate from other colours..."></textarea>
                    </div>

                    <!-- Starch Level -->
                    <div class="col-md-4">
                        <label class="p-label"><i class="fa fa-snowflake me-1"></i> Starch Level</label>
                        <div class="detail-options" id="det_starch_opts">
                            <button type="button" class="detail-opt active" data-val="none"   data-charge="0">None</button>
                            <button type="button" class="detail-opt" data-val="low"    data-charge="0">Low</button>
                            <button type="button" class="detail-opt" data-val="medium" data-charge="0">Medium</button>
                            <button type="button" class="detail-opt" data-val="high"   data-charge="0">High</button>
                        </div>
                    </div>

                    <!-- Heat Level -->
                    <div class="col-md-4">
                        <label class="p-label"><i class="fa fa-fire me-1"></i> Iron Heat</label>
                        <div class="detail-options" id="det_heat_opts">
                            <button type="button" class="detail-opt active" data-val="low"    data-charge="0">Low</button>
                            <button type="button" class="detail-opt" data-val="medium" data-charge="0">Medium</button>
                            <button type="button" class="detail-opt" data-val="high"   data-charge="0">High</button>
                        </div>
                    </div>

                    <!-- Finish -->
                    <div class="col-md-4">
                        <label class="p-label"><i class="fa fa-layer-group me-1"></i> Finish</label>
                        <div class="detail-options" id="det_finish_opts">
                            <button type="button" class="detail-opt active" data-val="folded" data-charge="0">
                                <i class="fa fa-layer-group me-1"></i>Folded
                            </button>
                            <button type="button" class="detail-opt" data-val="hanged" data-charge="0">
                                <i class="fa fa-shirt me-1"></i>Hanged
                            </button>
                        </div>
                    </div>

                    <!-- Extra Charge Summary — hidden from customers -->
                    @if (auth()->user()->role !== 'customer')
                        <div class="col-12">
                            <div class="det-charge-box">
                                <div class="det-charge-breakdown" id="det_charge_breakdown">
                                    <span class="det-charge-line zero" id="det_starch_line">Starch: None</span>
                                    <span class="det-charge-sep">·</span>
                                    <span class="det-charge-line zero" id="det_heat_line">Heat: Low</span>
                                    <span class="det-charge-sep">·</span>
                                    <span class="det-charge-line zero" id="det_finish_line">Finish: Folded</span>
                                </div>
                                <div class="det-charge-total-row">
                                    <label class="p-label mb-0">Extra Charge for this item</label>
                                    <div class="partial-input-wrap" style="max-width:180px;">
                                        <span class="partial-prefix">₦</span>
                                        <input type="number" id="det_extra_charge" class="p-input" min="0"
                                            placeholder="0" oninput="onExtraChargeManualEdit()">
                                    </div>
                                </div>
                                <div style="font-size:.72rem; color:#9ca3af; margin-top:4px;">
                                    Enter the extra charge for this item manually (e.g. special handling, starch treatment, folding etc.)
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- Keep hidden input so JS charge calculation doesn't break -->
                        <input type="number" id="det_extra_charge" value="0" style="display:none;">
                    @endif

                </div>

            </div>

            <div class="od-modal-footer">
                <button class="n-btn n-btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button class="n-btn n-btn-primary" id="saveDetailsBtn">
                    <i class="fa fa-check me-1"></i> Save Details
                </button>
            </div>

        </div>
    </div>
</div> --}}

{{-- <style>
    .notifs-label { font-size:.7rem; font-weight:700; letter-spacing:.1em; text-transform:uppercase; color:#a5b4fc; }
    .notifs-title { font-size:1.4rem; font-weight:700; color:#0f0f1a; letter-spacing:-.02em; }
    .notifs-sub   { font-size:.82rem; color:#9ca3af; margin-top:2px; }

    .p-card { background:#fff; border:1px solid #f0f0f8; border-radius:14px; padding:1.4rem; }
    .p-card-header { display:flex; align-items:center; gap:.85rem; margin-bottom:1.2rem; padding-bottom:1rem; border-bottom:1px solid #f5f5fb; }
    .p-card-icon { width:38px; height:38px; border-radius:10px; background:#eef2ff; color:#4f46e5; display:flex; align-items:center; justify-content:center; font-size:.9rem; flex-shrink:0; }
    .p-card-title { font-size:.9rem; font-weight:700; color:#111827; }
    .p-card-sub   { font-size:.75rem; color:#9ca3af; margin-top:1px; }

    .p-label { font-size:.78rem; font-weight:600; color:#6b7280; margin-bottom:5px; display:block; }
    .p-input { width:100%; border-radius:9px; border:1px solid #e5e7eb; padding:.52rem .75rem; font-size:.85rem; color:#111827; background:#fafafa; transition:all .15s; outline:none; appearance:auto; }
    .p-input:focus { border-color:#a5b4fc; background:#fff; box-shadow:0 0 0 3px rgba(79,70,229,.08); }
    .p-input:disabled { background:#f3f4f6; color:#9ca3af; }
    .p-input::placeholder { color:#c4c9d4; }
    textarea.p-input { resize:vertical; }

    .h-search-wrap { position:relative; }
    .h-search-wrap i { position:absolute; left:11px; top:50%; transform:translateY(-50%); color:#c4c9d4; font-size:.8rem; pointer-events:none; }
    .h-search { width:100%; border-radius:9px; border:1px solid #e5e7eb; padding:.52rem .75rem .52rem 2.1rem; font-size:.85rem; background:#fafafa; outline:none; transition:all .15s; color:#111827; }
    .h-search:focus { border-color:#a5b4fc; background:#fff; box-shadow:0 0 0 3px rgba(79,70,229,.08); }
    .h-search::placeholder { color:#c4c9d4; }

    .n-btn { display:inline-flex; align-items:center; gap:5px; padding:.45rem .85rem; border-radius:8px; font-size:.8rem; font-weight:600; border:1px solid transparent; cursor:pointer; transition:all .15s; white-space:nowrap; }
    .n-btn-secondary { background:#f3f4f6; border-color:#e5e7eb; color:#374151; }
    .n-btn-secondary:hover { background:#e9eaec; }
    .n-btn-primary { background:#4f46e5; color:#fff; }
    .n-btn-primary:hover { background:#4338ca; }
    .n-icon-btn { width:28px; height:28px; border-radius:7px; border:none; background:#f3f4f6; display:flex; align-items:center; justify-content:center; font-size:.75rem; cursor:pointer; transition:background .15s; }
    .n-icon-btn:hover { background:#fee2e2; }

    /* Detail option pills */
    .detail-options { display:flex; gap:.4rem; flex-wrap:wrap; }
    .detail-opt {
        padding:.35rem .75rem; border-radius:8px; border:1.5px solid #e5e7eb;
        background:#fafafa; font-size:.78rem; font-weight:500; color:#6b7280;
        cursor:pointer; transition:all .15s;
    }
    .detail-opt:hover { border-color:#a5b4fc; color:#4f46e5; }
    .detail-opt.active { border-color:#4f46e5; background:#eef2ff; color:#4f46e5; font-weight:700; }

    /* Details badge */
    .details-badge {
        display:inline-flex; align-items:center; justify-content:center;
        width:18px; height:18px; border-radius:50%;
        background:#10b981; color:#fff; font-size:.65rem; font-weight:700;
        margin-left:.3rem; vertical-align:middle;
    }

    /* Extra charge badge in table row */
    .item-extra-badge {
        display:inline-block; font-size:.68rem; font-weight:700;
        background:#fff7ed; color:#c2410c; border:1px solid #fed7aa;
        border-radius:5px; padding:.15em .5em; margin-left:.3rem;
        vertical-align:middle;
    }

    /* Charge breakdown box inside modal */
    .det-charge-box {
        background:#f8f7ff; border:1px solid #e0e7ff; border-radius:10px; padding:.85rem 1rem;
    }
    .det-charge-breakdown {
        display:flex; align-items:center; flex-wrap:wrap;
        gap:.35rem; margin-bottom:.65rem; font-size:.75rem;
    }
    .det-charge-line {
        background:#eef2ff; color:#4f46e5; font-weight:600;
        padding:.2em .55em; border-radius:5px;
    }
    .det-charge-line.zero { background:#f3f4f6; color:#9ca3af; }
    .det-charge-sep { color:#9ca3af; font-size:.7rem; }
    .det-charge-total-row {
        display:flex; align-items:center; justify-content:space-between; gap:.5rem;
    }

    /* Payment pills */
    .pay-options { display:flex; gap:.5rem; flex-wrap:wrap; }
    .pay-option { display:flex; align-items:center; gap:.5rem; padding:.5rem .9rem; border-radius:9px; border:1.5px solid #e5e7eb; background:#fafafa; font-size:.82rem; font-weight:500; color:#6b7280; cursor:pointer; transition:all .15s; user-select:none; }
    .pay-option:hover { border-color:#a5b4fc; color:#4f46e5; }
    .pay-option.active { border-color:#4f46e5; background:#eef2ff; color:#4f46e5; font-weight:600; }
    .pay-option i { font-size:.8rem; }

    .partial-input-wrap { display:flex; align-items:center; gap:.5rem; }
    .partial-prefix { font-size:.9rem; font-weight:600; color:#6b7280; }
    .partial-hint { font-size:.75rem; color:#9ca3af; margin-top:.4rem; }
    .paystack-note { background:#fffbeb; border:1px solid #fde68a; border-radius:8px; padding:.5rem .75rem; color:#92400e !important; margin-top:.5rem; }

    .pay-preview { background:#f8f7ff; border-radius:10px; padding:.75rem 1rem; }
    .pay-preview-row { display:flex; justify-content:space-between; font-size:.8rem; color:#6b7280; padding:.2rem 0; }
    .pay-preview-row span:last-child { font-weight:600; color:#4f46e5; }

    .book-table { font-size:.83rem; }
    .book-table thead th { font-size:.7rem; text-transform:uppercase; letter-spacing:.05em; color:#9ca3af; font-weight:600; border-bottom:1px solid #f0f0f8; padding:.6rem .5rem; }
    .book-table tbody td { border-color:#f5f5fb; padding:.5rem; vertical-align:middle; }
    .fw-600 { font-weight:600; }

    .summary-sticky { position:sticky; top:80px; }
    .summary-rows { display:flex; flex-direction:column; gap:.5rem; margin-bottom:.75rem; }
    .summary-row { display:flex; justify-content:space-between; font-size:.85rem; color:#6b7280; }
    .summary-divider { height:1px; background:#f0f0f8; margin:.75rem 0; }
    .summary-total { display:flex; justify-content:space-between; font-size:1.05rem; font-weight:700; color:#111827; }

    .no-items-state { display:flex; flex-direction:column; align-items:center; padding:.5rem 0; }

    /* Modal styles (reuse od-modal pattern) */
    .od-modal { border-radius:16px; border:1px solid #f0f0f8; overflow:hidden; }
    .od-modal-header { display:flex; justify-content:space-between; align-items:flex-start; padding:1.2rem 1.4rem; border-bottom:1px solid #f5f5fb; }
    .od-order-num { font-size:1rem; font-weight:700; color:#111827; }
    .od-order-sub { font-size:.75rem; color:#9ca3af; margin-top:2px; }
    .od-close { width:30px; height:30px; border-radius:8px; border:none; background:#f3f4f6; color:#6b7280; display:flex; align-items:center; justify-content:center; cursor:pointer; transition:background .15s; }
    .od-close:hover { background:#e9eaec; }
    .od-modal-body { padding:1.2rem 1.4rem; }
    .od-modal-footer { display:flex; justify-content:flex-end; gap:.6rem; padding:1rem 1.4rem; border-top:1px solid #f5f5fb; flex-wrap:wrap; }
</style> --}}

{{-- <script>
    const ITEMS = @json($items);
    let bookLaundryItemIndex = 0;

    // ── Per-row details store: { rowId: { description, observations, starch, heat, finish, requirements } }
    const itemDetails = {};

    // ── Row price & totals ───────────────────────────────────────────────────────

    function updateRowPrice(row) {
        const opt   = row.querySelector('.item-name')?.selectedOptions[0];
        const svc   = row.querySelector('.item-service')?.value;
        const qty   = parseInt(row.querySelector('.item-qty')?.value) || 0;
        const price = parseInt(opt?.dataset[svc]) || 0;
        const ph    = row.querySelector('.item-price');
        const pd    = row.querySelector('.price-display');
        const sub   = row.querySelector('.item-subtotal');
        if (ph)  ph.value        = price;
        if (pd)  pd.value        = '₦' + price.toLocaleString();
        if (sub) sub.textContent = '₦' + (price * qty).toLocaleString();
        updateTotals();
    }

    function getOrderTotal() {
        let subtotal = 0, totalItems = 0, extraTotal = 0;
        document.getElementById('itemsTableBody')?.querySelectorAll('tr').forEach(row => {
            const qty   = parseInt(row.querySelector('.item-qty')?.value)   || 0;
            const price = parseInt(row.querySelector('.item-price')?.value) || 0;
            totalItems += qty;
            subtotal   += qty * price;
            // Sum per-item extras from itemDetails
            const rowId = row.dataset.rowId;
            extraTotal += parseInt(itemDetails[rowId]?.extraCharge || 0);
        });
        return { subtotal, totalItems, extra: extraTotal, total: subtotal + 200 + extraTotal };
    }

    function updateTotals() {
        const { subtotal, totalItems, extra, total } = getOrderTotal();
        const el = id => document.getElementById(id);
        if (el('totalItems')) el('totalItems').textContent = totalItems;
        if (el('subtotal'))   el('subtotal').textContent   = '₦' + subtotal.toLocaleString();
        if (el('total'))      el('total').textContent      = '₦' + total.toLocaleString();

        // Extra charges row in summary
        if (el('extraChargesRow')) el('extraChargesRow').style.display = extra > 0 ? '' : 'none';
        if (el('summaryExtra'))    el('summaryExtra').textContent       = '₦' + extra.toLocaleString();

        updateSummaryPreview();
    }

    // ── Add item row ─────────────────────────────────────────────────────────────

    function addItemRow() {
        const tbody = document.getElementById('itemsTableBody');
        if (!tbody) return;
        const i = ++bookLaundryItemIndex;
        const opts = ITEMS.map(it =>
            `<option value="${it.id}" data-washing="${it.washing_price}" data-ironing="${it.ironing_price}" data-wash_and_iron="${it.wash_and_iron_price}">${it.name}</option>`
        ).join('');
        const row = document.createElement('tr');
        row.dataset.rowId = i;
        row.innerHTML = `
            <td><select class="p-input item-name">${opts}</select></td>
            <td><select class="p-input item-service">
                <option value="washing">Washing</option>
                <option value="ironing">Ironing</option>
                <option value="wash_and_iron">Wash &amp; Iron</option>
            </select></td>
            <td><input type="hidden" class="item-price"><input class="p-input price-display" disabled style="width:90px;"></td>
            <td><input type="number" class="p-input item-qty" value="1" min="1" style="width:70px;"></td>
            <td class="fw-600 item-subtotal">₦0</td>
            <td>
                <button type="button" class="n-btn n-btn-secondary details-btn" data-row="${i}" style="font-size:.72rem;padding:.3rem .6rem;">
                    <i class="fa fa-sliders me-1"></i>Details
                </button>
                <span class="details-badge" id="badge-${i}" style="display:none;">✓</span>
            </td>
            <td><button type="button" class="n-icon-btn remove-item"><i class="fa fa-trash text-danger"></i></button></td>`;
        tbody.appendChild(row);
        updateRowPrice(row);
    }

    // ── Item Details Modal ───────────────────────────────────────────────────────

    function getActiveVal(groupId) {
        return document.querySelector(`#${groupId} .detail-opt.active`)?.dataset.val || '';
    }

    function setActiveVal(groupId, val) {
        document.querySelectorAll(`#${groupId} .detail-opt`).forEach(b => {
            b.classList.toggle('active', b.dataset.val === val);
        });
    }

    function openDetailsModal(rowId) {
        document.getElementById('detailsRowId').value = rowId;
        const itemName = document.querySelector(`tr[data-row-id="${rowId}"] .item-name`)?.selectedOptions[0]?.text || 'Item';
        document.getElementById('detailsModalSubtitle').textContent = `Care preferences for: ${itemName}`;

        // Load saved values or defaults
        const saved = itemDetails[rowId] || {};
        document.getElementById('det_description').value   = saved.description   || '';
        document.getElementById('det_observations').value  = saved.observations  || '';
        document.getElementById('det_requirements').value  = saved.requirements  || '';
        setActiveVal('det_starch_opts', saved.starch  || 'medium');
        setActiveVal('det_heat_opts',   saved.heat    || 'medium');
        setActiveVal('det_finish_opts', saved.finish  || 'folded');

        // Set the extra charge — saved override or recalc from presets
        const presetTotal = calcPresetCharge();
        document.getElementById('det_extra_charge').value = saved.extraCharge !== undefined
            ? saved.extraCharge : presetTotal;

        updateChargeBreakdown();

        const modal = bootstrap.Modal.getInstance(document.getElementById('itemDetailsModal'))
            || new bootstrap.Modal(document.getElementById('itemDetailsModal'));
        modal.show();
    }

    // ── Preset charge helpers ────────────────────────────────────────────────────

    function getActiveCharge(groupId) {
        const btn = document.querySelector(`#${groupId} .detail-opt.active`);
        return parseInt(btn?.dataset.charge || 0);
    }

    function calcPresetCharge() {
        return getActiveCharge('det_starch_opts')
             + getActiveCharge('det_heat_opts')
             + getActiveCharge('det_finish_opts');
    }

    function updateChargeBreakdown() {
        const starchBtn = document.querySelector('#det_starch_opts .detail-opt.active');
        const heatBtn   = document.querySelector('#det_heat_opts .detail-opt.active');
        const finishBtn = document.querySelector('#det_finish_opts .detail-opt.active');

        const starchLabel = starchBtn?.dataset.val || '';
        const heatLabel   = heatBtn?.dataset.val   || '';
        const finishLabel = finishBtn?.dataset.val  || '';

        const sl = document.getElementById('det_starch_line');
        const hl = document.getElementById('det_heat_line');
        const fl = document.getElementById('det_finish_line');

        if (sl) { sl.textContent = `Starch: ${starchLabel}`; sl.className = 'det-charge-line zero'; }
        if (hl) { hl.textContent = `Heat: ${heatLabel}`;     hl.className = 'det-charge-line zero'; }
        if (fl) { fl.textContent = `Finish: ${finishLabel}`; fl.className = 'det-charge-line zero'; }
        // No auto-update of charge input — staff enters manually
    }

    function onExtraChargeManualEdit() {
        // Mark as manually overridden so auto-calc stops updating it
        const chargeInput = document.getElementById('det_extra_charge');
        if (chargeInput) chargeInput.dataset.manualOverride = '1';
    }

    function saveDetails() {
        const rowId      = document.getElementById('detailsRowId').value;
        const extraCharge = parseInt(document.getElementById('det_extra_charge')?.value) || 0;

        itemDetails[rowId] = {
            description:  document.getElementById('det_description').value.trim(),
            observations: document.getElementById('det_observations').value.trim(),
            requirements: document.getElementById('det_requirements').value.trim(),
            starch:       getActiveVal('det_starch_opts'),
            heat:         getActiveVal('det_heat_opts'),
            finish:       getActiveVal('det_finish_opts'),
            extraCharge,
        };

        // Show/update badge on the row button
        const badge = document.getElementById(`badge-${rowId}`);
        if (badge) badge.style.display = 'inline-flex';

        // Show extra charge badge in the table row if > 0
        const row = document.querySelector(`tr[data-row-id="${rowId}"]`);
        if (row) {
            let existingBadge = row.querySelector('.item-extra-badge');
            if (extraCharge > 0) {
                if (!existingBadge) {
                    existingBadge = document.createElement('span');
                    existingBadge.className = 'item-extra-badge';
                    const subtotalCell = row.querySelector('.item-subtotal');
                    if (subtotalCell) subtotalCell.appendChild(existingBadge);
                }
                existingBadge.textContent = `+₦${extraCharge.toLocaleString()}`;
            } else if (existingBadge) {
                existingBadge.remove();
            }
        }

        // Reset manual override flag for next time
        const chargeInput = document.getElementById('det_extra_charge');
        if (chargeInput) delete chargeInput.dataset.manualOverride;

        // Recalculate order totals (extra charges affect total)
        updateTotals();

        bootstrap.Modal.getInstance(document.getElementById('itemDetailsModal'))?.hide();
    }

    // ── Payment UI ───────────────────────────────────────────────────────────────

    const methodLabels = { cash: 'Cash', bank: 'Bank Transfer', paystack: 'Paystack' };
    const timingLabels = { now: 'Pay Now', on_delivery: 'On Delivery', on_collection: 'At Store' };

    function getMethod() { return document.querySelector('.pay-option[data-method].active')?.dataset.method || 'cash'; }
    function getTiming() { return document.querySelector('.pay-option[data-timing].active')?.dataset.timing || 'now'; }

    function updatePaymentUI() {
        const method = getMethod();
        const timing = getTiming();

        const timingRow = document.getElementById('timingRow');
        if (timingRow) timingRow.style.display = method === 'paystack' ? 'none' : '';

        const psNote = document.getElementById('paystackNote');
        if (psNote) psNote.style.display = method === 'paystack' ? '' : 'none';

        const partialRow = document.getElementById('partialRow');
        if (partialRow) partialRow.style.display = (timing === 'now' || method === 'paystack') ? '' : 'none';

        const labelEl = document.getElementById('submitLabel');
        if (labelEl) {
            if (method === 'paystack')  labelEl.textContent = 'Pay via Paystack';
            else if (timing === 'now')  labelEl.textContent = 'Create Order & Record Payment';
            else                        labelEl.textContent = 'Create Order';
        }

        updateSummaryPreview();
    }

    function updateSummaryPreview() {
        const method    = getMethod();
        const timing    = getTiming();
        const { total } = getOrderTotal();
        const amountNow = parseInt(document.getElementById('amountPaidNow')?.value) || 0;
        const effectiveAmount = amountNow > 0 ? amountNow :
            (timing === 'now' || method === 'paystack') ? total : 0;
        const balance = Math.max(0, total - effectiveAmount);

        const el = id => document.getElementById(id);
        if (el('previewMethod')) el('previewMethod').textContent = methodLabels[method] || method;
        if (el('previewTiming')) el('previewTiming').textContent = method === 'paystack'
            ? 'Pay Now (Online)' : (timingLabels[timing] || timing);
        if (el('previewPaid'))   el('previewPaid').textContent = effectiveAmount > 0
            ? '₦' + effectiveAmount.toLocaleString() : '₦0 (full later)';

        if (balance > 0 && effectiveAmount > 0 && effectiveAmount < total) {
            if (el('previewBalanceRow')) el('previewBalanceRow').style.display = '';
            if (el('previewBalance'))   el('previewBalance').textContent = '₦' + balance.toLocaleString();
        } else {
            if (el('previewBalanceRow')) el('previewBalanceRow').style.display = 'none';
        }
    }

    // ── Collect & validate ───────────────────────────────────────────────────────

    async function collectFields() {
        const customerId    = document.getElementById('field_customer_id')?.value;
        const customerEmail = document.getElementById('field_customer_email')?.value;
        const pickupAddr    = document.getElementById('field_pickup_address')?.value?.trim();
        const deliveryAddr  = document.getElementById('field_delivery_address')?.value?.trim();
        const pickupDate    = document.getElementById('field_pickup_date')?.value;
        const deliveryDate  = document.getElementById('field_delivery_date')?.value;

        const warn = (msg) => Swal.fire({
            icon: 'warning',
            title: 'Required Field',
            text: msg,
            confirmButtonColor: '#4f46e5',
            confirmButtonText: 'Got it',
        });

        if (!customerId)   { await warn('Please select a customer.');        return null; }
        if (!pickupAddr)   { await warn('Please enter a pickup address.');   return null; }
        if (!deliveryAddr) { await warn('Please enter a delivery address.'); return null; }
        if (!pickupDate)   { await warn('Please select a pickup date.');     return null; }
        if (!deliveryDate) { await warn('Please select a delivery date.');   return null; }

        // Washer & ironer required for admin and staff
        @if (in_array(auth()->user()->role, ['admin', 'staff']))
        const washStaffVal = document.getElementById('field_wash_assigned_to')?.value?.trim();
        const ironStaffVal = document.getElementById('field_iron_assigned_to')?.value?.trim();
        if (!washStaffVal) { await warn('Please assign a washer for this order.');  return null; }
        if (!ironStaffVal) { await warn('Please assign an ironer for this order.'); return null; }
        @endif

        const items = [];
        const itemsWithoutDetails = [];

        document.getElementById('itemsTableBody')?.querySelectorAll('tr').forEach(row => {
            const itemId = row.querySelector('.item-name')?.value;
            if (!itemId) return;
            const rowId   = row.dataset.rowId;
            const details = itemDetails[rowId] || {};

            if (!details.description && !details.observations && !details.requirements) {
                const itemName = row.querySelector('.item-name')?.selectedOptions[0]?.text || 'Item';
                itemsWithoutDetails.push(itemName);
            }

            items.push({
                item_id:      itemId,
                service_type: row.querySelector('.item-service')?.value,
                price:        row.querySelector('.item-price')?.value,
                quantity:     row.querySelector('.item-qty')?.value,
                description:  details.description  || '',
                observations: details.observations || '',
                requirements: details.requirements || '',
                starch:       details.starch       || 'none',
                heat:         details.heat         || 'low',
                finish:       details.finish       || 'folded',
                extra_charge: details.extraCharge  || 0,
            });
        });

        if (items.length === 0) {
            await warn('No items available. Please add items in the Items page before booking.');
            return null;
        }

        // Soft warning — confirm if any items have no care details
        if (itemsWithoutDetails.length > 0) {
            const names = itemsWithoutDetails.join(', ');
            const result = await Swal.fire({
                icon: 'question',
                title: 'Care Details Missing',
                html: `Care details not filled for: <strong>${names}</strong>.<br><br>Do you want to continue without filling them in?`,
                showCancelButton: true,
                confirmButtonColor: '#4f46e5',
                cancelButtonColor: '#e5e7eb',
                confirmButtonText: 'Yes, continue',
                cancelButtonText: 'Go back & fill details',
            });
            if (!result.isConfirmed) return null;
        }

        return { customerId, customerEmail, pickupAddr, deliveryAddr, pickupDate, deliveryDate, items };
    }

    // ── Submit ───────────────────────────────────────────────────────────────────

    async function handleSubmit() {
        const fields = await collectFields();
        if (!fields) return;

        document.getElementById('itemsTableBody')?.querySelectorAll('tr').forEach(row => updateRowPrice(row));

        const method    = getMethod();
        const timing    = method === 'paystack' ? 'now' : getTiming();
        const { total, extra } = getOrderTotal();
        const amountNow = parseInt(document.getElementById('amountPaidNow')?.value) || 0;
        const extraNote = `Per-item care charges (starch/heat/finish)`; // auto-generated note
        const washStaff = document.getElementById('field_wash_assigned_to')?.value || '';
        const ironStaff = document.getElementById('field_iron_assigned_to')?.value || '';

        const f = id => document.getElementById(id);

        if (method === 'paystack') {
            const chargeAmount = amountNow > 0 ? amountNow : total;
            f('ps_customer_id').value       = fields.customerId;
            f('paystackEmail').value         = fields.customerEmail;
            f('ps_pickup_address').value    = fields.pickupAddr;
            f('ps_delivery_address').value  = fields.deliveryAddr;
            f('ps_pickup_date').value       = fields.pickupDate;
            f('ps_delivery_date').value     = fields.deliveryDate;
            f('ps_items_json').value        = JSON.stringify(fields.items);
            f('paystackAmount').value        = chargeAmount * 100;
            f('ps_amount_paid_now').value   = chargeAmount;
            f('ps_extra_charges').value     = extra;
            f('ps_extra_charges_note').value = extraNote;
            f('ps_wash_assigned_to').value  = washStaff;
            f('ps_iron_assigned_to').value  = ironStaff;
            document.getElementById('paystackForm').submit();
        } else {
            const actualAmount = (timing === 'now' && amountNow === 0) ? total : amountNow;
            f('df_customer_id').value        = fields.customerId;
            f('df_pickup_address').value     = fields.pickupAddr;
            f('df_delivery_address').value   = fields.deliveryAddr;
            f('df_pickup_date').value        = fields.pickupDate;
            f('df_delivery_date').value      = fields.deliveryDate;
            f('df_items_json').value         = JSON.stringify(fields.items);
            f('df_payment_method').value     = method;
            f('df_payment_timing').value     = timing;
            f('df_amount_paid_now').value    = actualAmount;
            f('df_extra_charges').value      = extra;
            f('df_extra_charges_note').value = extraNote;
            f('df_wash_assigned_to').value   = washStaff;
            f('df_iron_assigned_to').value   = ironStaff;
            document.getElementById('directForm').submit();
        }
    }

    // ── Init ─────────────────────────────────────────────────────────────────────

    function initBookLaundry() {
        const tbody     = document.getElementById('itemsTableBody');
        const addBtn    = document.getElementById('addItemBtn');
        const submitBtn = document.getElementById('submitOrderBtn');
        const saveBtn   = document.getElementById('saveDetailsBtn');
        if (!tbody || !addBtn) return;

        bookLaundryItemIndex = tbody.querySelectorAll('tr').length - 1;
        tbody.querySelectorAll('tr').forEach(row => updateRowPrice(row));

        if (ITEMS.length === 0) {
            addBtn.disabled = true;
            addBtn.title = 'Add items in the Items page first';
        }

        if (tbody.dataset.bound === '1') return;
        tbody.dataset.bound = '1';

        tbody.addEventListener('change', e => {
            if (e.target.matches('.item-name, .item-service')) updateRowPrice(e.target.closest('tr'));
        });
        tbody.addEventListener('input', e => {
            if (e.target.matches('.item-qty')) updateRowPrice(e.target.closest('tr'));
        });
        tbody.addEventListener('click', e => {
            if (e.target.closest('.remove-item')) { e.target.closest('tr').remove(); updateTotals(); }
            if (e.target.closest('.details-btn')) {
                const rowId = e.target.closest('.details-btn').dataset.row;
                openDetailsModal(rowId);
            }
        });

        addBtn.addEventListener('click', addItemRow);
        submitBtn?.addEventListener('click', handleSubmit);
        saveBtn?.addEventListener('click', saveDetails);

        // Detail option toggles inside the modal
        document.querySelectorAll('.detail-options').forEach(group => {
            group.addEventListener('click', e => {
                const btn = e.target.closest('.detail-opt');
                if (!btn) return;
                group.querySelectorAll('.detail-opt').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                // Reset manual override so preset auto-calc takes over again
                const chargeInput = document.getElementById('det_extra_charge');
                if (chargeInput) delete chargeInput.dataset.manualOverride;
                updateChargeBreakdown();
            });
        });

        document.querySelectorAll('.pay-option[data-method]').forEach(opt => {
            opt.addEventListener('click', () => {
                document.querySelectorAll('.pay-option[data-method]').forEach(o => o.classList.remove('active'));
                opt.classList.add('active');
                if (opt.dataset.method === 'paystack') {
                    document.querySelectorAll('.pay-option[data-timing]').forEach(o => o.classList.remove('active'));
                    document.querySelector('.pay-option[data-timing="now"]')?.classList.add('active');
                }
                updatePaymentUI();
            });
        });

        document.querySelectorAll('.pay-option[data-timing]').forEach(opt => {
            opt.addEventListener('click', () => {
                document.querySelectorAll('.pay-option[data-timing]').forEach(o => o.classList.remove('active'));
                opt.classList.add('active');
                updatePaymentUI();
            });
        });

        document.getElementById('amountPaidNow')?.addEventListener('input', updateSummaryPreview);
        updatePaymentUI();

        // Bootstrap modal backdrop cleanup
        document.addEventListener('hidden.bs.modal', () => {
            document.querySelectorAll('.modal-backdrop').forEach(b => b.remove());
            document.body.classList.remove('modal-open');
            document.body.style.removeProperty('overflow');
            document.body.style.removeProperty('padding-right');
        });
    }

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
            const el  = id => document.getElementById(id);
            if (el('customerPhone'))        el('customerPhone').value        = opt?.dataset.phone || '';
            if (el('field_customer_id'))    el('field_customer_id').value    = opt?.value         || '';
            if (el('field_customer_email')) el('field_customer_email').value = opt?.dataset.email || '';
        }
    });

    document.addEventListener('DOMContentLoaded', initBookLaundry);
    document.addEventListener('htmx:afterSettle',  initBookLaundry);
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

    {{-- Paystack form (online payments) --}}
    <form method="POST" action="{{ route('payment.redirect') }}" id="paystackForm">
        @csrf
        <input type="hidden" name="email" id="paystackEmail" value="{{ auth()->user()->email }}">
        <input type="hidden" name="amount" id="paystackAmount">
        <input type="hidden" name="customer_id" id="ps_customer_id">
        <input type="hidden" name="pickup_address" id="ps_pickup_address">
        <input type="hidden" name="delivery_address" id="ps_delivery_address">
        <input type="hidden" name="pickup_date" id="ps_pickup_date">
        <input type="hidden" name="delivery_date" id="ps_delivery_date">
        <input type="hidden" name="items_json" id="ps_items_json">
        <input type="hidden" name="payment_method" value="paystack">
        <input type="hidden" name="payment_timing" value="now">
        <input type="hidden" name="amount_paid_now" id="ps_amount_paid_now">
        <input type="hidden" name="extra_charges" id="ps_extra_charges">
        <input type="hidden" name="extra_charges_note" id="ps_extra_charges_note">
        <input type="hidden" name="wash_assigned_to" id="ps_wash_assigned_to">
        <input type="hidden" name="iron_assigned_to" id="ps_iron_assigned_to">
    </form>

    {{-- Cash/Bank form (direct order creation) --}}
    <form method="POST" action="{{ route('order.store') }}" id="directForm">
        @csrf
        <input type="hidden" name="customer_id" id="df_customer_id">
        <input type="hidden" name="pickup_address" id="df_pickup_address">
        <input type="hidden" name="delivery_address" id="df_delivery_address">
        <input type="hidden" name="pickup_date" id="df_pickup_date">
        <input type="hidden" name="delivery_date" id="df_delivery_date">
        <input type="hidden" name="items_json" id="df_items_json">
        <input type="hidden" name="payment_method" id="df_payment_method">
        <input type="hidden" name="payment_timing" id="df_payment_timing">
        <input type="hidden" name="amount_paid_now" id="df_amount_paid_now">
        <input type="hidden" name="extra_charges" id="df_extra_charges">
        <input type="hidden" name="extra_charges_note" id="df_extra_charges_note">
        <input type="hidden" name="wash_assigned_to" id="df_wash_assigned_to">
        <input type="hidden" name="iron_assigned_to" id="df_iron_assigned_to">
    </form>

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
                        <input type="hidden" id="field_customer_id" value="{{ auth()->user()->id }}">
                        <input type="hidden" id="field_customer_email" value="{{ auth()->user()->email }}">
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
                            <select id="customerSelect" class="p-input">
                                <option value="">-- Select Customer --</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}" data-phone="{{ $customer->phone }}"
                                        data-email="{{ $customer->email }}">
                                        {{ $customer->name }}
                                    </option>
                                @endforeach
                            </select>
                            <input type="hidden" id="field_customer_id">
                            <input type="hidden" id="field_customer_email">
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
                        <textarea id="field_pickup_address" class="p-input" rows="2" placeholder="Enter pickup address"></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="p-label">Delivery Address</label>
                        <textarea id="field_delivery_address" class="p-input" rows="2" placeholder="Enter delivery address"></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="p-label">Pickup Date</label>
                        <input type="date" id="field_pickup_date" class="p-input">
                    </div>
                    <div class="col-md-6">
                        <label class="p-label">Delivery Date</label>
                        <input type="date" id="field_delivery_date" class="p-input">
                    </div>
                </div>
            </div>

            <!-- Laundry Items -->
            <div class="p-card mb-4">
                <div class="p-card-header">
                    <div class="p-card-icon"><i class="fa fa-shirt"></i></div>
                    <div class="flex-grow-1">
                        <div class="p-card-title">Laundry Items</div>
                        <div class="p-card-sub">Add items and configure care details per item</div>
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
                                <th>Details</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="itemsTableBody">
                            @if ($items->isNotEmpty())
                                @php $firstItem = $items->first(); @endphp
                                <tr data-row-id="0">
                                    <td>
                                        <select class="p-input item-name">
                                            @foreach ($items as $item)
                                                <option value="{{ $item->id }}"
                                                    data-washing="{{ $item->washing_price }}"
                                                    data-ironing="{{ $item->ironing_price }}"
                                                    data-wash_and_iron="{{ $item->wash_and_iron_price }}"
                                                    data-due_days="{{ $item->due_days ?? 1 }}">
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="p-input item-service">
                                            <option value="washing">Washing</option>
                                            <option value="ironing">Ironing</option>
                                            <option value="wash_and_iron">Wash & Iron</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="hidden" class="item-price"
                                            value="{{ $firstItem->washing_price }}">
                                        <input class="p-input price-display" disabled style="width:90px;">
                                    </td>
                                    <td><input type="number" class="p-input item-qty" value="1" min="1"
                                            style="width:70px;"></td>
                                    <td class="fw-600 item-subtotal">₦0</td>
                                    <td>
                                        <button type="button" class="n-btn n-btn-secondary details-btn"
                                            data-row="0" style="font-size:.72rem; padding:.3rem .6rem;">
                                            <i class="fa fa-sliders me-1"></i>Details
                                        </button>
                                        {{-- hidden badge shown when details filled --}}
                                        <span class="details-badge" id="badge-0" style="display:none;">✓</span>
                                    </td>
                                    <td>
                                        <button type="button" class="n-icon-btn remove-item">
                                            <i class="fa fa-trash text-danger"></i>
                                        </button>
                                    </td>
                                </tr>
                            @else
                                <tr id="noItemsRow">
                                    <td colspan="7" class="text-center py-4">
                                        <div class="no-items-state">
                                            <i class="fa fa-shirt mb-2" style="font-size:1.8rem; color:#d1d5db;"></i>
                                            <p class="mb-1 fw-600" style="color:#6b7280; font-size:.85rem;">No items
                                                available yet</p>
                                            <p class="mb-0" style="color:#9ca3af; font-size:.75rem;">
                                                Add items in the
                                                <a href="{{ route('items') }}" hx-get="{{ route('items') }}"
                                                    hx-target="#content-area" hx-push-url="true"
                                                    style="color:#4f46e5; font-weight:600;">Items page</a>
                                                before booking.
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Assignment — hidden from customers -->
            @if (auth()->user()->role !== 'customer')
                <div class="p-card mb-4">
                    <div class="p-card-header">
                        <div class="p-card-icon"><i class="fa fa-users"></i></div>
                        <div>
                            <div class="p-card-title">Staff Assignment</div>
                            <div class="p-card-sub">Who will handle this order?</div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="p-label"><i class="fa fa-droplet me-1" style="color:#3b82f6;"></i> Assigned
                                for Washing</label>
                            <input type="text" id="field_wash_assigned_to" class="p-input"
                                placeholder="Enter name of washer">
                        </div>
                        <div class="col-md-6">
                            <label class="p-label"><i class="fa fa-fire me-1" style="color:#f59e0b;"></i> Assigned
                                for Ironing</label>
                            <input type="text" id="field_iron_assigned_to" class="p-input"
                                placeholder="Enter name of ironer">
                        </div>
                    </div>
                </div>
            @else
                {{-- Keep hidden inputs so JS submit doesn't break --}}
                <input type="hidden" id="field_wash_assigned_to">
                <input type="hidden" id="field_iron_assigned_to">
            @endif

            <!-- Payment -->
            <div class="p-card mb-4">
                <div class="p-card-header">
                    <div class="p-card-icon"><i class="fa fa-credit-card"></i></div>
                    <div>
                        <div class="p-card-title">Payment</div>
                        <div class="p-card-sub">How will this order be paid?</div>
                    </div>
                </div>
                <div class="row g-3">

                    <!-- Method -->
                    <div class="col-12">
                        <label class="p-label">Payment Method</label>
                        <div class="pay-options">
                            <label class="pay-option active" data-method="cash">
                                <i class="fa fa-money-bill-wave"></i><span>Cash</span>
                            </label>
                            <label class="pay-option" data-method="bank">
                                <i class="fa fa-building-columns"></i><span>Bank Transfer</span>
                            </label>
                            <label class="pay-option" data-method="paystack">
                                <i class="fa fa-globe"></i><span>Paystack</span>
                            </label>
                        </div>
                    </div>

                    <!-- Timing -->
                    <div class="col-12" id="timingRow">
                        <label class="p-label">When will payment be made?</label>
                        <div class="pay-options">
                            <label class="pay-option active" data-timing="now">
                                <i class="fa fa-bolt"></i><span>Pay Now</span>
                            </label>
                            <label class="pay-option" data-timing="on_delivery">
                                <i class="fa fa-truck"></i><span>On Delivery</span>
                            </label>
                            <label class="pay-option" data-timing="on_collection">
                                <i class="fa fa-store"></i><span>At Store</span>
                            </label>
                        </div>
                    </div>

                    <!-- Partial amount -->
                    <div class="col-12" id="partialRow">
                        <label class="p-label">Amount Paying Now</label>
                        <div class="partial-input-wrap">
                            <span class="partial-prefix">₦</span>
                            <input type="number" id="amountPaidNow" class="p-input" min="0" value=""
                                placeholder="0">
                        </div>
                        <div class="partial-hint">
                            Leave 0 to pay the <strong>full amount</strong>. Enter a partial amount to pay less now.
                            Leave 0 for <strong>On Delivery / At Store</strong> timings.
                        </div>
                        <div class="partial-hint paystack-note" id="paystackNote" style="display:none;">
                            <i class="fa fa-circle-info me-1"></i>
                            For Paystack, leave 0 to charge the full amount online, or enter a partial amount.
                        </div>
                    </div>

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
                    <div class="summary-row"><span>Items</span><span id="totalItems">0</span></div>
                    <div class="summary-row"><span>Subtotal</span><span id="subtotal">₦0</span></div>
                    <div class="summary-row"><span>Service Fee</span><span>₦200</span></div>
                    <div class="summary-row" id="extraChargesRow" style="display:none;">
                        <span>Extra Charges</span>
                        <span id="summaryExtra" style="color:#f59e0b; font-weight:600;">₦0</span>
                    </div>
                </div>

                <div class="summary-divider"></div>

                <div class="summary-total">
                    <span>Total</span><span id="total">₦0</span>
                </div>

                <!-- Payment preview -->
                <div class="pay-preview mt-3">
                    <div class="pay-preview-row"><span>Method</span><span id="previewMethod">Cash</span></div>
                    <div class="pay-preview-row"><span>Timing</span><span id="previewTiming">Pay Now</span></div>
                    <div class="pay-preview-row" id="previewPaidRow">
                        <span>Paying Now</span><span id="previewPaid">₦0 (full)</span>
                    </div>
                    <div class="pay-preview-row" id="previewBalanceRow" style="display:none;">
                        <span>Balance Due</span><span id="previewBalance" class="text-warning fw-bold">₦0</span>
                    </div>
                </div>

                <button type="button" id="submitOrderBtn" class="n-btn n-btn-primary w-100 mt-4"
                    style="justify-content:center;padding:.65rem;">
                    <i class="fa fa-check-circle me-1"></i>
                    <span id="submitLabel">Create Order</span>
                </button>
            </div>
        </div>

    </div>
</div>

{{-- ═══ Item Details Modal ═══ --}}
<div class="modal fade" id="itemDetailsModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" style="max-width:580px;">
        <div class="modal-content od-modal">

            <div class="od-modal-header">
                <div>
                    <div class="od-order-num"><i class="fa fa-sliders me-2"></i>Item Care Details</div>
                    <div class="od-order-sub" id="detailsModalSubtitle">Configure care preferences for this item</div>
                </div>
                <button class="od-close" data-bs-dismiss="modal"><i class="fa fa-xmark"></i></button>
            </div>

            <div class="od-modal-body">

                <input type="hidden" id="detailsRowId">

                <div class="row g-3">

                    {{-- Cloth Description --}}
                    <div class="col-12">
                        <label class="p-label"><i class="fa fa-tag me-1"></i> Cloth Description</label>
                        <input type="text" id="det_description" class="p-input"
                            placeholder="e.g. Blue cotton shirt, faded at collar">
                    </div>

                    {{-- Staff Observations — hidden from customers --}}
                    @if (auth()->user()->role !== 'customer')
                        <div class="col-12">
                            <label class="p-label"><i class="fa fa-eye me-1"></i> Staff Observations</label>
                            <textarea id="det_observations" class="p-input" rows="2"
                                placeholder="e.g. Stain on left sleeve, missing button, torn hem..."></textarea>
                        </div>
                    @else
                        {{-- Keep hidden input so JS doesn't break when reading/saving --}}
                        <textarea id="det_observations" style="display:none;"></textarea>
                    @endif

                    {{-- Customer Requirements --}}
                    <div class="col-12">
                        <label class="p-label"><i class="fa fa-comment-dots me-1"></i> Customer Requirements</label>
                        <textarea id="det_requirements" class="p-input" rows="2"
                            placeholder="e.g. No bleach, handle with care, separate from other colours..."></textarea>
                    </div>

                    {{-- Starch Level --}}
                    <div class="col-md-4">
                        <label class="p-label"><i class="fa fa-snowflake me-1"></i> Starch Level</label>
                        <div class="detail-options" id="det_starch_opts">
                            <button type="button" class="detail-opt active" data-val="none"
                                data-charge="0">None</button>
                            <button type="button" class="detail-opt" data-val="low" data-charge="0">Low</button>
                            <button type="button" class="detail-opt" data-val="medium"
                                data-charge="0">Medium</button>
                            <button type="button" class="detail-opt" data-val="high" data-charge="0">High</button>
                        </div>
                    </div>

                    {{-- Heat Level --}}
                    <div class="col-md-4">
                        <label class="p-label"><i class="fa fa-fire me-1"></i> Iron Heat</label>
                        <div class="detail-options" id="det_heat_opts">
                            <button type="button" class="detail-opt active" data-val="low"
                                data-charge="0">Low</button>
                            <button type="button" class="detail-opt" data-val="medium"
                                data-charge="0">Medium</button>
                            <button type="button" class="detail-opt" data-val="high" data-charge="0">High</button>
                        </div>
                    </div>

                    {{-- Finish --}}
                    <div class="col-md-4">
                        <label class="p-label"><i class="fa fa-layer-group me-1"></i> Finish</label>
                        <div class="detail-options" id="det_finish_opts">
                            <button type="button" class="detail-opt active" data-val="folded" data-charge="0">
                                <i class="fa fa-layer-group me-1"></i>Folded
                            </button>
                            <button type="button" class="detail-opt" data-val="hanged" data-charge="0">
                                <i class="fa fa-shirt me-1"></i>Hanged
                            </button>
                        </div>
                    </div>

                    {{-- Extra Charge Summary — hidden from customers --}}
                    @if (auth()->user()->role !== 'customer')
                        <div class="col-12">
                            <div class="det-charge-box">
                                <div class="det-charge-breakdown" id="det_charge_breakdown">
                                    <span class="det-charge-line zero" id="det_starch_line">Starch: None</span>
                                    <span class="det-charge-sep">·</span>
                                    <span class="det-charge-line zero" id="det_heat_line">Heat: Low</span>
                                    <span class="det-charge-sep">·</span>
                                    <span class="det-charge-line zero" id="det_finish_line">Finish: Folded</span>
                                </div>
                                <div class="det-charge-total-row">
                                    <label class="p-label mb-0">Extra Charge for this item</label>
                                    <div class="partial-input-wrap" style="max-width:180px;">
                                        <span class="partial-prefix">₦</span>
                                        <input type="number" id="det_extra_charge" class="p-input" min=""
                                            placeholder="0" oninput="onExtraChargeManualEdit()">
                                    </div>
                                </div>
                                <div style="font-size:.72rem; color:#9ca3af; margin-top:4px;">
                                    Enter the extra charge for this item manually (e.g. special handling, starch
                                    treatment, folding etc.)
                                </div>
                            </div>
                        </div>
                    @else
                        {{-- Keep hidden input so JS charge calculation doesn't break --}}
                        <input type="number" id="det_extra_charge" value="0" style="display:none;">
                    @endif

                </div>

            </div>

            <div class="od-modal-footer">
                <button class="n-btn n-btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button class="n-btn n-btn-primary" id="saveDetailsBtn">
                    <i class="fa fa-check me-1"></i> Save Details
                </button>
            </div>

        </div>
    </div>
</div>

<style>
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

    /* Detail option pills */
    .detail-options {
        display: flex;
        gap: .4rem;
        flex-wrap: wrap;
    }

    .detail-opt {
        padding: .35rem .75rem;
        border-radius: 8px;
        border: 1.5px solid #e5e7eb;
        background: #fafafa;
        font-size: .78rem;
        font-weight: 500;
        color: #6b7280;
        cursor: pointer;
        transition: all .15s;
    }

    .detail-opt:hover {
        border-color: #a5b4fc;
        color: #4f46e5;
    }

    .detail-opt.active {
        border-color: #4f46e5;
        background: #eef2ff;
        color: #4f46e5;
        font-weight: 700;
    }

    /* Details badge */
    .details-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 18px;
        height: 18px;
        border-radius: 50%;
        background: #10b981;
        color: #fff;
        font-size: .65rem;
        font-weight: 700;
        margin-left: .3rem;
        vertical-align: middle;
    }

    /* Extra charge badge in table row */
    .item-extra-badge {
        display: inline-block;
        font-size: .68rem;
        font-weight: 700;
        background: #fff7ed;
        color: #c2410c;
        border: 1px solid #fed7aa;
        border-radius: 5px;
        padding: .15em .5em;
        margin-left: .3rem;
        vertical-align: middle;
    }

    /* Charge breakdown box inside modal */
    .det-charge-box {
        background: #f8f7ff;
        border: 1px solid #e0e7ff;
        border-radius: 10px;
        padding: .85rem 1rem;
    }

    .det-charge-breakdown {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: .35rem;
        margin-bottom: .65rem;
        font-size: .75rem;
    }

    .det-charge-line {
        background: #eef2ff;
        color: #4f46e5;
        font-weight: 600;
        padding: .2em .55em;
        border-radius: 5px;
    }

    .det-charge-line.zero {
        background: #f3f4f6;
        color: #9ca3af;
    }

    .det-charge-sep {
        color: #9ca3af;
        font-size: .7rem;
    }

    .det-charge-total-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: .5rem;
    }

    /* Payment pills */
    .pay-options {
        display: flex;
        gap: .5rem;
        flex-wrap: wrap;
    }

    .pay-option {
        display: flex;
        align-items: center;
        gap: .5rem;
        padding: .5rem .9rem;
        border-radius: 9px;
        border: 1.5px solid #e5e7eb;
        background: #fafafa;
        font-size: .82rem;
        font-weight: 500;
        color: #6b7280;
        cursor: pointer;
        transition: all .15s;
        user-select: none;
    }

    .pay-option:hover {
        border-color: #a5b4fc;
        color: #4f46e5;
    }

    .pay-option.active {
        border-color: #4f46e5;
        background: #eef2ff;
        color: #4f46e5;
        font-weight: 600;
    }

    .pay-option i {
        font-size: .8rem;
    }

    .partial-input-wrap {
        display: flex;
        align-items: center;
        gap: .5rem;
    }

    .partial-prefix {
        font-size: .9rem;
        font-weight: 600;
        color: #6b7280;
    }

    .partial-hint {
        font-size: .75rem;
        color: #9ca3af;
        margin-top: .4rem;
    }

    .paystack-note {
        background: #fffbeb;
        border: 1px solid #fde68a;
        border-radius: 8px;
        padding: .5rem .75rem;
        color: #92400e !important;
        margin-top: .5rem;
    }

    .pay-preview {
        background: #f8f7ff;
        border-radius: 10px;
        padding: .75rem 1rem;
    }

    .pay-preview-row {
        display: flex;
        justify-content: space-between;
        font-size: .8rem;
        color: #6b7280;
        padding: .2rem 0;
    }

    .pay-preview-row span:last-child {
        font-weight: 600;
        color: #4f46e5;
    }

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

    .no-items-state {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: .5rem 0;
    }

    /* Modal styles (reuse od-modal pattern) */
    .od-modal {
        border-radius: 16px;
        border: 1px solid #f0f0f8;
        overflow: hidden;
    }

    .od-modal-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        padding: 1.2rem 1.4rem;
        border-bottom: 1px solid #f5f5fb;
    }

    .od-order-num {
        font-size: 1rem;
        font-weight: 700;
        color: #111827;
    }

    .od-order-sub {
        font-size: .75rem;
        color: #9ca3af;
        margin-top: 2px;
    }

    .od-close {
        width: 30px;
        height: 30px;
        border-radius: 8px;
        border: none;
        background: #f3f4f6;
        color: #6b7280;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background .15s;
    }

    .od-close:hover {
        background: #e9eaec;
    }

    .od-modal-body {
        padding: 1.2rem 1.4rem;
    }

    .od-modal-footer {
        display: flex;
        justify-content: flex-end;
        gap: .6rem;
        padding: 1rem 1.4rem;
        border-top: 1px solid #f5f5fb;
        flex-wrap: wrap;
    }
</style>

<script>
    const ITEMS = @json($items);
    let bookLaundryItemIndex = 0;

    // ── Per-row details store: { rowId: { description, observations, starch, heat, finish, requirements } }
    const itemDetails = {};

    // ── Row price & totals ───────────────────────────────────────────────────────

    function updateRowPrice(row) {
        const opt = row.querySelector('.item-name')?.selectedOptions[0];
        const svc = row.querySelector('.item-service')?.value;
        const qty = parseInt(row.querySelector('.item-qty')?.value) || 0;
        const price = parseInt(opt?.dataset[svc]) || 0;
        const ph = row.querySelector('.item-price');
        const pd = row.querySelector('.price-display');
        const sub = row.querySelector('.item-subtotal');
        if (ph) ph.value = price;
        if (pd) pd.value = '₦' + price.toLocaleString();
        if (sub) sub.textContent = '₦' + (price * qty).toLocaleString();
        updateTotals();
        autoCalculateDeliveryDate();
    }

    // Auto-calculate delivery date based on highest due_days among all selected items
    function autoCalculateDeliveryDate() {
        const pickupInput = document.getElementById('field_pickup_date');
        const deliveryInput = document.getElementById('field_delivery_date');
        if (!pickupInput?.value || !deliveryInput) return;

        let maxDueDays = 0;
        document.getElementById('itemsTableBody')?.querySelectorAll('tr').forEach(row => {
            const opt = row.querySelector('.item-name')?.selectedOptions[0];
            const dueDays = parseInt(opt?.dataset.due_days || 0);
            if (dueDays > maxDueDays) maxDueDays = dueDays;
        });

        if (maxDueDays > 0) {
            const pickup = new Date(pickupInput.value);
            pickup.setDate(pickup.getDate() + maxDueDays);
            const yyyy = pickup.getFullYear();
            const mm = String(pickup.getMonth() + 1).padStart(2, '0');
            const dd = String(pickup.getDate()).padStart(2, '0');
            deliveryInput.value = `${yyyy}-${mm}-${dd}`;
        }
    }

    function getOrderTotal() {
        let subtotal = 0,
            totalItems = 0,
            extraTotal = 0;
        document.getElementById('itemsTableBody')?.querySelectorAll('tr').forEach(row => {
            const qty = parseInt(row.querySelector('.item-qty')?.value) || 0;
            const price = parseInt(row.querySelector('.item-price')?.value) || 0;
            totalItems += qty;
            subtotal += qty * price;
            // Sum per-item extras from itemDetails
            const rowId = row.dataset.rowId;
            extraTotal += parseInt(itemDetails[rowId]?.extraCharge || 0);
        });
        return {
            subtotal,
            totalItems,
            extra: extraTotal,
            total: subtotal + 200 + extraTotal
        };
    }

    function updateTotals() {
        const {
            subtotal,
            totalItems,
            extra,
            total
        } = getOrderTotal();
        const el = id => document.getElementById(id);
        if (el('totalItems')) el('totalItems').textContent = totalItems;
        if (el('subtotal')) el('subtotal').textContent = '₦' + subtotal.toLocaleString();
        if (el('total')) el('total').textContent = '₦' + total.toLocaleString();

        // Extra charges row in summary
        if (el('extraChargesRow')) el('extraChargesRow').style.display = extra > 0 ? '' : 'none';
        if (el('summaryExtra')) el('summaryExtra').textContent = '₦' + extra.toLocaleString();

        updateSummaryPreview();
    }

    // ── Add item row ─────────────────────────────────────────────────────────────

    function addItemRow() {
        const tbody = document.getElementById('itemsTableBody');
        if (!tbody) return;
        const i = ++bookLaundryItemIndex;
        const opts = ITEMS.map(it =>
            `<option value="${it.id}" data-washing="${it.washing_price}" data-ironing="${it.ironing_price}" data-wash_and_iron="${it.wash_and_iron_price}" data-due_days="${it.due_days || 1}">${it.name}</option>`
        ).join('');
        const row = document.createElement('tr');
        row.dataset.rowId = i;
        row.innerHTML =
            `
            <td><select class="p-input item-name">${opts}</select></td>
            <td><select class="p-input item-service">
                <option value="washing">Washing</option>
                <option value="ironing">Ironing</option>
                <option value="wash_and_iron">Wash &amp; Iron</option>
            </select></td>
            <td><input type="hidden" class="item-price"><input class="p-input price-display" disabled style="width:90px;"></td>
            <td><input type="number" class="p-input item-qty" value="1" min="1" style="width:70px;"></td>
            <td class="fw-600 item-subtotal">₦0</td>
            <td>
                <button type="button" class="n-btn n-btn-secondary details-btn" data-row="${i}" style="font-size:.72rem;padding:.3rem .6rem;">
                    <i class="fa fa-sliders me-1"></i>Details
                </button>
                <span class="details-badge" id="badge-${i}" style="display:none;">✓</span>
            </td>
            <td><button type="button" class="n-icon-btn remove-item"><i class="fa fa-trash text-danger"></i></button></td>`;
        tbody.appendChild(row);
        updateRowPrice(row);
    }

    // ── Item Details Modal ───────────────────────────────────────────────────────

    function getActiveVal(groupId) {
        return document.querySelector(`#${groupId} .detail-opt.active`)?.dataset.val || '';
    }

    function setActiveVal(groupId, val) {
        document.querySelectorAll(`#${groupId} .detail-opt`).forEach(b => {
            b.classList.toggle('active', b.dataset.val === val);
        });
    }

    function openDetailsModal(rowId) {
        document.getElementById('detailsRowId').value = rowId;
        const itemName = document.querySelector(`tr[data-row-id="${rowId}"] .item-name`)?.selectedOptions[0]?.text ||
            'Item';
        document.getElementById('detailsModalSubtitle').textContent = `Care preferences for: ${itemName}`;

        // Load saved values or defaults
        const saved = itemDetails[rowId] || {};
        document.getElementById('det_description').value = saved.description || '';
        document.getElementById('det_observations').value = saved.observations || '';
        document.getElementById('det_requirements').value = saved.requirements || '';
        setActiveVal('det_starch_opts', saved.starch || 'medium');
        setActiveVal('det_heat_opts', saved.heat || 'medium');
        setActiveVal('det_finish_opts', saved.finish || 'folded');

        // Set the extra charge — saved override or recalc from presets
        const presetTotal = calcPresetCharge();
        document.getElementById('det_extra_charge').value = saved.extraCharge !== undefined ?
            saved.extraCharge : presetTotal;

        updateChargeBreakdown();

        const modal = bootstrap.Modal.getInstance(document.getElementById('itemDetailsModal')) ||
            new bootstrap.Modal(document.getElementById('itemDetailsModal'));
        modal.show();
    }

    // ── Preset charge helpers ────────────────────────────────────────────────────

    function getActiveCharge(groupId) {
        const btn = document.querySelector(`#${groupId} .detail-opt.active`);
        return parseInt(btn?.dataset.charge || 0);
    }

    function calcPresetCharge() {
        return getActiveCharge('det_starch_opts') +
            getActiveCharge('det_heat_opts') +
            getActiveCharge('det_finish_opts');
    }

    function updateChargeBreakdown() {
        const starchBtn = document.querySelector('#det_starch_opts .detail-opt.active');
        const heatBtn = document.querySelector('#det_heat_opts .detail-opt.active');
        const finishBtn = document.querySelector('#det_finish_opts .detail-opt.active');

        const starchLabel = starchBtn?.dataset.val || '';
        const heatLabel = heatBtn?.dataset.val || '';
        const finishLabel = finishBtn?.dataset.val || '';

        const sl = document.getElementById('det_starch_line');
        const hl = document.getElementById('det_heat_line');
        const fl = document.getElementById('det_finish_line');

        if (sl) {
            sl.textContent = `Starch: ${starchLabel}`;
            sl.className = 'det-charge-line zero';
        }
        if (hl) {
            hl.textContent = `Heat: ${heatLabel}`;
            hl.className = 'det-charge-line zero';
        }
        if (fl) {
            fl.textContent = `Finish: ${finishLabel}`;
            fl.className = 'det-charge-line zero';
        }
        // No auto-update of charge input — staff enters manually
    }

    function onExtraChargeManualEdit() {
        // Mark as manually overridden so auto-calc stops updating it
        const chargeInput = document.getElementById('det_extra_charge');
        if (chargeInput) chargeInput.dataset.manualOverride = '1';
    }

    function saveDetails() {
        const rowId = document.getElementById('detailsRowId').value;
        const extraCharge = parseInt(document.getElementById('det_extra_charge')?.value) || 0;

        itemDetails[rowId] = {
            description: document.getElementById('det_description').value.trim(),
            observations: document.getElementById('det_observations').value.trim(),
            requirements: document.getElementById('det_requirements').value.trim(),
            starch: getActiveVal('det_starch_opts'),
            heat: getActiveVal('det_heat_opts'),
            finish: getActiveVal('det_finish_opts'),
            extraCharge,
        };

        // Show/update badge on the row button
        const badge = document.getElementById(`badge-${rowId}`);
        if (badge) badge.style.display = 'inline-flex';

        // Show extra charge badge in the table row if > 0
        const row = document.querySelector(`tr[data-row-id="${rowId}"]`);
        if (row) {
            let existingBadge = row.querySelector('.item-extra-badge');
            if (extraCharge > 0) {
                if (!existingBadge) {
                    existingBadge = document.createElement('span');
                    existingBadge.className = 'item-extra-badge';
                    const subtotalCell = row.querySelector('.item-subtotal');
                    if (subtotalCell) subtotalCell.appendChild(existingBadge);
                }
                existingBadge.textContent = `+₦${extraCharge.toLocaleString()}`;
            } else if (existingBadge) {
                existingBadge.remove();
            }
        }

        // Reset manual override flag for next time
        const chargeInput = document.getElementById('det_extra_charge');
        if (chargeInput) delete chargeInput.dataset.manualOverride;

        // Recalculate order totals (extra charges affect total)
        updateTotals();

        bootstrap.Modal.getInstance(document.getElementById('itemDetailsModal'))?.hide();
    }

    // ── Payment UI ───────────────────────────────────────────────────────────────

    const methodLabels = {
        cash: 'Cash',
        bank: 'Bank Transfer',
        paystack: 'Paystack'
    };
    const timingLabels = {
        now: 'Pay Now',
        on_delivery: 'On Delivery',
        on_collection: 'At Store'
    };

    function getMethod() {
        return document.querySelector('.pay-option[data-method].active')?.dataset.method || 'cash';
    }

    function getTiming() {
        return document.querySelector('.pay-option[data-timing].active')?.dataset.timing || 'now';
    }

    function updatePaymentUI() {
        const method = getMethod();
        const timing = getTiming();

        const timingRow = document.getElementById('timingRow');
        if (timingRow) timingRow.style.display = method === 'paystack' ? 'none' : '';

        const psNote = document.getElementById('paystackNote');
        if (psNote) psNote.style.display = method === 'paystack' ? '' : 'none';

        const partialRow = document.getElementById('partialRow');
        if (partialRow) partialRow.style.display = (timing === 'now' || method === 'paystack') ? '' : 'none';

        const labelEl = document.getElementById('submitLabel');
        if (labelEl) {
            if (method === 'paystack') labelEl.textContent = 'Pay via Paystack';
            else if (timing === 'now') labelEl.textContent = 'Create Order & Record Payment';
            else labelEl.textContent = 'Create Order';
        }

        updateSummaryPreview();
    }

    function updateSummaryPreview() {
        const method = getMethod();
        const timing = getTiming();
        const {
            total
        } = getOrderTotal();
        const amountNow = parseInt(document.getElementById('amountPaidNow')?.value) || 0;
        const effectiveAmount = amountNow > 0 ? amountNow :
            (timing === 'now' || method === 'paystack') ? total : 0;
        const balance = Math.max(0, total - effectiveAmount);

        const el = id => document.getElementById(id);
        if (el('previewMethod')) el('previewMethod').textContent = methodLabels[method] || method;
        if (el('previewTiming')) el('previewTiming').textContent = method === 'paystack' ?
            'Pay Now (Online)' : (timingLabels[timing] || timing);
        if (el('previewPaid')) el('previewPaid').textContent = effectiveAmount > 0 ?
            '₦' + effectiveAmount.toLocaleString() : '₦0 (full later)';

        if (balance > 0 && effectiveAmount > 0 && effectiveAmount < total) {
            if (el('previewBalanceRow')) el('previewBalanceRow').style.display = '';
            if (el('previewBalance')) el('previewBalance').textContent = '₦' + balance.toLocaleString();
        } else {
            if (el('previewBalanceRow')) el('previewBalanceRow').style.display = 'none';
        }
    }

    // ── Collect & validate ───────────────────────────────────────────────────────

    async function collectFields() {
        const customerId = document.getElementById('field_customer_id')?.value;
        const customerEmail = document.getElementById('field_customer_email')?.value;
        const pickupAddr = document.getElementById('field_pickup_address')?.value?.trim();
        const deliveryAddr = document.getElementById('field_delivery_address')?.value?.trim();
        const pickupDate = document.getElementById('field_pickup_date')?.value;
        const deliveryDate = document.getElementById('field_delivery_date')?.value;

        const warn = (msg) => Swal.fire({
            icon: 'warning',
            title: 'Required Field',
            text: msg,
            confirmButtonColor: '#4f46e5',
            confirmButtonText: 'Got it',
        });

        if (!customerId) {
            await warn('Please select a customer.');
            return null;
        }
        if (!pickupAddr) {
            await warn('Please enter a pickup address.');
            return null;
        }
        if (!deliveryAddr) {
            await warn('Please enter a delivery address.');
            return null;
        }
        if (!pickupDate) {
            await warn('Please select a pickup date.');
            return null;
        }
        if (!deliveryDate) {
            await warn('Please select a delivery date.');
            return null;
        }

        // Washer & ironer required for admin and staff
        @if (in_array(auth()->user()->role, ['admin', 'staff']))
            const washStaffVal = document.getElementById('field_wash_assigned_to')?.value?.trim();
            const ironStaffVal = document.getElementById('field_iron_assigned_to')?.value?.trim();
            if (!washStaffVal) {
                await warn('Please assign a washer for this order.');
                return null;
            }
            if (!ironStaffVal) {
                await warn('Please assign an ironer for this order.');
                return null;
            }
        @endif

        const items = [];
        const itemsWithoutDetails = [];

        document.getElementById('itemsTableBody')?.querySelectorAll('tr').forEach(row => {
            const itemId = row.querySelector('.item-name')?.value;
            if (!itemId) return;
            const rowId = row.dataset.rowId;
            const details = itemDetails[rowId] || {};

            if (!details.description && !details.observations && !details.requirements) {
                const itemName = row.querySelector('.item-name')?.selectedOptions[0]?.text || 'Item';
                itemsWithoutDetails.push(itemName);
            }

            items.push({
                item_id: itemId,
                service_type: row.querySelector('.item-service')?.value,
                price: row.querySelector('.item-price')?.value,
                quantity: row.querySelector('.item-qty')?.value,
                description: details.description || '',
                observations: details.observations || '',
                requirements: details.requirements || '',
                starch: details.starch || 'none',
                heat: details.heat || 'low',
                finish: details.finish || 'folded',
                extra_charge: details.extraCharge || 0,
            });
        });

        if (items.length === 0) {
            await warn('No items available. Please add items in the Items page before booking.');
            return null;
        }

        // Soft warning — confirm if any items have no care details
        if (itemsWithoutDetails.length > 0) {
            const names = itemsWithoutDetails.join(', ');
            const result = await Swal.fire({
                icon: 'question',
                title: 'Care Details Missing',
                html: `Care details not filled for: <strong>${names}</strong>.<br><br>Do you want to continue without filling them in?`,
                showCancelButton: true,
                confirmButtonColor: '#4f46e5',
                cancelButtonColor: '#e5e7eb',
                confirmButtonText: 'Yes, continue',
                cancelButtonText: 'Go back & fill details',
            });
            if (!result.isConfirmed) return null;
        }

        return {
            customerId,
            customerEmail,
            pickupAddr,
            deliveryAddr,
            pickupDate,
            deliveryDate,
            items
        };
    }

    // ── Submit ───────────────────────────────────────────────────────────────────

    async function handleSubmit() {
        const fields = await collectFields();
        if (!fields) return;

        document.getElementById('itemsTableBody')?.querySelectorAll('tr').forEach(row => updateRowPrice(row));

        const method = getMethod();
        const timing = method === 'paystack' ? 'now' : getTiming();
        const {
            total,
            extra
        } = getOrderTotal();
        const amountNow = parseInt(document.getElementById('amountPaidNow')?.value) || 0;
        const extraNote = `Per-item care charges (starch/heat/finish)`; // auto-generated note
        const washStaff = document.getElementById('field_wash_assigned_to')?.value || '';
        const ironStaff = document.getElementById('field_iron_assigned_to')?.value || '';

        const f = id => document.getElementById(id);

        if (method === 'paystack') {
            const chargeAmount = amountNow > 0 ? amountNow : total;
            f('ps_customer_id').value = fields.customerId;
            f('paystackEmail').value = fields.customerEmail;
            f('ps_pickup_address').value = fields.pickupAddr;
            f('ps_delivery_address').value = fields.deliveryAddr;
            f('ps_pickup_date').value = fields.pickupDate;
            f('ps_delivery_date').value = fields.deliveryDate;
            f('ps_items_json').value = JSON.stringify(fields.items);
            f('paystackAmount').value = chargeAmount * 100;
            f('ps_amount_paid_now').value = chargeAmount;
            f('ps_extra_charges').value = extra;
            f('ps_extra_charges_note').value = extraNote;
            f('ps_wash_assigned_to').value = washStaff;
            f('ps_iron_assigned_to').value = ironStaff;
            document.getElementById('paystackForm').submit();
        } else {
            const actualAmount = (timing === 'now' && amountNow === 0) ? total : amountNow;
            f('df_customer_id').value = fields.customerId;
            f('df_pickup_address').value = fields.pickupAddr;
            f('df_delivery_address').value = fields.deliveryAddr;
            f('df_pickup_date').value = fields.pickupDate;
            f('df_delivery_date').value = fields.deliveryDate;
            f('df_items_json').value = JSON.stringify(fields.items);
            f('df_payment_method').value = method;
            f('df_payment_timing').value = timing;
            f('df_amount_paid_now').value = actualAmount;
            f('df_extra_charges').value = extra;
            f('df_extra_charges_note').value = extraNote;
            f('df_wash_assigned_to').value = washStaff;
            f('df_iron_assigned_to').value = ironStaff;
            document.getElementById('directForm').submit();
        }
    }

    // ── Init ─────────────────────────────────────────────────────────────────────

    function initBookLaundry() {
        const tbody = document.getElementById('itemsTableBody');
        const addBtn = document.getElementById('addItemBtn');
        const submitBtn = document.getElementById('submitOrderBtn');
        const saveBtn = document.getElementById('saveDetailsBtn');
        if (!tbody || !addBtn) return;

        bookLaundryItemIndex = tbody.querySelectorAll('tr').length - 1;
        tbody.querySelectorAll('tr').forEach(row => updateRowPrice(row));

        if (ITEMS.length === 0) {
            addBtn.disabled = true;
            addBtn.title = 'Add items in the Items page first';
        }

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
            if (e.target.closest('.details-btn')) {
                const rowId = e.target.closest('.details-btn').dataset.row;
                openDetailsModal(rowId);
            }
        });

        addBtn.addEventListener('click', addItemRow);
        submitBtn?.addEventListener('click', handleSubmit);
        saveBtn?.addEventListener('click', saveDetails);

        // Detail option toggles inside the modal
        document.querySelectorAll('.detail-options').forEach(group => {
            group.addEventListener('click', e => {
                const btn = e.target.closest('.detail-opt');
                if (!btn) return;
                group.querySelectorAll('.detail-opt').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                // Reset manual override so preset auto-calc takes over again
                const chargeInput = document.getElementById('det_extra_charge');
                if (chargeInput) delete chargeInput.dataset.manualOverride;
                updateChargeBreakdown();
            });
        });

        document.querySelectorAll('.pay-option[data-method]').forEach(opt => {
            opt.addEventListener('click', () => {
                document.querySelectorAll('.pay-option[data-method]').forEach(o => o.classList.remove(
                    'active'));
                opt.classList.add('active');
                if (opt.dataset.method === 'paystack') {
                    document.querySelectorAll('.pay-option[data-timing]').forEach(o => o.classList
                        .remove('active'));
                    document.querySelector('.pay-option[data-timing="now"]')?.classList.add('active');
                }
                updatePaymentUI();
            });
        });

        document.querySelectorAll('.pay-option[data-timing]').forEach(opt => {
            opt.addEventListener('click', () => {
                document.querySelectorAll('.pay-option[data-timing]').forEach(o => o.classList.remove(
                    'active'));
                opt.classList.add('active');
                updatePaymentUI();
            });
        });

        document.getElementById('amountPaidNow')?.addEventListener('input', updateSummaryPreview);
        document.getElementById('field_pickup_date')?.addEventListener('change', autoCalculateDeliveryDate);
        updatePaymentUI();

        // Bootstrap modal backdrop cleanup
        document.addEventListener('hidden.bs.modal', () => {
            document.querySelectorAll('.modal-backdrop').forEach(b => b.remove());
            document.body.classList.remove('modal-open');
            document.body.style.removeProperty('overflow');
            document.body.style.removeProperty('padding-right');
        });
    }

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
            const el = id => document.getElementById(id);
            if (el('customerPhone')) el('customerPhone').value = opt?.dataset.phone || '';
            if (el('field_customer_id')) el('field_customer_id').value = opt?.value || '';
            if (el('field_customer_email')) el('field_customer_email').value = opt?.dataset.email || '';
        }
    });

    document.addEventListener('DOMContentLoaded', initBookLaundry);
    document.addEventListener('htmx:afterSettle', initBookLaundry);
</script>
