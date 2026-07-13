<?php

namespace App\Http\Controllers\Pembeli;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class InvoiceController extends Controller
{
    public function show($id)
    {
        $order = Order::with(['items.service', 'user'])
            ->where('id', $id)
            ->where('user_id', auth()->id())
            ->where('status', 'success')
            ->firstOrFail();

        return view('pembeli.invoice.show', compact('order'));
    }
}
