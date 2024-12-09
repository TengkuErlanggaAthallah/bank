<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    // Kolom yang dapat diisi massal
    protected $fillable = ['akun_id', 'tipe', 'nominal', 'metode_pembayaran'];

    // Relasi dengan model Akun
    public function akun()
    {
        return $this->belongsTo(Akun::class, 'akun_id');
    }
}