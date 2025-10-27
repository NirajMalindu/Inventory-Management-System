<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>

        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f4f6f8; 
            margin: 0;
            padding: 0;
            color: #333;
        }

        header {
            background: linear-gradient(90deg, #4b6cb7, #182848); 
            color: white;
            padding: 25px 0;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        header h1 {
            margin: 0;
            font-size: 2rem;
        }

        header p {
            margin: 5px 0 0 0;
            font-size: 1.1rem;
            opacity: 0.9; 
        }

        .container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            padding: 40px;
            max-width: 1000px;
            margin: 0 auto;
        }

        
        .card-btn {
            background: white;
            border-radius: 12px;
            padding: 25px 20px;
            text-decoration: none;
            color: #333;
            font-weight: bold;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        }

        
        .logout-btn {
            background: #ff4d4f;
            color: white;
            border-radius: 10px;
            padding: 10px 20px;
            height:25px;
            width:100px;
            margin-top:20px;
        }

        .logout-btn:hover {
            background: #d9363e;
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
    
    <header id="header">
        <h1>Dashboard</h1>
        <p>Welcome, {{ auth()->user()->name }}</p>
    </header>

    <!-- navigation Buttons card ekak -->
    <div class="container"  id = "navButtons">
        <a href="{{ route('products.index') }}" class="card-btn" onclick="submitData()">Products</a>
        <a href="{{ route('products.create') }}" class="card-btn" onclick="submitData()">Add Product</a>
        <a href="{{ route('orders.index') }}" class="card-btn" onclick="submitData()">Orders</a>
        <a href="{{ route('orders.create') }}" class="card-btn" onclick="submitData()">Place Order</a>
        <a href="{{ route('report.create') }}" class="card-btn" onclick="submitData()">Generate Report</a>
        <a href="{{ route('logout') }}" class="card-btn logout-btn"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </a>
    </div>

    <!-- hidden logout form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
        @csrf
    </form>


    <!--loading indicators-->
    <div id="loading">
        <div class="spinner"></div>
        <p>Loading please wait...⏳</p>
    </div>

    <script>

        function submitData(){
            const navButtons = document.getElementById('navButtons');//take navButton section
            const loading = document.getElementById('loading');//take loading section
            const header = document.getElementById('header');//take header section

            navButtons.style.display = 'none';//hide
            loading.style.display = 'block';//show
            header.style.display = 'none';

            
        }
    </script>

</body>
</html>
