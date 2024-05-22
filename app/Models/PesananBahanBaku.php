<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesananBahanBaku extends Model
{
    use HasFactory;

    protected $fillable = [
        'pesanan_id',
        'bahan_baku_id',
        'qty',
    ];

    protected $table = 'detail_pesanan_bahan_baku';

    public function bahanBaku()
    {
        return $this->belongsTo(BahanBaku::class, 'bahan_baku_id');
    }

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'pesanan_id');
    }
}
