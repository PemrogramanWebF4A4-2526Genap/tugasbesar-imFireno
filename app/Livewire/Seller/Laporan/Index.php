<?php

namespace App\Livewire\Seller\Laporan;

use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $sellerId = Auth::id();
        
        // Fetch order items that belong to the current seller's services
        $orderItems = OrderItem::whereHas('service', function($query) use ($sellerId) {
            $query->where('seller_id', $sellerId);
        })
        ->with(['order', 'service'])
        ->latest()
        ->get();

        // Calculate total revenue from completed/paid orders
        $totalPendapatan = OrderItem::whereHas('service', function($query) use ($sellerId) {
            $query->where('seller_id', $sellerId);
        })
        ->whereHas('order', function($query) {
            $query->where('status', 'PAID')->orWhere('status', 'COMPLETED');
        })
        ->sum('price');
        
        // Count total completed orders
        $totalPesananSelesai = OrderItem::whereHas('service', function($query) use ($sellerId) {
            $query->where('seller_id', $sellerId);
        })
        ->whereHas('order', function($query) {
            $query->where('status', 'PAID')->orWhere('status', 'COMPLETED');
        })
        ->count();

        return view('livewire.seller.laporan.index', [
            'orderItems' => $orderItems,
            'totalPendapatan' => $totalPendapatan,
            'totalPesananSelesai' => $totalPesananSelesai
        ]);
    }
}
