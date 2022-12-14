
@extends('layouts.app')
@section('title','Create Order')


<x-navbar :username="auth()->user()->name"/>

@section('content')
  
@if(session('msg'))
<div class="alert alert-success d-flex justify-content-center" role="alert">
 <div class="col-md-2">
     <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
         <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
       </svg> 
 </div>   
<div class="col-md-2">
 <h4>{{ session('msg') }}</h4>
</div>

</div>
@endif
<div class="container">
 <table class="table  table-hover mt-5">
   <thead>
     <tr>
       <th>Product Name</th>
       <th>Quantidade em estoque</th>
       <th id="th">Change Status</th>
       <th>Actions</th>
     </tr>
   </thead>
   <tbody>
     @foreach ($products as $product)

     <tr>
       <td>{{ $product->name }}</td>
       <td >{{ $product->quantity_in_stock }}</td>
       <td>
        <div class="btn-group">
          <button
           type="button"
           class="btn btn-primary dropdown-toggle dropdown-toggle-split"
           data-mdb-toggle="dropdown"
           aria-expanded="false"
          >
           <span class="visually-hidden">Toggle Dropdown</span>
          </button>
          {{-- <ul class="dropdown-menu">
           <li><a class="dropdown-item"  href="order/update/{{ $order->id }}/OPEN">OPEN</a></li>
           <li><a class="dropdown-item" href="order/update/{{ $order->id }}/PROGRESS">PROGRESS</a></li>
           <li><a class="dropdown-item" href="order/update/{{ $order->id }}/CLOSED">CLOSED</a></li>
          </ul> --}}
          </div>
         
       </td>
       <td> 
          <div class="d-grid gap-2 d-md-block">

             <a class="btn btn-warning" type="button" href=""><i class="fas fa-exchange-alt"></i>  UPDATE</a>
             <a class="btn btn-danger" type="button" href=""><i class="fas fa-trash"></i>  DELETE</a>
           </div>
         </td>
     </tr>
     @endforeach

   </tbody>
 </table>

 

</div>

@endsection