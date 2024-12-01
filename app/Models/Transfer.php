<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;

    // Specify the table associated with the model (optional if follows Laravel conventions)
    protected $table = 'transfer';

    // Define the fillable attributes
    protected $fillable = [
        'nama_pengirim',
        'nama_penerima',
        'nominal',
        'tanggal',
    ];

    // You can also define any relationships here if needed
}