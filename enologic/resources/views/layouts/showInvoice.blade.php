<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div>
        <div style="text-align: right;">
            <p>Customer: {{ $user->name }}</p>
            <p>Date: {{ $createdAt }}</p>
            <p>Order ID: {{ $order->id }}</p>
        </div>
        <h1>Invoice</h1>
        <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->products as $product)
                <tr>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->price }}€</td>
                    <td>{{ $product->pivot->quantity }}</td>
                    <td>{{ $product->price * $product->pivot->quantity }}€</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div style="text-align: right;">
            <p>Total: {{ $order->total }}€</p>
        </div>
    </div>
</body>
</html>
