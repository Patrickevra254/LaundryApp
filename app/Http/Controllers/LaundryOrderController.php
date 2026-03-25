<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\LaundryOrder;
use App\Models\LaundryItem;
use App\Models\User;
use App\Notifications\OrderStatusUpdated;
use Illuminate\Support\Facades\Notification;




// class LaundryOrderController extends Controller
// {
//     public function index()
//     {
//         $orders = LaundryOrder::with(['customer', 'items'])->get();

//         return view('adminSections2.orderTrack', compact('orders'));
//     }

//     /**
//      * Update order status and notify both admins and the customer.
//      */
//     public function updateStatus(Request $request, LaundryOrder $order)
//     {
//         $request->validate([
//             'status' => 'required|in:pending,In progress,completed,delivered',
//         ]);

//         $oldStatus = $order->status;

//         $order->update(['status' => $request->status]);

//         $newStatus = $order->status;

//         // Notify admins & superAdmins — technical message
//         $admins = User::whereIn('role', ['admin', 'superAdmin'])->get();
//         Notification::send(
//             $admins,
//             new OrderStatusUpdated($order, $oldStatus, $newStatus, 'admin')
//         );

//         // Notify the customer who owns the order — friendly message
//         $customer = $order->customer;
//         if ($customer) {
//             $customer->notify(
//                 new OrderStatusUpdated($order, $oldStatus, $newStatus, 'customer')
//             );
//         }

//         return redirect()->back()->with('success', 'Order status has been updated successfully');
//     }

//     /**
//      * Store a new laundry order.
//      */
//     public function store(Request $request)
//     {
//         $validated = $request->validate([
//             'customer_id'              => 'required|exists:users,id',
//             'pickup_address'           => 'required|string',
//             'delivery_address'         => 'required|string',
//             'pickup_date'              => 'required|date',
//             'delivery_date'            => 'required|date|after_or_equal:pickup_date',
//             'items'                    => 'required|array|min:1',
//             'items.*.item_id'          => 'required|exists:laundry_items,id',
//             'items.*.quantity'         => 'required|integer|min:1',
//             'items.*.service_type'     => 'required|in:washing,ironing,wash_and_iron',
//         ]);

//         DB::transaction(function () use ($validated) {

//             $subtotal   = 0;
//             $totalItems = 0;
//             $serviceFee = 200;

//             $order = LaundryOrder::create([
//                 'customer_id'     => $validated['customer_id'],
//                 'pickup_address'  => $validated['pickup_address'],
//                 'delivery_address' => $validated['delivery_address'],
//                 'pickup_date'     => $validated['pickup_date'],
//                 'delivery_date'   => $validated['delivery_date'],
//                 'total_items'     => 0,
//                 'subtotal'        => 0,
//                 'service_fee'     => $serviceFee,
//                 'total_amount'    => 0,
//                 'created_by'      => auth()->id(),
//             ]);

//             foreach ($validated['items'] as $row) {
//                 $item  = LaundryItem::findOrFail($row['item_id']);

//                 $price = match ($row['service_type']) {
//                     'washing'       => $item->washing_price,
//                     'ironing'       => $item->ironing_price,
//                     'wash_and_iron' => $item->wash_and_iron_price,
//                 };

//                 $subtotal   += $price * $row['quantity'];
//                 $totalItems += $row['quantity'];

//                 $order->items()->create([
//                     'laundry_item_id' => $item->id,
//                     'item_name'       => $item->name,
//                     'service_type'    => $row['service_type'],
//                     'price'           => $price,
//                     'quantity'        => $row['quantity'],
//                     'subtotal'        => $price * $row['quantity'],
//                 ]);
//             }

//             $order->update([
//                 'total_items'  => $totalItems,
//                 'subtotal'     => $subtotal,
//                 'total_amount' => $subtotal + $serviceFee,
//             ]);
//         });

//         return redirect()->back()->with('success', 'Order has been booked successfully');
//     }
// }



// class LaundryOrderController extends Controller
// {
//     public function index()
//     {
//         $orders = LaundryOrder::with(['customer', 'items'])->get();

//         return view('adminSections2.orderTrack', compact('orders'));
//     }

//     /**
//      * Update order status and notify both admins and the customer.
//      */
//     public function updateStatus(Request $request, LaundryOrder $order)
//     {
//         $request->validate([
//             'status' => 'required|in:pending,In progress,completed,delivered',
//         ]);

