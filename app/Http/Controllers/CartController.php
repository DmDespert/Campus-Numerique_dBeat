<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        // Récupération des données du panier stockées en session
        $sessioncart = session('cart');
        $cart = [];
        foreach ($sessioncart as $id => $qty) {
            // Récupération de l'objet Product avec identifiant $id
            $product = Product::find($id);
            // Construction du panier
            $cart[] = [
                'product' => $product,
                'quantity' => $qty
            ];
        }
        // Je passe le panier à la vue
        return view('cart', ['cart' => $cart]);
    }

    /* public function index(Request $request)
    {
        $sessioncart = session()->get('cart');
        if (isset($sessioncart)) {
            foreach ($sessioncart as $request->id => $qt) {
                $product = Product::find($request->id);
                $cart[$request->id] = [
                    "product" => $product,
                    "quantity" => $qt,
                ];
            }
        }
        return view('cart', ['product' => $cart[$request->id]]);
    }
*/
    public function store(Product $product, Request $request)
    {
        $cart = session()->get('cart');
        $quantity = $request->input('quantity');

        if (isset($cart[$product->id])) {
            $cart[$product->id] += $quantity;
        }
        $cart[$product->id] = $quantity;
        session()->put('cart', $cart);
        return redirect()->route('cart.index');
    }
}

