<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transfer; // Make sure to import your Transfer model
use App\Models\Akun; // Make sure to import your Akun model

class TransferController extends Controller
{
    // Display the list of transfers
    public function index()
    {
        $transfers = Transfer::all(); // Fetch all transfers from the database
        return view('bank.transfer.index', compact('transfers'));
    }

    // Show the form for creating a new transfer
    public function create()
    {
        $akun = Akun::with('nasabah')->get(); // Ambil semua akun beserta data nasabahnya
        return view('bank.transfer.create', compact('akun'));
    }

    // Handle the transfer logic
    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'pengirim_id' => 'required|exists:akun,id',
            'penerima_id' => 'required|exists:akun,id',
            'nominal' => 'required|numeric|min:0',
            'tanggal' => 'required|date',
        ]);
    
        // Ambil akun pengirim dan penerima
        $pengirim = Akun::with('nasabah')->find($validated['pengirim_id']);
        $penerima = Akun::with('nasabah')->find($validated['penerima_id']);
    
        // Cek apakah pengirim memiliki saldo yang cukup
        if ($pengirim->saldo < $validated['nominal']) {
            return redirect()->back()->with('error', 'Saldo pengirim tidak cukup.');
        }

        // Store the transfer in the database
        Transfer::create([
            'nama_pengirim' => $pengirim->nasabah->nama, // Menyimpan nama pengirim
            'nama_penerima' => $penerima->nasabah->nama, // Menyimpan nama penerima
            'nominal' => $validated['nominal'],
            'tanggal' => $validated['tanggal'],
        ]);

        // Update saldo pengirim dan penerima
        $pengirim->saldo -= $validated['nominal'];
        $penerima->saldo += $validated['nominal'];
        $pengirim->save();
        $penerima->save();
    
        return redirect()->route('transfer.index')->with('success', 'Transfer berhasil dilakukan.');
    }

    public function edit($id)
    {
        // Find the transfer by ID
        $transfer = Transfer::findOrFail($id);
        
        // Return the edit view with the transfer data
        return view('bank.transfer.edit', compact('transfer'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data
        $validated = $request->validate([
            'pengirim_id' => 'required|exists:akun,id',
            'penerima_id' => 'required|exists:akun,id',
            'nominal' => 'required|numeric|min:0',
            'tanggal' => 'required|date',
        ]);

        // Temukan transfer berdasarkan ID
        $transfer = Transfer::findOrFail($id);
        
        // Update saldo pengirim dan penerima
        $pengirim = Akun::find($validated['pengirim_id']);
        $penerima = Akun::find($validated['penerima_id']);

        // Cek apakah pengirim memiliki saldo yang cukup
        if ($pengirim->saldo + $transfer->nominal < $validated['nominal']) {
            return redirect()->back()->with('error', 'Saldo pengirim tidak cukup untuk melakukan update.');
        }

        // Update transfer
        $transfer->update([
            'nama_pengirim' => $pengirim->nasabah->nama,
            'nama_penerima' => $penerima->nasabah->nama,
            'nominal' => $validated['nominal'],
            'tanggal' => $validated['tanggal'],
        ]);

        // Update saldo
        $pengirim->saldo += $transfer->nominal; // Kembalikan saldo lama
        $pengirim->saldo -= $validated['nominal']; // Kurangi dengan nominal baru
        $penerima->saldo += $validated['nominal']; // Tambah saldo penerima
        $pengirim->save();
        $penerima->save();

        return redirect()->route('transfer.index')->with('success', 'Transfer updated successfully.');
    }

    public function destroy($id)
    {
        $transfer = Transfer::findOrFail($id);
        // Update the balances before deleting the transfer
        $pengirim = Akun::where('nasabah_id', $transfer->nama_pengirim)->first();
        $penerima = Akun::where('nasabah_id', $transfer->nama_penerima)->first();

        // Adjust the balances
        if ($pengirim && $penerima) {
            $pengirim->saldo += $transfer->nominal; // Restore the sender's balance
            $penerima->saldo -= $transfer->nominal; // Deduct from the receiver's balance
            $pengirim->save();
            $penerima->save();
        }

        $transfer->delete();

        return redirect()->route('transfer.index')->with('success', 'Transfer deleted successfully.');
    }
}