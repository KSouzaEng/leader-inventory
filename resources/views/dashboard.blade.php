@extends('layouts.app')
@section('title','Dashboard')

@section('content')
  <x-navbar :username="$username"/>
  <div class="d-grid gap-4 col-4 mt-5 mx-auto">
    <a class="btn btn-dark" type="button" href="{{ route('create-order') }}">NEW ORDER</a>
    <a class="btn btn-dark" type="button">ORDER STATUS</a>
    <a class="btn btn-dark" type="button">INVENTORY</a>
  </div>
  

@endsection