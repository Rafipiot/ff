<?php

namespace App\Http\Controllers;

use App\Models\Alternative;
use Illuminate\Http\Request;

class AlternativeController extends Controller
{
    public function index()
    {
        $alternatives = Alternative::all();
        return view('alternative.index', compact('alternatives'));
    }

    public function create()
    {
        return view('alternative.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan,L,P',
            'lama_bekerja' => 'required|integer|min:0',
            'posisi' => 'required|in:kasir,barista,kitchen'
        ]);

        Alternative::create([
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin === 'L' ? 'Laki-laki' : ($request->jenis_kelamin === 'P' ? 'Perempuan' : $request->jenis_kelamin),
            'lama_bekerja' => $request->lama_bekerja,
            'posisi' => $request->posisi
        ]);

        return redirect()->route('alternative.index')
            ->with('success', 'Data karyawan berhasil ditambahkan');
    }

    public function edit(Alternative $alternative)
    {
        return view('alternative.edit', compact('alternative'));
    }

    public function update(Request $request, Alternative $alternative)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan,L,P',
            'lama_bekerja' => 'required|integer|min:0',
            'posisi' => 'required|in:kasir,barista,kitchen'
        ]);

        $alternative->update([
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin === 'L' ? 'Laki-laki' : ($request->jenis_kelamin === 'P' ? 'Perempuan' : $request->jenis_kelamin),
            'lama_bekerja' => $request->lama_bekerja,
            'posisi' => $request->posisi
        ]);

        return redirect()->route('alternative.index')
            ->with('success', 'Data karyawan berhasil diperbarui');
    }

    public function destroy(Alternative $alternative)
    {
        $alternative->delete();
        return redirect()->route('alternative.index')
            ->with('success', 'Data karyawan berhasil dihapus');
    }
}