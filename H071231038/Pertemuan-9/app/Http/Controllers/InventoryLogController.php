<?php

namespace App\Http\Controllers;

use App\Models\InventoryLog;
use App\Models\Product;
use Illuminate\Http\Request;

class InventoryLogController extends Controller
{
    // Menampilkan daftar inventory log
    public function index()
    {
        $inventoryLogs = InventoryLog::with('product')->get();
        return view('inventorylog.index', compact('inventoryLogs'));
    }

    // Menampilkan form untuk membuat inventory log baru
    public function create()
    {
        $products = Product::all();
        return view('inventorylog.create', compact('products'));
    }

    // Menyimpan inventory log baru dan memperbarui stok produk
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|in:restock,sold',
            'quantity' => 'required|integer|min:1',
            'date' => 'required|date',
        ]);

        $product = Product::findOrFail($request->product_id);

        // Validasi stok saat log bertipe "sold"
        if ($request->type === 'sold' && $product->stock < $request->quantity) {
            return redirect()->back()->withErrors(['quantity' => 'Quantity exceeds available stock.']);
        }

        // Buat inventory log dan perbarui stok
        $log = InventoryLog::create($request->all());
        if ($request->type === 'restock') {
            $product->increment('stock', $request->quantity);
        } else {
            $product->decrement('stock', $request->quantity);
        }

        return redirect()->route('inventory-logs.index')->with('success', 'Inventory log created and stock updated.');
    }

    // Menampilkan form untuk mengedit inventory log
    public function edit(InventoryLog $inventoryLog)
    {
        $products = Product::all();
        return view('inventorylog.edit', compact('inventoryLog', 'products'));
    }

    // Memperbarui inventory log dan stok produk terkait
    public function update(Request $request, InventoryLog $inventoryLog)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|in:restock,sold',
            'quantity' => 'required|integer|min:1',
            'date' => 'required|date',
        ]);

        $product = Product::findOrFail($request->product_id);

        // Hitung perubahan kuantitas
        $quantityDifference = $request->quantity - $inventoryLog->quantity;

        // Validasi stok saat log bertipe "sold" dan perubahan stok negatif
        if ($request->type === 'sold' && $quantityDifference > $product->stock) {
            return redirect()->back()->withErrors(['quantity' => 'Updated quantity exceeds available stock.']);
        }

        // Update stok produk
        if ($request->type === 'restock') {
            $product->increment('stock', $quantityDifference);
        } else {
            $product->decrement('stock', $quantityDifference);
        }

        // Update log inventaris
        $inventoryLog->update($request->all());

        return redirect()->route('inventory-logs.index')->with('success', 'Inventory log updated successfully.');
    }

    // Menghapus inventory log 
    public function destroy(InventoryLog $inventoryLog)
{
    
    $inventoryLog->delete();

    return redirect()->route('inventory-logs.index')->with('success', 'Inventory log deleted successfully.');
}
}
