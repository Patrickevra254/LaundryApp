<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaundryItem;
use App\Models\LaundryOrder;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;

// class OrderController extends Controller
// {
//     /**
//      * Handle direct order creation for cash / bank transfer payments.
//      * Paystack orders go through PaymentController instead.
//      */
//     public function store(Request $request)
//     {
//         $request->validate([
//             'customer_id'      => 'required|exists:users,id',
//             'pickup_address'   => 'required|string',
//             'delivery_address' => 'required|string',
//             'pickup_date'      => 'required|date',
//             'delivery_date'    => 'required|date|after_or_equal:pickup_date',
//             'items_json'       => 'required|string',
//             'payment_method'   => 'required|in:cash,bank',
//             'payment_timing'   => 'required|in:now,on_delivery,on_collection',
//             'amount_paid_now'  => 'nullable|numeric|min:0',
//         ]);

//         $items = json_decode($request->items_json, true);

//         if (!$items || count($items) === 0) {
//             return back()->with('error', 'No items found in order.');
//         }

//         DB::transaction(function () use ($request, $items) {

//             $serviceFee   = 200;
//             $subtotal     = 0;
//             $totalItems   = 0;
//             $amountPaid   = (int) ($request->amount_paid_now ?? 0);

//             $order = LaundryOrder::create([
//                 'customer_id'      => $request->customer_id,
//                 'pickup_address'   => $request->pickup_address,
//                 'delivery_address' => $request->delivery_address,
//                 'pickup_date'      => $request->pickup_date,
//                 'delivery_date'    => $request->delivery_date,
//                 'total_items'      => 0,
//                 'subtotal'         => 0,
//                 'service_fee'      => $serviceFee,
//                 'total_amount'     => 0,
//                 'payment_method'   => $request->payment_method,
//                 'payment_timing'   => $request->payment_timing,
//                 'payment_status'   => 'pending',
//                 'amount_paid'      => 0,
//                 'created_by'       => auth()->id(),
//             ]);

//             foreach ($items as $itemRow) {
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
//                 ]);
//             }

//             $totalAmount = $subtotal + $serviceFee;

//             // Safety net: Pay Now + 0 entered means pay in full (JS handles this too, belt-and-braces)
//             if ($request->payment_timing === 'now' && $amountPaid === 0) {
//                 $amountPaid = $totalAmount;
//             }

//             // Determine payment status
//             $paymentStatus = 'pending';
//             if ($amountPaid >= $totalAmount) {
//                 $paymentStatus = 'paid';
//                 $amountPaid    = $totalAmount; // cap at total
//             } elseif ($amountPaid > 0) {
//                 $paymentStatus = 'partial';
//             }

//             $order->update([
//                 'total_items'    => $totalItems,
//                 'subtotal'       => $subtotal,
//                 'total_amount'   => $totalAmount,
//                 'amount_paid'    => $amountPaid,
//                 'payment_status' => $paymentStatus,
//             ]);

//             // Record payment if something was paid now
//             if ($amountPaid > 0) {
//                 Payment::create([
//                     'laundry_order_id' => $order->id,
//                     'reference'        => 'CASH-' . strtoupper(uniqid()),
//                     'status'           => 'success',
//                     'amount'           => $amountPaid,
//                     'currency'         => 'NGN',
//                     'method'           => $request->payment_method,
//                 ]);
//             }
//         });

//         return redirect()->route('bookLaundry')->with('success', 'Order created successfully!');
//     }

//     /**
//      * Record a payment against an existing order (staff marks cash/transfer received).
//      */
//     public function recordPayment(Request $request, LaundryOrder $order)
//     {
//         $request->validate([
//             'amount'         => 'required|numeric|min:1',
//             'payment_method' => 'required|in:cash,bank',
//         ]);

//         $remaining = $order->total_amount - $order->amount_paid;
//         $amount    = min((int) $request->amount, $remaining); // can't overpay

//         DB::transaction(function () use ($request, $order, $amount) {

//             $newAmountPaid = $order->amount_paid + $amount;
//             $paymentStatus = $newAmountPaid >= $order->total_amount ? 'paid' : 'partial';

//             $order->update([
//                 'amount_paid'    => $newAmountPaid,
//                 'payment_status' => $paymentStatus,
//             ]);

//             Payment::create([
//                 'laundry_order_id' => $order->id,
//                 'reference'        => 'CASH-' . strtoupper(uniqid()),
//                 'status'           => 'success',
//                 'amount'           => $amount,
//                 'currency'         => 'NGN',
//                 'method'           => $request->payment_method,
//             ]);
//         });

