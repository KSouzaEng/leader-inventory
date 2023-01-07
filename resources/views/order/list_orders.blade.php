@extends('layouts.app')
@section('title','Create Order')


@section('content')  
<div class="row">
  <div class="col-md-4 mt-5">
      <a href="{{ route('dashboard') }}" class="btn btn-dark btn-floating">
        <i class="far fa-hand-point-left fa-lg" ></i>
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
<div class="container">
 <table class="table  table-hover mt-5">
   <thead>
     <tr>
       <th>Order Code</th>
       <th>Product Name</th>
       <th>Status</th>
       <th>Change Status</th>
       <th>New Order</th>
       <th>Actions</th>
     </tr>
   </thead>
   <tbody>
     @foreach ($orders as $key => $order)
     @foreach ($order->products as $product)
     <tr>
       <td>{{ $order->order_code }}</td>
       <td>{{ $product->name }}</td>
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
        @if ($order->status == 'OPEN' && $order->new == 1)
        <h6 style="text-align: center;" class="col-xl-2" id="no"><span class="badge bg-success" >New</span></h6>
        @endif
       </td>
       <td> 
          <div class="row">
             <div class="col-sm-2">
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
        // console.log(e.order['id']);
        alert('New Order')
       setTimeout(() => {
      
        }, 200);
        window.location.reload(true);
        // if (r == true){
        //   window.location.reload();
        // }
        // td.hidden = true;
        // publico.innerHTML += "<h6>"+'<span class="badge badge-success">'+"New"+"</span>"+"</h6>"
        
    });

</script>
@endsection