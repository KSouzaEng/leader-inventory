@extends('layouts.app')
@section('title', 'Create Order')

<x-navbar :username="auth()->user()->name" class="mb-5" :back="true" :order="true" />
@section('content')


    {{-- @if (session('success'))

   {{ session('success') }}
@endif --}}
    @if (session('error'))
        <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle flex-shrink-0 me-2"></i>
            <div class="d-flex">
                {{ session('error') }}
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="container" id="datatable">
        <table class="table align-middle mb-0 bg-white mt-5">
            <thead class="bg-light">
                <tr >
                    <th class="fw-bolder">Details</th>
                    <th class="fw-bolder">Order Code</th>
                    <th class="fw-bolder">Customer Name</th>
                    <th class="fw-bolder">Customer E-mail</th>
                    <th class="fw-bolder">Status</th>
                    <th class="fw-bolder">Change Status</th>
                    <th class="fw-bolder">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $key => $order)
                    <tr data-entry-id="{{ $order->id }}" class="fs-6">
                        <td class="">
                            <a>
                                <x-modal :orderId="$order->id" :order="$order" />
                            </a>
                        </td>
                        <td>
                            <p class="fw-normal mb-1 text-center"> {{ $order->id ?? '' }}</p>
                        </td>
                        <td class="text-capitalize">
                            <p class="fw-normal mb-1  text-wrap text-break">{{ $order->customer_name ?? '' }}</p>
                        </td>
                        <td>
                            <p class="fw-normal mb-1 text-wrap text-break"> {{ $order->customer_phone ?? '' }}</p>
                        </td>
                        @if ($order->status == 'OPEN')
                            <td id="td">
                                <h6 style="text-align: center;" class="d-flex d-flex justify-content-center" id="publico">
                                    <span class="badge badge-success">{{ $order->status }}</span>
                                </h6>
                            </td>
                        @endif
                        @if ($order->status == 'PROGRESS')
                            <td>
                                <h6 style="text-align: center;" class="d-flex  d-flex justify-content-center"
                                    id="no"><span class="badge bg-warning">{{ $order->status }}</span></h6>
                            </td>
                        @endif
                        @if ($order->status == 'CLOSED')
                            <td>
                                <h6 style="text-align: center;" class="d-flex d-flex justify-content-center" id="no">
                                    <span class="badge bg-danger">{{ $order->status }}</span>
                                </h6>
                            </td>
                        @endif
                        <td>
                            <div class="d-flex justify-content-center ">
                                <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                    data-mdb-toggle="dropdown" aria-expanded="false">
                                    <span class="visually-hidden">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="order/update/{{ $order->id }}/OPEN">OPEN</a></li>
                                    <li><a class="dropdown-item"
                                            href="order/update/{{ $order->id }}/PROGRESS">PROGRESS</a></li>
                                    <li><a class="dropdown-item" href="order/update/{{ $order->id }}/CLOSED">CLOSED</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                        <td class="col-sm-9 col-md-6 col-lg-8">
                            {{-- <div class="d-grid gap-2 d-md-flex">
              <div class="col-sm-2 me-md-2"> --}}
                            <a class="btn btn-warning btn-floating mb-1 " type="button"
                                href="{{ route('order', "$order->id") }}" data-mdb-toggle="tooltip" title="UPDATE"><i
                                    class="fas fa-exchange-alt"></i></a>
                            {{-- </div>
              <div class="col-sm-4"> --}}
                            <form class="delete-form" data-route="{{ route('delete', $order->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-floating" data-mdb-toggle="tooltip"
                                    title="DELETE"><i class="fas fa-trash "></i></button>
                            </form>
                            {{-- </div>
            </div> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center mt-3 pagination pagination-circle">
            {!! $orders->links() !!}
        </div>
    </div>
    </div>

    <script type="module">

    var publico =  document.getElementById("publico");
    var td =  document.getElementById("no");
    // var order = @json($orders);
    // let id
    // const myServices = [];
    // @foreach ($orders as $service)
    //     myServices.push('{{ $service->id }}');
    // @endforeach
    // console.log(myServices)

    Echo.channel('order')
    .listen('NewOrder', (e) => {
        // console.log(e.order['id']);
    Swal.fire({
        icon: 'success',
        title: 'Order list Updated',
        confirmButtonText: 'Close',
        timer: 7000,
      }).then((result) =>{
        if (result.isConfirmed) {
          window.location.reload(true);
        }
      })
        // window.location.reload(true);
        // if (r == true){
        //   window.location.reload();
        // }
        // td.hidden = true;
        // publico.innerHTML += "<h6>"+'<span class="badge badge-success">'+"New"+"</span>"+"</h6>"
        
    });
    $(document).ready(function() {
        $('.delete-form').on('submit', function(e) {
            e.preventDefault();
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                type: 'post',
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  url: $(this).data('route'),
                  data: {
                    '_method': 'delete',
                    _token: '{{csrf_token()}}'
                  },
                  success: function (response, textStatus, xhr) {
                    // alert(response)
                    // window.location='/posts'
                    Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                    )
                    window.location.reload(true);
                  }
                })
                
            }
            })
        });
    });

</script>
@endsection
