@extends('layouts.app')
@section('title','Create Order')
<x-navbar :username="auth()->user()->name" class="mb-5" :back="true" :order="false"/>
@section('content')

@if(session('error'))
<div hidden class="alert alert-danger d-flex align-items-center alert-dismissible fade show mt-3" role="alert" >
  <i class="fas fa-times-circle flex-shrink-0 me-2"></i>
  <div class="d-flex">
    {{ session('error') }}
  </div>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

   

<div class="cotainer mt-5">
    
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-4 shadow-6 fw-bold">
                <h3 class="card-header text-center">Create Order Form</h3>
                <div class="card-body">
                  
                    <form class="row g-3" method="POST" action="{{ route('save') }}">
                        @csrf

                                <div class="col-md-12 mb-3">
                                    <label for="customer_name" class="form-label " >Customer Name <span class="text-danger">*</span>:</label>
                                    <input type="text" class="form-control" id="customer_name" name="customer_name"  required>
                                </div>
                                <div class="col-md-12 mb-4">
                                    <label for="customer_email" class="form-label">Customer Email <span class="text-danger">*</span>:</label>
                                    <input type="email" class="form-control" id="customer_email" name="customer_email"   required>
                                </div>
                                <table class="table" id="products_table">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr id="product0">
                                            <td>
                                                <select name="products[]" class="form-control" id="products">
                                                    <option value="">-- choose product --</option>
                                                    @foreach ($products as $product)
                                                        <option value="{{ $product->id }}">
                                                            {{ $product->name }} 
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" name="quantities[]" class="form-control"   id="quantity"/>
                                            </td>
                                            <td>

                                                <input type="text" name="prices[]" class="form-control"  id="price"  />
                                                
                                            </td>
                                            <td>
                                                <input type="number" name="total[]" class="form-control" value="1" id="quantities" />
                                            </td>
                                        </tr>
                                        <tr id="product1"></tr>
                                    </tbody>
                                </table>
                    
                                <div class="row ">
                                    <div class="col-md-12 ">
                                        <button id="add_row" class="btn btn-default pull-left">+ Add Row</button>
                                        <button id='delete_row' class="pull-right btn btn-danger justify-content-end">- Delete Row</button>
                                    </div>
                                </div>
                         
                  
                        {{-- <div class="col-12">
                            <label for="quantity_in_stock" class="form-label">Product in stock :</label>
                            <input type="text" class="form-control" id="quantity_in_stock"  @disabled(true) >
                            <p hidden class="text-danger mt-1" id="praragraph">No product in stock</p>
                            <p hidden class="text-danger mt-1" id="low">Low stock</p>
                          </div>   --}}
                        {{-- <div class="col-md-6">
                            <label for="qtd" class="form-label">Total:</label>
                            <input type="text" class="form-control" id="total" name="total" required>
                        </div>
                         --}}
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-dark ">Save Order</button>
                        </div>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
    let row_number = 1;
    $("#add_row").click(function(e){
      e.preventDefault();
      let new_row_number = row_number - 1;
      $('#product' + row_number).html($('#product' + new_row_number).html()).find('td:first-child');
      $('#products_table').append('<tr id="product' + (row_number + 1) + '"></tr>');
      row_number++;
    });

    $("#delete_row").click(function(e){
      e.preventDefault();
      if(row_number > 1){
        $("#product" + (row_number - 1)).html('');
        row_number--;
      }
    });
  });
</script>
@endsection
