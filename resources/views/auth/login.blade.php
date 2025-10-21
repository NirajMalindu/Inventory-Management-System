<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body { 
            font-family: 'Segoe UI', Arial, sans-serif; 
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex; 
            justify-content: center; 
            align-items: center; 
            height: 100vh; 
            margin: 0;
        }
        .login-container { 
            background: #fff; 
            padding: 40px 30px; 
            border-radius: 12px; 
            box-shadow: 0 8px 20px rgba(0,0,0,0.15); 
            width: 350px; 
            text-align: center;
        }
        .login-container h2 {
            margin-bottom: 20px;
            color: #333;
        }
        input { 
            width: 100%;
            padding: 12px; 
            margin: 10px 0; 
            border-radius: 6px; 
            border: 1px solid #ccc; 
            font-size: 1rem;
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        input:focus {
            border-color: #667eea;
            box-shadow: 0 0 5px rgba(102,126,234,0.4);
            outline: none;
        }
        button { 
            width: 100%; 
            padding: 12px; 
            margin-top: 10px;
            background: #667eea; 
            color: #fff; 
            font-size: 1rem;
            border: none; 
            border-radius: 6px; 
            cursor: pointer; 
            transition: background 0.3s;
        }
        button:hover { 
            background: #4a54e1; 
        }
        .error { 
            color: red; 
            font-size: 14px; 
            margin-top: -5px;
            text-align: left;
        }
        .register-link {
            margin-top: 15px;
            font-size: 0.95rem;
            color: #333;
        }
        .register-link a {
            color: #667eea;
            font-weight: bold;
            text-decoration: none;
        }
        .register-link a:hover {
            text-decoration: underline;
        }

        #loading{
            text-align: center;
            display:none;
            margin-top: 15%;
            color: #fff;
        }

        .spinner {
            border: 6px solid #f3f3f3;
            border-top: 6px solid hsla(211, 100%, 50%, 1.00);
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
    <div class="login-container" id = "login">
        <h2 id= "h2">Login</h2>

        @if(session('status'))
            <p class="error">{{ session('status') }}</p>
        @endif

        <form method="POST" action="{{ route('login') }}" id="loginForm">
            @csrf

            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
            @error('email') 
                <div class="error">{{ $message }}</div> 
            @enderror

            <input type="password" name="password" placeholder="Password" required>
            @error('password') 
                <div class="error">{{ $message }}</div> 
            @enderror

            <button type="submit" id = "">Login</button>
        </form>

        <p class="register-link">
            Don’t have an account? <a href="{{ route('register') }}">Register</a>
        </p>

    </div>

    
        <!--loading indicators-->
        <div id="loading">
            <div class="spinner"></div>
            <p>Loading Please wait...⏳</p>
        </div>

        <script>
            const form = document.getElementById('loginForm');
            const loading = document.getElementById('loading');
            const login = document.getElementById('login');

            form.addEventListener('submit', ()=>{
                form.style.display = 'none';
                loading.style.display = 'block';
                login.style.display = 'none';
            });

        </script>
</body>
</html>
