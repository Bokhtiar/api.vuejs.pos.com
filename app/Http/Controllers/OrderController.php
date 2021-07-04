<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index(){
      $orders = Order::with('customer')->get();
      return response()->json($orders, 200);
    }

    public function store(Request $request)
    {
      $order=new Order;
      $order->customer_id = $request->customer_id;
      $order->total_price = $request->total;
      $order->due_price = $request->due_price;
      $order->user_id = $request->user_id;
      $order->save();

      $cart=Cart::where('user_id', $request->user_id)
                ->where('order_id',NULL)
                ->get();

        foreach($cart as $v_cart_item) {
                $v_cart_item['order_id']=$order->id;
                $v_cart_item->save();
        }
    return response()->json($order, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        $order = Cart::with('product')->where('order_id', $id)->get();
        return response()->json($order, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
