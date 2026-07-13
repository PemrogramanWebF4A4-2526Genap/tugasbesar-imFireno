<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * View the invoice for an order in browser.
     */
    public function view(Order $order)
    {
        // Ensure the authenticated user owns this order
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke invoice ini.');
        }

        // Only allow viewing for paid orders (success, confirmed, completed)
        if (!in_array($order->status, ['success', 'confirmed', 'completed'])) {
            abort(404, 'Invoice belum tersedia untuk pesanan ini.');
        }

        // Load relationships
        $order->load('items.service.seller', 'user');

        return view('pdf.invoice', ['order' => $order]);
    }

    /**
     * Download the invoice PDF for an order.
     */
    public function download(Order $order)
    {
        // Ensure the authenticated user owns this order
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke invoice ini.');
        }

        // Only allow downloads for paid orders (success, confirmed, completed)
        if (!in_array($order->status, ['success', 'confirmed', 'completed'])) {
            abort(404, 'Invoice belum tersedia untuk pesanan ini.');
        }

        // Load relationships
        $order->load('items.service.seller', 'user');

        $pdf = Pdf::loadView('pdf.invoice', ['order' => $order]);

        return $pdf->download('Invoice-ORD-' . str_pad($order->id, 5, '0', STR_PAD_LEFT) . '.pdf');
    }
}
