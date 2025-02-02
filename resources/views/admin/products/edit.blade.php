@extends('admin.layouts.app')

@section('content')
    <h1>Edit Product</h1>
    <form action="{{ route('products.update', $product) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ $product->name }}" required>
        </div>

        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" class="form-control" name="price" id="price" value="{{ $product->price }}" step="0.01" required>
        </div>

        <div class="form-group">
            <label for="stock">Stock:</label>
            <input type="number" class="form-control" name="stock" id="stock" value="{{ $product->stock }}" required>
        </div>

        <div class="form-group">
            <label for="category_id">Category:</label>
            <select class="form-control" name="category_id" id="category_id" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-warning">Update</button>
    </form>

    <hr>

    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary mt-3">Back to Dashboard</a>
@endsection
