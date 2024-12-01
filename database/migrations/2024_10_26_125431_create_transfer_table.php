<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransferTable extends Migration
{
    public function up()
    {
        Schema::create('transfer', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('nama_pengirim'); // Name of the sender
            $table->string('nama_penerima'); // Name of the receiver
            $table->decimal('nominal', 15, 2); // Amount being transferred
            $table->date('tanggal'); // Date of the transfer
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('transfers');
    }
}