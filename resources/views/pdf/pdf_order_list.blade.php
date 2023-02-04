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
            background-color: rgb(220, 220, 234);
            text-align: center;
            padding: 3vw;
            position: relative;
        }

        div.op1 {
            width: 38%;
            display: inline-block;
            font-size: 3vw;
            text-align: center;
            padding: 5vw 0vw 5vw 0vw;
            min-width: 40vw;
            margin-bottom: 3em
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
            margin-bottom: 3em
        }

        div.next {
            page-break-inside: avoid;
            page-break-after: always;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="title">Resume Order</h2>
        <div class="row">
            <div class="op1">
                <p class="small text-muted mb-1">Date</p>
                <p>{{ $order[0]->created_at->format('d/m/Y') }}</p>
            </div>
            <div class="op2">
                <p class="small text-muted mb-1">Order No.</p>
                <p>{{ $order[0]->id }}</p>
            </div>
        </div>
        <div class="row">
            <table class="table table-striped">
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
                @foreach ($order[0]->products as $item)
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
            </table>
        </div>
    </div>
</body>

</html>
