<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use App\Product;

class CartController extends Controller
{
    public function getCart()
    {
        if (!Cart::count()) {
            return redirect()->route('index');
        }

    	return view('shop.cart');
    }

    public function postAddItem(Request $request, $id)
    {
    	$product = Product::find($id);
    	Cart::add($product->id, $product->name, 1, $product->price, ['size' => $request->size, 'image' => $product->images->first()->name]);

    	return redirect()->route('cart.show');
    }

    public function getIncreaseByOne($id)
    {
    	$item = Cart::search(function($cartItem) use ($id) {
            return $cartItem->id == $id;
        });

        $item = $item->first();
    	Cart::update($item->rowId, ++$item->qty);

    	return response()->json([
            'cartTotal' => Cart::subtotal(),
            'cartCount' => Cart::count(),
            'itemTotal' => $item->subtotal()
        ], 200);
    }

    public function getReduceByOne($id)
    {
    	$item = Cart::search(function($cartItem) use ($id) {
            return $cartItem->id == $id;
        });

        $item = $item->first();
        Cart::update($item->rowId, --$item->qty);

    	return response()->json([
            'cartTotal' => Cart::subtotal(),
            'cartCount' => Cart::count(),
            'itemTotal' => $item->subtotal()
        ], 200);
    }

    public function postUpdateQty(Request $request, $id)
    {
        $this->validate($request, [
            'qty' => 'required|integer'
        ]);

        $item = Cart::search(function($cartItem) use ($id) {
            return $cartItem->id == $id;
        });

        $item = $item->first();
        Cart::update($item->rowId, $request->qty);

        return response()->json([
            'cartTotal' => Cart::subtotal(),
            'cartCount' => Cart::count(),
            'itemTotal' => $item->subtotal()
        ], 200);
    }

    public function getRemoveItem($id)
    {
        $item = Cart::search(function($cartItem) use ($id) {
            return $cartItem->id == $id;
        });

        $item = $item->first();
        Cart::remove($item->rowId);

        return redirect()->route('cart.show');
    }
}
