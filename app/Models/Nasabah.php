<?php

// In App\Models\Nasabah.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nasabah extends Model
{
    use HasFactory;
    protected $table = 'nasabah';
    protected $fillable = ['nama', 'no_ktp', 'alamat', 'no_telepon'];

    // Define the relationship with Transaksi
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'nasabah_id'); // Adjust the foreign key if necessary
    }

    // Define the relationship with Akun if needed
    public function akun()
    {
        return $this->hasOne(Akun::class, 'nasabah_id'); // Adjust the foreign key if necessary
    }
}