//         return back()->with('success', 'Payment of ₦' . number_format($amount) . ' recorded successfully.');
//     }

//     /**
//      * Redirect customer to Paystack to pay remaining balance on an existing order.
//      */
//     public function completePayment(LaundryOrder $order)
//     {
//         // Only the customer who owns the order can pay the balance
//         abort_if($order->customer_id !== auth()->id(), 403);

//         $balance = $order->total_amount - $order->amount_paid;

//         if ($balance <= 0) {
//             return back()->with('info', 'This order is already fully paid.');
//         }

//         // Store inside order_data so handleGatewayCallback can find it
//         session([
//             'order_data' => [
//                 'completing_order_id' => $order->id,
//                 'customer_id'         => $order->customer_id,
//             ],
//         ]);

//         $reference = 'BAL-' . strtoupper(uniqid());

//         $paystack  = app(\App\Services\PaystackService::class);
//         $response  = $paystack->initializePayment([
//             'email'        => auth()->user()->email,
//             'amount'       => $balance * 100, // kobo
//             'reference'    => $reference,
//             'callback_url' => route('payment.callback'),
//         ]);

//         if (!empty($response->data->authorization_url)) {
//             return redirect($response->data->authorization_url);
//         }

//         return back()->with('error', 'Unable to initialize payment. Please try again.');
//     }

//     /**
//      * Delete an order and all related payments/items (admin/superAdmin only).
//      */
//     public function destroy(LaundryOrder $order)
//     {
//         DB::transaction(function () use ($order) {
//             $order->payments()->delete(); // delete payment records first
//             $order->items()->delete();    // delete item lines
//             $order->delete();             // then delete the order itself
//         });

//         return back()->with('success', 'Order #' . $order->id . ' deleted successfully.');
//     }
// }

// class OrderController extends Controller
// {
//     /**
//      * Handle direct order creation for cash / bank transfer payments.
//      * Paystack orders go through PaymentController instead.
//      */
//     public function store(Request $request)
//     {
//         $request->validate([
//             'customer_id'      => 'required|exists:users,id',
//             'pickup_address'   => 'required|string',
//             'delivery_address' => 'required|string',
//             'pickup_date'      => 'required|date',
//             'delivery_date'    => 'required|date|after_or_equal:pickup_date',
//             'items_json'       => 'required|string',
//             'payment_method'   => 'required|in:cash,bank',
//             'payment_timing'   => 'required|in:now,on_delivery,on_collection',
//             'amount_paid_now'  => 'nullable|numeric|min:0',
//             'extra_charges'    => 'nullable|numeric|min:0',
//             'extra_charges_note' => 'nullable|string',
//             'wash_assigned_to' => 'nullable|string|max:255',
//             'iron_assigned_to' => 'nullable|string|max:255',
//         ]);

//         $items = json_decode($request->items_json, true);

//         if (!$items || count($items) === 0) {
//             return back()->with('error', 'No items found in order.');
//         }

//         DB::transaction(function () use ($request, $items) {

//             $serviceFee   = 200;
//             $subtotal     = 0;
//             $totalItems   = 0;
//             $amountPaid   = (int) ($request->amount_paid_now ?? 0);
//             $extraCharges = (int) ($request->extra_charges ?? 0);

//             $order = LaundryOrder::create([
//                 'customer_id'        => $request->customer_id,
//                 'pickup_address'     => $request->pickup_address,
//                 'delivery_address'   => $request->delivery_address,
//                 'pickup_date'        => $request->pickup_date,
//                 'delivery_date'      => $request->delivery_date,
//                 'total_items'        => 0,
//                 'subtotal'           => 0,
//                 'service_fee'        => $serviceFee,
//                 'extra_charges'      => $extraCharges,
//                 'extra_charges_note' => $request->extra_charges_note,
//                 'total_amount'       => 0,
//                 'payment_method'     => $request->payment_method,
//                 'payment_timing'     => $request->payment_timing,
//                 'payment_status'     => 'pending',
//                 'amount_paid'        => 0,
//                 'wash_assigned_to'   => $request->wash_assigned_to,
//                 'iron_assigned_to'   => $request->iron_assigned_to,
//                 'created_by'         => auth()->id(),
//             ]);

//             foreach ($items as $itemRow) {
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

