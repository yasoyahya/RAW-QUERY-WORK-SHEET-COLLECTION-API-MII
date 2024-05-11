<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Education;


class EducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $educations = [
            [
                'employee_id' => '1',
                'name' => 'SMKN 7 Jakarta',
                'level' => 'Sma',
                'description' => 'Sekolah Menengah Atas',
                'created_by' => 'admin',
                'created_at' => '2022-12-12',
                'updated_by' => 'admin',
                'updated_at' => '2022-12-12',
            ],
            [
                'employee_id' => '2',
                'name' => 'Universitas Negeri Jakarta',
                'level' => 'Strata 1',
                'description' => 'Sarjana',
                'created_by' => 'admin',
                'created_at' => '2022-12-12',
                'updated_by' => 'admin',
                'updated_at' => '2022-12-12',
            ]
        ];

        // Loop through data karyawan dan masukkan ke dalam database
        foreach ($educations as $education) {
            Education::create([
                'employee_id' => $education['employee_id'],
                'name' => $education['name'],
                'level' => $education['level'],
                'description' => $education['description'],
                'created_by' => $education['created_by'],
                'created_at' => $education['created_at'],
                'updated_by' => $education['updated_by'],
                'updated_at' => $education['updated_at']
            ]);
        }
    }
}
