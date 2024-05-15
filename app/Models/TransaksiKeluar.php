<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TransaksiKeluar extends Model
{
    use HasFactory;

    protected $fillable = [
        'bahan_baku_id',
        'qty',
    ];

    protected $table = 'transaksi_keluar';

    public function bahanBaku()
    {
        return $this->belongsTo(BahanBaku::class, 'bahan_baku_id');
    }
}
