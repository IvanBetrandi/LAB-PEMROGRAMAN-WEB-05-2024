<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Product Management')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <style>
        
        body {
            background-color: #f8f9fa;
            color: #343a40;
        }
        .navbar {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        .container {
            max-width: 1000px;
        }
        .content-box {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        .sidebar {
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 15px;
            border-radius: 8px;
            margin-right: 15px;
        }
        .sidebar a {
            color: #007bff;
            font-weight: 500;
            transition: color 0.3s;
        }
        .sidebar a:hover {
            color: #0056b3;
        }
        
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="#">Product Management</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
    </div>
</nav>

<div class="container mt-4 d-flex">
    <div class="sidebar">
        <h5 class="mb-3">Navigation</h5>
        <ul class="list-unstyled">
            <li><a href="{{ route('categories.index') }}"><i class="fas fa-tags"></i> Categories</a></li>
            <li><a href="{{ route('products.index') }}"><i class="fas fa-box"></i> Products</a></li>
            <li><a href="{{ route('inventory-logs.index') }}"><i class="fas fa-clipboard-list"></i> Inventory Logs</a></li>
        </ul>
    </div>

    <div class="content-box flex-fill">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </div>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html> 