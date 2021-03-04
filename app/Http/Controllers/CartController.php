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
        if (isset($sessioncart)) {
            foreach ($sessioncart as $id => $qty) {
                // Récupération de l'objet Product avec identifiant $id
                $product = Product::find($id);
                // Construction du panier
                $cart[] = [
                    'product' => $product,
                    'quantity' => $qty
                ];
            }
        }
        // Je passe le panier à la vue
        return view('cart', ['cart' => $cart]);
    }

    public function store(Product $product, Request $request)
    {
        $cart = session()->get('cart');
        $quantity = $request->input('quantity');

        if (isset($cart[$product->id])) {
            $cart[$product->id] += $quantity;
        } else {
            $cart[$product->id] = $quantity;
        }
        session()->put('cart', $cart);
        return redirect()->route('cart.index');
    }

    //public function update(Request $request)
    //{
    //    if ($request->id and $request->quantity) {
    //        $cart = session()->get('cart');
    //        $cart[$request->id]["quantity"] = $request->quantity;
    //        session()->put('cart', $cart);
    //        session()->flash('success', 'Cart updated successfully');
    //    }
    //}

    public function destroy(Product $product)
    {
            $cart = session()->get('cart');
            if (isset($cart[$product->id])) {
                unset($cart[$product->id]);
                session()->put('cart', $cart);
            }
        return redirect()->route('cart.index');
        }
    }

