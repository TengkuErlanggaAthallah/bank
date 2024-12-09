<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;

class RiwayatController extends Controller
{
    // TransferController.php
public function Transferdestroy($id)
{
    $transfer = Transfer::findOrFail($id);
    $transfer->delete();

    return redirect()->back()->with('success', 'Riwayat transfer berhasil dihapus.');
}

// TopupController.php
public function topupdestroy($id)
{
    $topup = Transaksi::findOrFail($id);
    $topup->delete();

    return redirect()->back()->with('success', 'Riwayat top up berhasil dihapus.');
}
}
