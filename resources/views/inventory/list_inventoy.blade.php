
@extends('layouts.app')
@section('title','List Inventory')


@section('content')
<div class="row">
  <div class="col-md-4 mt-5">
      <a href="{{ route('dashboard') }}" class="btn btn-dark btn-floating">
        <i class="far fa-hand-point-left fa-lg" ></i>
        </a>
  </div>
  
  <div class="col-md-4 offset-md-4">  <x-navbar :username="auth()->user()->name"/></div>
</div>
  
@if(session('success'))
<div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
  <i class="fas fa-check-circle flex-shrink-0 me-2"></i>
  <div class="d-flex">
   {{ session('success') }}
  </div>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(session('msg'))
<div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
  <i class="fas fa-check-circle flex-shrink-0 me-2"></i>
  <div class="d-flex">
   {{ session('msg') }}
  </div>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="container">
 <table class="table  table-hover mt-5">
   <thead>
     <tr>
       <th>Product Name</th>
       <th>Quantity in stock</th>
       <th id="th">Price</th>
       <th>Actions</th>
     </tr>
   </thead>
   <tbody>
     @foreach ($products as $product)

     <tr>
       <td>{{ $product->name }}</td>
       <td >{{ $product->quantity_in_stock }}</td>
       <td>{{ $product->price_per_unit }}</td>
   
       <td> 
        <div class="row">
          <div class="col-sm-2">
            <a class="btn btn-warning btn-floating" type="button" href="{{route('product',"$product->id")}}" data-mdb-toggle="tooltip" title="UPADATE"><i class="fas fa-edit"></i></a>
           </div>
           <div class="col-sm-4">
            <form action="/delete/product/{{ $product->id }}" method="post" >
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger btn-floating"  data-mdb-toggle="tooltip" title="DELETE"><i class="fas fa-trash "></i></button>
              </form>
         </div>
         </td>
     </tr>
     @endforeach

   </tbody>
 </table>

 
 <div class="d-flex justify-content-center mt-3 pagination pagination-circle">
  {!! $products->links() !!}
</div>
</div>

@endsection