<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(){

        $products = Product::get();
        $username = Auth::user()->name;
  
        return view('order.create_order',compact('products','username'));
    }
    public function create(Request $request){

      $total = $request->price * $request->qtd;
      $order_code = rand();
   

      $order = Order::create([
        "product_id" => $request->product_id,
        "order_code" => $order_code,
        "quantity_product_order" => $request->qtd,
        "total_order" => $total
      ]);

      $orders = Order::orderBy('id','desc')->with('products')->get();
      $username = Auth::user()->name;
      return view('order.list_orders',compact('orders','username'));
    }
    public function show(){
        $orders = Order::orderBy('id','desc')->with('products')->get();
        $username = Auth::user()->name;
  
        return view('order.list_orders',compact('orders','username'));
    }
}