//         $oldStatus = $order->status;

//         $order->update(['status' => $request->status]);

//         $newStatus = $order->status;

//         // Notify admins & superAdmins — technical message
//         $admins = User::whereIn('role', ['admin', 'superAdmin'])->get();
//         Notification::send(
//             $admins,
//             new OrderStatusUpdated($order, $oldStatus, $newStatus, 'admin')
//         );

//         // Notify the customer who owns the order — friendly message
//         $customer = $order->customer;
//         if ($customer) {
//             $customer->notify(
//                 new OrderStatusUpdated($order, $oldStatus, $newStatus, 'customer')
//             );
//         }

//         return redirect()->back()->with('success', 'Order status has been updated successfully');
//     }

//     /**
//      * Store a new laundry order (admin-side form submission).
//      */
//     public function store(Request $request)
//     {
//         $request->validate([
//             'customer_id'              => 'required|exists:users,id',
//             'pickup_address'           => 'required|string',
//             'delivery_address'         => 'required|string',
//             'pickup_date'              => 'required|date',
//             'delivery_date'            => 'required|date|after_or_equal:pickup_date',
//             'items'                    => 'required|array|min:1',
//             'items.*.item_id'          => 'required|exists:laundry_items,id',
//             'items.*.quantity'         => 'required|integer|min:1',
//             'items.*.service_type'     => 'required|in:washing,ironing,wash_and_iron',
//             // care details per item (optional)
//             'items.*.description'      => 'nullable|string|max:255',
//             'items.*.observations'     => 'nullable|string',
//             'items.*.requirements'     => 'nullable|string',
//             'items.*.starch_level'     => 'nullable|in:none,low,medium,high',
//             'items.*.heat_level'       => 'nullable|in:low,medium,high',
//             'items.*.finish'           => 'nullable|in:folded,hanged',
//             'items.*.extra_charge'     => 'nullable|numeric|min:0',
//             // order-level fields
//             'extra_charges'            => 'nullable|numeric|min:0',
//             'extra_charges_note'       => 'nullable|string|max:255',
//             'wash_assigned_to'         => 'nullable|string|max:255',
//             'iron_assigned_to'         => 'nullable|string|max:255',
//         ]);

//         DB::transaction(function () use ($request) {

//             $subtotal     = 0;
//             $totalItems   = 0;
//             $serviceFee   = 200;
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
//                 'payment_status'     => 'pending',
//                 'amount_paid'        => 0,
//                 'wash_assigned_to'   => $request->wash_assigned_to,
//                 'iron_assigned_to'   => $request->iron_assigned_to,
//                 'created_by'         => auth()->id(),
//             ]);

//             foreach ($request->items as $row) {
//                 $item  = LaundryItem::findOrFail($row['item_id']);

//                 $price = match ($row['service_type']) {
//                     'washing'       => $item->washing_price,
//                     'ironing'       => $item->ironing_price,
//                     'wash_and_iron' => $item->wash_and_iron_price,
//                 };

//                 $qty         = (int) $row['quantity'];
//                 $subtotal   += $price * $qty;
//                 $totalItems += $qty;

//                 $order->items()->create([
//                     'laundry_item_id' => $item->id,
//                     'item_name'       => $item->name,
//                     'service_type'    => $row['service_type'],
//                     'price'           => $price,
//                     'quantity'        => $qty,
//                     'subtotal'        => $price * $qty,
//                     // care details
//                     'description'     => $row['description']  ?? null,
//                     'observations'    => $row['observations']  ?? null,
//                     'requirements'    => $row['requirements']  ?? null,
//                     'starch_level'    => $row['starch_level']  ?? 'medium',
//                     'heat_level'      => $row['heat_level']    ?? 'medium',
//                     'finish'          => $row['finish']        ?? 'folded',
//                     'extra_charge'    => (int) ($row['extra_charge'] ?? 0),
//                 ]);
//             }

//             $order->update([
//                 'total_items'  => $totalItems,
//                 'subtotal'     => $subtotal,
//                 'total_amount' => $subtotal + $serviceFee + $extraCharges,
//             ]);
//         });

//         return redirect()->back()->with('success', 'Order has been booked successfully');
//     }
// }


