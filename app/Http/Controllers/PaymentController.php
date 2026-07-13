<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Service;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function checkout()
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('pembeli.home')->with('error', 'Keranjang kosong');
        }

        // Calculate total
        $total = collect($cart)->sum(function ($item) {
            return $item['price'];
        });

        // Create order
        $order = Order::create([
            'user_id' => auth()->id(),
            'total_amount' => $total,
            'status' => 'pending',
        ]);

        // Create order items
        foreach ($cart as $serviceId => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'service_id' => $serviceId,
                'price' => $item['price'],
            ]);
        }

        // Clear cart
        session()->forget('cart');

        // Redirect to payment page
        return redirect()->route('pembeli.payment', ['order_id' => $order->id]);
    }

    public function showPayment($orderId)
    {
        $order = Order::with('items.service')->findOrFail($orderId);
        
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        return view('pembeli.payment.index', compact('order'));
    }

    public function createMidtransTransaction(Request $request, $orderId)
    {
        $order = Order::with('items.service')->findOrFail($orderId);
        
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        if ($order->status !== 'pending') {
            return back()->with('error', 'Order tidak valid');
        }

        // Set Midtrans configuration
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        \Midtrans\Config::$isSanitized = env('MIDTRANS_IS_SANITIZED', true);
        \Midtrans\Config::$is3ds = env('MIDTRANS_IS_3DS', true);

        // Create transaction details
        $transactionDetails = [
            'order_id' => $order->id . '-' . time(),
            'gross_amount' => $order->total_amount,
        ];

        // Create item details
        $itemDetails = [];
        foreach ($order->items as $item) {
            $itemDetails[] = [
                'id' => $item->service_id,
                'price' => $item->price,
                'quantity' => 1,
                'name' => $item->service->name,
            ];
        }

        // Create customer details
        $customerDetails = [
            'first_name' => auth()->user()->name,
            'email' => auth()->user()->email,
        ];

        // Create transaction
        $transaction = [
            'transaction_details' => $transactionDetails,
            'item_details' => $itemDetails,
            'customer_details' => $customerDetails,
        ];

        try {
            $snapToken = \Midtrans\Snap::getSnapToken($transaction);
            return response()->json(['snap_token' => $snapToken]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
