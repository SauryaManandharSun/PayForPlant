<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        $grandTotal = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        return view('checkout.index', compact('cart', 'grandTotal'));
    }

    public function place(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        $grandTotal = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        // Create order
        $order = Order::create([
            'user_id' => Auth::id(),
            'total_amount' => $grandTotal,
            'payment_status' => 'pending',
            'payment_method' => 'esewa',
        ]);

        foreach ($cart as $treeId => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'tree_id' => $treeId,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        session()->forget('cart');

        return redirect()->route('orders.show', $order->id)->with('success', 'Order placed successfully! Please complete payment via eSewa.');
    }
}
