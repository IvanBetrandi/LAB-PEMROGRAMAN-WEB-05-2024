<!-- resources/views/categories/create.blade.php -->
@extends('layouts.app')

@section('title', 'Add New Category')

@section('content')
<h1>Add New Category</h1>

<form action="{{ route('categories.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Category Name</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Save Category</button>
</form>
@endsection
