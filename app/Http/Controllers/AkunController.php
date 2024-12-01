<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\Nasabah;
use Illuminate\Http\Request;

class AkunController extends Controller
{
    public function index()
    {
        $akun = Akun::with('nasabah')->paginate(10); // Adjust the number as needed
        return view('bank.akun.index', compact('akun'));
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
