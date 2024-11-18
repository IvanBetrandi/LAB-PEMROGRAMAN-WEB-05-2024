<!-- resources/views/categories/edit.blade.php -->
@extends('layouts.app')

@section('title', 'Edit Category')

@section('content')
<h1>Edit Category</h1>

<form action="{{ route('categories.update', $category->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="name" class="form-label">Category Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description">{{ $category->description }}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Update Category</button>
</form>
@endsection
