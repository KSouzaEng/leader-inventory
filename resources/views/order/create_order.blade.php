@extends('layouts.app')
@section('title','Create Order')

@section('content')

@if(session('error'))
<div hidden class="alert alert-danger d-flex align-items-center alert-dismissible fade show mt-3" role="alert" >
  <i class="fas fa-times-circle flex-shrink-0 me-2"></i>
  <div class="d-flex">
    {{ session('error') }}
  </div>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="row">
    <div class="col-md-4 mt-5">
        <a href="{{ route('dashboard') }}" class="btn btn-dark btn-floating ">
            <i class="far fa-hand-point-left fa-lg" ></i>
          </a>
    </div>
    <div class="col-md-4 offset-md-4">  <x-navbar :username="auth()->user()->name"/></div>
</div>
<div class="cotainer mt-5">
    
    <div class="row justify-content-center">
        <div class="col-md-5">
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
                            <label for="quantity_in_stock" class="form-label">Product in stock :</label>
                            <input type="text" class="form-control" id="quantity_in_stock"  @disabled(true) >
                            <p hidden class="text-danger mt-1" id="praragraph">No product in stock</p>
                            <p hidden class="text-danger mt-1" id="low">Low stock</p>
                          </div>  
                        <div class="col-md-6 mb-3">
                            <label for="quantity_product_order" class="form-label">Quantity:</label>
                            <input type="text" class="form-control" id="quantity_product_order" name="quantity_product_order" onkeyup="Soma()" required>
                        </div>
                        <div class="col-md-6">
                            <label for="qtd" class="form-label">Total:</label>
                            <input type="text" class="form-control" id="total" name="total" required>
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
                document.getElementById("quantity_in_stock").value = x[index]['quantity_in_stock'];

                var stock = x[index]['quantity_in_stock'];
                let p = document.getElementById('praragraph');
                let p2 = document.getElementById('low');
                console.log(stock);
                if (stock == 0 ) {
               
                    p.removeAttribute("hidden");
                }else if(stock <= 10){
                    p2.removeAttribute("hidden");
                }
            }
          
        }

    }
    function Soma(){
          var qtd =  document.getElementById("quantity_product_order").value;
          var price =  document.getElementById("price").value;

          var soma = qtd * price;
        //   formatValue = new Intl.NumberFormat('en-IN', { maximumSignificantDigits: 3 }).format(soma);
          document.getElementById("total").value = soma;
     
          
        }
</script>
@endsection
