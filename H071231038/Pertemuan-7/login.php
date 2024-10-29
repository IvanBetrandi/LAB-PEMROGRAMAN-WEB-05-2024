<?php
session_start();
include 'config.php';

if (isset($_SESSION['user_id'])) {
    session_unset(); 
    session_destroy(); 
    header('Location: login.php'); 
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        header('Location: index.php');
        exit;
    } else {
        $error = 'Invalid username or password';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #abb2b9;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
        }
        .login-card {
            background: #fff;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            color: #333;
            max-width: 400px;
            width: 100%;
        }
        .form-control {
            border-radius: 10px;
        }
        .login-title {
            font-weight: 700;
            font-size: 1.5rem;
            color: #333;
        }
        .btn-primary {
            border-radius: 10px;
            background-image: linear-gradient(45deg, #6a11cb, #2575fc);
            border: none;
            font-weight: 600;
        }
        .btn-link {
            color: #6a11cb;
            font-weight: bold;
        }
        .btn-link:hover {
            color: #2575fc;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <h2 class="login-title text-center mb-4">Welcome!</h2>

        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="alert alert-success text-center">
                <?php 
                    echo $_SESSION['success_message']; 
                    unset($_SESSION['success_message']); 
                ?>
            </div>
        <?php endif; ?>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger text-center">
                <?= $error ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <input type="text" name="username" class="form-control" placeholder="Username" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>
        
        <p class="text-center mt-4">Belum punya akun? <a href="register.php" class="btn btn-link">Daftar sekarang</a></p>  
    </div>

</body>
</html>
