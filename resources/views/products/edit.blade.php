<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #e0f7fa, #ffffff);
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .btn-home {
            background: #28a745;
            color: #fff;
            font-weight: 600;
            border-radius: 8px;
            padding: 8px 16px;
            text-decoration: none;
            transition: background 0.3s ease;
            margin: 20px;
            align-self: flex-start;
        }

        .btn-home:hover {
            background: #1e7e34;
        }

        .container {
            background: #fff;
            width: 400px;
            border-radius: 15px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
            padding: 30px 40px;
            text-align: center;
        }

        h3 {
            color: #333;
            margin-bottom: 25px;
        }

        label {
            display: block;
            text-align: left;
            margin-bottom: 5px;
            color: #555;
            font-weight: 500;
        }

        input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-bottom: 15px;
            font-size: 15px;
            outline: none;
            transition: border 0.3s;
        }

        input:focus {
            border-color: #667eea;
            box-shadow: 0 0 5px rgba(102, 126, 234, 0.3);
        }

        button {
            width: 40%;
            background: #667eea;
            color: #fff;
            font-size: 16px;
            font-weight: 600;
            padding: 12px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background: #4a54e1;
        }
    </style>
</head>
<body>

    <a href="{{ route('dashboard') }}" class="btn-home">🏠 Home</a>
    <h2>Edit  ' {{$product->name}} '  product</h2><br><br>
    <div class="container">
        <br><br>
        <form action="{{ route('products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label>Name</label>
            <input type="text" name="name" value="{{ $product->name }}" required>

            <label>Price</label>
            <input type="number" step="0.01" name="price" value="{{ $product->price }}" required>

            <button type="submit">Update</button>
        </form>
    </div>

</body>
</html>
