<?php

namespace App\Livewire\Seller;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Service;

class Pesanan extends Component
{
    use WithFileUploads;

    public $orders = [];
    public $statusFilter = 'all';
    public $proofOfWork = null;
    public $selectedOrderId = null;
    public $showDetailModal = false;
    public $selectedOrder = null;

    public function mount()
    {
        $this->loadOrders();
    }

    public function loadOrders()
    {
        // Get seller's service IDs
        $sellerServiceIds = Service::where('seller_id', auth()->id())->pluck('id')->toArray();

        // Get orders that contain seller's services
        $orderIds = OrderItem::whereIn('service_id', $sellerServiceIds)->pluck('order_id')->unique();

        $query = Order::whereIn('id', $orderIds)->with(['items.service', 'user']);

        if ($this->statusFilter !== 'all') {
            $query->where('status', $this->statusFilter);
        }

        $this->orders = $query->latest()->get();
    }

    public function updatedStatusFilter()
    {
        $this->loadOrders();
    }

    public function confirmOrder($orderId)
    {
        $order = Order::find($orderId);
        if ($order) {
            $order->update(['status' => 'confirmed']);
            
            // Create notification for buyer
            \App\Services\NotificationService::create(
                $order->user_id,
                'order_confirmed',
                'Pesanan Dikonfirmasi',
                'Pesanan #' . str_pad($order->id, 5, '0', STR_PAD_LEFT) . ' telah dikonfirmasi oleh penjual dan sedang dikerjakan.',
                ['order_id' => $order->id]
            );
            
            $this->loadOrders();
            $this->dispatch('notification', message: 'Pesanan berhasil dikonfirmasi', type: 'success');
        }
    }

    public function rejectOrder($orderId)
    {
        $order = Order::find($orderId);
        if ($order) {
            $order->update(['status' => 'rejected']);
            
            // Create notification for buyer
            \App\Services\NotificationService::create(
                $order->user_id,
                'order_rejected',
                'Pesanan Ditolak',
                'Pesanan #' . str_pad($order->id, 5, '0', STR_PAD_LEFT) . ' telah ditolak oleh penjual.',
                ['order_id' => $order->id]
            );
            
            $this->loadOrders();
            $this->dispatch('notification', message: 'Pesanan berhasil ditolak', type: 'success');
        }
    }

    public function completeOrder($orderId)
    {
        $order = Order::find($orderId);
        if ($order) {
            $order->update(['status' => 'completed']);
            
            // Create notification for buyer
            \App\Services\NotificationService::create(
                $order->user_id,
                'order_completed',
                'Pesanan Selesai',
                'Pesanan #' . str_pad($order->id, 5, '0', STR_PAD_LEFT) . ' telah selesai. Bukti pengerjaan telah dikirim oleh penjual.',
                ['order_id' => $order->id]
            );
            
            $this->loadOrders();
            $this->dispatch('notification', message: 'Pesanan berhasil diselesaikan', type: 'success');
        }
    }

    public function uploadProofOfWork($orderId)
    {
        $this->validate([
            'proofOfWork' => 'required|mimes:jpeg,png,jpg,gif,mp4,pdf,docx,csv,pptx,doc,xls,xlsx,ppt|max:10240',
        ]);

        $order = Order::find($orderId);
        if ($order) {
            $path = $this->proofOfWork->store('proof_of_work', 'public');
            $order->update(['proof_of_work' => $path]);
            
            $this->proofOfWork = null;
            $this->selectedOrderId = null;
            $this->loadOrders();
            $this->dispatch('notification', message: 'Bukti pengerjaan berhasil diupload', type: 'success');
        }
    }

    public function openProofUpload($orderId)
    {
        $this->selectedOrderId = $orderId;
    }

    public function closeProofUpload()
    {
        $this->selectedOrderId = null;
        $this->proofOfWork = null;
    }

    public function deleteProofOfWork($orderId)
    {
        $order = Order::find($orderId);
        if ($order && $order->proof_of_work) {
            // Delete the file from storage
            \Storage::disk('public')->delete($order->proof_of_work);
            
            // Update the order to remove the proof of work
            $order->update(['proof_of_work' => null]);
            
            $this->loadOrders();
            $this->dispatch('notification', message: 'Bukti pengerjaan berhasil dihapus', type: 'success');
        }
    }

    public function showOrderDetail($orderId)
    {
        $this->selectedOrder = Order::with(['items.service.seller', 'user'])->findOrFail($orderId);
        $this->showDetailModal = true;
    }

    public function closeDetailModal()
    {
        $this->showDetailModal = false;
        $this->selectedOrder = null;
    }

    public function render()
    {
        return view('livewire.seller.pesanan');
    }
}
