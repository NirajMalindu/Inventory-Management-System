<!DOCTYPE html>
<html lang ="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


        <title>Products</title>
        

        <style>
            body{
                font-family: 'Poppins', sans-serif;
                background: #f5f7fa;
                margin: 0;
                padding: 20px;
            }
            h2{
                text-align: center;
            }
            .session-succ{
                color: green;
                text-align: center;
            }
            .session-err{
                color: red;
                text-align: center;
            }
            .no-products{
                text-align:center;
                color:gray;
                margin-top:30px;
            }

            .top-bar {
                display: flex;
                align-items: center;
                margin-bottom: 25px;
                flex-wrap: wrap;
                gap: 10px;
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
                border-color: #28a745;
                box-shadow: 0 0 5px rgba(0,123,255,0.3);
            }

            .search-box button {
                background: #28a745;
                color: white;
                border: none;
                border-radius: 8px;
                padding: 10px 18px;
                cursor: pointer;
                transition: 0.3s;
                margin-right: 30px;
            }

            .search-box button:hover {
                background: #1e7e34;
            }

            .card-container{
                align-items: center;
                display: flex;
                   flex-wrap: wrap; 
                margin-bottom: 30px;
                gap: 20px;
                
            }
            .card {
                background: white;
                border-radius: 10px;
                box-shadow: 0 4px 10px rgba(0,0,0,0.1);
                text-align: center;
                padding: 15px;
                transition: transform 0.2s;
                cursor: pointer;
                width: 13%;
                height: 260px; 
                margin-top: 30px;
   
            }
            .card:hover { 
                transform: translateY(-5px); 
            }
            .card img {
                width: 90%;
                height: 200px;
                object-fit: cover;
                border-radius: 10px;
            }

            .card h3 { 
                margin: 10px 0; 
                color: #333; 
            }

            .price {
                color: #27ae60;
                font-weight: bold;
            }

            /* Form style */
            .form-container {
                display: none;
                background: #fff;
                border-radius: 12px;
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
                padding: 20px;
                max-width: 400px;
                margin: 0 auto;
                text-align: center;
            }

            .form-container img {
                width: 80%;
                height: 300px;
                object-fit: cover;
                border-radius: 10px;
                margin-bottom: 10px;
            }

            .qty-btn {
                padding: 8px 12px;
                background: #007bff;
                border: none;
                color: white;
                border-radius: 6px;
                font-size: 18px;
                cursor: pointer;
                margin: 0 8px;
            }

            #buyBtn {
                background: #28a745;
                color: white;
                border: none;
                padding: 10px 20px;
                border-radius: 6px;
                cursor: pointer;
                margin-top: 10px;
            }

            .close-btn {
                color: red;
                cursor: pointer;
                margin-top: 10px;
                display: inline-block;
            }

            .descrip {
                color: #555;
                font-size: 14px;
                margin: 8px 0;
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

        </style>
    </head>
    <body>
        <h2>Place your order</h2>

        <div class="top-bar" id="searchLoading">
            <!--back btn-->
            <a href="{{ route('dashboard') }}" class="btn-home" id= "btnHome">🏠 Home</a>

            <form method= "GET" action="{{route('orders.create')}}" class = "search-box">
                <input type="text" name="search" placeholder= "Search by Name or Category" value="{{ request('search') }}" id="">
                <button type="submit">Search</button>
            </form>
        </div>
        <br><br>

        @if(session('success'))
            <p class="session-succ">{{session('success')}}</p>
        @endif

        @if(session('error'))
            <p class="session-err">{{session('error')}}</p>
        @endif
        

        @if($products->isEmpty())
        <p class= "no-products">
            No products founded.
        </p>
        @else

        <div class="card-container" id= "cardContain">
            @foreach($products as $product)
              <div class="card" 
                    onclick="openForm(@js($product->id), @js($product->name), @js(asset('storage/'.$product->image)),
                    @js($product->description), @js($product->price), @js($product->current_stock) )">


                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{$product->name}}">
                    <h3>Name: {{$product->name}}</h3>
                    <div class="price">
                        Rs. {{ number_format($product->price, 2) }}
                    </div>
                </div>
            @endforeach
        </div>
        @endif

        <!--hidden form-->
        <div id= "productForm" class="form-container">
            <p id="message" style="color:green; display:none; margin-top:10px; font-size:20px;"></p>

            <img id= "formImg" src="" alt="">
            <h3 id= "formName"></h3>

            <input type="hidden" id= "productId">
            <p id= "formDescrip"  class="descrip"></p>
            <div id ="formPrice" class="price"></div>
            <h3 id= "quantityValue"></h3>
            
            <div style= "margin:10px 0;">
                <button type="button" class= "qty-btn" onclick= "changeQty(-1)">-</button>
                <span id="quantityInput">1</span>
                <button type="button" class= "qty-btn" onclick= "changeQty(1)">+</button>
            </div>

            <button type="button" id= "buyBtn">Submit</button>
            <div class="close-btn" onclick= "closeForm()"> Cancel</div>

           

        </div>



        <script >

            let quantity = 1;
            let maxStock = 0;

            function openForm(id, name, image, description, price, current_stock){

                document.getElementById('formImg').src = image;
                document.getElementById('formName').innerText = name;
                document.getElementById('productId').value = id;
                document.getElementById('formDescrip').innerText = description;
                document.getElementById('formPrice').innerText =  'Rs. ' + price;

                document.getElementById('quantityValue').innerText = current_stock + '   Available';
                document.getElementById('quantityInput').innerText = 1;
                quantity = 1;

                maxStock = parseInt(current_stock);

                document.getElementById('productForm').style.display = 'block';
                document.getElementById('cardContain').style.display = 'none';
                document.getElementById('searchLoading').style.display = 'none';


            }


            function closeForm() {
                document.getElementById('productForm').style.display = 'none';
                document.getElementById('cardContain').style.display = 'flex';
                document.getElementById('searchLoading').style.display = 'flex';

                window.location.href = "{{ route('orders.create') }}";


            }


            function changeQty(change){

                let newQuantity = quantity + change;

                if(newQuantity < 1){
                    message.innerText = "Minimum quantity is 1.";
                    message.style.color = 'red';
                    message.style.display = 'block';
                    
                     setTimeout(() => {
                                $('#message').fadeOut();
                            }, 2000);
                    return;
                }

                if(newQuantity > maxStock){
                    message.innerText = "sorry, only " + maxStock + " stock available.";
                    message.style.display = 'block';

                     setTimeout(() => {
                                $('#message').fadeOut();
                            }, 2000);
                    return;
                }

                quantity = newQuantity;
                document.getElementById('quantityInput').innerText = quantity;
            }


            //ajax button, buy button
            $('#buyBtn').on('click', function(){
                
                let productId = $('#productId').val();
                let qty = $('#quantityInput').text();
                let token = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: "{{ route('orders.store') }}",
                    method: 'POST',
                    data: {
                        _token: token,
                        product_id: productId,
                        quantity: qty
                    },

                    success: function(response) {
                        if (response.status === 'success') {
                            $('#message').text(response.message).show();
                            $('#quantityValue').text(response.updated_stock + '   Available')
                            setTimeout(() => {
                                $('#message').fadeOut();
                            }, 2000);
                        }
                    },

                    error: function(xhr) {
                         if (xhr.responseJSON && xhr.responseJSON.message) {
                            $('#message').css('color', 'red').text(xhr.responseJSON.message).show();
                        }else{
                            alert('Something went wrong while buying!');
                        }
                    }
                })
            });

            
        </script>

    </body>
</html>
