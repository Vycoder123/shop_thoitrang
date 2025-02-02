@extends('admin.layouts.app')

@section('content')
    <h1>Thêm danh mục mới</h1>

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Tên danh mục</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <button type="submit" class="btn btn-success mt-3">Lưu danh mục</button>
    </form>

    <hr>

    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary mt-3">Back to Dashboard</a>
@endsection
