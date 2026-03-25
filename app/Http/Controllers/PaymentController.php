<?php

namespace App\Http\Controllers;

use App\Services\PaystackService;
use Illuminate\Http\Request;
use App\Models\LaundryItem;
use App\Models\LaundryOrder;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;



// class PaymentController extends Controller
// {
//     protected $paystack;

//     public function __construct(PaystackService $paystack)
//     {
//         $this->paystack = $paystack;
//     }

//     /**
//      * Initialize Paystack payment and store order data in session.
//      * Amount must be sent in kobo from the form.
//      */
//     public function redirectToGateway(Request $request)
//     {
//         $request->validate([
//             'customer_id'      => 'required|exists:users,id',
//             'pickup_address'   => 'required',
//             'delivery_address' => 'required',
//             'pickup_date'      => 'required|date',
//             'delivery_date'    => 'required|date|after_or_equal:pickup_date',
//             'items_json'       => 'required|string',
//             'email'            => 'required|email',
//             'amount'           => 'required|numeric|min:1', // in kobo
//         ]);

//         $items = json_decode($request->items_json, true);
//         if (!$items || count($items) === 0) {
//             return back()->with('error', 'No items found in order.');
//         }

//         // Store order data in session for use in callback
//         session(['order_data' => array_merge($request->all(), ['items' => $items])]);

//         $reference = uniqid('laundry_');

//         $response = $this->paystack->initializePayment([
//             'email'        => $request->email,
//             'amount'       => $request->amount, // already in kobo
//             'reference'    => $reference,
//             'callback_url' => route('payment.callback'),
//         ]);

//         if (!empty($response->data->authorization_url)) {
//             return redirect($response->data->authorization_url);
//         }

//         return back()->with('error', 'Unable to initialize payment.');
//     }

//     /**
//      * Handle Paystack callback after payment.
//      * Handles both new orders and balance completions.
//      */
//     public function handleGatewayCallback(Request $request)
//     {
//         $reference = $request->query('reference');
//         $result    = $this->paystack->verifyPayment($reference);

//         if (!$result->status || $result->data->status !== 'success') {
//             return redirect()->route('bookLaundry')->with('error', 'Payment verification failed.');
//         }

//         $orderData = session('order_data');

//         if (!$orderData) {
//             return redirect()->route('bookLaundry')->with('error', 'No order data found.');
//         }

//         if (Payment::where('reference', $reference)->exists()) {
//             return redirect()->route('bookLaundry')->with('error', 'This payment was already processed.');
//         }

//         // Amount Paystack actually charged (comes back in kobo → convert to naira)
//         $amountPaid = (int) ($result->data->amount / 100);
//         $method     = 'paystack';

//         // ── Case 1: Customer completing balance on existing order ──────────
//         if (!empty($orderData['completing_order_id'])) {

//             DB::transaction(function () use ($orderData, $reference, $amountPaid, $method) {
//                 $order   = LaundryOrder::findOrFail($orderData['completing_order_id']);
//                 $newPaid = min($order->amount_paid + $amountPaid, $order->total_amount);
//                 $status  = $newPaid >= $order->total_amount ? 'paid' : 'partial';

//                 $order->update([
//                     'amount_paid'        => $newPaid,
//                     'payment_status'     => $status,
//                     'paystack_reference' => $reference,
//                 ]);

//                 Payment::create([
//                     'laundry_order_id' => $order->id,
//                     'reference'        => $reference,
//                     'status'           => 'success',
//                     'amount'           => $amountPaid,
//                     'currency'         => 'NGN',
//                     'method'           => $method,
//                 ]);
//             });

//             session()->forget('order_data');
//             return redirect()->route('orderTrack')->with('success', 'Payment successful! Your balance has been updated.');
//         }

//         // ── Case 2: New order via Paystack ─────────────────────────────────
//         DB::transaction(function () use ($orderData, $reference, $amountPaid, $method) {

//             $serviceFee = 200;
//             $subtotal   = 0;
//             $totalItems = 0;

//             $order = LaundryOrder::create([
//                 'customer_id'        => $orderData['customer_id'],
//                 'pickup_address'     => $orderData['pickup_address'],
//                 'delivery_address'   => $orderData['delivery_address'],
//                 'pickup_date'        => $orderData['pickup_date'],
//                 'delivery_date'      => $orderData['delivery_date'],
//                 'total_items'        => 0,
//                 'subtotal'           => 0,
//                 'service_fee'        => $serviceFee,
//                 'total_amount'       => 0,
//                 'payment_method'     => 'paystack',
//                 'payment_timing'     => 'now',
//                 'payment_status'     => 'pending', // recalculated below
//                 'amount_paid'        => 0,
//                 'paystack_reference' => $reference,
//                 'created_by'         => auth()->id(),
//             ]);

