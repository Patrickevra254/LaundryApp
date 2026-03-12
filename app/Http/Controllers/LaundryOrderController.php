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
//      * Store a new laundry order
//      */

//     public function updateStatus(Request $request, LaundryOrder $order)
//     {
//         $request->validate([
//             'status' => 'required|in:pending,In progress,completed,delivered',
//         ]);

//         // Capture old status FIRST
//         $oldStatus = $order->status;

//         //  Update to new status
//         $order->update([
//             'status' => $request->status,
//         ]);

//         // Capture new status
//         $newStatus = $order->status;

//         // Notify admins
//         $admins = User::whereIn('role', ['admin', 'superAdmin'])->get();

//         Notification::send(
//             $admins,
//             new OrderStatusUpdated($order, $oldStatus, $newStatus)
//         );

//         return redirect()->back()->with('success', 'Order status has been updated successfully');
//     }

//     public function store(Request $request)
//     {

//         // dd($request->all());

//         $validated = $request->validate([
//             'customer_id' => 'required|exists:users,id',
//             'pickup_address' => 'required|string',
//             'delivery_address' => 'required|string',
//             'pickup_date' => 'required|date',
//             'delivery_date' => 'required|date|after_or_equal:pickup_date',

//             'items' => 'required|array|min:1',
//             'items.*.item_id' => 'required|exists:laundry_items,id',
//             'items.*.quantity' => 'required|integer|min:1',
//             'items.*.service_type' => 'required|in:washing,ironing,wash_and_iron',
//         ]);

//         DB::transaction(function () use ($validated) {

//             $subtotal = 0;
//             $totalItems = 0;

//             // Create the order first (no service_type needed)
//             $serviceFee = 200;
//             $order = LaundryOrder::create([
//                 'customer_id'    => $validated['customer_id'],
//                 'pickup_address' => $validated['pickup_address'],
//                 'delivery_address' => $validated['delivery_address'],
//                 'pickup_date'    => $validated['pickup_date'],
//                 'delivery_date'  => $validated['delivery_date'],
//                 'total_items'    => 0, // will update below
//                 'subtotal'       => 0, // will update below
//                 'service_fee'    => $serviceFee,
//                 'total_amount'   => 0, // will update below
//                 'created_by'     => auth()->id(),
//             ]);

//             // Create order items
//             foreach ($validated['items'] as $row) {
//                 $item = LaundryItem::findOrFail($row['item_id']);
//                 $itemServiceType = $row['service_type'];

//                 // Determine price based on service type
//                 switch ($itemServiceType) {
//                     case 'washing':
//                         $price = $item->washing_price;
//                         break;
//                     case 'ironing':
//                         $price = $item->ironing_price;
//                         break;
//                     case 'wash_and_iron':
//                         $price = $item->wash_and_iron_price;
//                         break;
//                 }

//                 $subtotal += $price * $row['quantity'];
//                 $totalItems += $row['quantity'];

//                 $order->items()->create([
//                     'laundry_item_id' => $item->id,
//                     'item_name'       => $item->name,
//                     'service_type'    => $itemServiceType, // store service type per item
//                     'price'           => $price,
//                     'quantity'        => $row['quantity'],
//                     'subtotal'        => $price * $row['quantity'],
//                 ]);
//             }

//             // Update order totals
//             $order->update([
//                 'total_items' => $totalItems,
//                 'subtotal'    => $subtotal,
//                 'total_amount' => $subtotal + $serviceFee,
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
     * Store a new laundry order.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id'              => 'required|exists:users,id',
            'pickup_address'           => 'required|string',
            'delivery_address'         => 'required|string',
            'pickup_date'              => 'required|date',
            'delivery_date'            => 'required|date|after_or_equal:pickup_date',
            'items'                    => 'required|array|min:1',
            'items.*.item_id'          => 'required|exists:laundry_items,id',
            'items.*.quantity'         => 'required|integer|min:1',
            'items.*.service_type'     => 'required|in:washing,ironing,wash_and_iron',
        ]);

        DB::transaction(function () use ($validated) {

            $subtotal   = 0;
            $totalItems = 0;
            $serviceFee = 200;

            $order = LaundryOrder::create([
                'customer_id'     => $validated['customer_id'],
                'pickup_address'  => $validated['pickup_address'],
                'delivery_address' => $validated['delivery_address'],
                'pickup_date'     => $validated['pickup_date'],
                'delivery_date'   => $validated['delivery_date'],
                'total_items'     => 0,
                'subtotal'        => 0,
                'service_fee'     => $serviceFee,
                'total_amount'    => 0,
                'created_by'      => auth()->id(),
            ]);

            foreach ($validated['items'] as $row) {
                $item  = LaundryItem::findOrFail($row['item_id']);

                $price = match ($row['service_type']) {
                    'washing'       => $item->washing_price,
                    'ironing'       => $item->ironing_price,
                    'wash_and_iron' => $item->wash_and_iron_price,
                };

                $subtotal   += $price * $row['quantity'];
                $totalItems += $row['quantity'];

                $order->items()->create([
                    'laundry_item_id' => $item->id,
                    'item_name'       => $item->name,
                    'service_type'    => $row['service_type'],
                    'price'           => $price,
                    'quantity'        => $row['quantity'],
                    'subtotal'        => $price * $row['quantity'],
                ]);
            }

            $order->update([
                'total_items'  => $totalItems,
                'subtotal'     => $subtotal,
                'total_amount' => $subtotal + $serviceFee,
            ]);
        });

        return redirect()->back()->with('success', 'Order has been booked successfully');
    }
}
