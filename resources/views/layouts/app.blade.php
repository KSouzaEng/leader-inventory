<html>
    <head>
        <title>Inventory - @yield('title')</title>

    
{{-- 
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="{{ asset('js/app.js') }}"></script> --}}
        
        <!-- Font Awesome -->
        <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        rel="stylesheet"
        />
        <!-- Google Fonts -->
        <link
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
        rel="stylesheet"
        />
        <!-- MDB CSS-->
            <link
            href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.css"
            rel="stylesheet"
            />
        <!-- MDB -->

    </head>
    <body>
        <div class=" container ">
            @yield('content')
        </div>
          <!-- MDB JS-->
         
     



    </body>
</html>