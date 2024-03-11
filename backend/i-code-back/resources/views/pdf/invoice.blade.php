<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>I-Code Multi Vendor</title>
    <style>
        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        a {
            color: #0087C3;
            text-decoration: none;
        }

        body {
            position: relative;
            width: 21cm;
            height: 29.7cm;
            margin: 0 auto;
            color: #555555;
            background: #FFFFFF;
            font-family: Arial, sans-serif;
            font-size: 14px;
            font-family: SourceSansPro;
        }

        header {
            padding: 10px 0;
            margin-bottom: 5px;
            border-bottom: 1px solid #AAAAAA;
        }

        #logo {
            float: left;
            margin-top: 8px;
        }

        #logo img {
            height: 70px;
        }

        #company {
            float: right;
            text-align: right;
        }


        #details {
            margin-bottom: 10px;
        }

        #client {
            padding-left: 6px;
            border-left: 6px solid #0087C3;
            float: left;
        }

        #client .to {
            color: #777777;
        }

        h2.name {
            font-size: 1.4em;
            font-weight: normal;
            margin: 0;
        }

        #invoice {
            float: right;
            text-align: left;
        }

        #invoice h1 {
            color: #0087C3;
            font-size: 2.4em;
            line-height: 1em;
            font-weight: normal;
            margin: 0 0 10px 0;
        }

        #invoice .date {
            font-size: 1.1em;
            color: #777777;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        table th,
        table td {
            padding: 20px;
            background: #EEEEEE;
            text-align: center;
            border-bottom: 1px solid #FFFFFF;
        }

        table th {
            white-space: nowrap;
            font-weight: normal;
        }

        table td {
            text-align: right;
        }

        table td h3 {
            color: #57B223;
            font-size: 1.2em;
            font-weight: normal;
            margin: 0 0 0.2em 0;
        }

        table .no {
            color: #FFFFFF;
            font-size: 1.6em;
            background: #57B223;
        }

        table .desc {
            text-align: left;
        }

        table .unit {
            background: #DDDDDD;
        }

        table .qty {}

        table .total {
            background: #57B223;
            color: #FFFFFF;
        }

        table td.unit,
        table td.qty,
        table td.total {
            font-size: 1.2em;
        }

        table tbody tr:last-child td {
            border: none;
        }

        table tfoot td {
            padding: 10px 20px;
            background: #FFFFFF;
            border-bottom: none;
            font-size: 1.2em;
            white-space: nowrap;
            border-top: 1px solid #AAAAAA;
        }

        table tfoot tr:first-child td {
            border-top: none;
        }

        table tfoot tr:last-child td {
            color: #57B223;
            font-size: 1.4em;
            border-top: 1px solid #57B223;

        }

        table tfoot tr td:first-child {
            border: none;
        }

        #thanks {
            font-size: 2em;
            margin-bottom: 10px;
        }

        #notices {
            padding-left: 6px;
            border-left: 6px solid #0087C3;
        }

        #notices .notice {
            font-size: 1.2em;
        }

        footer {
            color: #777777;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #AAAAAA;
            padding: 8px 0;
            text-align: center;
        }
    </style>
</head>

<body>
    <header class="clearfix">
        <div id="logo">
            <img src="logo.png">
        </div>
        <div id="company">
            <h2 class="name">I-Code Multi Vendor</h2>
            <div>455 Foggy Heights, AZ 85004, US</div>
            <div>(602) 519-0450</div>
            <div><a href="mailto:company@example.com">company@example.com</a></div>
        </div>
        </div>
    </header>
    <main>
        <div id="details" class="clearfix">
            <div id="client">
                <div class="to">INVOICE TO:</div>
                <h2 class="name">{{ $orderDetails['name'] }}</h2>
                <div class="address">{{ $orderDetails['address'] }}</div>
                <div class="email"><a href="mailto:{{ $orderDetails['email'] }}">{{ $orderDetails['email'] }}</a></div>
            </div>
            <div id="invoice">
                <h1><strong>Order ID:</strong> {{ $orderDetails['id'] }}</h1>
                <div class="date"><strong>Order Date:</strong><br>
                    {{ date('Y-m-d h:i:s', strtotime($orderDetails['created_at'])) }}</div>
                <div class="date"><strong>Order Amount: </strong> {{ $orderDetails['grand_total'] }} Tk.</div>
                <div class="date"><strong>Order Status: </strong> {{ $orderDetails['order_status'] }}</div>
                <div class="date"><strong>Payment Method: </strong> {{ $orderDetails['payment_method'] }}</div>
            </div>
        </div>
        <table border="0" cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th class="no">#</th>
                    <th class="no" style="">Product Code</th>
                    <th class="no">Size</th>
                    <th class="no">Color</th>
                    <th class="qty no">Quantity</th>
                    <th class="total no">Unit Price</th>
                    <th class="total no">Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $subTotal = 0;
                @endphp
                @foreach ($orderDetails['orders_products'] as $product)
                    <tr>
                        <td class="text-left">{{ $product['id'] }}</td>
                        <td class="" style="text-align: center;">{{ $product['product_code'] }}</td>
                        <td class="text-center"> {{ $product['product_size'] }} </td>
                        <td class="text-center"> {{ $product['product_color'] }} </td>
                        <td class="text-center"> {{ $product['product_qty'] }} </td>
                        <td class="text-center"> {{ $product['product_price'] }} Tk.</td>
                        <td class="text-center">
                            {{ $product['product_price'] * $product['product_qty'] }} Tk. </td>
                    </tr>
                    @php
                        $subTotal = $subTotal + $product['product_price'] * $product['product_qty'];
                    @endphp
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3"></td>
                    <td colspan="3">SUBTOTAL</td>
                    <td>{{ $subTotal }}</td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td colspan="3">Shipping Charge</td>
                    <td>0.00 Tk.</td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td colspan="3">GRAND TOTAL</td>
                    <td>{{ $orderDetails['grand_total'] }} Tk.</td>
                </tr>
            </tfoot>
        </table>
        {{-- <div id="thanks">Thank you!</div>
        <div id="notices">
            <h2 class="name">I-Code Multi Vendor</h2>
            <div>455 Foggy Heights, AZ 85004, US</div>
            <div>(602) 519-0450</div>
            <div><a href="mailto:company@example.com">company@example.com</a></div>
        </div> --}}
    </main>
    {{-- <footer>
        Invoice was created on a computer and is valid without the signature and seal.
    </footer> --}}
</body>

</html>
