@extends('layouts.app')
@section('title','Create Order')

@section('content')
<x-navbar :username="$username"/>
<div class="cotainer mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <h3 class="card-header text-center">Create Order Form</h3>
                <div class="card-body">
                    <form class="row g-3" method="POST" action="{{ route('save') }}">
                        @csrf
                        <div class="col-md-6">
                          <label for="ProductName" class="form-label">Product Name</label>
                          <select name="product_id" class="form-select" id="product_id" onchange="getValue({{ $products }})">
                            @foreach ($products as $key => $product)
                            <option  value="{{ $product->id }}"  >
                                {{ $product->name }}
                            </option>
                            @endforeach
                           
                        </select>
                        </div>
                        <div class="col-md-6">
                          <label for="price" class="form-label">Price:</label>
                          <input type="text" class="form-control" id="price" @disabled(true) >
                          <input type="hidden" id="hidden" name="price" >
                        </div>
                        <div class="col-12">
                            <label for="quantity_product_order" class="form-label">Product in stock :</label>
                            <input type="text" class="form-control" id="quantity_product_order"  @disabled(true) >
                          </div>  
                        <div class="col-12 mb-3">
                            <label for="qtd" class="form-label">Quantity:</label>
                            <input type="text" class="form-control" id="qtd" name="qtd" required>
                          </div>   
                        <div class="d-grid mx-auto">
                            <button type="submit" class="btn btn-dark btn-block">Save Order</button>
                        </div>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function getValue(x){
        var dop = document.getElementById("product_id").value;
        for (let index = 0; index < x.length; index++) {
            const element = x[index]['id'];
            if (element == dop) {
                document.getElementById("hidden").value = x[index]['price_per_unit'];
                document.getElementById("price").value = x[index]['price_per_unit'];
                document.getElementById("quantity_product_order").value = x[index]['quantity_in_stock'];
            }
        }

    }
</script>
@endsection
