<?php

namespace Database\Seeders;

use App\Models\Alternative;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AlternativesSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 30; $i++) {
            Alternative::create([
                'nama' => $faker->name(),
                'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'lama_bekerja' => $faker->numberBetween(1, 20),
            ]);
        }
    }
}
