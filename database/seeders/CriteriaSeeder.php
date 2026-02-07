<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Criteria;

class CriteriaSeeder extends Seeder
{
    public function run()
    {
        $criterias = [
            [
                'nama' => 'Kualitas Pelayanan',
                'bobot' => 0.25,
                'tipe' => 'benefit'
            ],
            [
                'nama' => 'Presensi',
                'bobot' => 0.20,
                'tipe' => 'benefit'
            ],
            [
                'nama' => 'Kedisiplinan',
                'bobot' => 0.15,
                'tipe' => 'benefit'
            ],
            [
                'nama' => 'Kebersihan dan Kepatuhan SOP',
                'bobot' => 0.15,
                'tipe' => 'benefit'
            ],
            [
                'nama' => 'Tingkat Keterlambatan',
                'bobot' => 0.15,
                'tipe' => 'cost'
            ],
            [
                'nama' => 'Pelanggaran Aturan',
                'bobot' => 0.10,
                'tipe' => 'cost'
            ]
        ];

        foreach ($criterias as $criteria) {
            Criteria::create($criteria);
        }
    }
}