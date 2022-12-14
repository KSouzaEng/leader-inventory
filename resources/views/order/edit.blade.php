@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">

            @if (session('status'))
                <h6 class="alert alert-success">{{ session('status') }}</h6>
            @endif

            <div class="card">
                <div class="card-header">
                    <h4>UPDATE ORDER
                        <a href="{{ route('list-order') }}" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">

                    <form action="{{ url('order/'.$order[0]->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-sm-2 mb-3 ">
                                <label for="" class="fw-bold">Order Code</label>
                                <input type="text" name="name" value="{{ $order[0]->order_code }}"  class="form-control " @disabled(true)>
                            </div>
                            <div class="col mb-3">
                                <label for="product_id" class="fw-bold">Product Name</label>
                                <select name="product_id" class="form-select text-capitalize" id="product_id" onchange="getValue({{ $products }})">
                                    @foreach ($products as $key => $product)
                                    <option  value="{{ $product->id }}" {{$order[0]->products[0]->id == $product->id  ? 'selected' : ''}} >
                                        {{ $product->name }}
                                    </option>
                                    @endforeach
                                   
                                </select>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-4 mb-3">
                                <label for="quantity_product_order" class="fw-bold">Quantity</label>
                                <input type="text" name="quantity_product_order" value="{{ $order[0]->quantity_product_order  }}" class="form-control" name="quantity_product_order">
                            </div>
                            <div class="col-sm-4 mb-3">
                                <label for="price" class="fw-bold">Price Unity</label>
                                <input type="text" name="price" value="{{ $order[0]->products[0]->price_per_unit }}"  class="form-control" id="price">
                            </div>
                            <div class="col-sm-4 mb-3">
                                <label for="quantity_in_stock" class="fw-bold">Quantity in Stock</label>
                                <input type="text" name="quantity_in_stock" value="{{ $order[0]->products[0]->quantity_in_stock }}"  class="form-control" id="quantity_product_order">
                            </div>
                            <div class="col-sm-4 mb-3">
                                <label for="total_order" class="fw-bold">Total Order</label>
                                <input type="text" name="total_order" value="{{ $order[0]->total_order }}"  class="form-control" id="total">
                            </div>
                            <div class="col mb-3">
                                <label for="status" class="fw-bold">Status</label>
                                <select name="status" class="form-select" id="status" >
                                    <option  value="{{ $order[0]->status }}"  >
                                        {{ $order[0]->status }}
                                    </option>
                                    <option value="PROGRESS">PROGRESS</option>
                                    <option value="CLOSED">CLOSED</option>
                                </select>
                            </div>
                        </div>
                      
                        <div class="d-grid gap-2 col-6 mx-auto">
                            <button class="btn btn-primary" type="submit">Button</button>
                          </div>

                    </form>

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
                    document.getElementById("price").value = x[index]['price_per_unit'];
                    document.getElementById("quantity_product_order").value = x[index]['quantity_in_stock'];
               
                }   
            }
    
        }
    </script>
</div>

@endsection