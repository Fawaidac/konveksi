<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailProduk extends Model
{
    use HasFactory;

    protected $fillable = [
        'produk_id',
        'color_id',
    ];

    protected $table = 'detail_produk';

    public function detail()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}
