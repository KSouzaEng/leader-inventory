@extends('layouts.app')
@section('title','Create Order')


@section('content')  
<div class="row">
  <div class="col-md-4 mt-5">
      <a href="{{ route('dashboard') }}" class="btn btn-dark btn-rounded  mx-1">
        <i class="fas fa-arrow-left"></i>
          Back 
        </a>
        <a href="{{ route('form-order') }}" class="btn btn-dark btn-rounded ">
          <i class="fas fa-plus"></i>
          New Order
          </a>
  </div>
  <div class="col-md-4 offset-md-4">  <x-navbar :username="auth()->user()->name"/></div>
</div>
@if(session('success'))
<div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
  <i class="fas fa-check-circle flex-shrink-0 me-2"></i>
  <div class="d-flex">
   {{ session('success') }}
  </div>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if(session('error'))
<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
  <i class="fas fa-check-circle flex-shrink-0 me-2"></i>
  <div class="d-flex">
   {{ session('error') }}
  </div>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="container">
 <table class="table  table-hover mt-5">
   <thead>
     <tr>
        <th>Details</th>
       <th>Order Code</th>
       <th>Customer Name</th>
       <th>Customer E-mail</th>
       <th>Status</th>
       <th>Change Status</th>
       <th>Actions</th>
     </tr>
   </thead>
   <tbody>
     @foreach ($orders as $key => $order)
     <tr data-entry-id="{{ $order->id }}">
        <td>
            <a>
                <x-modal :orderId="$order->id" :order="$order" />
            </a>
        </td>
       <td>    {{ $order->id ?? '' }}</td>
       <td>
        {{ $order->customer_name ?? '' }}
        </td>
        <td>
            {{ $order->customer_email ?? '' }}
        </td>
       @if($order->status == 'OPEN')
       <td id="td">
        <h6 style="text-align: center;" class="col-xl-2"  id="publico"><span class="badge badge-success">{{ $order->status }}</span></h6>
        </td>
        @endif
        @if($order->status == 'PROGRESS')
        <td>
          <h6 style="text-align: center;" class="col-xl-2" id="no"><span class="badge bg-warning" >{{ $order->status }}</span></h6>
        </td>
        @endif
        @if($order->status == 'CLOSED')
        <td>
        <h6 style="text-align: center;" class="col-xl-2" id="no"><span class="badge bg-danger" >{{ $order->status }}</span></h6>
       </td>
        @endif
       <td>
        <div class="btn-group">
          <button
           type="button"
           class="btn btn-primary dropdown-toggle dropdown-toggle-split"
           data-mdb-toggle="dropdown"
           aria-expanded="false"
          >
           <span class="visually-hidden">Toggle Dropdown</span>
          </button>
          <ul class="dropdown-menu">
           <li><a class="dropdown-item"  href="order/update/{{ $order->id }}/OPEN">OPEN</a></li>
           <li><a class="dropdown-item" href="order/update/{{ $order->id }}/PROGRESS">PROGRESS</a></li>
           <li><a class="dropdown-item" href="order/update/{{ $order->id }}/CLOSED">CLOSED</a></li>
          </ul>
          </div>
       </td>
       <td> 
          <div class="row">
             <div class="col-sm-2 mx-3">
              <a class="btn btn-warning btn-floating" type="button" href="{{route('order',"$order->id")}}" data-mdb-toggle="tooltip" title="UPDATE"><i class="fas fa-exchange-alt"></i></a>
             </div>
             <div class="col-sm-4">
              <form action="/delete/{{ $order->id }}" method="post" >
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-floating"  data-mdb-toggle="tooltip" title="DELETE"><i class="fas fa-trash "></i></button>
                </form>
             </div>
           </div>
         </td>
     </tr>
     @endforeach
   </tbody>
 </table>
</div>
{{-- Pagination --}}
<div class="d-flex justify-content-center">
  {!! $orders->links() !!}
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
        console.log(e.order['id']);
        alert('New Order')
        window.location.reload(true);
        // if (r == true){
        //   window.location.reload();
        // }
        // td.hidden = true;
        // publico.innerHTML += "<h6>"+'<span class="badge badge-success">'+"New"+"</span>"+"</h6>"
        
    });

</script>
@endsection