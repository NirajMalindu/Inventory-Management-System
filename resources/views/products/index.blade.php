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
        margin-bottom: 20px;
        color: #333;
    }

    .top-bar {
        display: flex;
        align-items: center;
        margin-bottom: 25px;
        flex-wrap: wrap;
        gap: 10px;
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
        margin-right: 30px;
    }

    .btn-add:hover {
        background: #218838;
    }
    .btn-his{
        display: inline-block;
        background: #28a745;
        color: #fff;
        font-weight: bold;
        border-radius: 8px;
        padding: 10px 20px;
        text-decoration: none;

    }

    .search-box {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .search-box input[type="text"] {
        padding: 10px 15px;
        border-radius: 8px;
        border: 1px solid #ccc;
        font-size: 1rem;
        width: 250px;
        transition: 0.2s;
    }

    .search-box input[type="text"]:focus {
        outline: none;
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0,123,255,0.3);
    }

    .search-box button {
        background: #007bff;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 10px 18px;
        cursor: pointer;
        transition: 0.3s;
        margin-right: 30px;
    }

    .search-box button:hover {
        background: #0056b3;
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
        font-size:20px;
        text-align:center;
    }

    .alert-danger{
        color:red;
        margin-bottom: 20px;
        font-size:20px;
        text-align:center;
    }
     #loading{
        text-align: center;
        display:none;
        margin-top: 20%;
    }
    .spinner {
        border: 6px solid #f3f3f3;
        border-top: 6px solid #007bff;
        border-radius: 50%;
        width: 45px;
        height: 45px;
        animation: spin 2s linear infinite;
        margin: 0 auto;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>
</head>
<body>

    <h1 id="h1">Product List</h1>

    <!-- Alert messages -->
    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert-danger">{{ session('error') }}</div>
    @endif

    <!--it helps to search product-->
    <div class="top-bar" id="searchLoading">

        <!--back button-->
        <a href="{{route('dashboard') }}" class="btn-his">Home</a>
        
        <form method="GET" action="{{ route('products.index') }}" class="search-box">
            <input type="text" name="search" placeholder="Search by name or category" value="{{ request('search') }}">
            <button type="submit">Search</button>
        </form>
            <!--it helps to Add product-->
        <a href="{{ route('products.create') }}" class="btn-add" onclick="submitData()" >+ Add Product</a>

        <!--this for product history-->
        <a href="#" class="btn-his">History</a>
    </div>

    <table id="historyLoading" >
        <thead >
            <tr>
                <th>Name</th>
                <th>Category</th>
                <th>Stock</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category->name ?? 'N/A' }}</td>
                <td>{{ $product->current_stock }}</td>
                <td>{{ number_format($product->price, 2) }}</td>
                <td onclick="submitData()">
                    <a href="{{ route('products.edit', $product->id) }}" class="btn-edit">Edit</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline-form" onsubmit="return confirm('Are you sure you want to delete this product?');">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-delete">Delete</button>
                    </form>
                    
                    <!--to show history page-->
                    <a href="{{ route('stock.history', $product->id) }}" class="btn-edit" >History</a>

                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align:center; padding:20px; color:#666;">No products found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    
        <!--loading indicators-->
        <div id="loading">
            <div class="spinner"></div>
            <p>Loading Please wait...⏳</p>
        </div>

        <script>
            function submitData(){
                const historyLoading = document.getElementById('historyLoading');
                const loading = document.getElementById('loading');
                const searchLoading = document.getElementById('searchLoading');
                const h1 = document.getElementById('h1');

                historyLoading.style.display = 'none';
                loading.style.display = 'block';
                searchLoading.style.display = 'none';
                h1.style.display = 'none';
        }
        </script>


    </body>
</html>
