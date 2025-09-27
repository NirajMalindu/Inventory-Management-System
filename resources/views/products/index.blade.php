<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Products</title>
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

    .btn-add {
        display: inline-block;
        padding: 10px 20px;
        background: #28a745;
        color: white;
        border-radius: 8px;
        text-decoration: none;
        font-weight: bold;
        transition: 0.3s;
    }

    .btn-add:hover {
        background: #218838;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background: white;
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

    a, button {
        padding: 8px 12px;
        text-decoration: none;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 0.9rem;
        transition: 0.2s;
    }

    .btn-edit {
        background: #ffc107;
        color: #212529;
    }

    .btn-edit:hover {
        background: #e0a800;
    }

    .btn-delete {
        background: #dc3545;
        color: white;
    }

    .btn-delete:hover {
        background: #c82333;
    }

    form.inline-form {
        display: inline;
    }

    .alert-success{
        color: green;
        margin-bottom: 20px;
        font-size:28px;
        

    }
    .alert-danger{
        color:red;
        margin-bottom: 20px;
        font-size:28px;
    }

</style>
</head>
<body>

<h1>Products</h1>
<p><!-- if session success it show a message-->
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
</p>
<a href="{{ route('products.create') }}" class="btn-add">+ Add Product</a>

<br><br>

<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Category</th>
            <th>Stock</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>{{ $product->category->name }}</td>
            <td>{{ $product->stock_quantity }}</td>
            <td>${{ number_format($product->price, 2) }}</td>
            <td>
                <a href="#" class="btn-edit">Edit</a>
                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline-form">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-delete">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
