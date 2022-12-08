<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

      public function index(){
        $orders = Order::orderBy('id','desc')->with('products')->get();
        // $username = Auth::user()->name;

        return view('order.list_orders',compact('orders'));
    }

    public function formOrder(){

        $products = Product::get();
        // $username = Auth::user()->name;
  
        return view('order.create_order',compact('products'));
    }
    public function create(Request $request){

      $total = $request->price * $request->qtd;
      $order_code = rand();

      $quantityInStock = Product::where('id',$request->product_id)->first();
      $error = 'Sem produtos em estoque ou estoque zerado';

      if ($quantityInStock->quantity_in_stock < $request->qtd || $quantityInStock->quantity_in_stock == 0 ) {
        return redirect('/form-order')->with('error',$error);
      }
        
      $order = Order::create([
        "product_id" => $request->product_id,
        "order_code" => $order_code,
        "quantity_product_order" => $request->qtd,
        "total_order" => $total
      ]);

      if ($order) {
       $qtdStpck = $quantityInStock->quantity_in_stock - $request->qtd;
        $product = Product::where('id',$request->product_id)->update(['quantity_in_stock' => $qtdStpck]); 
        return Redirect('/list-order');
      }else {
        return redirect('/form-order')->with('error','Erro');
      }

    }
  
    public function show(int $id){

  
      $order = Order::where('id',$id)->with('products')->get();
      dd($order);

    }

    public function updateStatus(int $id,string $status){
      dd($status);
      $product = Order::where('id',$request->id)->update(['status' => $status]);
      return redirect('/list-order');
    }

    public function destroy($id){

      Order::findOrFail($id)->delete();

       return redirect('/list-order')->with('msg','Order deleted!!');
   }

}
