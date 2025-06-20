<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'diamond_id',
        'jumlah_diamond',
        'total_harga',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function diamond()
    {
        return $this->belongsTo(Diamond::class);
    }
}