//             // Safety net: Pay Now + 0 entered means pay in full
//             if ($request->payment_timing === 'now' && $amountPaid === 0) {
//                 $amountPaid = $totalAmount;
//             }

//             // Determine payment status
//             if ($amountPaid >= $totalAmount) {
//                 $paymentStatus = 'paid';
//                 $amountPaid    = $totalAmount; // cap at total
//             } elseif ($amountPaid > 0) {
//                 $paymentStatus = 'partial';
//             } else {
//                 $paymentStatus = 'pending';
//             }

//             $order->update([
//                 'total_items'    => $totalItems,
//                 'subtotal'       => $subtotal,
//                 'total_amount'   => $totalAmount,
//                 'amount_paid'    => $amountPaid,
//                 'payment_status' => $paymentStatus,
//             ]);

//             if ($amountPaid > 0) {
//                 Payment::create([
//                     'laundry_order_id' => $order->id,
//                     'reference'        => 'CASH-' . strtoupper(uniqid()),
//                     'status'           => 'success',
//                     'amount'           => $amountPaid,
//                     'currency'         => 'NGN',
//                     'method'           => $request->payment_method,
//                 ]);
//             }
//         });

//         return redirect()->route('bookLaundry')->with('success', 'Order created successfully!');
//     }

//     /**
//      * Record a payment against an existing order (staff marks cash/transfer received).
//      */
//     public function recordPayment(Request $request, LaundryOrder $order)
//     {
//         $request->validate([
//             'amount'         => 'required|numeric|min:1',
//             'payment_method' => 'required|in:cash,bank',
//         ]);

//         $remaining = $order->total_amount - $order->amount_paid;
//         $amount    = min((int) $request->amount, $remaining);

//         DB::transaction(function () use ($request, $order, $amount) {

//             $newAmountPaid = $order->amount_paid + $amount;
//             $paymentStatus = $newAmountPaid >= $order->total_amount ? 'paid' : 'partial';

//             $order->update([
//                 'amount_paid'    => $newAmountPaid,
//                 'payment_status' => $paymentStatus,
//             ]);

//             Payment::create([
//                 'laundry_order_id' => $order->id,
//                 'reference'        => 'CASH-' . strtoupper(uniqid()),
//                 'status'           => 'success',
//                 'amount'           => $amount,
//                 'currency'         => 'NGN',
//                 'method'           => $request->payment_method,
//             ]);
//         });

//         return back()->with('success', 'Payment of ₦' . number_format($amount) . ' recorded successfully.');
//     }

//     /**
//      * Redirect customer to Paystack to pay remaining balance on an existing order.
//      */
//     public function completePayment(LaundryOrder $order)
//     {
//         abort_if($order->customer_id !== auth()->id(), 403);

//         $balance = $order->total_amount - $order->amount_paid;

//         if ($balance <= 0) {
//             return back()->with('info', 'This order is already fully paid.');
//         }

//         session([
//             'order_data' => [
//                 'completing_order_id' => $order->id,
//                 'customer_id'         => $order->customer_id,
//             ],
//         ]);

//         $reference = 'BAL-' . strtoupper(uniqid());

//         $paystack = app(\App\Services\PaystackService::class);
//         $response = $paystack->initializePayment([
//             'email'        => auth()->user()->email,
//             'amount'       => $balance * 100,
//             'reference'    => $reference,
//             'callback_url' => route('payment.callback'),
//         ]);

//         if (!empty($response->data->authorization_url)) {
//             return redirect($response->data->authorization_url);
//         }

//         return back()->with('error', 'Unable to initialize payment. Please try again.');
//     }

//     /**
//      * Update staff-only fields on an existing order.
//      * Accessible by admin, superAdmin, staff — NOT customer.
//      */
//     public function updateDetails(Request $request, LaundryOrder $order)
//     {
//         $request->validate([
//             'wash_assigned_to'   => 'nullable|string|max:255',
//             'iron_assigned_to'   => 'nullable|string|max:255',
//             'extra_charges'      => 'nullable|numeric|min:0',
//             'extra_charges_note' => 'nullable|string|max:255',
//         ]);

//         $extraCharges = (int) ($request->extra_charges ?? 0);

//         // Recalculate total_amount with updated extra charges
//         // total = subtotal + service_fee + extra_charges
//         $newTotal = $order->subtotal + $order->service_fee + $extraCharges;

