@extends('layouts.app')
@section('title','Create Product')
<x-navbar :username="auth()->user()->name" class="mb-5" :back="true" :order="false"/>
@section('content')


        @if(session('error'))
        <div class="alert alert-danger d-flex justify-content-center" role="alert">
                <h4>{{ session('error') }}</h4>
        </div>
        @endif
 
<div class="cotainer mt-5">
    
    <div class="row justify-content-center py-5">
        <div class="col-md-5">
            <div class="card">
                <h3 class="card-header text-center">Add Product</h3>
                <div class="card-body">
                    <form class="row g-3" method="POST" action="{{ route('save-product') }}">
                        @csrf
                        <div class="col-md-6">
                            <label for="name" class="form-label">Product Name:</label>
                            <input type="text" class="form-control p-2" id="name" name="name">
                          </div>
                        <div class="col-md-6">
                          <label for="price_per_unit" class="form-label">Price:</label>
                          <input type="text" class="form-control p-2" id="price_per_unit" name="price_per_unit" onKeyUp="mascaraMoeda(this, event)"  value="">
                        </div>
                        <div class="col-12 mt-3 mb-3">
                            <label for="quantity_in_stock" class="form-label">Product in stock :</label>
                            <input type="text" class="form-control p-2" id="quantity_in_stock"  name="quantity_in_stock">
                          </div>  
                        
                        <div class="d-grid mx-auto">
                            <button type="submit" class="btn btn-dark btn-block p-3 bg-primary bg-gradient">Save Product</button>
                        </div>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    String.prototype.reverse = function(){
  return this.split('').reverse().join(''); 
};

function mascaraMoeda(campo,evento){
  var tecla = (!evento) ? window.event.keyCode : evento.which;
  var valor  =  campo.value.replace(/[^\d]+/gi,'').reverse();
  var resultado  = "";
  var mascara = "##.###.###.##".reverse();
  for (var x=0, y=0; x<mascara.length && y<valor.length;) {
    if (mascara.charAt(x) != '#') {
      resultado += mascara.charAt(x);
      x++;
    } else {
      resultado += valor.charAt(y);
      y++;
      x++;
    }
  }
  campo.value = resultado.reverse();
}
</script>
@endsection
