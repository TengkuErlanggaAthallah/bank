<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('akun', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nasabah_id'); // Foreign key ke tabel Nasabah
            $table->string('nomor_rekening')->unique();
            $table->decimal('saldo', 15, 2);
            $table->timestamps();
    
            // Relasi ke tabel Nasabah
            $table->foreign('nasabah_id')->references('id')->on('nasabah')->onDelete('cascade');
        });
    }    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akun');
    }
};
