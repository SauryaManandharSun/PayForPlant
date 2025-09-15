<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Product; 

class BuyController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function add($id)
    {
        $cart = Session::get('cart', []);

        $product = Product::find($id);

        if ($product) {
            if (isset($cart[$id])) {
                $cart[$id]['quantity'] += 1;
            } else {
                $cart[$id] = [
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => 1,
                    'image' => $product->image, // optional if you want image in cart
                ];
            }
        }

        Session::put('cart', $cart);

        return redirect()->route('cart.index');
    }

    public function increaseQuantity($id)
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += 1;
        }
        Session::put('cart', $cart);
        return redirect()->route('cart.index');
    }

    public function decreaseQuantity($id)
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] -= 1;
            if ($cart[$id]['quantity'] <= 0) {
                unset($cart[$id]);
            }
        }
        Session::put('cart', $cart);
        return redirect()->route('cart.index');
    }
}
