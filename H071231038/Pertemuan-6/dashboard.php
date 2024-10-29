<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit();
}

$user = $_SESSION['user'];
$is_admin = $user['username'] === 'adminxxx';

// Data pengguna
$users = [
    [
       'email' => 'admin@gmail.com',
       'username' => 'adminxxx',
       'name' => 'Admin',
       'password' => password_hash('admin123', PASSWORD_DEFAULT),
   ],
   [
       'email' => 'nanda@gmail.com',
       'username' => 'nanda_aja',
       'name' => 'Wd. Ananda Lesmono',
       'password' => password_hash('nanda123', PASSWORD_DEFAULT),
       'gender' => 'Female',
       'faculty' => 'MIPA',
       'batch' => '2021',
   ],
   [
       'email' => 'arif@gmail.com',
       'username' => 'arif_nich',
       'name' => 'Muhammad Arief',
       'password' => password_hash('arief123', PASSWORD_DEFAULT),
       'gender' => 'Male',
       'faculty' => 'Hukum',
       'batch' => '2021',
   ],
   [
       'email' => 'eka@gmail.com',
       'username' => 'eka59',
       'name' => 'Eka Hanny',
       'password' => password_hash('eka123', PASSWORD_DEFAULT),
       'gender' => 'Female',
       'faculty' => 'Keperawatan',
       'batch' => '2021',
   ],
   [
       'email' => 'adnan@gmail.com',
       'username' => 'adnan72',
       'name' => 'Adnan',
       'password' => password_hash('adnan123', PASSWORD_DEFAULT),
       'gender' => 'Male',
       'faculty' => 'Teknik',
       'batch' => '2020',
   ],
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #E9D5FF, #C7D2FE);
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 2em;
            color: #1D4ED8;
        }
        .header a {
            background-color: #EF4444;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }
        .header a:hover {
            background-color: #DC2626;
        }
        .card {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            transition: background-color 0.3s ease;
        }
        .card:hover {
            background-color: #F3F4F6;
        }
        .table-container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table, th, td {
            border: 1px solid #9CA3AF;
            text-align: center;
        }
        th, td {
            padding: 10px;
        }
        th {
            background-color: #F3F4F6;
            color: #6B7280;
        }
        tr:hover {
            background-color: #DBEAFE;
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Welcome container -->
        <div class="header">
            <h1>Dashboard</h1>
            <a href="logout.php">Logout</a>
        </div>

        <!-- Welcome section -->
        <div class="card">
            <h2>Welcome, <?= htmlspecialchars($user['name']) ?>!</h2>
            <p>You are logged in as <span style="font-weight: bold;"><?= htmlspecialchars($is_admin ? 'Admin' : 'User') ?></span>.</p>
            <?php if ($is_admin): ?>
                <div class="admin-info">
                    <p>Admin Email: <strong><?= htmlspecialchars($users[0]['email']) ?></strong></p>
                    <p>Admin Username: <strong><?= htmlspecialchars($users[0]['username']) ?></strong></p>
                </div>
            <?php else: ?>
                <div class="user-info">
                    <p>Your Email: <strong><?= htmlspecialchars($user['email']) ?></strong></p>
                    <p>Your Username: <strong><?= htmlspecialchars($user['username']) ?></strong></p>
                </div>
            <?php endif; ?>
        </div>

        <!-- All users container -->
        <div class="table-container">
            <h3><?= $is_admin ? 'All Users' : 'Your Information' ?></h3>

            <!-- Table -->
            <table>
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Faculty</th>
                        <th>Batch</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($is_admin): ?>
                        <?php foreach ($users as $user_data): ?>
                            <?php if ($user_data['username'] !== 'adminxxx'): ?> <!-- Filter out admin data -->
                                <tr>
                                    <td><?= htmlspecialchars($user_data['email']) ?></td>
                                    <td><?= htmlspecialchars($user_data['username']) ?></td>
                                    <td><?= htmlspecialchars($user_data['name']) ?></td>
                                    <td><?= htmlspecialchars($user_data['gender'] ?? '-') ?></td>
                                    <td><?= htmlspecialchars($user_data['faculty'] ?? '-') ?></td>
                                    <td><?= htmlspecialchars($user_data['batch'] ?? '-') ?></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td><?= htmlspecialchars($user['email']) ?></td>
                            <td><?= htmlspecialchars($user['username']) ?></td>
                            <td><?= htmlspecialchars($user['name']) ?></td>
                            <td><?= htmlspecialchars($user['gender'] ?? '-') ?></td>
                            <td><?= htmlspecialchars($user['faculty'] ?? '-') ?></td>
                            <td><?= htmlspecialchars($user['batch'] ?? '-') ?></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>