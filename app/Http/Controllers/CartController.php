<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        return view('cart');
    }

    public function store(Product $product, Request $request)
    {
        $cart = session()->get('cart');
        $quantity = $request->input('quantity');

        if (!$cart) {
            $cart[$product->id] = 1;
        } elseif (isset($cart[$product->id])) {
            $cart[$product->id]+=$quantity;
        }
        session()->put('cart', $cart);
        return redirect()->route('cart.index');
    }
}
