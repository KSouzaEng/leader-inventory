@extends('layouts.app')
@section('title','Dashboard')
<x-navbar :username="auth()->user()->name"  :back="false" :order="false"/>
@section('content')


  {{-- <div class="row mt-5 py-5 d-flex justify-content-center">
    <div class="col-sm-4">
      <a  href="{{ route('form-order') }}">

          <h5 class="card-title text-center mt-5 mb-5 ">NEW ORDER</h5>
      
      </div>
    </a>
    </div>
    <div class="col-sm-4">
      <a  href="{{ route('list-order') }}">
 
          <h5 class="card-title text-center mt-5 mb-5">ORDER LIST</h5>
     
      </a>
    </div>


    <div class="col-sm-4">
      <a  href="{{ route('list-inventory') }}">
 
          <h5 class="card-title text-center mt-5 mb-5">INVENTORY</h5>
   
      </a>
    </div>
    <div class="col-sm-4">
      <a  href="{{ route('form-inventory') }}">
  
          <h5 class="card-title text-center mt-5 mb-5">ADD PRODUCT</h5>
  
      </a>
  </div> --}}
  <div class="cotainer mt-5 py-2 ">
  <div class="row py-5 justify-content-center">
    {{-- <div class="card d-flex" style="width: 30rem;height:42em"> --}}
      <ul class="list-group list-group-light list-group-small " style="width: 60rem;height:42em">
        <a  href="{{ route('form-order') }}" class=" hover-overlay hover-zoom hover-shadow ripple mt-3">
        <li class="list-group-item px-3  fs-5 rounded-5 ">
       
            
            <h5 class="card-title mb-5 text-center mt-5 "><i class="fas fa-file-signature text-success"></i> NEW ORDER</h5>
   
        </li>
      </a>
        <a  href="{{ route('list-order') }}" class="hover-overlay hover-zoom hover-shadow ripple mt-3">
        <li class="list-group-item px-3  fs-5 rounded-5">
        
 
            <h5 class="card-title mb-5 text-center mt-5">  <i class="fas fa-list-ol text-warning"></i> ORDER LIST</h5>
           
       
      
        </li>
      </a>  
      <a  href="{{ route('list-inventory') }}" class="hover-overlay hover-zoom hover-shadow ripple mt-3">
        <li class="list-group-item px-3 text-center fs-5 rounded-5">
      
 
            <h5 class="card-title mb-5 text-center mt-5"><i class="fas fa-archive text-primary"></i> INVENTORY</h5>
     

        </li>
      </a>
      <a  href="{{ route('form-inventory') }}" class="hover-overlay hover-zoom hover-shadow ripple mt-3">
        <li class="list-group-item px-3 text-center fs-5 rounded-5">
    
  
            <h5 class="card-title mb-5 text-center mt-5"><i class="fas fa-cart-plus text-danger"></i> ADD PRODUCT</h5>
  
        </li>
      </a>
      </ul>


  </div>
  </div>

@endsection
