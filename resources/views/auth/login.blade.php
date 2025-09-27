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
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>

        @if(session('status'))
            <p class="error">{{ session('status') }}</p>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
            @error('email') 
                <div class="error">{{ $message }}</div> 
            @enderror

            <input type="password" name="password" placeholder="Password" required>
            @error('password') 
                <div class="error">{{ $message }}</div> 
            @enderror

            <button type="submit">Login</button>
        </form>

        <p class="register-link">
            Don’t have an account? <a href="{{ route('register') }}">Register</a>
        </p>
    </div>
</body>
</html>