//             foreach ($orderData['items'] as $itemRow) {
//                 $item  = LaundryItem::findOrFail($itemRow['item_id']);
//                 $price = match ($itemRow['service_type']) {
//                     'washing'       => $item->washing_price,
//                     'ironing'       => $item->ironing_price,
//                     'wash_and_iron' => $item->wash_and_iron_price,
//                 };
//                 $qty        = (int) ($itemRow['quantity'] ?? 1);
//                 $subtotal  += $price * $qty;
//                 $totalItems += $qty;

//                 $order->items()->create([
//                     'laundry_item_id' => $item->id,
//                     'item_name'       => $item->name,
//                     'service_type'    => $itemRow['service_type'],
//                     'price'           => $price,
//                     'quantity'        => $qty,
//                     'subtotal'        => $price * $qty,
//                 ]);
//             }

//             $totalAmount  = $subtotal + $serviceFee;
//             $amountPaid   = min($amountPaid, $totalAmount); // cap — can't overpay

//             if ($amountPaid >= $totalAmount)     $paymentStatus = 'paid';
//             elseif ($amountPaid > 0)             $paymentStatus = 'partial';
//             else                                 $paymentStatus = 'pending';

//             $order->update([
//                 'total_items'    => $totalItems,
//                 'subtotal'       => $subtotal,
//                 'total_amount'   => $totalAmount,
//                 'amount_paid'    => $amountPaid,
//                 'payment_status' => $paymentStatus,
//             ]);

//             Payment::create([
//                 'laundry_order_id' => $order->id,
//                 'reference'        => $reference,
//                 'status'           => 'success',
//                 'amount'           => $amountPaid,
//                 'currency'         => 'NGN',
//                 'method'           => $method,
//             ]);
//         });

//         session()->forget('order_data');
//         return redirect()->route('bookLaundry')->with('success', 'Payment successful and order created!');
//     }

//     /**
//      * Delete a payment record and recalculate the order's amount_paid and status.
//      * admin/superAdmin only.
//      */
//     public function destroy(Payment $payment)
//     {
//         DB::transaction(function () use ($payment) {
//             $order = $payment->order;

//             $payment->delete();

//             if ($order) {
//                 // Recalculate amount_paid from remaining successful payment records
//                 $newAmountPaid = $order->payments()->where('status', 'success')->sum('amount');

//                 if ($newAmountPaid >= $order->total_amount)  $status = 'paid';
//                 elseif ($newAmountPaid > 0)                  $status = 'partial';
//                 else                                         $status = 'pending';

//                 $order->update([
//                     'amount_paid'    => $newAmountPaid,
//                     'payment_status' => $status,
//                 ]);
//             }
//         });

//         return back()->with('success', 'Payment #' . $payment->id . ' deleted successfully.');
//     }
// }



// class PaymentController extends Controller
// {
//     protected $paystack;

//     public function __construct(PaystackService $paystack)
//     {
//         $this->paystack = $paystack;
//     }

//     /**
//      * Initialize Paystack payment and store order data in session.
//      */
//     public function redirectToGateway(Request $request)
//     {
//         $request->validate([
//             'customer_id'      => 'required|exists:users,id',
//             'pickup_address'   => 'required',
//             'delivery_address' => 'required',
//             'pickup_date'      => 'required|date',
//             'delivery_date'    => 'required|date|after_or_equal:pickup_date',
//             'items_json'       => 'required|string',
//             'email'            => 'required|email',
//             'amount'           => 'required|numeric|min:1', // in kobo
//         ]);

//         $items = json_decode($request->items_json, true);
//         if (!$items || count($items) === 0) {
//             return back()->with('error', 'No items found in order.');
//         }

//         session(['order_data' => array_merge($request->all(), ['items' => $items])]);

//         $reference = uniqid('laundry_');

//         $response = $this->paystack->initializePayment([
//             'email'        => $request->email,
//             'amount'       => $request->amount, // already in kobo
//             'reference'    => $reference,
//             'callback_url' => route('payment.callback'),
//         ]);

//         if (!empty($response->data->authorization_url)) {
//             return redirect($response->data->authorization_url);
//         }

//         return back()->with('error', 'Unable to initialize payment.');
//     }

//     /**
//      * Handle Paystack callback after payment.
//      * Handles both new orders and balance completions.
//      */
//     public function handleGatewayCallback(Request $request)
//     {
//         $reference = $request->query('reference');
//         $result    = $this->paystack->verifyPayment($reference);

