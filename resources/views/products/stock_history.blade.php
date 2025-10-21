<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{$product->name}} Stock History</title>

    <style>

        body{
            font-family: 'Segoe UI', sans-serif;
            background: #fff;
            margin: 0;
            padding: 30px;
        }

        h1 { 
            text-align: center;
            margin-bottom: 20px; 
        }
        
        h3, p { 
            text-align: center; 
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th { 
            background: #007bff; 
            color: #fff; 
        }
        
        .filters {
            margin-top: 10px;
            text-align: center;
        }
        .filters a {
            display: inline-block;
            margin: 5px;
            padding: 6px 12px;
            text-decoration: none;
            background: #e9ecef;
            border-radius: 5px;
            color: #333;
            transition: 0.3s;
        }
        .filters a.active {
            background: #007bff;
            color: #fff;
        }
        .btn-back {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background: #28a745;
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
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

    <div id="h1">
        <h1 >{{$product->name}} Stock history</h1><!--to show the stock name-->
        <h3>Category: {{$product->category->name ?? 'N/A' }}</h3><!--to show the category name-->
        <p>Current Stock: {{$product->current_stock}}</p><!--to show the current stock (used dynamically calculation stock in- out)-->
    </div>
        <div class="filters" id ="filter">
            <!--give filter option to filter in,out-->
           <strong>Filter By:</strong>
            <a href="{{ route('stock.history', $product->id) }}" class="{{ !$type ? 'active' : '' }}">All</a>
            <a href="{{ route('stock.history', $product->id) }}? type=in" class="{{ $type == 'in' ? 'active' : '' }}">In</a>
            <a href="{{ route('stock.history', $product->id) }}? type=out" class="{{ $type == 'out' ? 'active' : '' }}">Out</a>
            
            <br>
            <!--give sort option to sort asc and desc-->
            <strong>Sort By:</strong>
            <a href="?sort=asc" class="{{ $sort=='asc' ? 'active' : '' }}">Oldest</a>
            <a href="?sort=desc" class="{{ $sort=='desc' ? 'active' : '' }}">Newest</a>
        </div>

        <table id="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Type</th>
                    <th>In</th>
                    <th>Out</th>
                    <th>Reference</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($entries as $entry)
                <tr>
                    <td>{{ $loop->iteration }}</td><!--display the current index number when looping through items-->
                    <td>{{ ucfirst($entry->type) }}</td>
                    <td>{{ $entry->in ?: '-' }}</td>
                    <td>{{ $entry->out ?: '-' }}</td>
                    <td>{{ $entry->reference_id ?? 'N/A' }}</td>
                    <td>{{ $entry->created_at?->format('Y-m-d H:i') ?? 'N/A' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">No records found</td>
                </tr>
                @endforelse
            </tbody>
        </table>


        <div style="text-align:center;" id="btn">
            <a href="{{ route('products.index') }}" class="btn-back" onclick="submitData()">← Back to Products</a>
        </div>

    <!--loading indicators-->
        <div id="loading">
            <div class="spinner"></div>
            <p>Loading Please  Wait...</p>
        </div>

        <script>

            function submitData(){
                const filter = document.getElementById('filter');
                const loading = document.getElementById('loading');
                const table = document.getElementById('table');
                const h1 = document.getElementById('h1');
                const btn = document.getElementById('btn');

                filter.style.display = 'none';//hide
                loading.style.display = 'block';//show
                table.style.display = 'none';
                h1.style.display = "none";
                btn.style.display= "none";

                // After 3 seconds, reverse the visibility
                setTimeout(() => {
                    navButtons.style.display = 'block';
                    table.style.display = 'block';
                    loading.style.display = 'none';
                }, 3000); // 3000ms = 3 seconds
            }
        </script>
    </body>
</html>