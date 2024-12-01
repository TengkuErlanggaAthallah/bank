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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nasabah_id')->constrained()->onDelete('cascade');
            $table->string('jenis_transaksi');
            $table->decimal('jumlah', 15, 2);
            $table->decimal('uang_masuk', 15, 2)->nullable(); // Add this
            $table->decimal('uang_keluar', 15, 2)->nullable(); // Add this
            $table->date('tanggal_transaksi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
