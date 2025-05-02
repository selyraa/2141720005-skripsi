<?php

namespace Database\Seeders;

use App\Models\DietProgram;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DietProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $diet_programs = [
            [
                'name' => 'Naik BB',
                'description' => 'Program diet untuk meningkatkan berat badan.',
            ],
            [
                'name' => 'Turun BB',
                'description' => 'Program diet untuk menurunkan berat badan.',
            ],
            [
                'name' => 'Turun Lemak',
                'description' => 'Program diet untuk menurunkan lemak tubuh.',
            ],
        ];

        foreach ($diet_programs as $program) {
            $existing = DietProgram::where('name', $program['name'])->first();
            if (! $existing) {
                DietProgram::create([
                    'name' => $program['name'],
                    'description' => $program['description'],
                ]);
            }
        }
    }
}
