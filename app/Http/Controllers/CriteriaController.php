<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use Illuminate\Http\Request;

class CriteriaController extends Controller
{
   public function index()
   {
       $criterias = Criteria::all();
       return view('criteria.index', compact('criterias'));
   }

   public function create()
   {
       return view('criteria.create');
   }

   public function store(Request $request)
   {
       $request->validate([
           'nama' => 'required|string|max:255',
           'bobot' => 'required|numeric|min:0|max:1',
           'tipe' => 'required|in:benefit,cost'
       ]);

       Criteria::create([
           'nama' => $request->nama,
           'bobot' => $request->bobot,
           'tipe' => $request->tipe
       ]);

       return redirect()->route('criteria.index')
           ->with('success', 'Kriteria berhasil ditambahkan');
   }

   public function edit(Criteria $criterion)  // Ubah parameter menjadi $criterion
   {
       return view('criteria.edit', compact('criterion')); // Pass $criterion ke view
   }

   public function update(Request $request, Criteria $criterion) // Ubah parameter menjadi $criterion
   {
       $request->validate([
           'nama' => 'required|string|max:255',
           'bobot' => 'required|numeric|min:0|max:1',
           'tipe' => 'required|in:benefit,cost'
       ]);

       $criterion->update([ // Gunakan $criterion
           'nama' => $request->nama,
           'bobot' => $request->bobot,
           'tipe' => $request->tipe
       ]);

       return redirect()->route('criteria.index')
           ->with('success', 'Kriteria berhasil diperbarui');
   }

   public function destroy(Criteria $criterion) // Ubah parameter menjadi $criterion
   {
       $criterion->delete();
       return redirect()->route('criteria.index')
           ->with('success', 'Kriteria berhasil dihapus');
   }
}