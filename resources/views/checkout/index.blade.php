<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Checkout</h1>

        <h2>Items in your Cart</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach ($cartItems as $item)
                        @php $subtotal = $item->product->price * $item->quantity; @endphp
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>${{ number_format($item->product->price, 2) }}</td>
                            <td>${{ number_format($subtotal, 2) }}</td>
                        </tr>
                        @php $total += $subtotal; @endphp
                    @endforeach
                </tbody>
            </table>
        </div>

        <h3 class="mt-4">Total: ${{ number_format($total, 2) }}</h3>

        <!-- Checkout Form -->
        <form action="{{ route('checkout.store') }}" method="POST" class="mt-4">
            @csrf
            <div class="form-group">
                <label for="address">Shipping Address</label>
                <textarea name="address" id="address" class="form-control" rows="3" placeholder="Enter your shipping address" required></textarea>
            </div>

            <div class="form-group">
                <label for="payment_method">Payment Method</label>
                <select name="payment_method" id="payment_method" class="form-control" required>
                    <option value="credit_card">Credit Card</option>
                    <option value="paypal">PayPal</option>
                    <option value="bank_transfer">Bank Transfer</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success btn-lg btn-block">Place Order</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
