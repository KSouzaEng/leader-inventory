@extends('layouts.app')
@section('title','Dashboard')

@section('content')
  <x-navbar :username="auth()->user()->name"/>  

  <div class="row mt-5 d-flex justify-content-center">
    <div class="col-sm-4">
      <a  href="{{ route('form-order') }}">
      <div class="card text-white bg-dark mb-3" >
        <div class="card-body">
          <h5 class="card-title text-center mt-5 mb-5 ">NEW ORDER</h5>
        </div>
      </div>
    </a>
    </div>
    <div class="col-sm-4">
      <a  href="{{ route('list-order') }}">
      <div class="card text-white bg-dark mb-3">
        <div class="card-body">
          <h5 class="card-title text-center mt-5 mb-5">ORDER LIST</h5>
        </div>
      </div>
      </a>
    </div>
  </div>
  <div class="row mt-3 d-flex justify-content-center">
    <div class="col-sm-4">
      <a  href="{{ route('list-inventory') }}">
      <div class="card text-white bg-dark mb-3">
        <div class="card-body">
          <h5 class="card-title text-center mt-5 mb-5">INVENTORY</h5>
        </div>
      </div>
      </a>
    </div>
    <div class="col-sm-4">
      <a  href="{{ route('form-inventory') }}">
      <div class="card text-white bg-dark mb-3">
        <div class="card-body">
          <h5 class="card-title text-center mt-5 mb-5">ADD PRODUCT</h5>
        </div>
      </div>
      </a>
    </div>
  </div>


@endsection
