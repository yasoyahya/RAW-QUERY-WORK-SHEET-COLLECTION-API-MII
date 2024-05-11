<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EmployeeFamily;

class EmployeeFamilySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employeeFamilys = [
            [
                'employee_id' => '1',
                'name' => 'Marni',
                'identifier' => '32100594109960002',
                'job' => 'Ibu Rumah Tangga',
                'place_of_birth' => 'Denpasar',
                'date_of_birth' => '1995-10-17',
                'religion' => 'Islam',
                'is_life' => true,
                'is_divorced' => false,
                'relation_status' => 'Istri',
                'created_by' => 'admin',
                'updated_by' => 'admin',
                'created_at' => '2022-12-12',
                'updated_at' => '2022-12-12',
            ],
            [
                'employee_id' => '1',
                'name' => 'Clara',
                'identifier' => '32100594109020004',
                'job' => 'Pelajar',
                'place_of_birth' => 'Bangkalan',
                'date_of_birth' => '2008-10-17',
                'religion' => 'Islam',
                'is_life' => true,
                'is_divorced' => false,
                'relation_status' => 'Anak',
                'created_by' => 'admin',
                'updated_by' => 'admin',
                'created_at' => '2022-12-12',
                'updated_at' => '2022-12-12',
            ],
            [
                'employee_id' => '1',
                'name' => 'Stephanie',
                'identifier' => '32100594109020005',
                'job' => 'Pelajar',
                'place_of_birth' => 'Bangkalan',
                'date_of_birth' => '2008-10-17',
                'religion' => 'Islam',
                'is_life' => true,
                'is_divorced' => false,
                'relation_status' => 'Anak',
                'created_by' => 'admin',
                'updated_by' => 'admin',
                'created_at' => '2022-12-12',
                'updated_at' => '2022-12-12',
            ],
        ];

        // Loop through data karyawan dan masukkan ke dalam database
        foreach ($employeeFamilys as $employeeFamily) {
            EmployeeFamily::create([
                'employee_id' => $employeeFamily['employee_id'],
                'name' => $employeeFamily['name'],
                'identifier' => $employeeFamily['identifier'],
                'job' => $employeeFamily['job'],
                'place_of_birth' => $employeeFamily['place_of_birth'],
                'date_of_birth' => $employeeFamily['date_of_birth'],
                'religion' => $employeeFamily['religion'],
                'is_life' => $employeeFamily['is_life'],
                'is_divorced' => $employeeFamily['is_divorced'],
                'relation_status' => $employeeFamily['relation_status'],
                'created_by' => $employeeFamily['created_by'],
                'updated_by' => $employeeFamily['updated_by'],
                'created_at' => $employeeFamily['created_at'],
                'updated_at' => $employeeFamily['updated_at'],
            ]);
        }
    }
}
