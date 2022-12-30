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
}
