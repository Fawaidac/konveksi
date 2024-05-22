<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DetailPesanan extends Model
{
    use HasFactory;
    protected $fillable = [
        'pesanan_id',
        'bahan_baku_id',
        'ukuran',
        'qty',
    ];

    protected $table = 'detail_pesanan';

    public function bahanBaku()
    {
        return $this->belongsTo(BahanBaku::class);
    }

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }
}
