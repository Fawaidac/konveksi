<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Kategori extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
    ];

    protected $table = 'kategori';

    public function produk(): HasOne
    {
        return $this->hasOne(Produk::class);
    }

    public function scopeWithTotalProduk(Builder $query)
    {
        return $query->withCount('produk');
    }
}
