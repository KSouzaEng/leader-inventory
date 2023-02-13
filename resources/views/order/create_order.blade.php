@extends('layouts.app')
@section('title', 'Create Order')
@php
    $price = 0.0;
    $id;
    
@endphp
<x-navbar :username="auth()->user()->name" class="mb-5" :back="true" :order="false" />
@section('content')

    @if (session('error'))
        <div hidden class="alert alert-danger d-flex align-items-center alert-dismissible fade show mt-3" role="alert">
            <i class="fas fa-times-circle flex-shrink-0 me-2"></i>
            <div class="d-flex">
                {{ session('error') }}
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('low'))
        <div hidden class="alert alert-danger d-flex align-items-center alert-dismissible fade show mt-3" role="alert">
            <i class="fas fa-times-circle flex-shrink-0 me-2"></i>
            <div class="d-flex">
                {{ session('low') }}
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
                                <label for="customer_name" class="form-label ">Customer Name <span
                                        class="text-danger">*</span>:</label>
                                <input type="text" class="form-control" id="customer_name" name="customer_name" required>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label for="customer_email" class="form-label">Customer Email <span
                                        class="text-danger">*</span>:</label>
                                <input type="email" class="form-control" id="customer_email" name="customer_email"
                                    required>
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
                                            <select name="products[]" class="form-control" id="products"
                                                >
                                                <option value="">-- choose product --</option>
                                                @foreach ($products as $key => $product)
                                                    {{ $price = $products }}


                                                    <option value="{{ $product->id }}"
                                                        @if ($product->quantity_in_stock == 0) @disabled(true) @endif>
                                                        {{ $product->quantity_in_stock < 20 ? $product->name . '--' . 'LOW STOCK' : $product->name }}

                                                    </option>
                                                @endforeach
                                            </select>
                                            <p class="p" hidden>LOW STOCK</p>
                                        </td>
                                        <td>
                                            <input type="text" name="quantities[]" class="form-control quantities"
                                                id="qtd" />
                                        </td>
                                        <td>
                                            {{-- <input type="hidden" name="priceHiden" id="priceHiden" class="priceHiden"
                                                value="{{ $price }}"> --}}
                                            <input type="text" name="prices[]" class="form-control prices"
                                                id="price" />

                                        </td>
                                        <td>
                                            <input type="text" name="total[]" class="form-control total"
                                                id="total" />
                                        </td>
                                    </tr>
                                    <tr id="product1"></tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th id="total" colspan="3">Total :</th>
                                        <td>
                                            <input type="text" name="total_amount" class="form-control total_amount"
                                                id="total_amount" />
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>

                            <div class="row ">
                                <div class="col-md-12 ">
                                    <button id="add_row" class="btn btn-default pull-left add_row">+ Add Row</button>
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
    </div>
    <script>
        $(document).ready(function() {
            let row_number = 1;
            let s = 0;

            $("#add_row").click(function(e) {
                e.preventDefault();
                let new_row_number = row_number - 1;
                $('#product' + row_number).html($('#product' + new_row_number).html()).find(
                    'td:first-child');
                $('#products_table').append('<tr id="product' + (row_number + 1) + '"></tr>');
                row_number++;



                $("table tbody tr input").on('input', function() {
                    let total = 0;
                    let soma = 0
                    $("table tbody tr").each(function() {

                        const price = +$(this).find(".quantities").val()
                        const qty = +$(this).find(".prices").val()
                        const val = price * qty
                        total += val;
                        soma += total;
                        if (!isNaN(soma)) {
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
                if (row_number > 1) {
                    $("#product" + (row_number - 1)).html('');
                    row_number--;
                }
            });



            $("table tbody tr input").on('input', function() {
                let total = 0;
                let soma = 0;


                $("table tbody tr ").each(function() {
                    const price = +$(this).find(".prices").val()
                    const qty = +$(this).find(".quantities").val()
                    const val = price * qty
                    total += val;


                    soma += total;
                    if (!isNaN(soma)) {
                        $(".total_amount").val(soma);
                    }


                    $(this).find(".total").val(total)
                    total = 0
                })



            }).trigger("input")


            // $("#products").change(function(e) {
            //     var arr = $("#priceHiden").map(function() {
            //         return this.value; // $(this).val()
            //     }).get();
            //     var products = JSON.parse(arr)


            //             for (let i = 0; i < products.length; i++) {
            //         const element = products[i];
            //         console.log(element['id'])
            //         if (element["id"] == this.value) {
            //             console.log(element['price_per_unit'])
            //             var price = element['price_per_unit']



            //         }
            //         }

            // });






        });

        // function getValue(x, p) {

        //     for (let index = 0; index < p.length; index++) {
        //         const element = p[index]['id'];
        //         // p[index]['price_per_unit'];
        //         // console.log(p[index]['price_per_unit'])

        //         if (element == x.value) {
        //             var oTable = document.getElementById('products_table');
        //             var rowLength = oTable.rows.length;
        //             var spans = document.querySelector('.prices');
        //             var i;
        //             for (i = 0; i < spans.length; i++) {
        //                 spans[i].style.backgroundColor = red;
        //             }

        //             // for (i = 0; i < rowLength; i++){
        //             //     var oCells = oTable.rows[i].cells;
        //             //     var cellLength = oCells.length;
        //             //     // console.log(cellLength)
        //             //     for(var j = 0; j < cellLength; j++){
        //             //         console.log(oCells[j].getElementsByTagName("input")[0]);
        //             //     }

        //             // }
        //         }
        //     }
        // }
    </script>
@endsection
