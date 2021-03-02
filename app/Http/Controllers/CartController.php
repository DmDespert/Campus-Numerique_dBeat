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

    public function addToCart($id)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart');

        if(!$cart) {

            $cart = [
                $id => [
                    "title" => $product->title,
                    "quantity" => 1,
                    "price" => $product->price
                ]
            ];
            session()->put('cart', $cart);
        }
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;

            session()->put('cart', $cart);
        }

        $cart[$id] = [
            "title" => $product->title,
            "quantity" => 1,
            "price" => $product->price,
        ];
        session()->put('cart', $cart);
    }
}
