<?php

namespace App\Http\Controllers;

use App\Services\PaystackService;
use Illuminate\Http\Request;
use App\Models\LaundryItem;
use App\Models\LaundryOrder;
use App\Models\LaundryOrderItem;
use App\Models\Payment;
use App\Notifications\OrderStatusUpdated;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class PaymentController extends Controller
{
    protected $paystack;

    public function __construct(PaystackService $paystack)
    {
        $this->paystack = $paystack;
    }

    public function redirectToGateway(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:users,id',
            'pickup_address' => 'required',
            'delivery_address' => 'required',
            'pickup_date' => 'required|date',
            'delivery_date' => 'required|date|after_or_equal:pickup_date',
            'items' => 'required|array|min:1',
            'email' => 'required|email',
            'amount' => 'required|numeric|min:1',
        ]);

        session(['order_data' => $request->all()]);

        $reference = uniqid('laundry_');

        $response = $this->paystack->initializePayment([
            'email' => $request->email,
            'amount' => $request->amount, // in kobo
            'reference' => $reference,
            'callback_url' => route('payment.callback'),
        ]);

        if (!empty($response->data->authorization_url)) {
            return redirect($response->data->authorization_url);
        }

        return back()->with('error', 'Unable to initialize payment.');
    }

    public function handleGatewayCallback(Request $request)
    {
        $reference = $request->query('reference');

        $result = $this->paystack->verifyPayment($reference);

        if ($result->status && $result->data->status === 'success') {

            $orderData = session('order_data');

            if (!$orderData) {
                return redirect()->route('bookLaundry')->with('error', 'No order data found.');
            }

            // Prevent duplicate payments
            if (Payment::where('reference', $reference)->exists()) {
                return redirect()->route('bookLaundry')->with('error', 'This payment was already processed.');
            }

            $order = DB::transaction(function () use ($orderData, $reference) {

                $serviceFee = 200;
                $subtotal = 0;
                $totalItems = 0;

                $order = LaundryOrder::create([
                    'customer_id' => $orderData['customer_id'],
                    'pickup_address' => $orderData['pickup_address'],
                    'delivery_address' => $orderData['delivery_address'],
                    'pickup_date' => $orderData['pickup_date'],
                    'delivery_date' => $orderData['delivery_date'],
                    'total_items' => 0,
                    'subtotal' => 0,
                    'service_fee' => $serviceFee,
                    'total_amount' => 0,
                    // 'status' => 'pending',
                    'payment_status' => 'paid',
                    'created_by' => auth()->id(),
                ]);

                foreach ($orderData['items'] as $itemRow) {
                    $item = LaundryItem::findOrFail($itemRow['item_id']);
                    $price = match ($itemRow['service_type']) {
                        'washing' => $item->washing_price,
                        'ironing' => $item->ironing_price,
                        'wash_and_iron' => $item->wash_and_iron_price,
                    };

                    $qty = $itemRow['quantity'] ?? 1;
                    $subtotal += $price * $qty;
                    $totalItems += $qty;

                    $order->items()->create([
                        'laundry_item_id' => $item->id,
                        'item_name' => $item->name,
                        'service_type' => $itemRow['service_type'],
                        'price' => $price,
                        'quantity' => $qty,
                        'subtotal' => $price * $qty,
                    ]);
                }

                $order->update([
                    'total_items' => $totalItems,
                    'subtotal' => $subtotal,
                    'total_amount' => $subtotal + $serviceFee,
                ]);

                // $method = $result->data->channel ?? 'Paystack';
                $method = $result->data->channel
                    ?? $result->data->authorization->channel
                    ?? 'Paystack';


                Payment::create([
                    'laundry_order_id' => $order->id,
                    'reference' => $reference,
                    'status' => 'success',
                    'amount' => $order->total_amount,
                    'currency' => 'NGN',
                    'method' => $method,

                ]);

                return $order;
            });

            session()->forget('order_data');


            return redirect()->route('bookLaundry')->with('success', 'Payment successful and order created!');
        }

        return redirect()->route('bookLaundry')->with('error', 'Payment verification failed.');
    }
}
