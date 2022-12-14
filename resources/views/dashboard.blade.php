@extends('layouts.app')
@section('title','Dashboard')

@section('content')
  <x-navbar :username="auth()->user()->name"/>
  
  <div class="d-grid gap-4 col-4 mt-5 mx-auto">
    <a class="btn btn-dark" type="button" href="{{ route('form-order') }}">NEW ORDER</a>
    <a class="btn btn-dark" type="button" href="{{ route('list-order') }}">ORDER LIST</a>
    <a class="btn btn-dark" type="button" href="{{ route('list-inventory') }}">INVENTORY</a>
  </div>


@endsection