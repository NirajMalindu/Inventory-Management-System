<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Product</title>
<style>
    body {
        font-family: 'Segoe UI', sans-serif;
        background: #f4f6f8;
        margin: 0;
        padding: 0;
    }

    h1 {
        text-align: center;
        margin-top: 40px;
        color: #333;
    }

    form {
        background: #fff;
        padding: 30px 25px;
        border-radius: 12px;
        max-width: 500px;
        margin: 40px auto;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }

    input, select {
        width: 90%;
        padding: 12px 15px;
        margin: 12px 0;
        border-radius: 8px;
        border: 1px solid #ccc;
        font-size: 1rem;
        transition: 0.3s;
    }

    input:focus, select:focus {
        border-color: #007bff;
        outline: none;
        box-shadow: 0 0 5px rgba(0,123,255,0.3);
    }

    button {
        display: block;
        width: 80%;
        margin: 20px auto;
        padding: 12px;
        background: #007bff;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 1.1rem;
        cursor: pointer;
        transition: transform 0.2s ease, background 0.3s ease;
    }

    button:hover {
        background: #0056b3;
        transform: translateY(-2px);
    }

    @media (max-width: 500px) {
        form {
            margin: 20px;
            padding: 20px;
        }
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

<h1>Add Product</h1>

<form action="{{ route('products.store') }}" method="POST">
    @csrf

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

    <input type="text" name="name" placeholder="Product Name" required>

    <select name="category_name" required>
        <option value="" disabled selected hidden>Select Category</option>
        <option value="Electronics">Electronics</option>
        <option value="Clothing">Clothing</option>
        <option value="Books">Books</option>
    </select>

    <input type="number" name="stock_quantity" placeholder="Stock Quantity" min="0" required>
    <input type="number" step="0.01" name="price" placeholder="Price" min="0" required>
    <button type="submit">Save Product</button>
</form>

</body>
</html>
