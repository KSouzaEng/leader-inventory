@extends('layouts.app')
<x-navbar :username="auth()->user()->name" :back="true" :order="false"/>
@section('content')

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">

                @if (session('status'))
                    <h6 class="alert alert-success">{{ session('status') }}</h6>
                @endif

                <div class="card">
                    <div class="card-header text-center">
                        <h4>UPDATE ORDER
                           
                        </h4>
                    </div>
                    <div class="card-body">

                        <form action="{{ url('order/' . $order[0]->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="col-md-12 mb-3">
                                <label for="customer_name" class="form-label ">Customer Name <span
                                        class="text-danger">*</span>:</label>
                                <input type="text" class="form-control" id="customer_name" name="customer_name" value="{{ $order[0]->customer_name }}" required>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label for="customer_email" class="form-label">Customer Email <span
                                        class="text-danger">*</span>:</label>
                                <input type="email" class="form-control" id="customer_email" name="customer_email"
                                value="{{ $order[0]->customer_email }}"   required>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label for="status" class="form-label">Status<span
                                        class="text-danger">*</span>:</label>
                                <input type="text" class="form-control" id="status" name="status"
                                value="{{ $order[0]->status }}"   required>
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
                                    @foreach($order[0]->products as $item)
                                    <tr id="product0">
                                        <td>
                                            <select name="products[]" class="form-control"
                                                onchange="getValue({{ $products }})">
                                                <option value="">-- choose product --</option>
                                                @foreach ($products as $product)
                                                <option value="{{ $product->id }}"
                                                    @if (old('products.' . $loop->parent->index, optional($item)->id) == $product->id) selected @endif
                                                >{{ $product->name }} </option>
                                            @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" name="quantities[]" class="form-control quantities" value="{{ $item->pivot->quantity_product_order }}" />
                                        </td>
                                        <td>

                                            <input type="text" name="prices[]" class="form-control prices" id="price"   value="{{ $item->pivot->price }}"/>

                                        </td>
                                        <td>
                                            <input type="text" name="total[]" class="form-control total" 
                                            value="{{ $item->pivot->total }}"  id="quantities" />
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr id="product1"></tr>
                                </tbody>
                            </table>

                            <div class="row ">
                                <div class="col-md-12 ">
                                    <button id="add_row" class="btn btn-default pull-left">+ Add Row</button>
                                    <button id='delete_row' class="pull-right btn btn-danger justify-content-end">- Delete
                                        Row</button>
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
        <script>
      
      $(document).ready(function() {
            let row_number = 1;
            $("#add_row").click(function(e) {
                e.preventDefault();
                let new_row_number = row_number - 1;
                $('#product' + row_number).html($('#product' + new_row_number).html()).find(
                    'td:first-child');
                $('#products_table').append('<tr id="product' + (row_number + 1) + '"></tr>');
                row_number++;

                $("table tbody tr input").on('input', function() {
                let total = 0;
                $("table tbody tr").each(function() {
                    const price = +$(this).find(".quantities").val()
                    const qty = +$(this).find(".prices").val()
                    const val = price * qty
                    total += val;
                    $(this).find(".total").val(total)
                    total = 0;

                })
            }).trigger("input")
            });

            $("#delete_row").click(function(e) {
                e.preventDefault();
                if (row_number > 1) {
                    $("#product" + (row_number - 1)).html('');
                    row_number--;
                }
            });

            $("table tbody tr input").on('input', function() {
                let total = 0;
                $("table tbody tr").each(function() {
                    const price = +$(this).find(".quantities").val()
                    const qty = +$(this).find(".prices").val()
                    const val = price * qty
                    total += val;
                    $(this).find(".total").val(total)
                    total =0

                })
              
             
            }).trigger("input")

        });
        </script>
    </div>
@endsection
