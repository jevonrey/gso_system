<!DOCTYPE html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GSO Inventory Portal</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: #0b0f1a;
            font-family: Arial, sans-serif;
            margin: 0;
        }
        .container {
            position: relative;
            width: 350px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
        }
        .container h2 {
            color: white;
            margin-bottom: 20px;
        }
        .input-group {
            margin-bottom: 15px;
            text-align: left;
        }
        .input-group label {
            display: block;
            font-size: 14px;
            color: #aaa;
        }
        .input-group input {
            width: 95%;
            padding: 10px;
            border: none;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            color: white;
            font-size: 14px;
        }
        .submit-btn {
            display: block;
            width: 100%;
            padding: 10px;
            background: #1f2d52;
            color: white;
            text-align: center;
            border-radius: 25px;
            text-decoration: none;
            font-weight: bold;
            margin-top: 10px;
            cursor: pointer;
            border: none;
        }
        .submit-btn:hover {
            background: #293b6a;
        }
        .footer {
            margin-top: 10px;
            font-size: 14px;
            display: flex;
            justify-content: space-between;
            color: white;
        }
        .footer a {
            text-decoration: none;
            color: #4a90e2;
        }
    </style>
</head>
<body>
    
    <div class="container">
        <h1>Welcome to GSO Inventory Portal</h1>
        <h2>LOGIN to Continue</h2>
        <div class="input-group">
            <label>USERNAME</label>
            <input type="text" placeholder="Enter Username">
        </div>
        <div class="input-group">
            <label>PASSWORD</label>
            <input type="password" placeholder="Enter Password">
        </div>
        <button class="submit-btn">LOGIN</button>
        <div class="footer">
        </div>
    </div>
</body>
</html>