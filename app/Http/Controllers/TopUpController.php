<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Akun; // Pastikan Anda menggunakan model yang sesuai
use App\Models\Transaksi; // Pastikan Anda menggunakan model yang sesuai
use Illuminate\Support\Facades\DB; // Untuk menggunakan DB transaction
use Carbon\Carbon; // Untuk menggunakan Carbon

class TopUpController extends Controller
{
    public function create()
    {
        $akun = Akun::with('nasabah')->get(); // Ambil semua akun beserta nasabahnya
        return view('bank.topup.topup', compact('akun'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'account_id' => 'required|exists:akun,id',
            'amount' => 'required|numeric|min:1',
            'metode_pembayaran' => 'required|string',
        ]);
    
        // Temukan akun berdasarkan ID
        $akun = Akun::findOrFail($validated['account_id']);
    
        // Mulai transaksi database
        DB::beginTransaction();
        try {
            // Tambahkan saldo ke akun
            $akun->saldo += $validated['amount'];
            $akun->save();
    
            // Simpan transaksi top-up
            Transaksi::create([
                'akun_id' => $akun->id,
                'tipe' => 'topup',
                'nominal' => $validated['amount'],
                'metode_pembayaran' => $validated['metode_pembayaran'], // Perbaikan di sini
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
    
            // Commit transaksi
            DB::commit();
    
            return redirect()->route('akun.show', $akun->id)->with('success', 'Top Up berhasil!');
        } catch (\Exception $e) {
            // Rollback jika terjadi kesalahan
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat melakukan top up: ' . $e->getMessage());
        }
    }
}