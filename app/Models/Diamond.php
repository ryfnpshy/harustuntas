<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diamond extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_paket',
        'jumlah',
        'harga',
    ];

    // Relasi ke transaksi (jika ada)
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}