//         // Recalculate payment status based on new total
//         $amountPaid = $order->amount_paid;
//         if ($amountPaid >= $newTotal)      $paymentStatus = 'paid';
//         elseif ($amountPaid > 0)           $paymentStatus = 'partial';
//         else                               $paymentStatus = 'pending';

//         $order->update([
//             'wash_assigned_to'   => $request->wash_assigned_to,
//             'iron_assigned_to'   => $request->iron_assigned_to,
//             'extra_charges'      => $extraCharges,
//             'extra_charges_note' => $request->extra_charges_note,
//             'total_amount'       => $newTotal,
//             'payment_status'     => $paymentStatus,
//         ]);

//         // Update per-item observations if provided
//         if ($request->has('item_observations')) {
//             foreach ($request->item_observations as $itemId => $observation) {
//                 $order->items()->where('id', $itemId)->update([
//                     'observations' => $observation,
//                 ]);
//             }
//         }

//         return back()->with('success', 'Order #' . $order->id . ' details updated successfully.');
//     }



//     /**
//      * Delete an order and all related payments/items.
//      */
//     public function destroy(LaundryOrder $order)
//     {
//         DB::transaction(function () use ($order) {
//             $order->payments()->delete();
//             $order->items()->delete();
//             $order->delete();
//         });

//         return back()->with('success', 'Order #' . $order->id . ' deleted successfully.');
//     }
// }



class OrderController extends Controller
{
    /**
     * Handle direct order creation for cash / bank transfer payments.
     * Paystack orders go through PaymentController instead.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id'      => 'required|exists:users,id',
            'pickup_address'   => 'required|string',
            'delivery_address' => 'required|string',
            'pickup_date'      => 'required|date',
            'delivery_date'    => 'required|date|after_or_equal:pickup_date',
            'items_json'       => 'required|string',
            'payment_method'   => 'required|in:cash,bank',
            'payment_timing'   => 'required|in:now,on_delivery,on_collection',
            'amount_paid_now'  => 'nullable|numeric|min:0',
            'extra_charges'    => 'nullable|numeric|min:0',
            'extra_charges_note' => 'nullable|string',
            'wash_assigned_to' => 'nullable|string|max:255',
            'iron_assigned_to' => 'nullable|string|max:255',
        ]);

        $items = json_decode($request->items_json, true);

        if (!$items || count($items) === 0) {
            return back()->with('error', 'No items found in order.');
        }

        DB::transaction(function () use ($request, $items) {

            $serviceFee   = 200;
            $subtotal     = 0;
            $totalItems   = 0;
            $amountPaid   = (int) ($request->amount_paid_now ?? 0);
            $extraCharges = (int) ($request->extra_charges ?? 0);

            $order = LaundryOrder::create([
                'customer_id'        => $request->customer_id,
                'pickup_address'     => $request->pickup_address,
                'delivery_address'   => $request->delivery_address,
                'pickup_date'        => $request->pickup_date,
                'delivery_date'      => $request->delivery_date,
                'total_items'        => 0,
                'subtotal'           => 0,
                'service_fee'        => $serviceFee,
                'extra_charges'      => $extraCharges,
                'extra_charges_note' => $request->extra_charges_note,
                'total_amount'       => 0,
                'payment_method'     => $request->payment_method,
                'payment_timing'     => $request->payment_timing,
                'payment_status'     => 'pending',
                'amount_paid'        => 0,
                'wash_assigned_to'   => $request->wash_assigned_to,
                'iron_assigned_to'   => $request->iron_assigned_to,
                'created_by'         => auth()->id(),
                'branch_id'          => auth()->user()->branch_id,
            ]);

            foreach ($items as $itemRow) {
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

            // Safety net: Pay Now + 0 entered means pay in full
            if ($request->payment_timing === 'now' && $amountPaid === 0) {
                $amountPaid = $totalAmount;
            }

            // Determine payment status
            if ($amountPaid >= $totalAmount) {
                $paymentStatus = 'paid';
                $amountPaid    = $totalAmount; // cap at total
            } elseif ($amountPaid > 0) {
                $paymentStatus = 'partial';
            } else {
                $paymentStatus = 'pending';
            }

            $order->update([
                'total_items'    => $totalItems,
                'subtotal'       => $subtotal,
                'total_amount'   => $totalAmount,
                'amount_paid'    => $amountPaid,
                'payment_status' => $paymentStatus,
            ]);

            if ($amountPaid > 0) {
                Payment::create([
                    'laundry_order_id' => $order->id,
                    'reference'        => 'CASH-' . strtoupper(uniqid()),
                    'status'           => 'success',
                    'amount'           => $amountPaid,
                    'currency'         => 'NGN',
                    'method'           => $request->payment_method,
                ]);
            }
        });

        return redirect()->route('bookLaundry')->with('success', 'Order created successfully!');
    }

    /**
     * Record a payment against an existing order (staff marks cash/transfer received).
     */
    public function recordPayment(Request $request, LaundryOrder $order)
    {
        $request->validate([
            'amount'         => 'required|numeric|min:1',
            'payment_method' => 'required|in:cash,bank',
        ]);

        $remaining = $order->total_amount - $order->amount_paid;
        $amount    = min((int) $request->amount, $remaining);

        DB::transaction(function () use ($request, $order, $amount) {

            $newAmountPaid = $order->amount_paid + $amount;
            $paymentStatus = $newAmountPaid >= $order->total_amount ? 'paid' : 'partial';

            $order->update([
                'amount_paid'    => $newAmountPaid,
                'payment_status' => $paymentStatus,
            ]);

            Payment::create([
                'laundry_order_id' => $order->id,
                'reference'        => 'CASH-' . strtoupper(uniqid()),
                'status'           => 'success',
                'amount'           => $amount,
                'currency'         => 'NGN',
                'method'           => $request->payment_method,
            ]);
        });

        return back()->with('success', 'Payment of ₦' . number_format($amount) . ' recorded successfully.');
    }

