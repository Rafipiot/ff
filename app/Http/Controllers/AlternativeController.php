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
            'nama' => 'required|string|max:255'
        ]);

        Alternative::create([
            'nama' => $request->nama
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
            'nama' => 'required|string|max:255'
        ]);

        $alternative->update([
            'nama' => $request->nama
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