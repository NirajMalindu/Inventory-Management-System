<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>My Orders</title>
<style>
    body {
        font-family: 'Segoe UI', sans-serif;
        background: #f4f6f8;
        margin: 0;
        padding: 20px;
        color: #333;
    }

    h1 {
        text-align: center;
        margin-bottom: 30px;
        color: #333;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }

    th, td {
        padding: 15px 12px;
        text-align: left;
    }

    th {
        background: #007bff;
        color: white;
        font-weight: 600;
    }

    tr:nth-child(even) {
        background: #f8f9fa;
    }

    tr:hover {
        background: #e9f0ff;
    }

    ul {
        padding-left: 20px;
        margin: 0;
    }

    li {
        margin-bottom: 5px;
    }

    .badge {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 12px;
        color: white;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .badge-pending { background: #ffc107; color: #212529; }
    .badge-completed { background: #28a745; }
    .badge-cancelled { background: #dc3545; }

    @media (max-width: 600px) {
        table, th, td {
            font-size: 0.9rem;
        }
    }

    .alert-success{
        color: green;
        margin-bottom: 20px;
        font-size:28px;
        text-align: center;
        

    }
    .alert-danger{
        color:red;
        margin-bottom: 20px;
        font-size:28px;
        text-align: center;
    }

    /*back btn*/
     .btn-home {
        background: #28a745;
        color: #fff;
        font-weight: 600;
        border-radius: 8px;
        padding: 10px 18px;
        text-decoration: none;
        transition: background 0.3s ease;
    }
    .btn-home:hover {
        background: #1e7e34;
    }

</style>
</head>
<body>

<!--back btn-->
<a href="{{ route('dashboard') }}" class="btn-home">🏠 Home</a>
<h1>Orders</h1>

<!-- if session success it show a message-->
    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- if session success it show a error message-->
    @if(session('error'))
        <div class="alert-danger">
            {{ session('error') }}
        </div>
    @endif

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Status</th>
            <th>Total</th>
            <th>Products</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>
                <!--dynamically chooses a CSS badge style based on the order’s status-->
                @php
                    $statusClass = match($order->status) {
                        'pending' => 'badge-pending',
                        'completed' => 'badge-completed',
                        'cancelled' => 'badge-cancelled',
                        default => 'badge-pending',
                    };
                @endphp
                <span class="badge {{ $statusClass }}">{{ ucfirst($order->status) }}</span><!--(ucfirst)capitalizes the first letter of a string-->
            </td>
            <td>${{ number_format($order->total, 2) }}</td>
            <td>
                <ul>
                    @foreach($order->products as $product)
                        <li>{{ $product->name }} (Qty: {{ $product->pivot->quantity }})</li>
                    @endforeach
                </ul>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
