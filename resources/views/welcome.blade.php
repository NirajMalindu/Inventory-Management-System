<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <style>
        body {
            margin: 0;
            font-family: "Segoe UI", Arial, sans-serif;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: #fff;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 40px;
            background: rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(6px);
        }

        header h1 {
            font-size: 1.8rem;
            font-weight: bold;
        }

        header nav a {
            margin-left: 15px;
            padding: 10px 18px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 500;
            transition: background 0.3s;
        }

        .btn-login {
            background: #007bff;
            color: white;
        }

        .btn-login:hover {
            background: #0056b3;
        }

        .btn-register {
            background: #ff4081;
            color: white;
        }

        .btn-register:hover {
            background: #c60055;
        }

        main {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 40px 20px;
        }

        main h2 {
            font-size: 3rem;
            margin-bottom: 20px;
        }

        main p {
            font-size: 1.2rem;
            max-width: 600px;
            color: #f0f0f0;
            margin-bottom: 30px;
        }

        .cta-buttons a {
            margin: 10px;
            padding: 12px 25px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 1rem;
            font-weight: bold;
            transition: 0.3s;
        }

        
    </style>
</head>
<body>

<header>
    <h1>Trading Company</h1>
    <nav>
        <a href="{{ route('login') }}" class="btn-login">Login</a>
        <a href="{{ route('register') }}" class="btn-register">Register</a>
    </nav>
</header>

<main>
    <h2>Welcome !</h2>
    <p>
        We are a global trading company
    </p>
    <div class="cta-buttons">
        <a href="{{ route('register') }}" class="btn-register">Get Started</a>
        <a href="{{ route('login') }}" class="btn-login">Login</a>
    </div>
</main>


</body>
</html>
