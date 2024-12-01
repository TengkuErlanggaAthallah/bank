<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUangMasukUangKeluarToTransaksiTable extends Migration
{
    public function up()
    {
        Schema::table('transaksi', function (Blueprint $table) {
            $table->decimal('uang_masuk', 15, 2)->nullable()->after('jumlah'); // Add uang_masuk
            $table->decimal('uang_keluar', 15, 2)->nullable()->after('uang_masuk'); // Add uang_keluar
        });
    }

    public function down()
    {
        Schema::table('transaksi', function (Blueprint $table) {
            $table->dropColumn('uang_masuk'); // Remove uang_masuk
            $table->dropColumn('uang_keluar'); // Remove uang_keluar
        });
    }
}
