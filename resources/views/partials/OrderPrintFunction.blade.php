{{-- Hidden printable invoice templates (one per order) --}}
@foreach ($orders as $order)
    @php
        $balance = max(0, $order->total_amount - $order->amount_paid);
        $payStatus = $order->payment_status ?? 'pending';
        $invoiceNo = 'INV-' . str_pad($order->id, 4, '0', STR_PAD_LEFT);
        $subtotal = $order->items->sum(fn($i) => $i->price * $i->quantity);
        $createdByUser = $order->createdBy;
    @endphp
    <div id="invoice-print-{{ $order->id }}" style="display:none;">
        <div class="inv-doc">

            {{-- Header --}}
            <div class="inv-header">
                <div class="inv-brand">
                    <div class="inv-brand-icon">🧺</div>
                    <div>
                        <div class="inv-brand-name">LaundryPro</div>
                        <div class="inv-brand-tag">Professional Laundry Services</div>
                    </div>
                </div>
                <div class="inv-meta">
                    <div class="inv-number">{{ $invoiceNo }}</div>
                    <div class="inv-date">{{ $order->created_at->format('D, M d Y · h:i A') }}</div>
                    <span class="inv-status-badge inv-status-{{ $payStatus }}">{{ ucfirst($payStatus) }}</span>
                </div>
            </div>

            <div class="inv-divider"></div>

            {{-- Customer & Order Info --}}
            <div class="inv-info-row">
                <div class="inv-info-col">
                    <div class="inv-section-label">Bill To</div>
                    <div class="inv-info-name">{{ $order->customer?->name ?? '—' }}</div>
                    <div class="inv-info-detail">{{ $order->customer?->phone ?? '' }}</div>
                </div>
                <div class="inv-info-col">
                    <div class="inv-section-label">Pickup & Delivery</div>
                    <div class="inv-info-detail"><strong>From:</strong> {{ $order->pickup_address }}</div>
                    <div class="inv-info-detail"><strong>To:</strong> {{ $order->delivery_address }}</div>
                    <div class="inv-info-detail"><strong>Pickup:</strong> {{ $order->pickup_date }}</div>
                    <div class="inv-info-detail"><strong>Delivery:</strong> {{ $order->delivery_date }}</div>
                </div>
                <div class="inv-info-col">
                    <div class="inv-section-label">Order Info</div>
                    <div class="inv-info-detail"><strong>Order #:</strong> {{ $order->id }}</div>
                    <div class="inv-info-detail"><strong>Status:</strong> {{ ucfirst($order->status) }}</div>
                    <div class="inv-info-detail"><strong>Created By:</strong> {{ $createdByUser?->name ?? '—' }}
                        @if ($createdByUser)
                            ({{ ucfirst($createdByUser->role) }})
                        @endif
                    </div>
                </div>
            </div>

            <div class="inv-divider"></div>

            {{-- Items Table --}}
            <div class="inv-section-label mb-2">Items</div>
            <table class="inv-table">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Service</th>
                        <th>Unit Price</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->items as $item)
                        <tr>
                            <td>{{ $item->item_name }}</td>
                            <td>{{ ucwords(str_replace('_', ' ', $item->service_type)) }}</td>
                            <td>₦{{ number_format($item->price) }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>₦{{ number_format($item->price * $item->quantity) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Totals --}}
            <div class="inv-totals">
                <div class="inv-totals-row"><span>Subtotal</span><span>₦{{ number_format($subtotal) }}</span></div>
                <div class="inv-totals-row"><span>Service
                        Fee</span><span>₦{{ number_format($order->service_fee) }}</span></div>
                <div class="inv-totals-divider"></div>
                <div class="inv-totals-row grand">
                    <span>Total</span><span>₦{{ number_format($order->total_amount) }}</span>
                </div>
                <div class="inv-totals-row paid"><span>Amount
                        Paid</span><span>₦{{ number_format($order->amount_paid) }}</span></div>
                <div class="inv-totals-row {{ $balance > 0 ? 'balance-due' : 'balance-clear' }}">
                    <span>Balance Due</span><span>₦{{ number_format($balance) }}</span>
                </div>
            </div>

            <div class="inv-divider"></div>

            {{-- Footer --}}
            <div class="inv-footer">
                <p>Thank you for choosing LaundryPro. For inquiries, please reference
                    <strong>{{ $invoiceNo }}</strong>.
                </p>
                <p class="inv-footer-small">Printed on {{ now()->format('M d, Y · h:i A') }}</p>
            </div>

        </div>
    </div>
@endforeach

<script>
    let _printingInvoice = false;

    function printInvoice(orderId) {
        const content = document.getElementById('invoice-print-' + orderId);
        if (!content) return;

        const openModal = document.querySelector('.modal.show');

        if (openModal) {
            const bsModal = bootstrap.Modal.getInstance(openModal);
            if (bsModal) {
                _printingInvoice = true;
                openModal.addEventListener('hidden.bs.modal', function handler() {
                    openModal.removeEventListener('hidden.bs.modal', handler);
                    // Force cleanup only on print-triggered close
                    document.querySelectorAll('.modal-backdrop').forEach(b => b.remove());
                    document.body.classList.remove('modal-open');
                    document.body.style.removeProperty('overflow');
                    document.body.style.removeProperty('padding-right');
                    _printingInvoice = false;
                    openPrintWindow(content);
                });
                bsModal.hide();
                return;
            }
        }

        openPrintWindow(content);
    }

    function openPrintWindow(content) {
        const win = window.open('', '_blank', 'width=800,height=500');
        if (!win) {
            alert('Pop-up blocked. Please allow pop-ups for this site to print invoices.');
            return;
        }
        win.document.write(`
        <!DOCTYPE html>
        <html>
        <head>
            <title>Invoice</title>
            <meta charset="UTF-8">
            <style>
                * { margin: 0; padding: 0; box-sizing: border-box; }
                body { font-family: 'Segoe UI', Arial, sans-serif; font-size: 13px; color: #111827; background: #fff; padding: 40px; }
                .inv-doc { max-width: 740px; margin: 0 auto; }
                .inv-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 24px; }
                .inv-brand  { display: flex; align-items: center; gap: 12px; }
                .inv-brand-icon  { font-size: 2rem; }
                .inv-brand-name  { font-size: 1.4rem; font-weight: 700; color: #4f46e5; }
                .inv-brand-tag   { font-size: .75rem; color: #9ca3af; margin-top: 2px; }
                .inv-meta        { text-align: right; }
                .inv-number      { font-size: 1.1rem; font-weight: 700; color: #111827; font-family: monospace; }
                .inv-date        { font-size: .78rem; color: #6b7280; margin-top: 4px; }
                .inv-status-badge { display: inline-block; margin-top: 6px; font-size: .72rem; font-weight: 700; padding: .2em .7em; border-radius: 5px; }
                .inv-status-paid    { background: #ecfdf5; color: #065f46; }
                .inv-status-partial { background: #fff7ed; color: #c2410c; border: 1px solid #fed7aa; }
                .inv-status-pending { background: #fffbeb; color: #92400e; }
                .inv-divider { height: 1px; background: #e5e7eb; margin: 20px 0; }
                .inv-info-row { display: flex; gap: 24px; margin-bottom: 8px; }
                .inv-info-col { flex: 1; }
                .inv-section-label { font-size: .68rem; font-weight: 700; text-transform: uppercase; letter-spacing: .08em; color: #9ca3af; margin-bottom: 6px; }
                .inv-info-name   { font-size: .95rem; font-weight: 700; color: #111827; margin-bottom: 4px; }
                .inv-info-detail { font-size: .8rem; color: #6b7280; margin-bottom: 3px; }
                .mb-2 { margin-bottom: 8px; }
                .inv-table { width: 100%; border-collapse: collapse; margin-bottom: 16px; }
                .inv-table thead tr { background: #f5f5fb; }
                .inv-table th { font-size: .7rem; font-weight: 700; text-transform: uppercase; letter-spacing: .06em; color: #9ca3af; padding: 8px 10px; text-align: left; border-bottom: 2px solid #e5e7eb; }
                .inv-table td { padding: 9px 10px; font-size: .82rem; color: #374151; border-bottom: 1px solid #f0f0f8; }
                .inv-table tbody tr:last-child td { border-bottom: none; }
                .inv-totals { margin-left: auto; width: 280px; margin-top: 8px; }
                .inv-totals-row { display: flex; justify-content: space-between; padding: 5px 0; font-size: .83rem; color: #6b7280; }
                .inv-totals-row.grand { font-size: .95rem; font-weight: 700; color: #111827; padding: 8px 0; }
                .inv-totals-row.paid  { color: #059669; font-weight: 600; }
                .inv-totals-row.balance-due   { color: #dc2626; font-weight: 700; }
                .inv-totals-row.balance-clear { color: #059669; font-weight: 700; }
                .inv-totals-divider { height: 1px; background: #e5e7eb; margin: 6px 0; }
                .inv-footer { text-align: center; margin-top: 24px; }
                .inv-footer p { font-size: .8rem; color: #6b7280; margin-bottom: 4px; }
                .inv-footer-small { font-size: .72rem; color: #9ca3af; }
                @media print {
                    body { padding: 20px; }
                    @page { margin: 1cm; }
                }
            </style>
        </head>
        <body>
            ${content.innerHTML}
            <script>window.onload = function() { window.print(); }<\/script>
        </body>
        </html>
        `);
        win.document.close();
    }
</script>
