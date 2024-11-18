<!-- resources/views/inventorylog/create.blade.php -->
@extends('layouts.app')

@section('title', 'Add Inventory Log')

@section('content')
<h1>Add Inventory Log</h1>

<!-- Form untuk menambah log -->
<form action="{{ route('inventory-logs.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="product_id" class="form-label">Product</label>
        <select class="form-select" id="product_id" name="product_id" required>
            <option value="" selected disabled>Select a Product</option>
            @foreach ($products as $product)
                <option value="{{ $product->id }}">{{ $product->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="type" class="form-label">Type</label>
        <select class="form-select" id="type" name="type" required>
            <option value="restock">Restock</option>
            <option value="sold">Sold</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="quantity" class="form-label">Quantity</label>
        <input type="number" class="form-control" id="quantity" name="quantity" min="1" required>
    </div>

    <div class="mb-3">
        <label for="date" class="form-label">Date</label>
        <input type="date" class="form-control" id="date" name="date" required>
    </div>

    <button type="submit" class="btn btn-primary">Save Inventory Log</button>
</form>
@endsection
