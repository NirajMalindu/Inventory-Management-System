<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Stock</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #dfe9f3, #ffffff);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        h1 {
            font-size: 2.2rem;
            color: #1a1a1a;
            text-align: center;
            margin-bottom: 10px;
        }
            
        form {
            background: #fff;
            padding: 35px 40px;
            border-radius: 16px;
            max-width: 480px;
            width: 90%;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            animation: fadeIn 0.6s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(25px); }
            to { opacity: 1; transform: translateY(0); }
        }

        input, select {
            width:90%;
            padding: 14px 15px;
            margin: 14px 0;
            border-radius: 10px;
            border: 1px solid #d1d0d0ff;
            font-size: 1rem;
        }

        input:focus, select:focus{
            border-color: #0d7cf2ff;
            outline: none;
            box-shadow: 0 0 6px rgba(0,123,255,0.4);
        }
     
        button{
            width: 50%;
            margin-top: 15px;
            padding: 13px;
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 1.1rem;
            cursor: pointer;
            font-weight: 400;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }

        button:hover {
            background: linear-gradient(135deg, #0056b3, #004099);
            transform: translateY(-2px);
        }
        
        .alert-success {
            color: #155724;
            background: #d4edda;
            border: 1px solid #c3e6cb;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 8px;
        }

        .alert-danger {
            color: #721c24;
            background: #f8d7da;
            border: 1px solid #f5c6cb;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 8px;
        }

        /* loading spinner */
        #loading {
            display: none;
            margin-top: 15px;
            text-align: center;
        }

        .spinner {
            border: 6px solid #f3f3f3;
            border-top: 6px solid #007bff;
            border-radius: 50%;
            width: 40px;
            height: 40px;
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
    <h1>Add stock for your product</h1>

    <form id="purchaseForm" action ="{{ route('purchases.store') }}" method="POST">

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

        <label>Your Name</label>
        <input type="text" name="supplier" required><br>

        <label>Product:</label>
        <select name="product_id">
            @foreach($products as $product)
                <option value="{{ $product->id }}">{{ $product->name }}</option>
            @endforeach
        </select><br>

        <label>Quantity</label>
        <input type="number" name="quantity" required><br>

        <button type="submit" >Add your stock</button>


        <!-- Loading spinner -->
        <div id="loading">
            <div class="spinner"></div>
            <p>Processing... Please wait ⏳</p>
        </div>
    </form>

    <script>
        const form = document.getElementById('purchaseForm');
        const loading = document.getElementById('loading');
        const button = form.querySelector('button');

        form.addEventListener('submit', () => {
            // Show spinner and disable button
            loading.style.display = 'block';
            button.disabled = true;//disable button
            button.textContent = 'Submitting...';
        });
    </script>
</body>
</html>
