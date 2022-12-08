@extends('layouts.app')
@section('title','Order List')

@section('content')
@php
   $status = false; 
@endphp
<x-navbar :username="auth()->user()->name"/>
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

    <table class="table  table-hover mt-5">
      <thead>
        <tr>
          <th>Order Code</th>
          <th>Product Name</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($orders as $order)
        @foreach ($order->products as $product)
        <tr>
          <td>{{ $order->order_code }}</td>
          <td>{{ $product->name }}</td>
          <td >{{ $order->status }}</td>
          <td> 
             <div class="d-grid gap-2 d-md-block">
                <a class="btn" type="button" href="{{route('order',"$order->id")}}">DETAILS</a>
                <a class="btn " type="button" href="{{route('destroy',"$order->id")}}">DELETE</a>
              </div>
            </td>
        </tr>
        @endforeach
        @endforeach
      </tbody>
    </table>
@endsection   
