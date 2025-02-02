<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashion Shop - Home</title>
    <!-- Thêm Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center">
            <h1>Fashion Shop</h1>
            @if(auth()->check())
                <div>
                    <p class="mb-0">Welcome, <strong>{{ auth()->user()->name }}</strong>!</p>
                    <a href="{{ route('logout') }}" class="btn btn-danger btn-sm" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            @else
                <p class="mb-0">Welcome, Guest!</p>
                <a href="{{ route('login.form') }}" class="btn btn-primary btn-sm">Log In</a>
            @endif
        </div>

        <!-- Product List -->
        <h2 class="my-4">Product List</h2>
        <div class="row">
            @foreach($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text"><strong>Price:</strong> ${{ $product->price }}</p>
                            <p class="card-text"><strong>Stock:</strong> {{ $product->stock }}</p>
                            <p class="card-text"><strong>Category:</strong> 
                                {{ $product->category ? $product->category->name : 'No Category' }}
                            </p>
                            @if ($product->stock == 0)
                                <p class="text-danger">Đã hết hàng</p>
                                <button class="btn btn-secondary btn-sm" disabled>Hết hàng</button>
                            @else
                                <form action="{{ route('cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <div class="d-flex align-items-center mb-2">
                                        <input type="number" name="quantity" value="1" min="1" 
                                               max="{{ $product->stock }}" class="form-control me-2" style="width: 80px;">
                                        <button type="submit" class="btn btn-success btn-sm">Add to Cart</button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
