<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Events\EventNewOrder;
use Illuminate\Support\Facades\Auth;
use App\Events\NewOrder;

class OrderController extends Controller
{

      public function index(){

        $orders = Order::with('products')->paginate(2);
        // dd($orders);

        return view('order.list_orders',compact('orders'));
    }

    public function formOrder(){

        $products = Product::get();
        // $username = Auth::user()->name;
  
        return view('order.create_order',compact('products'));
    }
    public function create(Request $request){
      // dd($request->all());


      // $total = $request->price * $request->quantity_product_order;
      $order_code = rand();

      // $quantityInStock = Product::where('id',$request->product_id)->first();
      // $error = 'No product in stock';

      // if ($quantityInStock->quantity_in_stock < $request->quantity_product_order || $quantityInStock->quantity_in_stock == 0 ) {
      //   return redirect('/form-order')->with('error',$error);
      // }

      // $p = array();

      // foreach($request->product_id as $key => $product) {
      //   array_push($p,$product);
      // }
        
  
    // dd($order->id);
    $order = Order::create($request->all());

    $products = $request->input('products', []);
    $quantities = $request->input('quantities', []);
    $prices = $request->input('prices', []);
    $total = $request->input('total', []);
    for ($product=0; $product < count($products); $product++) {
        if ($products[$product] != '') {
            $order->products()->attach($products[$product], 
            [
            'quantity_product_order' => $quantities[$product],
             'price' =>$prices[$product],
             'total' =>$total[$product]
          ]);
          $orderFind = Order::find($order->id);
          broadcast(new NewOrder($orderFind));
        }
    }

    return Redirect('/list-order')->with('success','Order saved');

      // if ($order) {
      //  $qtdStpck = $quantityInStock->quantity_in_stock - $request->quantity_product_order;
      //   $product = Product::where('id',$request->product_id)->update(['quantity_in_stock' => $qtdStpck]);
      //   $orderFind = Order::find($order->id) ;
      //   broadcast(new NewOrder($orderFind));
      //   return Redirect('/list-order')->with('success','Order saved');
      // }else {
      //   return redirect('/list-order')->with('error','Erro');
      // }

    }
  
    public function show(int $id){

  
      $order = Order::where('id',$id)->with('products')->get();
      $products = Product::get();
      return view('order.edit',compact('order','products'));

    }
    public function update(Request $request,int $id){
  
      $orderDB = Order::where('id',$id)->with('products')->get();

      // foreach ($orderDB[0]->products as $key => $value) {
      //   if ($value->quantity_in_stock < $request->quantities[$key]) {
      //     return redirect('/list-order')->with('error','Low Stock');
      //   }
      // }


      $order = Order::where('id',$id)->update([
        'customer_name' => $request->customer_name,
        'customer_email' => $request->customer_email,
        'status' => $request->status,
      ]);
      $orderDetach = Order::find($id);
      $orderDetach->products()->detach();
      $products = $request->input('products', []);
      $quantities = $request->input('quantities', []);
      $prices = $request->input('prices', []);
      $total = $request->input('total', []);
      for ($product=0; $product < count($products); $product++) {
          if ($products[$product] != '') {
              $orderDetach->products()->attach($products[$product], 
              [
              'quantity_product_order' => $quantities[$product],
              'price' =>$prices[$product],
              'total' =>$total[$product]
            ]);
            $orderFind = Order::find($id);
            broadcast(new NewOrder($orderFind));
          }
      }

      if ($order) {
        
         foreach ($orderDB[0]->products as $key => $value) {
          $test_value = $value->id;
          $ids = explode(',',$test_value);

            $qtdStpck = $value->quantity_in_stock - $request->quantities[$key];
            // dd($qtdStpck);
            $product = Product::whereIn('id',$ids)->update(['quantity_in_stock' => $qtdStpck]); 
          
        }
         return redirect('/list-order')->with('status','Order Updated Successfully');
       }else {
         return redirect('/list-order')->with('error','Erro');
       }
 
  
    }

    public function updateStatus(int $id,string $status){
      $order = Order::where('id',$id)->update(['status' => $status]);
    

      if ($order) {
        $orderFind = Order::find($id) ;
        broadcast(new NewOrder($orderFind));
        return redirect('/list-order')->with('update','Status  updated!!');
      }

      return redirect('/list-order')->with('notUpadate','Status not updated!!');


    }

    public function destroy($id){

      // Order::findOrFail($id)->delete();
      $order = Order::find($id);
      $order->products()->detach();
      $order->delete();

       return redirect('/list-order')->with('msg','Order deleted!!');
   }

}
