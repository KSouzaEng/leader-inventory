@extends('layouts.app')
@section('title','Order List')

@section('content')
<x-navbar :username="$username"/>
@foreach ($products as $product)

<h3>{{ $product->name}}</h3>

@endforeach
@endsection