@extends('layouts.app')
<x-navbar :username="auth()->user()->name" :back="true" :order="false" />
@php $tota_all @endphp
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
                                <input type="text" class="form-control" id="customer_name" name="customer_name"
                                    value="{{ $order[0]->customer_name }}" required>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label for="customer_phone" class="form-label">Customer phone <span
                                        class="text-danger">*</span>:</label>
                                <input type="tel" class="form-control" id="customer_phone" name="customer_phone"
                                    value="{{ $order[0]->customer_phone }}" required>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label for="status" class="form-label">Status<span class="text-danger">*</span>:</label>
                                <input type="text" class="form-control" id="status" name="status"
                                    value="{{ $order[0]->status }}" required>
                            </div>
                            <table class="table" id="maintable">
                                <thead>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </thead>
                                <tbody>
                                    @foreach ($order[0]->products as $item)
                                        <tr>
                                            <td>
                                                <select name="products[]" class="form-control" id="product_select">
                                                    <option value="">-- choose product --</option>
                                                    @foreach ($products as $product)
                                                        <option value="{{ $product->id }}"
                                                            @if (old('products.' . $loop->parent->index, optional($item)->id) == $product->id) selected @endif>
                                                            {{ $product->name }} </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" name="quantities[]" class="form-control quantities"
                                                    value="{{ $item->pivot->quantity_product_order }}" />
                                            </td>
                                            <td>
                                                <input type="text" name="prices[]" class="form-control prices"
                                                    id="price" value="{{ $item->pivot->price }}" />
                                            </td>
                                            <td>
                                                <input type="text" name="total[]" class="form-control total"
                                                    value="{{ $item->pivot->total }}" />
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="row ">
                                <div class="col-md-12 ">
                                    <button id="add_row" class="btn btn-default pull-left">+ Add Row</button>
                                    <button id='delete_row' class="pull-right btn btn-danger justify-content-end delete_row">- Delete
                                        Row</button>
                                </div>
                            </div>



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
                let s = 0;

                $("#add_row").click(function(e) {
                    e.preventDefault();
                    let new_row_number = row_number - 1;
                    $('#maintable tr:last').after(`
                <tr id="edit">
                    <td>
                        <select name="products[]" class="form-control" id="product_select">
                            <option value="">-- choose product --</option>
                                @foreach ($products as $key => $product)
                                    <option value="{{ $product->id }}"
                                        @if ($product->quantity_in_stock == 0) @disabled(true) @endif>
                                        {{ $product->quantity_in_stock < 20 ? $product->name . '--' . 'LOW STOCK' : $product->name }}

                                    </option>
                                 @endforeach
                        </select>
                    </td>
                    <td> <input type="text" name="quantities[]" class="form-control quantities"  /></td>
                    <td> <input type="text" name="prices[]" class="form-control prices"  /></td>
                    <td>    <input type="text" name="total[]" class="form-control total"/></td>
                    </tr>
                
                    `);

                    row_number++;

                    $("table tbody tr input").on('input', function() {
                        let total = 0;
                        let soma = 0
                        $("table tbody tr").each(function(index, e) {
                            // console.log('INDEX',e)

                            // if (index == row_number + 1) {

                            //     $(this).find(".quantities").val("")
                            //     $(this).find(".prices").val("")
                            //     $(this).find(".total").val("")
                            //     $(this).find('#product_select').val("");
                            //     // if ($(this).find(".quantities").val("") == "") {
                            //     //     row_number++;
                            //     //     console.log("lk")
                            //     // }

                            // }

                            const price = +$(this).find(".quantities").val()
                            const qty = +$(this).find(".prices").val()
                            const val = price * qty
                            total += val;
                            soma += total;
                            if (!isNaN(soma)) {
                                // console.log("SOMA:", soma)
                                $(".total_amount").val(soma);
                            }
                            // console.log(this.value)
                            $(this).find(".total").val(total)
                            total = 0;

                        })
                    }).trigger("input")
                });

                $("#delete_row").click(function(e) {
                    e.preventDefault();
                    $("#edit" ).remove();
                    
                });



                $("table tbody tr input").on('input', function() {
                    let total = 0;
                    let soma = 0;


                    $("table tbody tr ").each(function(index) {

                        const price = +$(this).find(".prices").val()
                        const qty = +$(this).find(".quantities").val()
                        const val = price * qty
                        total += val;


                        soma += total;
                        if (!isNaN(soma)) {
                            // console.log("SOMA:", soma)
                            $(".total_amount").val(soma);
                        }


                        $(this).find(".total").val(total)
                        total = 0
                    })



                }).trigger("input")



            });
        </script>
    </div>
@endsection