//         if (!$result->status || $result->data->status !== 'success') {
//             return redirect()->route('bookLaundry')->with('error', 'Payment verification failed.');
//         }

//         $orderData = session('order_data');

//         if (!$orderData) {
//             return redirect()->route('bookLaundry')->with('error', 'No order data found.');
//         }

//         if (Payment::where('reference', $reference)->exists()) {
//             return redirect()->route('bookLaundry')->with('error', 'This payment was already processed.');
//         }

//         $amountPaid = (int) ($result->data->amount / 100);
//         $method     = 'paystack';

//         // ── Case 1: Customer completing balance on existing order ──────────
//         if (!empty($orderData['completing_order_id'])) {

//             DB::transaction(function () use ($orderData, $reference, $amountPaid, $method) {
//                 $order   = LaundryOrder::findOrFail($orderData['completing_order_id']);
//                 $newPaid = min($order->amount_paid + $amountPaid, $order->total_amount);
//                 $status  = $newPaid >= $order->total_amount ? 'paid' : 'partial';

//                 $order->update([
//                     'amount_paid'        => $newPaid,
//                     'payment_status'     => $status,
//                     'paystack_reference' => $reference,
//                 ]);

//                 Payment::create([
//                     'laundry_order_id' => $order->id,
//                     'reference'        => $reference,
//                     'status'           => 'success',
//                     'amount'           => $amountPaid,
//                     'currency'         => 'NGN',
//                     'method'           => $method,
//                 ]);
//             });

//             session()->forget('order_data');
//             return redirect()->route('orderTrack')->with('success', 'Payment successful! Your balance has been updated.');
//         }

//         // ── Case 2: New order via Paystack ─────────────────────────────────
//         DB::transaction(function () use ($orderData, $reference, $amountPaid, $method) {

//             $serviceFee   = 200;
//             $subtotal     = 0;
//             $totalItems   = 0;
//             $extraCharges = (int) ($orderData['extra_charges'] ?? 0);

//             $order = LaundryOrder::create([
//                 'customer_id'        => $orderData['customer_id'],
//                 'pickup_address'     => $orderData['pickup_address'],
//                 'delivery_address'   => $orderData['delivery_address'],
//                 'pickup_date'        => $orderData['pickup_date'],
//                 'delivery_date'      => $orderData['delivery_date'],
//                 'total_items'        => 0,
//                 'subtotal'           => 0,
//                 'service_fee'        => $serviceFee,
//                 'extra_charges'      => $extraCharges,
//                 'extra_charges_note' => $orderData['extra_charges_note'] ?? null,
//                 'total_amount'       => 0,
//                 'payment_method'     => 'paystack',
//                 'payment_timing'     => 'now',
//                 'payment_status'     => 'pending',
//                 'amount_paid'        => 0,
//                 'paystack_reference' => $reference,
//                 'wash_assigned_to'   => $orderData['wash_assigned_to'] ?? null,
//                 'iron_assigned_to'   => $orderData['iron_assigned_to'] ?? null,
//                 'created_by'         => auth()->id(),
//             ]);

//             foreach ($orderData['items'] as $itemRow) {
//                 $item  = LaundryItem::findOrFail($itemRow['item_id']);
//                 $price = match ($itemRow['service_type']) {
//                     'washing'       => $item->washing_price,
//                     'ironing'       => $item->ironing_price,
//                     'wash_and_iron' => $item->wash_and_iron_price,
//                     default         => 0,
//                 };
//                 $qty        = (int) ($itemRow['quantity'] ?? 1);
//                 $subtotal  += $price * $qty;
//                 $totalItems += $qty;

//                 $order->items()->create([
//                     'laundry_item_id' => $item->id,
//                     'item_name'       => $item->name,
//                     'service_type'    => $itemRow['service_type'],
//                     'price'           => $price,
//                     'quantity'        => $qty,
//                     'subtotal'        => $price * $qty,
//                     // care details
//                     'description'     => $itemRow['description']  ?? null,
//                     'observations'    => $itemRow['observations']  ?? null,
//                     'requirements'    => $itemRow['requirements']  ?? null,
//                     'starch_level'    => $itemRow['starch']        ?? 'medium',
//                     'heat_level'      => $itemRow['heat']          ?? 'medium',
//                     'finish'          => $itemRow['finish']        ?? 'folded',
//                     'extra_charge'    => (int) ($itemRow['extra_charge'] ?? 0),
//                 ]);
//             }

//             $totalAmount = $subtotal + $serviceFee + $extraCharges;
//             $amountPaid  = min($amountPaid, $totalAmount);

