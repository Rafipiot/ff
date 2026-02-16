<?php

namespace App\Services;

use App\Models\Alternative;
use App\Models\Criteria;
use Illuminate\Support\Collection;

class AhpTopsisService
{
    protected $alternatives;
    protected $criterias;
    protected $decisionMatrix;
    protected $normalizedMatrix;
    protected $weightedMatrix;
    
    public function __construct()
    {
        $this->criterias = Criteria::all();

        // Hanya ambil alternatif yang sudah memiliki data penilaian
        // sehingga karyawan yang belum dinilai tidak ikut dihitung
        $criteriaCount = $this->criterias->count();

        $this->alternatives = Alternative::with(['scores'])
            ->whereHas('scores')
            ->get()
            ->filter(function ($alternative) use ($criteriaCount) {
                return $alternative->scores->count() >= $criteriaCount;
            })
            ->values();
        $this->decisionMatrix = [];
        $this->normalizedMatrix = [];
        $this->weightedMatrix = [];
    }

    public function process()
    {
        if ($this->alternatives->isEmpty() || $this->criterias->isEmpty()) {
            return collect([]);
        }

        $this->createDecisionMatrix();
        $this->normalizeMatrix();
        $this->createWeightedMatrix();
        
        $idealSolution = $this->findIdealSolution();
        $negativeIdealSolution = $this->findNegativeIdealSolution();
        
        $separationMeasures = $this->calculateSeparationMeasures(
            $idealSolution, 
            $negativeIdealSolution
        );
        
        $relativeCloseness = $this->calculateRelativeCloseness($separationMeasures);
        
        return $this->rankAlternatives($relativeCloseness);
    }

    protected function createDecisionMatrix()
    {
        foreach ($this->alternatives as $alternative) {
            $scores = [];
            foreach ($this->criterias as $criteria) {
                $score = $alternative->scores
                    ->where('criteria_id', $criteria->id)
                    ->first();
                    
                $scores[$criteria->id] = $score ? $score->nilai : 0;
            }
            $this->decisionMatrix[$alternative->id] = $scores;
        }
    }

    protected function normalizeMatrix()
    {
        foreach ($this->criterias as $criteria) {
            $sumSquared = 0;
            
            foreach ($this->alternatives as $alternative) {
                $score = $this->decisionMatrix[$alternative->id][$criteria->id] ?? 0;
                $sumSquared += pow($score, 2);
            }
            $root = sqrt($sumSquared);
            
            if ($root > 0) {
                foreach ($this->alternatives as $alternative) {
                    $score = $this->decisionMatrix[$alternative->id][$criteria->id] ?? 0;
                    $this->normalizedMatrix[$alternative->id][$criteria->id] = $score / $root;
                }
            } else {
                foreach ($this->alternatives as $alternative) {
                    $this->normalizedMatrix[$alternative->id][$criteria->id] = 0;
                }
            }
        }
    }

    protected function createWeightedMatrix()
    {
        foreach ($this->alternatives as $alternative) {
            foreach ($this->criterias as $criteria) {
                $normalizedScore = $this->normalizedMatrix[$alternative->id][$criteria->id] ?? 0;
                $this->weightedMatrix[$alternative->id][$criteria->id] = 
                    $normalizedScore * $criteria->bobot;
            }
        }
    }

    protected function findIdealSolution()
    {
        $idealSolution = [];
        
        foreach ($this->criterias as $criteria) {
            $scores = [];
            foreach ($this->weightedMatrix as $altScores) {
                $scores[] = $altScores[$criteria->id] ?? 0;
            }
            $idealSolution[$criteria->id] = $criteria->isBenefit() ? 
                max($scores) : min($scores);
        }
        
        return $idealSolution;
    }

    protected function findNegativeIdealSolution()
    {
        $negativeIdealSolution = [];
        
        foreach ($this->criterias as $criteria) {
            $scores = [];
            foreach ($this->weightedMatrix as $altScores) {
                $scores[] = $altScores[$criteria->id] ?? 0;
            }
            $negativeIdealSolution[$criteria->id] = $criteria->isBenefit() ? 
                min($scores) : max($scores);
        }
        
        return $negativeIdealSolution;
    }

    protected function calculateSeparationMeasures($idealSolution, $negativeIdealSolution)
    {
        $separationMeasures = [];
        
        foreach ($this->alternatives as $alternative) {
            $dPlus = 0;
            $dMinus = 0;
            
            foreach ($this->criterias as $criteria) {
                $weightedScore = $this->weightedMatrix[$alternative->id][$criteria->id] ?? 0;
                
                $dPlus += pow($weightedScore - ($idealSolution[$criteria->id] ?? 0), 2);
                $dMinus += pow($weightedScore - ($negativeIdealSolution[$criteria->id] ?? 0), 2);
            }
            
            $separationMeasures[$alternative->id] = [
                'dPlus' => sqrt($dPlus),
                'dMinus' => sqrt($dMinus)
            ];
        }
        
        return $separationMeasures;
    }

    protected function calculateRelativeCloseness($separationMeasures)
    {
        $relativeCloseness = [];
        
        foreach ($this->alternatives as $alternative) {
            $dPlus = $separationMeasures[$alternative->id]['dPlus'];
            $dMinus = $separationMeasures[$alternative->id]['dMinus'];
            
            if (($dPlus + $dMinus) > 0) {
                $relativeCloseness[$alternative->id] = $dMinus / ($dPlus + $dMinus);
            } else {
                $relativeCloseness[$alternative->id] = 0;
            }
        }
        
        return $relativeCloseness;
    }

    protected function rankAlternatives($relativeCloseness)
    {
        $rankings = [];
        
        foreach ($this->alternatives as $alternative) {
            $rankings[] = [
                'alternative' => $alternative,
                'score' => $relativeCloseness[$alternative->id] ?? 0
            ];
        }
        
        usort($rankings, function($a, $b) {
            return $b['score'] <=> $a['score'];
        });
        
        foreach ($rankings as $index => $ranking) {
            $rankings[$index]['rank'] = $index + 1;
        }
        
        return collect($rankings);
    }
}