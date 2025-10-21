<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Product</title>
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: #fff;
        margin: 0;
        padding: 0;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .top-bar {
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 40px;
        box-sizing: border-box;
    }

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

    h1 {
        color: #333;
        text-align: center;
        font-size: 2.2rem;
        margin-top: 10px;
        letter-spacing: 1px;
    }

    .card {
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        padding: 40px 45px;
        width: 80%;
        max-width: 430px;
        margin-top: 20px;
        animation: fadeIn 0.7s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    input, select {
        width: 100%;
        padding: 14px 15px;
        margin: 12px 0;
        border-radius: 10px;
        border: 1px solid #ccc;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: #f9f9f9;
    }

    input:focus, select:focus {
        border-color: #007bff;
        background: #fff;
        box-shadow: 0 0 8px rgba(0,123,255,0.4);
        outline: none;
    }

    button {
        width: 100%;
        margin-top: 20px;
        padding: 14px;
        border: none;
        border-radius: 10px;
        background: linear-gradient(135deg, #007bff, #0046b3);
        color: white;
        font-size: 1.1rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        cursor: pointer;
        transition: transform 0.2s ease, box-shadow 0.3s ease;
    }

    button:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(0, 123, 255, 0.3);
    }

    .stock-btn {
        display: inline-block;
        background: #28a745;
        color: #fff;
        font-weight: 600;
        border-radius: 8px;
        padding: 10px 18px;
        text-decoration: none;
        transition: background 0.3s ease;
        margin-top: 15px;
    }

    .stock-btn:hover {
        background: #1e7e34;
    }

    .alert-success, .alert-danger {
        text-align: center;
        padding: 12px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 1rem;
        font-weight: 600;
        animation: fadeIn 0.5s ease-in-out;
    }

    .alert-success {
        color: #155724;
        background: #d4edda;
        border: 1px solid #c3e6cb;
    }

    .alert-danger {
        color: #721c24;
        background: #f8d7da;
        border: 1px solid #f5c6cb;
    }

    #loading {
        display: none;
        margin-top: 15px;
        text-align: center;
    }

    .spinner {
        border: 5px solid #f3f3f3;
        border-top: 5px solid #007bff;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        animation: spin 1s linear infinite;
        margin: 0 auto;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    @media (max-width: 500px) {
        .card {
            padding: 30px 25px;
        }
        h1 {
            font-size: 1.8rem;
        }
    }
</style>
</head>
<body>

    <div class="top-bar">
        <a href="{{ route('dashboard') }}" class="btn-home">🏠 Home</a>
        <a href="{{ route('purchases.create') }}" class="stock-btn">➕ Add Stock</a>
    </div>

    <h1>Add Product</h1>

    <div class="card">
        <form id="productForm" action="{{ route('products.store') }}" method="POST">
            @csrf

            @if(session('success'))
                <div class="alert-success">
                    {{ session('success') }}
                </div>
            @endif

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

            <input type="number" step="0.01" name="price" placeholder="Price" min="0" required>

            <button type="submit">💾 Save Product</button>

            <!--loading indicators-->
            <div id="loading">
                <div class="spinner"></div>
                <p>Please wait...⏳</p>
            </div>
        </form>
    </div>

<script>
    const form = document.getElementById('productForm');
    const loading = document.getElementById('loading');
    const button = form.querySelector('button');

    form.addEventListener('submit', () => {
        loading.style.display = 'block';
        button.disabled = true;
        button.textContent = 'Submitting...';
    });
</script>

</body>
</html>
