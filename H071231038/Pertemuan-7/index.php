<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$role = $_SESSION['role'];
$search = isset($_GET['search']) ? $_GET['search'] : '';

$error_message = '';


$editData = null;
if (isset($_GET['edit']) && $role === 'admin') {
    $id = $_GET['edit'];
    $stmt = $pdo->prepare("SELECT * FROM mahasiswa WHERE id = ?");
    $stmt->execute([$id]);
    $editData = $stmt->fetch();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $prodi = $_POST['prodi'];

    $stmt = $pdo->prepare("SELECT COUNT(*) FROM mahasiswa WHERE nim = ? AND id != ?");
    $stmt->execute([$nim, $_POST['id'] ?? 0]);
    $nimExists = $stmt->fetchColumn() > 0;

    if ($nimExists) {
        $error_message = 'NIM sudah terdaftar. Silakan gunakan NIM lain.';
    } else {
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            $id = $_POST['id'];
            $stmt = $pdo->prepare("UPDATE mahasiswa SET nama = ?, nim = ?, prodi = ? WHERE id = ?");
            $stmt->execute([$nama, $nim, $prodi, $id]);
        } else {
            $stmt = $pdo->prepare("INSERT INTO mahasiswa (nama, nim, prodi) VALUES (?, ?, ?)");
            $stmt->execute([$nama, $nim, $prodi]);
        }
        
        header("Location: index.php");
        exit();
    }
}


if (isset($_GET['delete']) && $role === 'admin') {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM mahasiswa WHERE id = ?");
    $stmt->execute([$id]);
}


if ($search) {
    $stmt = $pdo->prepare("SELECT * FROM mahasiswa WHERE nama LIKE ? OR nim LIKE ? OR prodi LIKE ?");
    $stmt->execute(["%$search%", "%$search%", "%$search%"]);
} else {
    $stmt = $pdo->prepare("SELECT * FROM mahasiswa");
    $stmt->execute();
}

$mahasiswa = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body { background-color: #f4f5f7; font-family: Arial, sans-serif; }
        .container { max-width: 800px; margin: 2rem auto; padding: 1.5rem; background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); }
        .header-title { font-size: 1.8rem; font-weight: bold; color: #333; text-align: center; margin-bottom: 1.5rem; }
        .form-control, .btn { border-radius: 5px; }
        .btn-primary { background-color: #007bff; border: none; }
        .btn-success { background-color: #28a745; border: none; }
        .btn-danger { background-color: #dc3545; border: none; }
        .table th, .table td { text-align: center; vertical-align: middle; }
        .action-links a { margin: 0 0.2rem; color: #555; font-weight: 500; }
        .action-links a:hover { text-decoration: underline; }
        .logout-btn { color: #555; font-weight: bold; }
        .cancel-btn { margin-left: 0.5rem; color: #007bff; font-size: 0.9rem; }
        .error-message { color: red; text-align: center; margin-bottom: 10px; }
    </style>
</head>
<body>

<div class="container">
    <h1 class="header-title">Data Mahasiswa</h1>

    <!-- Error Message -->
    <?php if (!empty($error_message)): ?>
        <div class="error-message"><?= $error_message ?></div>
    <?php endif; ?>

    <!-- Search -->
    <form method="GET" action="index.php" class="d-flex justify-content-center mb-4">
        <input type="text" name="search" class="form-control" placeholder="Cari nama, NIM, atau prodi" value="<?= htmlspecialchars($search) ?>">
        <button type="submit" class="btn btn-primary ml-2">Cari</button>
    </form>

    <!-- Add/Edit Form -->
    <?php if ($role === 'admin'): ?>
        <form method="POST" class="border rounded p-3 mb-4">
            <input type="hidden" name="id" value="<?= $editData['id'] ?? '' ?>">
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <input type="text" name="nama" class="form-control" placeholder="Nama" required value="<?= $editData['nama'] ?? '' ?>">
                </div>
                <div class="col-md-4 mb-3">
                    <input type="text" name="nim" class="form-control" placeholder="NIM" required value="<?= $editData['nim'] ?? '' ?>">
                </div>
                <div class="col-md-4 mb-3">
                    <input type="text" name="prodi" class="form-control" placeholder="Prodi" required value="<?= $editData['prodi'] ?? '' ?>">
                </div>
            </div>
            <button type="submit" class="btn btn-success"><?= isset($editData) ? 'Update' : 'Simpan' ?></button>
            <?php if (isset($editData)): ?>
                <a href="index.php" class="cancel-btn">Batal</a>
            <?php endif; ?>
        </form>
    <?php endif; ?>

    <!-- Tabel -->
    <table class="table table-striped table-hover">
        <thead class="thead-dark">
            <tr>
                <th>Nama</th>
                <th>NIM</th>
                <th>Prodi</th>
                <?php if ($role === 'admin'): ?><th>Aksi</th><?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($mahasiswa as $mhs): ?>
                <tr>
                    <td><?= htmlspecialchars($mhs['nama']) ?></td>
                    <td><?= htmlspecialchars($mhs['nim']) ?></td>
                    <td><?= htmlspecialchars($mhs['prodi']) ?></td>
                    <?php if ($role === 'admin'): ?>
                        <td class="action-links">
                            <a href="?edit=<?= $mhs['id'] ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                            <a href="?delete=<?= $mhs['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="text-center mt-3">
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
