<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'name', 'description', 'price', 'stock'];

    // Relasi: Produk memiliki satu kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi: Produk memiliki banyak log inventaris
    public function inventoryLogs()
    {
        return $this->hasMany(InventoryLog::class);
    }
}
