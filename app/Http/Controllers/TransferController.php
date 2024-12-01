<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transfer; // Make sure to import your Transfer model
use App\Models\Akun; // Make sure to import your Transfer model

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
    
        // Ambil nama pengirim dan penerima
        $pengirim = Akun::with('nasabah')->find($validated['pengirim_id']);
        $penerima = Akun::with('nasabah')->find($validated['penerima_id']);
    
        // Store the transfer in the database
        Transfer::create([
            'nama_pengirim' => $pengirim->nasabah->nama, // Menyimpan nama pengirim
            'nama_penerima' => $penerima->nasabah->nama, // Menyimpan nama penerima
            'nominal' => $validated['nominal'],
            'tanggal' => $validated['tanggal'],
        ]);
    
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

    // Temukan transfer berdasarkan ID dan update
    $transfer = Transfer::findOrFail($id);
    $transfer->update([
        'nama_pengirim' => Akun::find($validated['pengirim_id'])->nasabah->nama,
        'nama_penerima' => Akun::find($validated['penerima_id'])->nasabah->nama,
        'nominal' => $validated['nominal'],
        'tanggal' => $validated['tanggal'],
    ]);

    return redirect()->route('transfer.index')->with('success', 'Transfer updated successfully.');
}
    public function destroy($id)
{
    $transfer = Transfer::findOrFail($id);
    $transfer->delete();

    return redirect()->route('transfer.index')->with('success', 'Transfer deleted successfully.');
}
}