//             if ($amountPaid >= $totalAmount)     $paymentStatus = 'paid';
//             elseif ($amountPaid > 0)             $paymentStatus = 'partial';
//             else                                 $paymentStatus = 'pending';

//             $order->update([
//                 'total_items'    => $totalItems,
//                 'subtotal'       => $subtotal,
//                 'total_amount'   => $totalAmount,
//                 'amount_paid'    => $amountPaid,
//                 'payment_status' => $paymentStatus,
//             ]);

//             Payment::create([
//                 'laundry_order_id' => $order->id,
//                 'reference'        => $reference,
//                 'status'           => 'success',
//                 'amount'           => $amountPaid,
//                 'currency'         => 'NGN',
//                 'method'           => $method,
//             ]);
//         });

//         session()->forget('order_data');
//         return redirect()->route('bookLaundry')->with('success', 'Payment successful and order created!');
//     }

//     /**
//      * Delete a payment record and recalculate the order's amount_paid and status.
//      */
//     public function destroy(Payment $payment)
//     {
//         DB::transaction(function () use ($payment) {
//             $order = $payment->order;

//             $payment->delete();

//             if ($order) {
//                 $newAmountPaid = $order->payments()->where('status', 'success')->sum('amount');

//                 if ($newAmountPaid >= $order->total_amount)  $status = 'paid';
//                 elseif ($newAmountPaid > 0)                  $status = 'partial';
//                 else                                         $status = 'pending';

//                 $order->update([
//                     'amount_paid'    => $newAmountPaid,
//                     'payment_status' => $status,
//                 ]);
//             }
//         });

//         return back()->with('success', 'Payment #' . $payment->id . ' deleted successfully.');
//     }
// }



class PaymentController extends Controller
{
    protected $paystack;

    public function __construct(PaystackService $paystack)
    {
        $this->paystack = $paystack;
    }

    /**
     * Initialize Paystack payment and store order data in session.
     */
    public function redirectToGateway(Request $request)
    {
        $request->validate([
            'customer_id'      => 'required|exists:users,id',
            'pickup_address'   => 'required',
            'delivery_address' => 'required',
            'pickup_date'      => 'required|date',
            'delivery_date'    => 'required|date|after_or_equal:pickup_date',
            'items_json'       => 'required|string',
            'email'            => 'required|email',
            'amount'           => 'required|numeric|min:1', // in kobo
        ]);

        $items = json_decode($request->items_json, true);
        if (!$items || count($items) === 0) {
            return back()->with('error', 'No items found in order.');
        }

        session(['order_data' => array_merge($request->all(), ['items' => $items])]);

        $reference = uniqid('laundry_');

        $response = $this->paystack->initializePayment([
            'email'        => $request->email,
            'amount'       => $request->amount, // already in kobo
            'reference'    => $reference,
            'callback_url' => route('payment.callback'),
        ]);

        if (!empty($response->data->authorization_url)) {
            return redirect($response->data->authorization_url);
        }

        return back()->with('error', 'Unable to initialize payment.');
    }

