<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <!-- Menu sidebar -->
        <div class="d-flex justify-content-between">
            <div class="btn-group">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Dashboard</a>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Products</a>
                <a href="{{ route('categories.index') }}" class="btn btn-secondary">Categories</a>
            </div>
            <div class="btn-group">
                <a href="{{ route('logout') }}" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>

        <hr>

        <!-- Content section -->
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
