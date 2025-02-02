@extends('admin.layouts.app')

@section('content')
    <h1>Sửa danh mục</h1>

    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Tên danh mục</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $category->name) }}" required>
        </div>
        <button type="submit" class="btn btn-warning mt-3">Cập nhật danh mục</button>
    </form>
@endsection
