<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Mail\PaymentSuccessToSeller;
use Illuminate\Support\Facades\Mail;

class MidtransController extends Controller
{
    public function callback(Request $request)
    {
        $serverKey = env('MIDTRANS_SERVER_KEY');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            $orderIdParts = explode('-', $request->order_id);
            $realOrderId = $orderIdParts[0];

            $order = Order::find($realOrderId);
            if ($order) {
                if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                    $order->update(['status' => 'success']);

                    // Auto-send invoice email to each seller involved in this order
                    $this->notifySellers($order);

                } else if ($request->transaction_status == 'cancel' || $request->transaction_status == 'deny' || $request->transaction_status == 'expire') {
                    $order->update(['status' => 'failed']);
                } else if ($request->transaction_status == 'pending') {
                    $order->update(['status' => 'pending']);
                }
            }
        }

        return response()->json(['message' => 'ok']);
    }

    /**
     * Group order items by seller and send each seller
     * a payment notification email with the invoice PDF attached.
     */
    private function notifySellers(Order $order): void
    {
        // Eager-load relationships needed for the email and PDF
        $order->load('items.service.seller', 'user');

        // Group items by seller_id
        $itemsBySeller = [];
        foreach ($order->items as $item) {
            $sellerId = $item->service->seller_id;
            if (!isset($itemsBySeller[$sellerId])) {
                $itemsBySeller[$sellerId] = [
                    'seller' => $item->service->seller,
                    'items' => [],
                ];
            }
            $itemsBySeller[$sellerId]['items'][] = $item;
        }

        // Send an email to each unique seller
        foreach ($itemsBySeller as $sellerGroup) {
            $seller = $sellerGroup['seller'];
            $sellerItems = $sellerGroup['items'];

            // Create notification for seller
            \App\Services\NotificationService::create(
                $seller->id,
                'order_paid',
                'Pembayaran Pesanan Berhasil',
                'Pembayaran untuk pesanan #' . str_pad($order->id, 5, '0', STR_PAD_LEFT) . ' telah berhasil. Silakan mulai mengerjakan pesanan.',
                ['order_id' => $order->id]
            );

            try {
                Mail::to($seller->email)->send(
                    new PaymentSuccessToSeller($order, $sellerItems, $seller->name)
                );
            } catch (\Exception $e) {
                // Log the error but don't fail the callback
                \Log::error('Failed to send payment notification to seller: ' . $seller->email . ' - ' . $e->getMessage());
            }
        }
    }
}
