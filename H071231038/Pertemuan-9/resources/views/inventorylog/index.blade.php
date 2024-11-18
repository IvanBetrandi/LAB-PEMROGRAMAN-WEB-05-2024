<!-- resources/views/inventorylog/index.blade.php -->
@extends('layouts.app')

@section('title', 'Inventory Logs')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Inventory Logs</h1>
        <a href="{{ route('inventory-logs.create') }}" class="btn btn-success">+ Add New Inventory Log</a>
    </div>

    <!-- Tabel -->
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Product</th>
                        <th>Type</th>
                        <th>Quantity</th>
                        <th>Date</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($inventoryLogs as $log)
                        <tr>
                            <td>{{ $log->product->name ?? 'Product Not Found' }}</td>
                            <td>
                                <span class="badge {{ $log->type == 'restock' ? 'bg-success' : 'bg-danger' }} text-white">
                                    {{ ucfirst($log->type) }}
                                </span>
                            </td>
                            <td>{{ $log->quantity }}</td>
                            <td>{{ $log->date }}</td>
                            <td class="text-center">
                                <!-- Delete button -->
                                <form action="{{ route('inventory-logs.destroy', $log->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this log?')">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
