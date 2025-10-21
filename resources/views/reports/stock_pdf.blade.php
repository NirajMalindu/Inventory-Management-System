<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Stock Report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background: #007bff; color: #fff; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>Stock Report</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Product</th>
                <th>Category</th>
                <th>Total In</th>
                <th>Total Out</th>
                <th>Current Stock</th>
            </tr>
        </thead>
        <tbody>
            @foreach($report as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item['name'] }}</td>
                <td>{{ $item['category'] }}</td>
                <td>{{ $item['total_in'] }}</td>
                <td>{{ $item['total_out'] }}</td>
                <td>{{ $item['current_stock'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p style="text-align:right; margin-top:15px;">Generated on: {{ now()->format('Y-m-d H:i') }}</p>
</body>
</html>
