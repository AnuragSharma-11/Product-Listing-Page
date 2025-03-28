<?php
include '../config/db.php';

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin_users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        $_SESSION['admin'] = $username;
        header("Location: index.php");
        exit;
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
        }
        .login-box {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.3);
            text-align: center;
            width: 100%;
            max-width: 400px;
        }
        .form-control {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: #fff;
            border-radius: 8px;
        }
        .form-control::placeholder {
            color: #ddd;
        }
        .btn-primary {
            background: linear-gradient(45deg, #ff7eb3, #ff4f7b);
            border: none;
            transition: 0.3s;
            border-radius: 8px;
            font-weight: bold;
            box-shadow: 0 4px 10px rgba(255, 126, 179, 0.5);
        }
        .btn-primary:hover {
            background: linear-gradient(45deg, #ff4f7b, #ff245b);
        }
        .error-msg {
            color: #ff4d4d;
            margin-top: 10px;
        }
        h3 {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h3>Admin Login</h3>
        <form method="post">
            <div class="mb-3">
                <input type="text" name="username" class="form-control" placeholder="Username" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
            <?php if (isset($error)) { echo "<p class='error-msg'>$error</p>"; } ?>
        </form>
    </div>
</body>
</html>