    /**
     * Handle Paystack callback after payment.
     * Handles both new orders and balance completions.
     */
    public function handleGatewayCallback(Request $request)
    {
        $reference = $request->query('reference');
        $result    = $this->paystack->verifyPayment($reference);

        if (!$result->status || $result->data->status !== 'success') {
            return redirect()->route('bookLaundry')->with('error', 'Payment verification failed.');
        }

        $orderData = session('order_data');

        if (!$orderData) {
            return redirect()->route('bookLaundry')->with('error', 'No order data found.');
        }

        if (Payment::where('reference', $reference)->exists()) {
            return redirect()->route('bookLaundry')->with('error', 'This payment was already processed.');
        }

        $amountPaid = (int) ($result->data->amount / 100);
        $method     = 'paystack';

        // ── Case 1: Customer completing balance on existing order ──────────
        if (!empty($orderData['completing_order_id'])) {

            DB::transaction(function () use ($orderData, $reference, $amountPaid, $method) {
                $order   = LaundryOrder::findOrFail($orderData['completing_order_id']);
                $newPaid = min($order->amount_paid + $amountPaid, $order->total_amount);
                $status  = $newPaid >= $order->total_amount ? 'paid' : 'partial';

                $order->update([
                    'amount_paid'        => $newPaid,
                    'payment_status'     => $status,
                    'paystack_reference' => $reference,
                ]);

                Payment::create([
                    'laundry_order_id' => $order->id,
                    'reference'        => $reference,
                    'status'           => 'success',
                    'amount'           => $amountPaid,
                    'currency'         => 'NGN',
                    'method'           => $method,
                ]);
            });

            session()->forget('order_data');
            return redirect()->route('orderTrack')->with('success', 'Payment successful! Your balance has been updated.');
        }

        // ── Case 2: New order via Paystack ─────────────────────────────────
        DB::transaction(function () use ($orderData, $reference, $amountPaid, $method) {

            $serviceFee   = 200;
            $subtotal     = 0;
            $totalItems   = 0;
            $extraCharges = (int) ($orderData['extra_charges'] ?? 0);

            $order = LaundryOrder::create([
                'customer_id'        => $orderData['customer_id'],
                'pickup_address'     => $orderData['pickup_address'],
                'delivery_address'   => $orderData['delivery_address'],
                'pickup_date'        => $orderData['pickup_date'],
                'delivery_date'      => $orderData['delivery_date'],
                'total_items'        => 0,
                'subtotal'           => 0,
                'service_fee'        => $serviceFee,
                'extra_charges'      => $extraCharges,
                'extra_charges_note' => $orderData['extra_charges_note'] ?? null,
                'total_amount'       => 0,
                'payment_method'     => 'paystack',
                'payment_timing'     => 'now',
                'payment_status'     => 'pending',
                'amount_paid'        => 0,
                'paystack_reference' => $reference,
                'wash_assigned_to'   => $orderData['wash_assigned_to'] ?? null,
                'iron_assigned_to'   => $orderData['iron_assigned_to'] ?? null,
                'created_by'         => auth()->id(),
                'branch_id'          => auth()->user()->branch_id,
            ]);

            foreach ($orderData['items'] as $itemRow) {
                $item  = LaundryItem::findOrFail($itemRow['item_id']);
                $price = match ($itemRow['service_type']) {
                    'washing'       => $item->washing_price,
                    'ironing'       => $item->ironing_price,
                    'wash_and_iron' => $item->wash_and_iron_price,
                    default         => 0,
                };
                $qty        = (int) ($itemRow['quantity'] ?? 1);
                $subtotal  += $price * $qty;
                $totalItems += $qty;

                $order->items()->create([
                    'laundry_item_id' => $item->id,
                    'item_name'       => $item->name,
                    'service_type'    => $itemRow['service_type'],
                    'price'           => $price,
                    'quantity'        => $qty,
                    'subtotal'        => $price * $qty,
                    // care details
                    'description'     => $itemRow['description']  ?? null,
                    'observations'    => $itemRow['observations']  ?? null,
                    'requirements'    => $itemRow['requirements']  ?? null,
                    'starch_level'    => $itemRow['starch']        ?? 'medium',
                    'heat_level'      => $itemRow['heat']          ?? 'medium',
                    'finish'          => $itemRow['finish']        ?? 'folded',
                    'extra_charge'    => (int) ($itemRow['extra_charge'] ?? 0),
                ]);
            }

            $totalAmount = $subtotal + $serviceFee + $extraCharges;
            $amountPaid  = min($amountPaid, $totalAmount);

            if ($amountPaid >= $totalAmount)     $paymentStatus = 'paid';
            elseif ($amountPaid > 0)             $paymentStatus = 'partial';
            else                                 $paymentStatus = 'pending';

            $order->update([
                'total_items'    => $totalItems,
                'subtotal'       => $subtotal,
                'total_amount'   => $totalAmount,
                'amount_paid'    => $amountPaid,
                'payment_status' => $paymentStatus,
            ]);

            Payment::create([
                'laundry_order_id' => $order->id,
                'reference'        => $reference,
                'status'           => 'success',
                'amount'           => $amountPaid,
                'currency'         => 'NGN',
                'method'           => $method,
            ]);
        });

        session()->forget('order_data');
        return redirect()->route('bookLaundry')->with('success', 'Payment successful and order created!');
    }

    /**
     * Delete a payment record and recalculate the order's amount_paid and status.
     */
    public function destroy(Payment $payment)
    {
        DB::transaction(function () use ($payment) {
            $order = $payment->order;

            $payment->delete();

            if ($order) {
                $newAmountPaid = $order->payments()->where('status', 'success')->sum('amount');

                if ($newAmountPaid >= $order->total_amount)  $status = 'paid';
                elseif ($newAmountPaid > 0)                  $status = 'partial';
                else                                         $status = 'pending';

                $order->update([
                    'amount_paid'    => $newAmountPaid,
                    'payment_status' => $status,
                ]);
            }
        });

        return back()->with('success', 'Payment #' . $payment->id . ' deleted successfully.');
    }
}