    /**
     * Redirect customer to Paystack to pay remaining balance on an existing order.
     */
    public function completePayment(LaundryOrder $order)
    {
        abort_if($order->customer_id !== auth()->id(), 403);

        $balance = $order->total_amount - $order->amount_paid;

        if ($balance <= 0) {
            return back()->with('info', 'This order is already fully paid.');
        }

        session([
            'order_data' => [
                'completing_order_id' => $order->id,
                'customer_id'         => $order->customer_id,
            ],
        ]);

        $reference = 'BAL-' . strtoupper(uniqid());

        $paystack = app(\App\Services\PaystackService::class);
        $response = $paystack->initializePayment([
            'email'        => auth()->user()->email,
            'amount'       => $balance * 100,
            'reference'    => $reference,
            'callback_url' => route('payment.callback'),
        ]);

        if (!empty($response->data->authorization_url)) {
            return redirect($response->data->authorization_url);
        }

        return back()->with('error', 'Unable to initialize payment. Please try again.');
    }

    /**
     * Delete an order and all related payments/items.
     */
    public function destroy(LaundryOrder $order)
    {
        DB::transaction(function () use ($order) {
            $order->payments()->delete();
            $order->items()->delete();
            $order->delete();
        });

        return back()->with('success', 'Order #' . $order->id . ' deleted successfully.');
    }

    /**
     * Update staff-only fields on an existing order.
     * Accessible by admin, superAdmin, staff — NOT customer.
     */
    public function updateDetails(Request $request, LaundryOrder $order)
    {
        $request->validate([
            'wash_assigned_to'   => 'nullable|string|max:255',
            'iron_assigned_to'   => 'nullable|string|max:255',
            'extra_charges'      => 'nullable|numeric|min:0',
            'extra_charges_note' => 'nullable|string|max:255',
        ]);

        $extraCharges = (int) ($request->extra_charges ?? 0);

        // Recalculate total_amount with updated extra charges
        // total = subtotal + service_fee + extra_charges
        $newTotal = $order->subtotal + $order->service_fee + $extraCharges;

        // Recalculate payment status based on new total
        $amountPaid = $order->amount_paid;
        if ($amountPaid >= $newTotal)      $paymentStatus = 'paid';
        elseif ($amountPaid > 0)           $paymentStatus = 'partial';
        else                               $paymentStatus = 'pending';

        $order->update([
            'wash_assigned_to'   => $request->wash_assigned_to,
            'iron_assigned_to'   => $request->iron_assigned_to,
            'extra_charges'      => $extraCharges,
            'extra_charges_note' => $request->extra_charges_note,
            'total_amount'       => $newTotal,
            'payment_status'     => $paymentStatus,
        ]);

        // Update per-item observations if provided
        if ($request->has('item_observations')) {
            foreach ($request->item_observations as $itemId => $observation) {
                $order->items()->where('id', $itemId)->update([
                    'observations' => $observation,
                ]);
            }
        }

        return back()->with('success', 'Order #' . $order->id . ' details updated successfully.');
    }
}
