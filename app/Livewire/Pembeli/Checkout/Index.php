<?php

namespace App\Livewire\Pembeli\Checkout;

use App\Services\CartService;
use Livewire\Component;

class Index extends Component
{
    public $cart = [];
    public $selectedItems = [];
    public $total = 0;
    public $jobDescription = '';

    public function mount()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $this->selectedItems = session()->get('checkout_items', []);
        $this->loadCart();
    }

    public function loadCart()
    {
        $this->cart = CartService::get();
        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $this->total = 0;
        foreach ($this->selectedItems as $id) {
            if (isset($this->cart[$id])) {
                $this->total += $this->cart[$id]['price'];
            }
        }
    }

    public function processPayment()
    {
        if (count($this->selectedItems) === 0) {
            $this->dispatch('notification', message: 'Tidak ada item untuk diproses', type: 'error');
            return;
        }

        $this->validate([
            'jobDescription' => 'nullable|string|max:1000',
        ]);

        // Setup Midtrans Configuration
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false) === 'true';
        \Midtrans\Config::$isSanitized = env('MIDTRANS_IS_SANITIZED', true) === 'true' || env('MIDTRANS_IS_SANITIZED') === true;
        \Midtrans\Config::$is3ds = env('MIDTRANS_IS_3DS', true) === 'true' || env('MIDTRANS_IS_3DS') === true;

        // Create Order
        $order = \App\Models\Order::create([
            'user_id' => auth()->id(),
            'total_amount' => $this->total,
            'status' => 'pending',
            'job_description' => $this->jobDescription,
        ]);

        $itemDetails = [];

        foreach ($this->selectedItems as $id) {
            if (isset($this->cart[$id])) {
                \App\Models\OrderItem::create([
                    'order_id' => $order->id,
                    'service_id' => $id,
                    'price' => $this->cart[$id]['price'],
                ]);

                // Get service seller for notification
                $service = \App\Models\Service::find($id);
                if ($service && $service->seller_id) {
                    // Create notification for seller
                    \App\Services\NotificationService::create(
                        $service->seller_id,
                        'new_order',
                        'Pesanan Baru Masuk',
                        'Pesanan baru untuk jasa "' . $service->name . '" telah masuk. Silakan konfirmasi pesanan.',
                        ['order_id' => $order->id, 'service_id' => $id, 'service_name' => $service->name]
                    );
                }

                $itemDetails[] = [
                    'id' => $id,
                    'price' => $this->cart[$id]['price'],
                    'quantity' => 1,
                    'name' => \Illuminate\Support\Str::limit($this->cart[$id]['name'], 50),
                ];
            }
        }

        $transactionDetails = [
            'order_id' => $order->id . '-' . time(),
            'gross_amount' => $this->total,
        ];

        $customerDetails = [
            'first_name' => auth()->user()->name,
            'email' => auth()->user()->email,
        ];

        $params = [
            'transaction_details' => $transactionDetails,
            'item_details' => $itemDetails,
            'customer_details' => $customerDetails,
        ];

        try {
            $snapToken = \Midtrans\Snap::getSnapToken($params);
            $order->update(['snap_token' => $snapToken]);

            // Store order ID and job description in session for post-payment cleanup
            session()->put('pending_order_id', $order->id);
            session()->put('pending_order_items', $this->selectedItems);
            session()->put('job_description', $this->jobDescription);

            // Create notification for checkout completed
            \App\Services\NotificationService::create(
                auth()->id(),
                'checkout_completed',
                'Pesanan Berhasil Dibuat',
                'Pesanan #' . str_pad($order->id, 5, '0', STR_PAD_LEFT) . ' telah berhasil dibuat. Silakan selesaikan pembayaran.',
                ['order_id' => $order->id]
            );

            $this->js("window.snapToken = '{$snapToken}'; window.openSnap();");
        } catch (\Exception $e) {
            $this->dispatch('notification', message: 'Gagal menghubungkan ke Midtrans: ' . $e->getMessage(), type: 'error');
        }
    }

    public function clearPendingOrder()
    {
        $pendingItems = session()->get('pending_order_items', []);
        
        foreach ($pendingItems as $id) {
            CartService::remove($id);
        }
        
        session()->forget('pending_order_id');
        session()->forget('pending_order_items');
        session()->forget('checkout_items');
    }

    public function render()
    {
        return view('livewire.pembeli.checkout.index');
    }
}
