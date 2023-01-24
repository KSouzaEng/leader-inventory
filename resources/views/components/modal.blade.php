<!-- Button trigger modal -->
<a type="button" class="text-dark d-flex justify-content-center" data-mdb-toggle="modal" data-mdb-target="#exampleModal{{ $orderId }}">
    <i class="fas fa-eye"></i>
</a>

<!-- Modal -->
<div class="modal fade" id="exampleModal{{ $orderId }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog card border-top border-bottom border-3" style="border-color: #f37a27 !important;">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title" id="exampleModalLabel">Order Details</h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid py-3 h-100">
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <p class="small text-muted mb-1">Date</p>
                            <p>{{ $order->created_at->format('d/m/Y') }}</p>
                        </div>
                        <div class="col mb-3">
                            <p class="small text-muted mb-1">Order No.</p>
                            <p>{{ $order->id }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>     
                                
                                @foreach($order->products as $item)

                                <tr>
                                    <td>
                                        {{ $item->name }}
                                    </td>
                                    <td>
                                        {{ $item->pivot->quantity_product_order }}
                                    </td>
                                    <td>
                                        {{ $item->pivot->price }}
                                    </td>
                                    <td>
                                        {{ $item->pivot->total }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                       
                    </div>
                    {{-- <div class="row py-3 ml-3">
                        <div class="col-md-6 fw-bold">Total:</div>
                        <div class="col-md-4 ms-auto" style="color:#f37a27">US$ {{ $order->total_order }}</div>
                    </div> --}}
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
