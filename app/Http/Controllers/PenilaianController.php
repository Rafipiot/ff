<?php

namespace App\Http\Controllers;

use App\Models\Alternative;
use App\Models\Criteria;
use App\Models\AlternativeScore;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    public function index()
    {
        $alternatives = Alternative::with(['scores.criteria'])->get();
        $criterias = Criteria::all();
        return view('penilaian.index', compact('alternatives', 'criterias'));
    }

    public function create()
    {
        $alternatives = Alternative::all();
        $criterias = Criteria::all();
        return view('penilaian.create', compact('alternatives', 'criterias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'scores' => 'required|array',
            'scores.*' => 'required|array',
            'scores.*.*' => 'required|numeric|min:1|max:5'
        ]);

        foreach ($request->scores as $alternativeId => $scores) {
            foreach ($scores as $criteriaId => $nilai) {
                AlternativeScore::updateOrCreate(
                    [
                        'alternative_id' => $alternativeId,
                        'criteria_id' => $criteriaId
                    ],
                    ['nilai' => $nilai]
                );
            }
        }

        return redirect()->route('penilaian.index')
            ->with('success', 'Penilaian berhasil disimpan');
    }

    public function edit(Alternative $alternative)
    {
        $criterias = Criteria::all();
        return view('penilaian.edit', compact('alternative', 'criterias'));
    }

    public function update(Request $request, Alternative $alternative)
    {
        $request->validate([
            'scores' => 'required|array',
            'scores.*' => 'required|numeric|min:1|max:5'
        ]);

        foreach ($request->scores as $criteriaId => $nilai) {
            AlternativeScore::updateOrCreate(
                [
                    'alternative_id' => $alternative->id,
                    'criteria_id' => $criteriaId
                ],
                ['nilai' => $nilai]
            );
        }

        return redirect()->route('penilaian.index')
            ->with('success', 'Penilaian berhasil diperbarui');
    }
}