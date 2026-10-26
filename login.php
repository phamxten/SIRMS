<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    // Idealnya cek dari database, ini contoh hardcode dulu
    if ($username === 'admin' && $password === '12345') {
        $_SESSION['user'] = $username; // Simpan session
        header('Location: dashboard.php'); // Redirect ke dashboard
        exit();
    } else {
        $error = "Username atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body{
            font: 18px/30px arial,san-serif ;
            font-weight: bold;
            background-image: url(bg.png);
        }
        .container{
            padding: 20px;
            border-radius: 15px;
            width: 500px;
            height: 400px;
            margin: 100px auto;
            background-color: white;
            position: relative;
        }
        input{
            font: 18px/30px arial,san-serif ;
            font-weight: bold;
            width: 90%;
            height: 8%;
            border-radius: 13px;
        }
        
        #login{
            text-align: center;
        }
        button{
            font: 18px/30px arial,san-serif ;
            font-weight: bold;
            border-radius: 13px;
            width: 200px;
            height: 50px;
            align-self: center;
            position: absolute;
            bottom: 20px;
            left: 150px;
        }
    </style>
</head>
<body>
    <form action="login.php" method="post">
        <div class="container">
            <h1 id="login">Login</h1>
            <h2>Username</h2>
            <input type="text" name="username" placeholder="Username">
            <h2>Password</h2>
            <input type="password" name="password" placeholder="Password">
            <?php if (!empty($error)) echo "<p style='color:red'>$error</p>"; ?>
            <br>
            <br>
            <button>login</button>
        </div>
    </form>
</body>
</html>