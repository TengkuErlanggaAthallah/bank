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
    // Definisikan relasi dengan model Nasabah
    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class);
    }

    // Relasi dengan model Transaksi
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'akun_id');
    }
    public function pengirim()
    {
        return $this->belongsTo(Akun::class, 'pengirim_id'); // Pastikan 'pengirim_id' adalah kolom yang benar
    }

    public function penerima()
    {
        return $this->belongsTo(Akun::class, 'penerima_id'); // Pastikan 'penerima_id' adalah kolom yang benar
    }
}