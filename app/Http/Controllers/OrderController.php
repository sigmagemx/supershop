<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Cart;
use App\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        return view('admin.orders', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Cart::count()) {
            return redirect()->route('cart.show');
        }

        return view('shop.checkout');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'delivery' => 'required|integer',
            'comment' => 'max:255'
        ]);

        if (!Cart::count()) {
            return redirect()->route('cart.show');
        }

        $order = Auth::user()->orders()->create([
            'total' => Cart::subtotal('2', '.', ''),
            'delivery_id' => $request->delivery,
            'comment' => $request->comment
        ]);

        foreach (Cart::content() as $item) {
            $order->orderItems()->create([
                'product_id' => $item->id,
                'qty' => $item->qty
            ]);
        }

        Cart::destroy();

        return view('shop.checkout-done', ['order' => $order]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        return view('admin.order-info', ['order' => $order]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'itemId' => 'required|integer'
        ]);

        $order = Order::find($id);
        $orderItem = $order->orderItems()->find($request->itemId);
        $order->total -= $orderItem->product->price * $orderItem->qty;
        $order->save();
        $orderItem->delete();
        
        return redirect()->route('orders.show', ['id' => $order->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        $order->orderItems()->delete();
        $order->delete();

        return redirect()->route('orders.index');
    }

    public function updateStatus(Request $request, $id)
    {
        $this->validate($request, [
            'status' => 'required'
        ]);

        $order = Order::find($id);
        $order->status = ucfirst(strip_tags($request->status));
        $order->save();
        
        return 'ok';
    }
}
