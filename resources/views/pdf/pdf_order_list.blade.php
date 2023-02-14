<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Leader Inventory</title>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }

        p {
            display: block;
            justify-content: center;
            flex-direction: row;
            font-size: 16px;
            text-align: justify;
        }

        .container {
            height: 100%;
            background: -webkit-linear-gradient(top, #088fad 20%, #00d5ff 100%);
        }

        .title {
            font-size: 5vw;
            text-align: center;
            padding: 2vw;
            background-color: rgb(224, 224, 238);
            position: relative;
            top: 25px;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 1.5em
        }

        div.op1 {
            width: 38%;
            display: inline-block;
            font-size: 3vw;
            text-align: center;
            padding: 5vw 0vw 5vw 0vw;
            min-width: 40vw;
            margin-bottom: 3em;
     
        }

        div.op2 {
            width: 38%;
            display: inline-block;
            margin-right: 0vw;
            font-size: 3vw;
            text-align: center;
            padding: 5vw 0vw 5vw 0vw;
            min-width: 40vw;
            float: right;
            margin-bottom: 3em;
           
        }

        div.next {
            page-break-inside: avoid;
            page-break-after: always;
        }

        .cont {
            position: relative;
            text-align: center;
            margin-bottom: 1em;

            /* color: white; */
        }
    </style>
</head>

<body>
    @php $total =  0.0 @endphp
 
    <div class="container">
        <div class="cont">
            <img src="{{ public_path('leaderinventory.png') }}" alt="Snow" style="width:120px;height:120px;" >
    
            <div class="title">Resume Order</div>
        </div>
        <div class="row">
            <div class="op1">
                <p class="small text-muted mb-1" style=" font-weight: bold;">date of purchase:</p>
                <p>{{ $order[0]->created_at->format('d/m/Y') }}</p>
            </div>
            <div class="op2">
                <p class="small text-muted mb-1" style=" font-weight: bold;">Order Code:</p>
                <p>{{ $order[0]->id }}</p>
            </div>
        </div>
        <div class="row">
            <table class="table table-striped">
                <tr style=" background-color: rgb(224, 224, 238);">
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>

                </tr>
                @foreach ($order[0]->products as $item)
                @php $total = $item->pivot->total_all @endphp
                    <tbody>
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
                    </tbody>
                @endforeach
                <tfoot>
                    <tr>
                        <th id="total" colspan="3">Total Amount:</th>
                        <td>
                            {{ $total }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</body>

</html>
