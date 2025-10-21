<!DOCTYPE html>
<html>
    <head>
        <meta lang="en">
        <meta name="viewport" content="width=device-width, initial-scale= 1.0">
        <title>Stock Report</title>
        <style>
            body{
                font-family: 'Segoe UI', sans-serif;
                background: #f4f6f8;
                margin: 0;
                padding: 20px;
                color: #333;
            }
             
            h1{
                text-align: center;
                margin-bottom: 30px;
                color: #0d0000ff;
            }
            table{
                width: 90%;
                background: #fff;
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

            /* download pdf button */
            .btn-download {
                background: #28a745;
                color: #fff;
                font-weight: 600;
                border-radius: 8px;
                padding: 10px 18px;
                text-decoration: none;
                margin-right: 110px;
                transition: background 0.3s ease;
            }
            .btn-download:hover {
                background: #1e7e34;
            }

            .top-bar {
                width: 100%;
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 20px 40px;
                box-sizing: border-box;
            }

        </style>
    </head>
    <body>

            <h1>Stock Report</h1>
            <div class="top-bar">
                <a href="{{route('dashboard')}}" class="btn-home">Back</a> <br><br>

                <!--download report pdf-->
                <a href="{{ route('reports.stock.pdf') }}" class="btn-download">Download PDF</a>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>product Name</th>
                        <th>Category</th>
                        <th>Total In</th>
                        <th>Total Out</th>
                        <th>Current Stock </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($report as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td><!--show a serial number (row number) for each product-->
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['category'] }}</td>
                        <td>{{ $item['total_in'] }}</td>
                        <td>{{ $item['total_out'] }}</td>
                        <td>{{ $item['current_stock'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

    </body>
</html>