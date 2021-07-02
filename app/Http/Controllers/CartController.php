<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
  public function index($id){
    $carts = Cart::where('user_id', $id)->where('order_id', null)->with('product')->get();
    return response()->json($carts, 200);
  }
    public function store(Request $request){
        $cart = new Cart;
        $cart->user_id =$request->user_id;
        $cart->product_id = $request->id;
        $cart->save();
        return response()->json($cart, 200);
    }

    public function delete($id){
      $cart = Cart::find($id)->delete();
      return response()->json($cart, 200);
    }
}
