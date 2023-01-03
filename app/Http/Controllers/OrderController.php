<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Events\EventNewOrder;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

      public function index(){
        $orders = Order::orderBy('id','desc')->with('products')->paginate(5);
        // $username = Auth::user()->name;

        return view('order.list_orders',compact('orders'));
    }

    public function formOrder(){

        $products = Product::get();
        // $username = Auth::user()->name;
  
        return view('order.create_order',compact('products'));
    }
    public function create(Request $request){

      $total = $request->price * $request->quantity_product_order;
      $order_code = rand();

      $quantityInStock = Product::where('id',$request->product_id)->first();
      $error = 'No product in stock';

      if ($quantityInStock->quantity_in_stock < $request->quantity_product_order || $quantityInStock->quantity_in_stock == 0 ) {
        return redirect('/form-order')->with('error',$error);
      }
        
      $order = Order::create([
        "product_id" => $request->product_id,
        "order_code" => $order_code,
        "quantity_product_order" => $request->quantity_product_order,
        "total_order" => $total
      ]);

      if ($order) {
       $qtdStpck = $quantityInStock->quantity_in_stock - $request->quantity_product_order;
        $product = Product::where('id',$request->product_id)->update(['quantity_in_stock' => $qtdStpck]);
        return Redirect('/list-order')->with('success','Order saved');
      }else {
        return redirect('/list-order')->with('error','Erro');
      }

    }
  
    public function show(int $id){

  
      $order = Order::where('id',$id)->with('products')->get();
      $products = Product::get();
      return view('order.edit',compact('order','products'));

    }
    public function update(Request $request,int $id){
      $orderDB = Order::where('id',$id)->with('products')->get();
      // dd($orderDB[0]->products[0]->quantity_in_stock);

      if ($orderDB[0]->products[0]->quantity_in_stock < $request->quantity_product_order || $orderDB[0]->products[0]->quantity_in_stock  == 0 ) {
        return redirect('order.edit')->with('error','');
      }
  

      $order = Order::where('id',$id)->update([
        'product_id' => $request->product_id,
        'quantity_product_order' => $request->quantity_product_order,
        'total_order' => $request->total_order,
        'status' => $request->status,
      ]);

      if ($order) {
        $qtdStpck = $orderDB[0]->products[0]->quantity_in_stock - $request->quantity_product_order;
         $product = Product::where('id',$request->product_id)->update(['quantity_in_stock' => $qtdStpck]); 
         return redirect()->back()->with('status','Order Updated Successfully');
       }else {
         return redirect('/list-order')->with('error','Erro');
       }
 
  
    }

    public function updateStatus(int $id,string $status){
      $order = Order::where('id',$id)->update(['status' => $status]);

      if ($order) {
        return redirect('/list-order')->with('update','Status  updated!!');
      }

      return redirect('/list-order')->with('notUpadate','Status not updated!!');


    }

    public function destroy($id){

      Order::findOrFail($id)->delete();

       return redirect('/list-order')->with('msg','Order deleted!!');
   }

}
