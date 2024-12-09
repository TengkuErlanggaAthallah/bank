<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\Nasabah;
use App\Models\Transaksi;
use App\Models\Transfer;
use Illuminate\Http\Request;

class AkunController extends Controller
{
    public function index()
    {
        $akun = Akun::with('nasabah')->paginate(10); // Adjust the number as needed
        return view('bank.akun.index', compact('akun'));
    }

    public function show($id)
    {
        $akun = Akun::with(['nasabah', 'transaksi'])->findOrFail($id);
        
// Ambil semua transfer yang relevan berdasarkan nama pengirim dan penerima
$transfers = Transfer::where('nama_pengirim', $akun->nasabah->nama)
    ->orWhere('nama_penerima', $akun->nasabah->nama)
    ->get();

// Menghitung jumlah transfer per pengirim
$jumlahTransferPerPengirim = Transfer::select('nama_pengirim', \DB::raw('count(*) as total'))
    ->groupBy('nama_pengirim')
    ->get()
    ->keyBy('nama_pengirim');

return view('bank.akun.show', compact('akun', 'jumlahTransferPerPengirim', 'transfers'));
    }

    public function create()
    {
        $nasabah = Nasabah::all();
        return view('bank.akun.create', compact('nasabah'));
    }

    public function store(Request $request)
    {
        // Validate data
        $validated = $request->validate([
            'nasabah_id' => 'required|exists:nasabah,id',
            'nomor_rekening' => 'required|string|size:10|unique:akun,nomor_rekening', // Ensure it is unique if necessary
            'saldo' => 'required|string', // Temporarily treat it as a string for validation
        ]);
    
        // Format saldo to remove any formatting characters before saving
        $validated['saldo'] = str_replace('.', '', $validated['saldo']); // Remove dots
        $validated['saldo'] = str_replace(',', '.', $validated['saldo']); // Convert comma to dot for database
    
        // Validate that saldo is numeric after formatting
        if (!is_numeric($validated['saldo'])) {
            return redirect()->back()->withErrors(['saldo' => 'Saldo must be a valid number.'])->withInput();
        }
    
        // Convert saldo to a float
        $validated['saldo'] = (float) $validated['saldo'];
    
        // Save akun data
        Akun::create($validated);
    
        return redirect()->route('akun.index')->with('success', 'Akun berhasil ditambahkan .');
    }

    public function edit($id)
    {
        $akun = Akun::findOrFail($id);
        $nasabah = Nasabah::all();
        return view('bank.akun.edit', compact('akun', 'nasabah'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nasabah_id' => 'required',
            'nomor_rekening' => 'required|unique:akun,nomor_rekening,'.$id,
            'saldo' => 'required|numeric',
        ]);

        $akun = Akun::findOrFail($id);
        $akun->update($request->all());

        return redirect()->route('akun.index')->with('success', 'Akun berhasil diperbarui');
    }

    public function destroy($id)
    {
        Akun::destroy($id);
        return redirect()->route('akun.index')->with('success', 'Akun berhasil dihapus');
    }
}
