<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1>Your Cart</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach ($cartItems as $item)
                        @php $subtotal = $item->product->price * $item->quantity; @endphp
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>
                                <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="form-control form-control-sm w-auto d-inline">
                                    <button type="submit" class="btn btn-warning btn-sm">Update</button>
                                </form>
                            </td>
                            <td>${{ number_format($item->product->price, 2) }}</td>
                            <td>${{ number_format($subtotal, 2) }}</td>
                            <td>
                                <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                </form>
                            </td>
                        </tr>
                        @php $total += $subtotal; @endphp
                    @endforeach
                </tbody>
            </table>
        </div>

        <h3 class="mt-4">Total: ${{ number_format($total, 2) }}</h3>

        <!-- Checkout Button -->
        @if($cartItems->isNotEmpty())
            <form action="{{ route('checkout.index') }}" method="GET" class="mt-3">
                <button type="submit" class="btn btn-success btn-lg btn-block">Proceed to Checkout</button>
            </form>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
