<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akun extends Model
{
    use HasFactory;
    protected $table = 'akun';
    protected $fillable = [
        'nasabah_id',
        'nomor_rekening',
        'saldo',
    ];

    // Define the relationship with Nasabah
    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class);
    }
}