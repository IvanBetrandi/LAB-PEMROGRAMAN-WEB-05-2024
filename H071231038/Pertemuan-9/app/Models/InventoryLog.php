<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryLog extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'type', 'quantity', 'date'];

    // Relasi: Log inventaris memiliki satu produk
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
