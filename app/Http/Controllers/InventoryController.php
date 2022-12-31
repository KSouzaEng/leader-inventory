<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    public function index(){

        $products = Product::paginate(5);
        $username = Auth::user()->name;

        return view('inventory.list_inventoy',compact('products','username'));
    }

    public function formInventory(){

        return view('inventory.create_product');
    }

    public function create(Request $request){


        $product = Product::create([
            "name" => $request->name,
            "quantity_in_stock" => $request->quantity_in_stock,
            "price_per_unit" => $request->price_per_unit
          ]);

          if ($product) { 
             return Redirect('/list-inventory')->with('success','Product Saved');
           }else {
             return redirect('/list-inventory')->with('error','Erro');
           }
    }
    public function show(int $id){

        $product = Product::where('id',$id)->get();
        return view('inventory.edit',compact('product'));
    }

    public function update(Request $request,int $id){

        $product = Product::where('id',$id)->update([
            'name' => $request->name,
            'quantity_in_stock' => $request->quantity_in_stock,
            'price_per_unit' => $request->price_per_unit,
        ]);

        if ($product) { 
            return redirect('/list-inventory')->with('success','Product Updated Successfully');
           }else {
             return redirect('/list-inventory')->with('error','Erro');
           }
    }

    public function destroy($id){

        Product::findOrFail($id)->delete();
  
         return redirect('/list-inventory')->with('msg','Product deleted!!');
    }
}
