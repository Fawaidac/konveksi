<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pesanan extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'color_id',
        'produk_id',
        'bank_id',
        'bahan_baku_id',
        'qty',
        'grand_total',
        'status',
        'bukti',
        'status_pembayaran',
        'detail_pesanan',
        'detail_alamat',
    ];

    protected $table = 'pesanan';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
    public function pengiriman(): HasOne
    {
        return $this->hasOne(Pengiriman::class);
    }
    public function detailPesanan()
    {
        return $this->hasMany(DetailPesanan::class);
    }
}
