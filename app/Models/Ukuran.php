<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ukuran extends Model
{
    use HasFactory;

    protected $fillable = [
        'ukuran',
    ];

    protected $table = 'ukuran';

    public function detail()
    {
        return $this->hasMany(DetailProduk::class);
    }
}
