<?php

namespace App\Http\Controllers;

use App\Models\Nasabah;
use Illuminate\Http\Request;

class NasabahController extends Controller
{
    public function index()
    {
        $nasabah = Nasabah::all();
        return view('bank.nasabah.index', compact('nasabah'));
    }

    public function create()
    {
        return view('bank.nasabah.create');
    }

    public function store(Request $request)
    {
        // Validate data
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'no_ktp' => 'required|string|size:16|unique:nasabah,no_ktp',
            'alamat' => 'required|string|max:255',
            'no_telepon' => 'required|string|size:11',
            'country_code' => 'required|string',
        ]);
    
        // Trim the phone number to remove any extra spaces
        $validated['no_telepon'] = trim($validated['no_telepon']);
        
        // Concatenate country code with the phone number, adding a space
        $validated['no_telepon'] = $validated['country_code'] . ' ' . $validated['no_telepon'];
    
        // Save nasabah data
        Nasabah::create($validated);
    
        return redirect()->route('nasabah.index')->with('success', 'Nasabah berhasil ditambahkan.');
    }

    public function edit(Nasabah $nasabah)
    {
        return view('bank.nasabah.edit', compact('nasabah'));
    }

    public function update(Request $request, Nasabah $nasabah)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_ktp' => 'required|string|size:16|unique:nasabah,no_ktp,' . $nasabah->id,
            'alamat' => 'required|string|max:255',
            'no_telepon' => 'required|string|size:11',
        ]);

        $nasabah->update($request->all());

        return redirect()->route('nasabah.index')->with('success', 'Nasabah berhasil diperbarui');
    }

    public function destroy(Nasabah $nasabah)
    {
        $nasabah->delete();
        return redirect()->route('nasabah.index')->with('success', 'Nasabah berhasil dihapus');
    }
}