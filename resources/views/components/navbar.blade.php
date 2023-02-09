{{-- <header>
  <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
  <script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.js"
  ></script>
<div class="container">
  <div class=" clearfix mt-5 ">

   <div class=" float-end">
    <ul class="nav ">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="#">
          <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="black" class="bi bi-person-circle" viewBox="0 0 16 16">
              <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
              <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
            </svg>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled link-dark link-nav fs-6" href="#" >{{$username}}</a>
      </li>
      <li class="nav-item">
          <a class="nav-link link-dark link-nav fs-6" href="{{ route('signout') }}">Logout</a>
      </li>

    </ul>
   </div>
  </div>
</div>
</header>  --}}
<!-- Navbar -->
<header>
  {{-- <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script> --}}
  <script src="{{ asset('jquery.js') }}"></script>
  <script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.js"
  ></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="icon" type="image/x-icon" href="{{ asset('/icons/favicon.ico') }}">
    <nav class="navbar navbar-expand-lg navbar-light bg-light w-100">
      <!-- Container wrapper -->
      <div class="container-fluid">
        <!-- Toggle button -->
        <button
          class="navbar-toggler"
          type="button"
          data-mdb-toggle="collapse"
          data-mdb-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <i class="fas fa-bars"></i>
        </button>
    
        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Navbar brand -->
          <a class="navbar-brand mt-2 mt-lg-0" href="#">
         
          </a>
          <!-- Left links -->
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item mt-1 p-2">
              @if ($back == true)
              <a href="{{ route('dashboard') }}" class="btn btn-dark btn-rounded  mx-1">
                <i class="fas fa-arrow-left"></i>
                  Back 
                </a>
              @endif
            
            
            </li>
            <li class="nav-item mt-1 p-2">
              @if ($order == true)
              <a href="{{ route('form-order') }}" class="btn btn-dark btn-rounded ">
                <i class="fas fa-plus"></i>
                New Order
                </a>
              @endif
           
            </li>
            
          </ul>
          <!-- Left links -->
        </div>
        <!-- Collapsible wrapper -->
    
        <!-- Right elements -->
        <div class="d-flex align-items-center">
        
          <!-- Avatar -->
          <div class="dropdown">
           
            <ul
              class="dropdown-menu dropdown-menu-end"
              aria-labelledby="navbarDropdownMenuAvatar"
            >
              <li>
                <a class="dropdown-item" href="{{ route('dashboard') }}">Back</a>
              </li>
              <li>
                <a class="dropdown-item" href="">{{ $username }}</a>
              </li>
               <li>
                <a class="dropdown-item" href="#">Logout</a>
              </li>
            </ul>
          </div>
          <div class="mx-3">{{ $username }}</div>
          <a class="text-reset me-3 fs-6" href="{{ route('signout') }}">
            <i class="fas fa-sign-out-alt"></i>
            Logout
          </a>
        </div>
        <!-- Right elements -->
      </div>
      <!-- Container wrapper -->
    </nav>
</header>
 
<!-- Navbar -->