class LaundryOrderController extends Controller
{
    public function index()
    {
        $orders = LaundryOrder::with(['customer', 'items'])->get();

        return view('adminSections2.orderTrack', compact('orders'));
    }

    /**
     * Update order status and notify both admins and the customer.
     */
    public function updateStatus(Request $request, LaundryOrder $order)
    {
        $request->validate([
            'status' => 'required|in:pending,In progress,completed,delivered',
        ]);

        $oldStatus = $order->status;

        $order->update(['status' => $request->status]);

        $newStatus = $order->status;

        // Notify admins & superAdmins — technical message
        $admins = User::whereIn('role', ['admin', 'superAdmin'])->get();
        Notification::send(
            $admins,
            new OrderStatusUpdated($order, $oldStatus, $newStatus, 'admin')
        );

        // Notify the customer who owns the order — friendly message
        $customer = $order->customer;
        if ($customer) {
            $customer->notify(
                new OrderStatusUpdated($order, $oldStatus, $newStatus, 'customer')
            );
        }

        return redirect()->back()->with('success', 'Order status has been updated successfully');
    }

    /**
     * Store a new laundry order (admin-side form submission).
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id'              => 'required|exists:users,id',
            'pickup_address'           => 'required|string',
            'delivery_address'         => 'required|string',
            'pickup_date'              => 'required|date',
            'delivery_date'            => 'required|date|after_or_equal:pickup_date',
            'items'                    => 'required|array|min:1',
            'items.*.item_id'          => 'required|exists:laundry_items,id',
            'items.*.quantity'         => 'required|integer|min:1',
            'items.*.service_type'     => 'required|in:washing,ironing,wash_and_iron',
            // care details per item (optional)
            'items.*.description'      => 'nullable|string|max:255',
            'items.*.observations'     => 'nullable|string',
            'items.*.requirements'     => 'nullable|string',
            'items.*.starch_level'     => 'nullable|in:none,low,medium,high',
            'items.*.heat_level'       => 'nullable|in:low,medium,high',
            'items.*.finish'           => 'nullable|in:folded,hanged',
            'items.*.extra_charge'     => 'nullable|numeric|min:0',
            // order-level fields
            'extra_charges'            => 'nullable|numeric|min:0',
            'extra_charges_note'       => 'nullable|string|max:255',
            'wash_assigned_to'         => 'nullable|string|max:255',
            'iron_assigned_to'         => 'nullable|string|max:255',
        ]);

        DB::transaction(function () use ($request) {

            $subtotal     = 0;
            $totalItems   = 0;
            $serviceFee   = 200;
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
                'payment_status'     => 'pending',
                'amount_paid'        => 0,
                'wash_assigned_to'   => $request->wash_assigned_to,
                'iron_assigned_to'   => $request->iron_assigned_to,
                'created_by'         => auth()->id(),
                'branch_id'          => auth()->user()->branch_id,
            ]);

            foreach ($request->items as $row) {
                $item  = LaundryItem::findOrFail($row['item_id']);

                $price = match ($row['service_type']) {
                    'washing'       => $item->washing_price,
                    'ironing'       => $item->ironing_price,
                    'wash_and_iron' => $item->wash_and_iron_price,
                };

                $qty         = (int) $row['quantity'];
                $subtotal   += $price * $qty;
                $totalItems += $qty;

                $order->items()->create([
                    'laundry_item_id' => $item->id,
                    'item_name'       => $item->name,
                    'service_type'    => $row['service_type'],
                    'price'           => $price,
                    'quantity'        => $qty,
                    'subtotal'        => $price * $qty,
                    // care details
                    'description'     => $row['description']  ?? null,
                    'observations'    => $row['observations']  ?? null,
                    'requirements'    => $row['requirements']  ?? null,
                    'starch_level'    => $row['starch_level']  ?? 'medium',
                    'heat_level'      => $row['heat_level']    ?? 'medium',
                    'finish'          => $row['finish']        ?? 'folded',
                    'extra_charge'    => (int) ($row['extra_charge'] ?? 0),
                ]);
            }

            $order->update([
                'total_items'  => $totalItems,
                'subtotal'     => $subtotal,
                'total_amount' => $subtotal + $serviceFee + $extraCharges,
            ]);
        });

        return redirect()->back()->with('success', 'Order has been booked successfully');
    }
}
