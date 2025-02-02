@extends('admin.layouts.app')

@section('content')
    <h1>Add New Product</h1>
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Product Name:</label>
            <input type="text" class="form-control" name="name" id="name" required>
        </div>

        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" class="form-control" name="price" id="price" step="0.01" required>
        </div>

        <div class="form-group">
            <label for="stock">Stock:</label>
            <input type="number" class="form-control" name="stock" id="stock" required>
        </div>

        <div class="form-group">
            <label for="category_id">Category:</label>
            <select class="form-control" name="category_id" id="category_id">
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Add Product</button>
    </form>

    <hr>

    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary mt-3">Back to Dashboard</a>
@endsection
