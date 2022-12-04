@extends('layouts.app')
@section('title','Order List')

@section('content')
<x-navbar :username="$username"/>
@foreach ($orders as $order)
@foreach ($order->products as $product)
<h3>{{ $product->name}}</h3>
<h4>{{ $order->quantity_product_order }}</h4>
<h4>{{ $order->total_order }}</h4>
@endforeach  
@endforeach
@endsection