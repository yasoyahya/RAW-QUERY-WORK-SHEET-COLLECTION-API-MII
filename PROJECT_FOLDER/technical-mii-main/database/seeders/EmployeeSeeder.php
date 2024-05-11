<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Employee;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = [
            [
                'nik' => '11012',
                'name' => 'Budi',
                'is_active' => true,
                'start_date' => '2022-12-12',
                'end_date' => '2029-12-12',
            ],
            [
                'nik' => '11013',
                'name' => 'Jarot',
                'is_active' => true,
                'start_date' => '2021-09-01',
                'end_date' => '2028-09-01',
            ]
        ];

        // Loop through data karyawan dan masukkan ke dalam database
        foreach ($employees as $employee) {
            Employee::create([
                'nik' => $employee['nik'],
                'name' => $employee['name'],
                'is_active' => $employee['is_active'],
                'start_date' => $employee['start_date'],
                'end_date' => $employee['end_date'],
            ]);
        }
    }
}
