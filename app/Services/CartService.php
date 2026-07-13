<?php

namespace App\Services;

use App\Models\Service;

class CartService
{
    /**
     * Add a service to the cart
     */
    public static function add($serviceId)
    {
        $service = Service::with('seller')->find($serviceId);

        if (!$service) {
            return ['success' => false, 'message' => 'Jasa tidak ditemukan'];
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$serviceId])) {
            return ['success' => false, 'message' => 'Jasa sudah ada di keranjang'];
        }

        $cart[$serviceId] = [
            'id' => $service->id,
            'name' => $service->name,
            'price' => $service->price,
            'thumbnail' => $service->thumbnail,
            'seller_name' => $service->seller ? $service->seller->name : 'Unknown',
            'duration' => $service->duration,
        ];

        session()->put('cart', $cart);

        return ['success' => true, 'message' => 'Jasa berhasil ditambahkan ke keranjang'];
    }

    /**
     * Get all items in the cart
     */
    public static function get()
    {
        return session()->get('cart', []);
    }

    /**
     * Get the total price of all items in the cart
     */
    public static function total()
    {
        $cart = session()->get('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'];
        }

        return $total;
    }

    /**
     * Remove an item from the cart
     */
    public static function remove($serviceId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$serviceId])) {
            unset($cart[$serviceId]);
            session()->put('cart', $cart);
        }
    }

    /**
     * Clear the cart
     */
    public static function clear()
    {
        session()->forget('cart');
    }
}
