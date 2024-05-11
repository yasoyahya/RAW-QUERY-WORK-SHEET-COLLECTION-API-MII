<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EmployeeProfile;

class EmployeeProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employeeProfiles = [
            [
                'employee_id' => '1',
                'place_of_birth' => 'Jakarta',
                'date_of_birth' => '1997-05-02',
                'gender' => 'Laki-Laki',
                'is_married' => true,
                'prof_pict' => null,
                'created_by' => 'admin',
                'updated_by' => 'admin',
                'created_at' => '2022-12-12',
                'updated_at' => '2022-12-12',
            ],
            [
                'employee_id' => '2',
                'place_of_birth' => 'Sukabumi',
                'date_of_birth' => '1996-05-02',
                'gender' => 'Laki-Laki',
                'is_married' => false,
                'prof_pict' => null,
                'created_by' => 'admin',
                'updated_by' => 'admin',
                'created_at' => '2022-12-12',
                'updated_at' => '2022-12-12',
            ],
        ];

        // Loop through data karyawan dan masukkan ke dalam database
        foreach ($employeeProfiles as $employeeProfile) {
            EmployeeProfile::create([
                'employee_id' => $employeeProfile['employee_id'],
                'place_of_birth' => $employeeProfile['place_of_birth'],
                'date_of_birth' => $employeeProfile['date_of_birth'],
                'gender' => $employeeProfile['gender'],
                'is_married' => $employeeProfile['is_married'],
                'prof_pict' => $employeeProfile['prof_pict'],
                'created_by' => $employeeProfile['created_by'],
                'updated_by' => $employeeProfile['updated_by'],
                'created_at' => $employeeProfile['created_at'],
                'updated_at' => $employeeProfile['updated_at'],
            ]);
        }
    }
}
