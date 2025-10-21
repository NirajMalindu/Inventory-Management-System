<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Place Order</title>
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
        margin-top: 30px;
        margin-bottom: 30px;
    }

    form {
        background: #fff;
        padding: 30px 25px;
        border-radius: 12px;
        max-width: 500px;
        margin: auto;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }

    label {
        display: block;
        margin-top: 15px;
        font-weight: 600;
        color: #555;
    }

    input[type="number"] {
        width: 100%;
        padding: 10px 12px;
        margin-top: 5px;
        border-radius: 8px;
        border: 1px solid #ccc;
        font-size: 1rem;
        transition: 0.3s;
    }

    input[type="number"]:focus {
        border-color: #007bff;
        outline: none;
        box-shadow: 0 0 5px rgba(0,123,255,0.3);
    }

    button {
        display: block;
        width: 80%;
        margin: 25px auto 0;
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
<h1 id="h1">Place Order</h1>

<form id = "orderForm" action="{{ route('orders.store') }}" method="POST">
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

    @foreach($products as $product)
        <label>{{ $product->name }} (Stock: {{ $product->current_stock }})</label><!--to show quantity (sum(in)-sum(out)) of each product and product name-->
        <input type="number" name="products[{{ $product->id }}]" value="0" min="0" max="{{ $product->current_stock }}"><!--validation for when user enter larger than quantity-->
    @endforeach

    <button type="submit">Place Order</button>
</form>

<!--loading indicators-->
<div id="loading">
    <div class="spinner"></div>
    <p>please wait....⏳</p>
</div>

<script>

    const form = document.getElementById('orderForm');
    const loading = document.getElementById('loading');
    const h1 = document.getElementById('h1');

    form.addEventListener('submit', ()=>{
        loading.style.display = 'block';//show loading indicator
        form.style.display = 'none';//hide the form
        h1.style.display = 'none';//hide place order h1
    });

</script>



</body>
</html>
