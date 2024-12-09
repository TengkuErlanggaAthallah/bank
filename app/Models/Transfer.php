<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;

    protected $table = 'transfer';

    protected $fillable = [
        'nama_pengirim',
        'nama_penerima',
        'nominal',
        'tanggal',
    ];

    public function getPengirimNasabah()
    {
        return Nasabah::where('nama', $this->nama_pengirim)->first();
    }
    
    public function getPenerimaNasabah()
    {
        return Nasabah::where('nama', $this->nama_penerima)->first();
    }
    public function penerima()
    {
        return $this->belongsTo(Akun::class, 'penerima_id'); // Pastikan 'penerima_id' adalah kolom yang benar
    }
    public function pengirim()
    {
        return $this->belongsTo(Akun::class, 'pengirim_id'); // Pastikan 'pengirim_id' adalah kolom yang benar
    }
}