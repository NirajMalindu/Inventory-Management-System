<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .register-container {
            background: #fff;
            padding: 50px 40px;
            border-radius: 15px;
            box-shadow: 0 12px 30px rgba(0,0,0,0.2);
            width: 400px;
            max-width: 90%;
            text-align: center;
        }

        h2 {
            font-size: 2rem;
            margin-bottom: 25px;
            color: #333;
        }

        label {
            display: block;
            margin: 10px 0 5px 0;
            font-weight: 600;
            color: #555;
            text-align: left;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-bottom: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 0.95rem;
            transition: 0.3s;
        }

        input:focus {
            border-color: #667eea;
            box-shadow: 0 0 8px rgba(102, 126, 234, 0.3);
            outline: none;
        }

        .error {
            color: #e3342f;
            font-size: 13px;
            text-align: left;
            margin-bottom: 8px;
        }

        .btn-primary {
            background: #667eea;
            color: #fff;
            border: none;
            padding: 12px;
            width: 100%;
            font-size: 1rem;
            border-radius: 10px;
            cursor: pointer;
            margin-top: 10px;
            transition: 0.3s;
        }

        .btn-primary:hover {
            background: #4a54e1;
        }

        .login-link {
            margin-top: 15px;
            font-size: 0.9rem;
            color: #555;
        }

        .login-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Register</h2>
        <form method="POST" action="{{ route('register') }}">
            
            @csrf

            <label for="name">Name</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="password">Password</label>
            <input id="password" type="password" name="password" required autocomplete="new-password">
            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="password_confirmation">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
            @error('password_confirmation')
                <div class="error">{{ $message }}</div>
            @enderror

            <button type="submit" class="btn-primary">Register</button>

            <div class="login-link">
                <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
            </div>
        </form>
    </div>
</body>
</html>
