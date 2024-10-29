<?php
session_start();
include 'config.php';

$success_message = '';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = 'mahasiswa';

    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        $error_message = 'Username sudah terdaftar. Silakan pilih username lain.';
    } else {
        $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
        if ($stmt->execute([$username, $password, $role])) {
            $success_message = 'Akun Berhasil Dibuat. Silahkan <a href="login.php">Login di sini</a>.';
        } else {
            $error_message = 'Gagal Membuat akun. Silakan coba lagi.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register Mahasiswa</title>
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
        .register-card {
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
        .register-title {
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

    <div class="register-card">
        <h2 class="register-title text-center mb-4">Buat Akun</h2>

        <?php if (!empty($success_message)): ?>
            <div class="alert alert-success">
                <?= $success_message ?>
            </div>
        <?php elseif (!empty($error_message)): ?>
            <div class="alert alert-danger">
                <?= $error_message ?>
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
                <button type="submit" class="btn btn-primary">Daftar</button>
            </div>
        </form>
        
        <div class="text-center mt-3">
            <a href="login.php" class="btn-link">Sudah punya akun? Login di sini</a>
        </div>
    </div>

</body>
</html>
